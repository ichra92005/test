"""
╔══════════════════════════════════════════════════════════════════╗
║     GAM — CATNAT SEISMIC PORTFOLIO ANALYSIS                     ║
║     Complete step-by-step notebook — run cell by cell           ║
║     Starting file: CATNAT_2023_2025.csv                         ║
║                                                                  ║
║  HOW TO USE THIS FILE:                                          ║
║  Option A — Jupyter: jupyter notebook → open this file          ║
║  Option B — Run all at once: python GAM_CATNAT_notebook.py      ║
║  Option C — Kaggle: upload this file + the CSV → run            ║
╚══════════════════════════════════════════════════════════════════╝
"""

# ════════════════════════════════════════════════════════════════
# CELL 0 — INSTALL LIBRARIES (run this ONCE, then never again)
# ════════════════════════════════════════════════════════════════
# In terminal/cmd first run:
#   pip install pandas numpy catboost matplotlib seaborn

import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
import json, warnings, re
warnings.filterwarnings('ignore')
print("✓ Libraries loaded")


# ════════════════════════════════════════════════════════════════
# CELL 1 — LOAD THE RAW CSV
# ════════════════════════════════════════════════════════════════
# WHAT THIS DOES: Opens your raw file and shows you what is inside.
# WHY: The file has a weird title row on line 1 — we skip it.
# ────────────────────────────────────────────────────────────────

df_raw = pd.read_csv(
    'CATNAT_2023_2025.csv',   # ← put the file in the same folder as this script
    skiprows=1,                # skip the first line "2023: Table 1"
    encoding='ascii',
    dtype=str                  # load everything as text first — safest
)

print("=" * 55)
print("CELL 1 — RAW DATA LOADED")
print("=" * 55)
print(f"Shape   : {df_raw.shape[0]:,} rows × {df_raw.shape[1]} columns")
print(f"Columns : {df_raw.columns.tolist()}")
print()
print("First 3 rows:")
print(df_raw.head(3).to_string())


# ════════════════════════════════════════════════════════════════
# CELL 2 — REMOVE GARBAGE ROWS
# ════════════════════════════════════════════════════════════════
# WHAT THIS DOES: Removes 2 rows where the header got duplicated
#                 inside the data. Like finding a page title in
#                 the middle of a table.
# ────────────────────────────────────────────────────────────────

df = df_raw.copy()
before = len(df)

# Remove rows where NUMERO_POLICE literally says "NUMERO_POLICE"
df = df[df['NUMERO_POLICE'] != 'NUMERO_POLICE']
df = df[df['NUMERO_POLICE'] != 'TYPE']
df = df.dropna(how='all')

after = len(df)
print("=" * 55)
print("CELL 2 — GARBAGE ROWS REMOVED")
print("=" * 55)
print(f"Before : {before:,} rows")
print(f"After  : {after:,} rows")
print(f"Removed: {before - after} garbage rows")


# ════════════════════════════════════════════════════════════════
# CELL 3 — FIX CAPITAL_ASSURE (the insured value column)
# ════════════════════════════════════════════════════════════════
# PROBLEM: In Algeria, the decimal separator is a COMMA not a dot.
#          So "2500,000" does NOT mean two million five hundred.
#          It means TWO THOUSAND FIVE HUNDRED (2500.000).
#          We need to replace , with . to make Python understand.
# ────────────────────────────────────────────────────────────────

def fix_number(series):
    """
    Turns '2500,000' → 2500.0
    Turns '1 500 000' → 1500000.0
    Turns 'abc' → NaN (not a number)
    """
    s = series.astype(str).str.strip()
    s = s.replace({'nan': np.nan, 'None': np.nan, '': np.nan})
    s = s.str.replace(r'\s', '', regex=True)  # remove spaces
    def smart_comma(x):
        if pd.isna(x):
            return np.nan
        n_commas = str(x).count(',')
        if n_commas == 1:
            return str(x).replace(',', '.')   # decimal comma → dot
        elif n_commas > 1:
            return str(x).replace(',', '')    # thousands comma → remove
        return x
    s = s.apply(smart_comma)
    return pd.to_numeric(s, errors='coerce')

df['CAPITAL_ASSURE'] = fix_number(df['CAPITAL_ASSURE'])
df['PRIME_NETTE']    = fix_number(df['PRIME_NETTE'])

print("=" * 55)
print("CELL 3 — NUMBERS FIXED")
print("=" * 55)
print(f"CAPITAL_ASSURE — missing values : {df['CAPITAL_ASSURE'].isna().sum()}")
print(f"CAPITAL_ASSURE — min value      : {df['CAPITAL_ASSURE'].min():,.0f}")
print(f"CAPITAL_ASSURE — max value      : {df['CAPITAL_ASSURE'].max():,.0f}")
print(f"PRIME_NETTE    — missing values : {df['PRIME_NETTE'].isna().sum()}")
print(f"PRIME_NETTE    — negative values: {(df['PRIME_NETTE'] < 0).sum():,}")


# ════════════════════════════════════════════════════════════════
# CELL 4 — FIX DATES
# ════════════════════════════════════════════════════════════════
# PROBLEM: Dates are stored as text "03/01/2023".
#          Python cannot do math on text. We convert to real dates.
# ────────────────────────────────────────────────────────────────

df['DATE_EFFET_DT']      = pd.to_datetime(df['DATE_EFFET'],      format='%d/%m/%Y', errors='coerce')
df['DATE_EXPIRATION_DT'] = pd.to_datetime(df['DATE_EXPIRATION'], format='%d/%m/%Y', errors='coerce')
df['ANNEE']              = df['DATE_EFFET_DT'].dt.year.astype('Int64')

print("=" * 55)
print("CELL 4 — DATES FIXED")
print("=" * 55)
print("Year distribution:")
print(df['ANNEE'].value_counts().sort_index().to_string())
print(f"\nDate nulls (rows with no date): {df['DATE_EFFET_DT'].isna().sum():,}")
print("NOTE: 84,000 rows have no date — this is a known data quality issue")


# ════════════════════════════════════════════════════════════════
# CELL 5 — CLEAN WILAYA AND COMMUNE NAMES
# ════════════════════════════════════════════════════════════════
# PROBLEM: Wilaya is stored as "16  - ALGER" or " 16 - ALGER"
#          (with extra spaces). Two rows that mean the same thing
#          look different to Python. We extract just the clean name.
# ────────────────────────────────────────────────────────────────

def clean_code_name(series):
    s = series.astype(str).str.strip()
    s = s.str.replace(r'\s+', ' ', regex=True)  # collapse spaces
    code = s.str.extract(r'^(\d+)\s*-', expand=False)
    code = pd.to_numeric(code, errors='coerce').astype('Int64')
    name = s.str.extract(r'-\s*(.+)$', expand=False)
    name = name.str.strip().str.upper()
    return code, name

df['WILAYA_CODE'],  df['WILAYA']  = clean_code_name(df['WILAYA'])
df['COMMUNE_CODE'], df['COMMUNE'] = clean_code_name(df['COMMUNE'])

print("=" * 55)
print("CELL 5 — WILAYA & COMMUNE NAMES CLEANED")
print("=" * 55)
print(f"Unique Wilayas : {df['WILAYA'].nunique()} (was 112 with duplicates)")
print(f"Unique Communes: {df['COMMUNE'].nunique()}")
print()
print("Sample cleaned names:")
print(df[['WILAYA_CODE','WILAYA','COMMUNE_CODE','COMMUNE']].drop_duplicates().head(8).to_string(index=False))


# ════════════════════════════════════════════════════════════════
# CELL 6 — CLEAN THE TYPE COLUMN
# ════════════════════════════════════════════════════════════════
# PROBLEM: Same type written many different ways:
#   "1 - Installation Industrielle"
#   "1   - Installation Industrielle"   (extra spaces)
#   "Bien immobilier"
#   "BIEN IMMOBILIER"
# We standardize to exactly 3 clean categories.
# ────────────────────────────────────────────────────────────────

def clean_type(val):
    if pd.isna(val) or str(val).strip() in ['', 'TYPE']:
        return np.nan
    v = str(val).upper().strip()
    v = re.sub(r'\s+', ' ', v)
    if 'INDUSTRIEL' in v or v.startswith('1'):
        return 'Installation Industrielle'
    elif 'COMMERC' in v or v.startswith('2'):
        return 'Installation Commerciale'
    elif 'IMMOB' in v or 'BIEN' in v:
        return 'Bien Immobilier'
    return 'Autre'

df['TYPE'] = df['TYPE'].apply(clean_type)

print("=" * 55)
print("CELL 6 — TYPE COLUMN CLEANED")
print("=" * 55)
print(df['TYPE'].value_counts(dropna=False).to_string())


# ════════════════════════════════════════════════════════════════
# CELL 7 — ASSIGN RPA99 SEISMIC ZONES
# ════════════════════════════════════════════════════════════════
# WHAT THIS DOES: This is the key step. We read the official
#   RPA99 document (pages 11-14) and assign each policy its
#   seismic zone based on where it is located.
#
# Zone 0 = negligible risk (Adrar, Bechar, deep south)
# Zone I = low risk
# Zone IIa = medium risk
# Zone IIb = medium-high risk
# Zone III = HIGH RISK (Alger, Tipaza, Boumerdes, Chlef...)
#
# IMPORTANT: Some wilayas have DIFFERENT zones per commune.
#   Example: Blida = Zone III for most communes
#                    BUT Zone IIb for: Meftah, Larbaa, Hammam Melouane...
# ────────────────────────────────────────────────────────────────

from rapidfuzz import process, fuzz

# Official RPA99 Annex 1 — commune-level mapping
RPA99 = {
    1:  {'default':'Zone 0',   'exceptions':{}},
    2:  {'default':'Zone III', 'exceptions':{'EL KARIMIA':'Zone IIb','HARCHOUN':'Zone IIb','SENDJAS':'Zone IIb','OUED SLY':'Zone IIb','BOUKADIR':'Zone IIb','OULED BEN ABDELKADER':'Zone IIa'}},
    3:  {'default':'Zone I',   'exceptions':{}},
    4:  {'default':'Zone I',   'exceptions':{}},
    5:  {'default':'Zone I',   'exceptions':{}},
    6:  {'default':'Zone IIa', 'exceptions':{}},
    7:  {'default':'Zone I',   'exceptions':{}},
    8:  {'default':'Zone 0',   'exceptions':{}},
    9:  {'default':'Zone III', 'exceptions':{'MEFTAH':'Zone IIb','DJEBABRA':'Zone IIb','SOUHANE':'Zone IIb','LARBAA BLIDA':'Zone IIb','OULED SLAMA':'Zone IIb','OULED SELLAM':'Zone IIb','BOUGARA BLIDA':'Zone IIb','HAMMAM MELOUANE':'Zone IIb','AIN ROMANA':'Zone IIb'}},
    10: {'default':'Zone IIa', 'exceptions':{}},
    11: {'default':'Zone 0',   'exceptions':{}},
    12: {'default':'Zone I',   'exceptions':{}},
    13: {'default':'Zone I',   'exceptions':{}},
    14: {'default':'Zone I',   'exceptions':{}},
    15: {'default':'Zone IIa', 'exceptions':{'MIZRANA':'Zone IIb'}},
    16: {'default':'Zone III', 'exceptions':{}},
    17: {'default':'Zone I',   'exceptions':{}},
    18: {'default':'Zone IIa', 'exceptions':{}},
    19: {'default':'Zone IIa', 'exceptions':{}},
    20: {'default':'Zone I',   'exceptions':{}},
    21: {'default':'Zone IIa', 'exceptions':{}},
    22: {'default':'Zone I',   'exceptions':{}},
    23: {'default':'Zone IIa', 'exceptions':{}},
    24: {'default':'Zone IIa', 'exceptions':{}},
    25: {'default':'Zone IIa', 'exceptions':{}},
    26: {'default':'Zone IIa', 'exceptions':{'EL HAMDANIA':'Zone IIb','MEDEA':'Zone IIb','TAMESGUIDA':'Zone IIb','BOU AICHE':'Zone I','CHAHBOUNIA':'Zone I','BOUGHZOUL':'Zone I','SAREG':'Zone I','MEFTAHA':'Zone I','OULED MAREF':'Zone I','EL AOUNET':'Zone I','AIN BOUCIF':'Zone I','SIDI DAMED':'Zone I','AIN OUKSIR':'Zone I','CHENIGUEL':'Zone I'}},
    27: {'default':'Zone IIa', 'exceptions':{'OULED BOUGHALEM':'Zone III','ACHAACHA':'Zone III','KHADRA':'Zone III','NEKMARIA':'Zone III','SIDI LAKHDAR':'Zone IIb','TASGHAIT':'Zone IIb','OULED MAALAH':'Zone IIb'}},
    28: {'default':'Zone I',   'exceptions':{'BENI ILMANE':'Zone IIa','OUNOUGHA':'Zone IIa','HAMMAM DALAA':'Zone IIa','TARMOUNT':'Zone IIa','OULED MANSOUR':'Zone IIa',"M'SILA":'Zone IIa',"M'TARFA":'Zone IIa','MAADID':'Zone IIa','OULED DERRADJ':'Zone IIa','OULED ADDI':'Zone IIa','DAHAHNA':'Zone IIa','BERHOUM':'Zone IIa','AIN KADRA':'Zone IIa','MAGRA':'Zone IIa','BELAIBA':'Zone IIa'}},
    29: {'default':'Zone IIa', 'exceptions':{'AIN FARES':'Zone I','AIN FEKRAN':'Zone I','BOUHANIFIA':'Zone I','GUERDJOU':'Zone I','OUED TARIA':'Zone I','GHRIS':'Zone I','BENAIN':'Zone I','MOKHDA':'Zone I','AOUF':'Zone I','GHAROUS':'Zone I','NESMOT':'Zone I',"M'HAMID":'Zone I','HACHEM':'Zone I','OUED EL ABTAL':'Zone I','AIN FERRAH':'Zone I'}},
    30: {'default':'Zone 0',   'exceptions':{}},
    31: {'default':'Zone IIa', 'exceptions':{}},
    32: {'default':'Zone I',   'exceptions':{}},
    33: {'default':'Zone 0',   'exceptions':{}},
    34: {'default':'Zone IIa', 'exceptions':{}},
    35: {'default':'Zone III', 'exceptions':{'AFIR':'Zone IIb','BENCHOUD':'Zone IIb','TAOUERGA':'Zone IIb','BAGHLIA':'Zone IIb','OUED AISSA':'Zone IIb','NACIRIA':'Zone IIb','BORDJ MENAIL':'Zone IIb','ISSER':'Zone IIb','BENI AMRANE':'Zone IIb','SOUK EL HAD':'Zone IIb','BOUZEGZA KEDAR':'Zone IIb','EL KHAROUBA':'Zone IIb','LARBATACHE':'Zone IIb','KHEMIS EL KHECHNA':'Zone IIb','OULED MOUSSA':'Zone IIb','HAMMADI':'Zone IIb','TIMEZRIT':'Zone IIa','AMMAL':'Zone IIa','CHAABET EL AMEUR':'Zone IIa'}},
    36: {'default':'Zone IIa', 'exceptions':{}},
    37: {'default':'Zone 0',   'exceptions':{}},
    38: {'default':'Zone IIa', 'exceptions':{}},
    39: {'default':'Zone 0',   'exceptions':{}},
    40: {'default':'Zone I',   'exceptions':{}},
    41: {'default':'Zone I',   'exceptions':{}},
    42: {'default':'Zone III', 'exceptions':{}},
    43: {'default':'Zone IIa', 'exceptions':{}},
    44: {'default':'Zone III', 'exceptions':{'TACHETA':'Zone I','ZOUGAGHA':'Zone I','EL ABADIA':'Zone I','AIN BOUYAHIA':'Zone I','EL ATTAF':'Zone I','EL AMRA':'Zone IIb','MEKHTARIA':'Zone IIb','ARIB':'Zone IIb','ROUINA':'Zone IIb','AIN DEFLA':'Zone IIb','BOURASHED':'Zone IIb','ZEDDINE':'Zone IIb','TIBERKANINE':'Zone IIb','SEN ALLAH':'Zone IIb','MELIANA':'Zone IIb','AIN TORKI':'Zone IIb','HAMMAM RIGHA':'Zone IIb','AIN BENIAN':'Zone IIb','HOUCEINIA':'Zone IIb','BOUMADFAA':'Zone IIb'}},
    45: {'default':'Zone I',   'exceptions':{}},
    46: {'default':'Zone IIa', 'exceptions':{}},
    47: {'default':'Zone 0',   'exceptions':{}},
    48: {'default':'Zone IIa', 'exceptions':{'MEDIOUNA':'Zone III','SIDI MHAMED BEN ALI':'Zone III','MAZOUNA':'Zone III','EL GUETTAR':'Zone III','MERDJA SIDI ABED':'Zone IIb','OUED RHIOU':'Zone IIb','OUARTZENZ':'Zone IIb','DJIDIOUIA':'Zone IIb','HAMRI':'Zone IIb','BENI ZENTIS':'Zone IIb'}},
}

def get_zone(wilaya_code, commune_name):
    """
    Returns the RPA99 seismic zone for a wilaya_code + commune.
    Uses fuzzy matching to handle typos in commune names.
    """
    if pd.isna(wilaya_code):
        return None
    wcode = int(wilaya_code)
    if wcode not in RPA99:
        return None
    entry = RPA99[wcode]
    if not entry['exceptions']:
        return entry['default']
    if pd.isna(commune_name) or str(commune_name).strip() == '':
        return entry['default']
    commune_clean = str(commune_name).strip().upper()
    if commune_clean in entry['exceptions']:
        return entry['exceptions'][commune_clean]
    match = process.extractOne(commune_clean, list(entry['exceptions'].keys()),
                                scorer=fuzz.token_sort_ratio, score_cutoff=82)
    if match:
        return entry['exceptions'][match[0]]
    return entry['default']

print("Assigning RPA99 zones (takes ~30 seconds)...")
df['ZONE_RPA'] = df.apply(lambda row: get_zone(row['WILAYA_CODE'], row['COMMUNE']), axis=1)

ZONE_SCORE = {'Zone 0':0, 'Zone I':1, 'Zone IIa':2, 'Zone IIb':3, 'Zone III':4}
ZONE_PML   = {'Zone 0':0.01, 'Zone I':0.05, 'Zone IIa':0.12, 'Zone IIb':0.20, 'Zone III':0.30}

df['ZONE_SCORE'] = df['ZONE_RPA'].map(ZONE_SCORE)
df['PML_RATE']   = df['ZONE_RPA'].map(ZONE_PML)
df['PML_EXPOSE'] = df['CAPITAL_ASSURE'] * df['PML_RATE']

print("=" * 55)
print("CELL 7 — RPA99 SEISMIC ZONES ASSIGNED")
print("=" * 55)
print("Zone distribution in portfolio:")
print(df['ZONE_RPA'].value_counts(dropna=False).to_string())
print(f"\nUnassigned policies: {df['ZONE_RPA'].isna().sum()}")

# ── SAVE: catnat_rpa_precise.csv ──────────────────────────────
cols_precise = ['NUMERO_POLICE','DATE_EFFET_DT','DATE_EXPIRATION_DT','ANNEE',
                'TYPE','WILAYA_CODE','WILAYA','COMMUNE_CODE','COMMUNE',
                'CAPITAL_ASSURE','PRIME_NETTE','ZONE_RPA','ZONE_SCORE','PML_RATE','PML_EXPOSE']
df[cols_precise].to_csv('catnat_rpa_precise.csv', index=False, encoding='utf-8-sig')
print("\n✓ SAVED: catnat_rpa_precise.csv")


# ════════════════════════════════════════════════════════════════
# CELL 8 — CATBOOST AI: FILL MISSING VALUES + RISK SCORE
# ════════════════════════════════════════════════════════════════
# WHAT THIS DOES:
#   Step A: 3 rows have missing CAPITAL_ASSURE. The AI looks at
#           all 123,433 rows that DO have values, learns the pattern,
#           then predicts the 3 missing ones.
#   Step B: Every policy gets a RISK_SCORE = how dangerous it is
#           relative to the whole portfolio.
#
# WHY CATBOOST: It handles text columns (Wilaya, Commune, Type)
#   directly without converting them to numbers. With 1,007 unique
#   communes, this saves huge memory and is more accurate.
# ────────────────────────────────────────────────────────────────

from catboost import CatBoostRegressor

df['TYPE']    = df['TYPE'].fillna('Bien Immobilier')
df['WILAYA']  = df['WILAYA'].fillna('INCONNU')
df['COMMUNE'] = df['COMMUNE'].fillna('INCONNU')

ZONE_WEIGHT = {'Zone 0':1, 'Zone I':2, 'Zone IIa':3, 'Zone IIb':4, 'Zone III':5}
df['ZONE_WEIGHT'] = df['ZONE_RPA'].map(ZONE_WEIGHT).fillna(1)

features     = ['PRIME_NETTE', 'WILAYA', 'COMMUNE', 'TYPE', 'ZONE_WEIGHT']
cat_features = ['WILAYA', 'COMMUNE', 'TYPE']   # CatBoost handles these natively!

train_mask = df['CAPITAL_ASSURE'].notna() & df['PRIME_NETTE'].notna()
pred_mask  = df['CAPITAL_ASSURE'].isna()  & df['PRIME_NETTE'].notna()

X_train = df.loc[train_mask, features].copy()
y_train = df.loc[train_mask, 'CAPITAL_ASSURE'].copy()

print("Training CatBoost model...")
model = CatBoostRegressor(iterations=300, learning_rate=0.1, depth=6,
                           cat_features=cat_features, verbose=0, random_seed=42)
model.fit(X_train, y_train)
print("Model trained!")

if pred_mask.sum() > 0:
    X_pred = df.loc[pred_mask, features].copy()
    df.loc[pred_mask, 'CAPITAL_ASSURE'] = model.predict(X_pred).clip(min=0)
    print(f"Filled {pred_mask.sum()} missing CAPITAL_ASSURE values using AI")

df['PRIME_NETTE'] = df['PRIME_NETTE'].fillna(df['PRIME_NETTE'].median())

# Risk Score: (this policy's capital / total portfolio) × zone danger weight
total_portfolio   = df['CAPITAL_ASSURE'].sum()
df['RISK_SCORE']  = (df['CAPITAL_ASSURE'] / total_portfolio * df['ZONE_WEIGHT'] * 1000).round(4)

def risk_label(score):
    if score >= 0.5:    return 'CRITIQUE'
    elif score >= 0.1:  return 'ELEVE'
    elif score >= 0.02: return 'MODERE'
    else:               return 'FAIBLE'

df['RISK_LABEL'] = df['RISK_SCORE'].apply(risk_label)

print("=" * 55)
print("CELL 8 — CATBOOST AI COMPLETE")
print("=" * 55)
print("Feature importance (which variable matters most):")
for feat, imp in zip(features, model.get_feature_importance()):
    print(f"  {feat:20s}: {imp:.1f}%")
print()
print("Risk label distribution:")
print(df['RISK_LABEL'].value_counts().to_string())

# ── SAVE: gam_master_data.csv ─────────────────────────────────
df.to_csv('gam_master_data.csv', index=False, encoding='utf-8-sig')
print("\n✓ SAVED: gam_master_data.csv (the FINAL master file — use this for everything)")


# ════════════════════════════════════════════════════════════════
# CELL 9 — ZONE ANALYSIS TABLE
# ════════════════════════════════════════════════════════════════
# WHAT THIS DOES: Creates the summary table answering the cahier
#   de charge question: "Cumuls des capitaux par zone de risque"
# ────────────────────────────────────────────────────────────────

zone_order = ['Zone 0','Zone I','Zone IIa','Zone IIb','Zone III']

zone_analysis = df.groupby('ZONE_RPA', dropna=False).agg(
    nb_polices    = ('NUMERO_POLICE', 'count'),
    capital_B     = ('CAPITAL_ASSURE', lambda x: round(x.sum()/1e9, 2)),
    prime_M       = ('PRIME_NETTE',    lambda x: round(x.sum()/1e6, 2)),
    pml_B         = ('PML_EXPOSE',     lambda x: round(x.sum()/1e9, 2)),
).reset_index()

zone_analysis['ratio_prime_pct'] = (
    zone_analysis['prime_M'] * 1e6 /
    (zone_analysis['capital_B'] * 1e9) * 100
).round(4)

zone_analysis['sort_key'] = zone_analysis['ZONE_RPA'].map(
    {z:i for i,z in enumerate(zone_order)}).fillna(99)
zone_analysis = zone_analysis.sort_values('sort_key').drop('sort_key', axis=1)

total_cap   = df['CAPITAL_ASSURE'].sum()
total_pml   = df['PML_EXPOSE'].sum()
total_prime = df['PRIME_NETTE'].sum()

print("=" * 55)
print("CELL 9 — ZONE ANALYSIS")
print("=" * 55)
print(zone_analysis.to_string(index=False))
print()
print(f"TOTAL Capital : {total_cap/1e9:.2f} Billion DZD")
print(f"TOTAL PML     : {total_pml/1e9:.2f} Billion DZD")
print(f"TOTAL Primes  : {total_prime/1e6:.2f} Million DZD")
print()

# Key finding: concentration index
high_risk_pct = df[df['ZONE_RPA'].isin(['Zone III','Zone IIb'])]['CAPITAL_ASSURE'].sum()
print(f"⚠  Zone IIb+III = {high_risk_pct/total_cap*100:.1f}% of total portfolio")
print(f"⚠  ALGER alone  = {df[df['WILAYA']=='ALGER']['CAPITAL_ASSURE'].sum()/total_cap*100:.1f}% of total portfolio")

# ── SAVE: zone_analysis.csv ───────────────────────────────────
zone_analysis.to_csv('zone_analysis.csv', index=False, encoding='utf-8-sig')
print("\n✓ SAVED: zone_analysis.csv")


# ════════════════════════════════════════════════════════════════
# CELL 10 — HOTSPOTS (top dangerous wilayas)
# ════════════════════════════════════════════════════════════════
# WHAT: Top wilayas in Zone IIb and III ranked by capital exposed.
#       These are the "points chauds" from the cahier de charge.
# ────────────────────────────────────────────────────────────────

hotspots = (
    df[df['ZONE_RPA'].isin(['Zone IIb','Zone III'])]
    .groupby(['WILAYA','ZONE_RPA']).agg(
        nb_polices = ('NUMERO_POLICE', 'count'),
        capital_B  = ('CAPITAL_ASSURE', lambda x: round(x.sum()/1e9, 2)),
        pml_B      = ('PML_EXPOSE',     lambda x: round(x.sum()/1e9, 2)),
        prime_M    = ('PRIME_NETTE',    lambda x: round(x.sum()/1e6, 2)),
    ).reset_index()
    .sort_values('capital_B', ascending=False)
    .head(15)
)

print("=" * 55)
print("CELL 10 — TOP HOTSPOTS")
print("=" * 55)
print(hotspots.to_string(index=False))

# ── SAVE: hotspots_precise.csv ────────────────────────────────
hotspots.to_csv('hotspots_precise.csv', index=False, encoding='utf-8-sig')
print("\n✓ SAVED: hotspots_precise.csv")


# ════════════════════════════════════════════════════════════════
# CELL 11 — MONTE CARLO SIMULATION (10,000 years)
# ════════════════════════════════════════════════════════════════
# WHAT: Simulates 10,000 different years. In each year, we roll
#       a dice for each seismic zone: did an earthquake happen?
#       If yes, how much did GAM lose?
#       After 10,000 rolls, we find the 99th percentile loss
#       = the "1-in-100-year worst case" = PML 99%.
# ────────────────────────────────────────────────────────────────

np.random.seed(42)
N = 10_000

zone_capitals = df.groupby('ZONE_RPA')['CAPITAL_ASSURE'].sum()

SCENARIOS = {
    'Zone III': {'cap': zone_capitals.get('Zone III',0), 'prob':0.07,  'mean':0.30, 'std':0.08},
    'Zone IIb': {'cap': zone_capitals.get('Zone IIb',0), 'prob':0.04,  'mean':0.20, 'std':0.06},
    'Zone IIa': {'cap': zone_capitals.get('Zone IIa',0), 'prob':0.025, 'mean':0.12, 'std':0.04},
    'Zone I':   {'cap': zone_capitals.get('Zone I',  0), 'prob':0.010, 'mean':0.05, 'std':0.02},
    'Zone 0':   {'cap': zone_capitals.get('Zone 0',  0), 'prob':0.002, 'mean':0.01, 'std':0.005},
}

print("Running 10,000 Monte Carlo simulations...")
annual_losses = np.zeros(N)
for sim in range(N):
    total = 0
    for zone, p in SCENARIOS.items():
        if np.random.random() < p['prob']:   # did earthquake happen?
            rate = np.clip(np.random.normal(p['mean'], p['std']), 0, 1)
            total += p['cap'] * rate
    annual_losses[sim] = total

pml_90  = np.percentile(annual_losses, 90)
pml_99  = np.percentile(annual_losses, 99)
pml_995 = np.percentile(annual_losses, 99.5)
avg     = np.mean(annual_losses)

print("=" * 55)
print("CELL 11 — MONTE CARLO RESULTS")
print("=" * 55)
print(f"Average annual loss   : {avg/1e9:.2f} Billion DZD")
print(f"PML 90% (1-in-10 yr)  : {pml_90/1e9:.2f} Billion DZD")
print(f"PML 99% (1-in-100 yr) : {pml_99/1e9:.2f} Billion DZD  ← KEY NUMBER")
print(f"PML 99.5% (1-in-200yr): {pml_995/1e9:.2f} Billion DZD")
print(f"Annual primes         : {total_prime/1e6:.2f} Million DZD")
print(f"PML 99% / Primes      : {pml_99/total_prime:.0f}x  ← GAP = CRITICAL RISK")

sim_results = {
    'n_simulations': N,
    'avg_loss_B': round(avg/1e9, 3),
    'pml_90_B':   round(pml_90/1e9, 3),
    'pml_99_B':   round(pml_99/1e9, 3),
    'pml_995_B':  round(pml_995/1e9, 3),
    'total_capital_B':  round(total_cap/1e9, 2),
    'total_prime_M':    round(total_prime/1e6, 2),
    'pml_to_prime_ratio': round(pml_99/total_prime, 1),
}
hist_counts, hist_edges = np.histogram(annual_losses/1e9, bins=80)
hist_data = {'counts': hist_counts.tolist(), 'edges': hist_edges.tolist(),
             'pml_99_B': sim_results['pml_99_B'], 'pml_90_B': sim_results['pml_90_B'],
             'avg_B': sim_results['avg_loss_B']}

with open('simulation_results.json','w') as f: json.dump(sim_results, f, indent=2)
with open('histogram_data.json','w') as f:     json.dump(hist_data, f)
np.save('annual_losses.npy', annual_losses)
print("\n✓ SAVED: simulation_results.json, histogram_data.json, annual_losses.npy")


# ════════════════════════════════════════════════════════════════
# CELL 12 — CHARTS (visualize your results)
# ════════════════════════════════════════════════════════════════
# WHAT: Creates 4 charts saved as PNG images you can use in your
#       report or presentation.
# ────────────────────────────────────────────────────────────────

ZONE_COLORS = {
    'Zone 0':'#43A047', 'Zone I':'#8BC34A',
    'Zone IIa':'#FFC107', 'Zone IIb':'#FF9800', 'Zone III':'#E53935'
}

fig, axes = plt.subplots(2, 2, figsize=(14, 10))
fig.suptitle('GAM — Analyse Sismique CATNAT 2023-2025', fontsize=14, fontweight='bold')

# Chart 1 — Capital by zone (bar)
ax1 = axes[0, 0]
za_plot = zone_analysis[zone_analysis['ZONE_RPA'].notna()].copy()
colors1 = [ZONE_COLORS.get(z,'#888') for z in za_plot['ZONE_RPA']]
bars = ax1.barh(za_plot['ZONE_RPA'], za_plot['capital_B'], color=colors1)
ax1.set_xlabel('Capital (Milliards DZD)')
ax1.set_title('Capital Assuré par Zone RPA99')
for bar, val in zip(bars, za_plot['capital_B']):
    ax1.text(bar.get_width()+2, bar.get_y()+bar.get_height()/2,
             f'{val:.0f}B', va='center', fontsize=9)
ax1.grid(axis='x', alpha=0.3)

# Chart 2 — Monte Carlo histogram
ax2 = axes[0, 1]
ax2.hist(annual_losses/1e9, bins=80, color='#78909C', alpha=0.7, edgecolor='none')
ax2.axvline(avg/1e9,    color='#43A047', linestyle='--', linewidth=2, label=f'Moyenne {avg/1e9:.1f}B')
ax2.axvline(pml_90/1e9, color='#FF9800', linestyle='--', linewidth=2, label=f'PML 90% {pml_90/1e9:.1f}B')
ax2.axvline(pml_99/1e9, color='#E53935', linestyle='-',  linewidth=2.5,label=f'PML 99% {pml_99/1e9:.1f}B')
ax2.set_xlabel('Perte annuelle (Milliards DZD)')
ax2.set_ylabel('Nombre d\'années')
ax2.set_title('Monte Carlo — Distribution des pertes (10 000 ans)')
ax2.legend(fontsize=8)
ax2.grid(alpha=0.3)

# Chart 3 — Top hotspots
ax3 = axes[1, 0]
top10 = hotspots.head(10)
colors3 = [ZONE_COLORS.get(z,'#888') for z in top10['ZONE_RPA']]
ax3.barh(top10['WILAYA'], top10['capital_B'], color=colors3)
ax3.set_xlabel('Capital (Milliards DZD)')
ax3.set_title('Top Wilayas — Zones à Risque Élevé (IIb + III)')
ax3.grid(axis='x', alpha=0.3)

# Chart 4 — Prime/Capital ratio by zone (adequacy check)
ax4 = axes[1, 1]
za_r = zone_analysis[zone_analysis['ZONE_RPA'].notna()].copy()
colors4 = [ZONE_COLORS.get(z,'#888') for z in za_r['ZONE_RPA']]
bars4 = ax4.bar(za_r['ZONE_RPA'], za_r['ratio_prime_pct'], color=colors4)
ax4.set_ylabel('Ratio Prime/Capital (%)')
ax4.set_title('Adéquation Tarifaire — Prime / Capital par Zone')
ax4.tick_params(axis='x', rotation=15)
for bar, val in zip(bars4, za_r['ratio_prime_pct']):
    ax4.text(bar.get_x()+bar.get_width()/2, bar.get_height()+0.001,
             f'{val:.3f}%', ha='center', fontsize=8)
ax4.grid(axis='y', alpha=0.3)

plt.tight_layout()
plt.savefig('catnat_analysis_charts.png', dpi=150, bbox_inches='tight')
plt.show()
print("✓ SAVED: catnat_analysis_charts.png")


# ════════════════════════════════════════════════════════════════
# CELL 13 — FINAL SUMMARY
# ════════════════════════════════════════════════════════════════

print()
print("╔══════════════════════════════════════════════════════╗")
print("║           ALL OUTPUTS CREATED SUCCESSFULLY          ║")
print("╠══════════════════════════════════════════════════════╣")
print("║  catnat_rpa_precise.csv   — clean data + RPA zones  ║")
print("║  gam_master_data.csv      — final file + AI scores  ║")
print("║  zone_analysis.csv        — capital by zone table   ║")
print("║  hotspots_precise.csv     — top dangerous wilayas   ║")
print("║  simulation_results.json  — Monte Carlo PML numbers ║")
print("║  histogram_data.json      — loss distribution data  ║")
print("║  catnat_analysis_charts.png — 4 charts for report   ║")
print("╠══════════════════════════════════════════════════════╣")
print("║  3 KEY NUMBERS TO PRESENT:                          ║")
print(f"║  Portfolio total : {total_cap/1e9:>7.0f} Billion DZD          ║")
print(f"║  PML 99%         : {pml_99/1e9:>7.1f} Billion DZD          ║")
print(f"║  PML / Primes    : {pml_99/total_prime:>7.0f}x                       ║")
print("╚══════════════════════════════════════════════════════╝")
print()
print("NEXT STEP: run   streamlit run app.py   for the dashboard")