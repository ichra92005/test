// Math + Spell sections share a similar grid + lock pattern
const { useState: useS_m, useRef: useRef_m, useEffect: useEffect_m } = React;

function SectionMath({ctx}) {
  const ageBand = ctx?.profile?.ageBand || '7-10';
  const subtitleByBand = {
    '3-6': '6 ألعاب لتعلّم الأرقام والعمليات البسيطة',
    '7-10': 'جمع وطرح وضرب وقسمة وتحديات رقمية',
    '11+': 'رياضيات متقدمة: عمليات مركبة وألغاز',
  };
  const baseGames = (MATH_GAMES || []).filter((g) => {
    if (ageBand !== '3-6' && g.id === 'count') return false;
    return true;
  });
  const extraMathGamesByBand = {
    '7-10': [
      {id:'add-carry', title:'الجمع مع الحمل', desc:'جمع أعداد أكبر خطوة بخطوة', icon:'🧠', level:'متوسط', premium:false},
      {id:'sub-borrow', title:'الطرح مع الاستلاف', desc:'حل تدريجي مع تلميحات', icon:'📉', level:'متوسط', premium:false},
      {id:'mixed-ops', title:'عمليات مختلطة', desc:'اختر العملية الصحيحة بسرعة', icon:'🎯', level:'متقدم', premium:false},
    ],
    '11+': [
      {id:'equations', title:'معادلات سريعة', desc:'أوجد قيمة المجهول', icon:'🧩', level:'متقدم', premium:false},
      {id:'order-ops', title:'ترتيب العمليات', desc:'أسبقية الأقواس والضرب والجمع', icon:'📚', level:'متقدم', premium:false},
      {id:'word-problems', title:'مسائل لفظية', desc:'تطبيق الرياضيات على مواقف واقعية', icon:'📝', level:'متقدم', premium:true},
    ],
  };
  const ageGames = [
    ...baseGames,
    ...(ageBand === '3-6' ? [] : [
      {id:'mul-adv', title:'الضرب المتقدم', desc:'تمارين ضرب أقوى', icon:'✖️', level:'متقدم', premium:false},
      {id:'div-adv', title:'القسمة الذكية', desc:'قسمة مع تحديات', icon:'➗', level:'متقدم', premium:false},
    ]),
    ...(extraMathGamesByBand[ageBand] || []),
  ];

  const sample = ageBand === '3-6'
    ? <CountTamr ctx={ctx}/>
    : ageBand === '7-10'
      ? <MathOpsSample ctx={ctx} ageBand="7-10"/>
      : <MathOpsSample ctx={ctx} ageBand="11+"/>;

  return <LockedGameGrid title="الحساب الممتع" subtitle={subtitleByBand[ageBand] || subtitleByBand['7-10']}
    accent="#2C7A51" bg="#E8F4ED" games={ageGames} ctx={ctx} sample={sample}/>;
}

function CountTamr({ctx}) {
  const [picked, setPicked] = useS_m(null);
  const correct = 3;
  return (
    <div style={{textAlign:'center'}}>
      <div style={{fontSize:14, fontWeight:700, color:'var(--c-mint)', letterSpacing:1}}>· جرب لعبة ·</div>
      <h3 style={{fontFamily:'var(--font-display)', fontSize:28, marginTop:6}}>كم تمرة تشاهد؟</h3>
      <div style={{fontSize:80, margin:'24px 0', letterSpacing:8}}>
        {Array.from({length:3}).map((_,i)=><span key={i}>🌴</span>)}
      </div>
      <div style={{display:'flex', gap:12, justifyContent:'center'}}>
        {[1,2,3,4,5].map(n => (
          <button key={n} onClick={()=>{
            setPicked(n);
            if(n===correct && picked!==correct) ctx?.addPoints?.(10);
          }} className="squish" style={{
            width:60, height:60, borderRadius:18, fontSize:24, fontWeight:800,
            background: picked === n ? (n===correct?'var(--c-mint)':'var(--c-clay)') : '#FFF6E5',
            color: picked === n ? '#FFF6E5' : '#2A1810',
            border:`3px solid ${picked === n ? (n===correct?'var(--c-mint)':'var(--c-clay)') : 'var(--c-soft)'}`,
            boxShadow:'0 4px 0 rgba(0,0,0,.08)'
          }}>{n}</button>
        ))}
      </div>
      {picked === correct && <div style={{marginTop:16, fontSize:18, color:'var(--c-mint)', fontWeight:700}}>أحسنت! +10 نقطة ⭐</div>}
      {picked && picked !== correct && <div style={{marginTop:16, fontSize:18, color:'var(--c-clay)', fontWeight:700}}>حاول مرة أخرى 💪</div>}
    </div>
  );
}

function AdvancedOpsSample({ageBand='7-10', maxTable=10, ctx}) {
  const [step, setStep] = useS_m(0);
  const [picked, setPicked] = useS_m(null);
  const [score, setScore] = useS_m(0);
  const qaByBand = {
    '7-10': [
      {q:'27 + 15 = ؟', opts:['32','40','42','45'], answer:2, tip:'اجمع الآحاد ثم العشرات.'},
      {q:'54 - 18 = ؟', opts:['26','36','46','38'], answer:1, tip:'ابدأ بالآحاد: 14 - 8.'},
      {q:`6 × ${maxTable > 10 ? 10 : 8} = ؟`, opts:['42','46','48','54'], answer:2, tip:'كرّر 6 ثماني مرات.'},
      {q:'72 ÷ 9 = ؟', opts:['7','8','9','10'], answer:1, tip:'ابحث عن العدد الذي إذا ضربته في 9 يعطي 72.'},
    ],
    '11+': [
      {q:'125 + 279 = ؟', opts:['394','404','414','425'], answer:1, tip:'اجمع المئات ثم العشرات ثم الآحاد.'},
      {q:'400 - 167 = ؟', opts:['223','233','243','253'], answer:1, tip:'الاستلاف من خانة المئات.'},
      {q:`12 × ${maxTable > 10 ? 11 : 9} = ؟`, opts:['120','121','132','144'], answer:2, tip:'12 × 10 ثم أضف 12.'},
      {q:'144 ÷ 12 = ؟', opts:['10','11','12','13'], answer:2, tip:'ما حاصل 12 × ؟ = 144'},
    ],
  };
  const qa = qaByBand[ageBand] || qaByBand['7-10'];
  const cur = qa[step];

  const onPick = (index) => {
    if (picked !== null) return;
    setPicked(index);
    if (index === cur.answer) { setScore((s) => s + 1); ctx?.addPoints?.(10); }
  };
  const onNext = () => {
    if (step >= qa.length - 1) return;
    setStep((s) => s + 1);
    setPicked(null);
  };
  const isDone = step === qa.length - 1 && picked !== null;

  return (
    <div style={{textAlign:'center'}}>
      <div style={{fontSize:14, fontWeight:700, color:'var(--c-mint)', letterSpacing:1}}>· تدريب متقدم ·</div>
      <h3 style={{fontFamily:'var(--font-display)', fontSize:28, marginTop:6}}>تدريب العمليات الأساسية</h3>
      <div style={{fontSize:13, color:'#5a3a1f', marginTop:8}}>
        السؤال {step + 1} / {qa.length} · النقاط: {score}
      </div>
      <div style={{fontSize:38, margin:'18px 0 12px', fontWeight:800, color:'#1F3A2B'}}>{cur.q}</div>
      <div style={{display:'flex', gap:12, justifyContent:'center', flexWrap:'wrap'}}>
        {cur.opts.map((o, i) => (
          <button key={i} onClick={()=>onPick(i)} className="squish" style={{
            minWidth:74, height:58, borderRadius:14, fontSize:24, fontWeight:800,
            background: picked === i ? (i===cur.answer?'var(--c-mint)':'var(--c-clay)') : '#FFF6E5',
            color: picked === i ? '#FFF6E5' : '#2A1810',
            border:`3px solid ${picked === i ? (i===cur.answer?'var(--c-mint)':'var(--c-clay)') : 'var(--c-soft)'}`,
            boxShadow:'0 4px 0 rgba(0,0,0,.08)'
          }}>{o}</button>
        ))}
      </div>
      {picked === cur.answer && <div style={{marginTop:12, fontSize:17, color:'var(--c-mint)', fontWeight:700}}>إجابة صحيحة! أحسنت 👏</div>}
      {picked !== null && picked !== cur.answer && <div style={{marginTop:12, fontSize:17, color:'var(--c-clay)', fontWeight:700}}>إجابة غير صحيحة، {cur.tip}</div>}
      {picked !== null && !isDone && (
        <button onClick={onNext} className="squish" style={{
          marginTop:14, padding:'10px 18px', borderRadius:999, background:'var(--c-mint)',
          color:'#FFF6E5', fontWeight:800, border:'2px solid #1F5D3C'
        }}>السؤال التالي</button>
      )}
      {isDone && (
        <div style={{marginTop:14, fontSize:16, fontWeight:800, color:'var(--c-mint)'}}>
          انتهى التدريب! نتيجتك: {score}/{qa.length}
        </div>
      )}
    </div>
  );
}

function MathOpsSample({ageBand='7-10', ctx}) {
  const [activeOp, setActiveOp] = useS_m('add');
  const [picked, setPicked] = useS_m(null);
  const [activeTable, setActiveTable] = useS_m(5);

  const ops = [
    {id:'add', icon:'➕', label:'الجمع',   color:'#2C7A51'},
    {id:'sub', icon:'➖', label:'الطرح',   color:'#C0392B'},
    {id:'mul', icon:'✖️', label:'الضرب',   color:'#E67E22'},
    {id:'div', icon:'➗', label:'القسمة', color:'#7B4CC2'},
  ];

  const qByBand = {
    '7-10': {
      add: {q:'27 + 15 = ؟', opts:['38','40','42','45'], answer:2, tip:'اجمع الآحاد ثم العشرات.'},
      sub: {q:'54 - 18 = ؟', opts:['26','36','46','38'], answer:1, tip:'ابدأ بالآحاد: 14 - 8.'},
      mul: {q:`${activeTable} × 6 = ؟`, opts:[String(activeTable*5), String(activeTable*6), String(activeTable*7), String(activeTable*8)], answer:1, tip:`${activeTable} × 6 = ${activeTable*6}`},
      div: {q:'72 ÷ 9 = ؟', opts:['7','8','9','10'], answer:1, tip:'ابحث عن 9 × ؟ = 72.'},
    },
    '11+': {
      add: {q:'125 + 279 = ؟', opts:['394','404','414','425'], answer:1, tip:'اجمع المئات ثم العشرات.'},
      sub: {q:'400 - 167 = ؟', opts:['223','233','243','253'], answer:1, tip:'استلف من خانة المئات.'},
      mul: {q:`${activeTable} × 11 = ؟`, opts:[String(activeTable*9), String(activeTable*10), String(activeTable*11), String(activeTable*12)], answer:2, tip:`${activeTable} × 11 = ${activeTable*11}`},
      div: {q:'144 ÷ 12 = ؟', opts:['10','11','12','13'], answer:2, tip:'12 × ؟ = 144.'},
    },
  };

  const op = ops.find(o => o.id === activeOp);
  const q = (qByBand[ageBand] || qByBand['7-10'])[activeOp];

  const handlePick = (i) => {
    if (picked !== null) return;
    setPicked(i);
    if (i === q.answer) ctx?.addPoints?.(10);
  };

  const switchOp = (id) => { setActiveOp(id); setPicked(null); };

  return (
    <div style={{textAlign:'center'}}>
      <div style={{fontSize:14, fontWeight:700, color:'var(--c-mint)', letterSpacing:1}}>· اختر العملية ·</div>
      <h3 style={{fontFamily:'var(--font-display)', fontSize:26, marginTop:4}}>تمرين العمليات</h3>

      {/* Operation tabs */}
      <div style={{display:'flex', gap:8, justifyContent:'center', flexWrap:'wrap', margin:'14px 0'}}>
        {ops.map(o => (
          <button key={o.id} onClick={()=>switchOp(o.id)} className="squish" style={{
            padding:'8px 18px', borderRadius:999, fontSize:15, fontWeight:800,
            background: activeOp===o.id ? o.color : '#FFF6E5',
            color: activeOp===o.id ? '#FFF6E5' : '#2A1810',
            border:`3px solid ${o.color}`,
          }}>{o.icon} {o.label}</button>
        ))}
      </div>

      {/* Multiplication table reference (only for mul) */}
      {activeOp === 'mul' && (
        <div style={{marginBottom:12}}>
          <div style={{fontSize:12, color:'#5a3a1f', marginBottom:6}}>اختر جدول الضرب:</div>
          <div style={{display:'flex', flexWrap:'wrap', justifyContent:'center', gap:6}}>
            {[2,3,4,5,6,7,8,9,10].map(n => (
              <button key={n} onClick={()=>{setActiveTable(n); setPicked(null);}} className="squish" style={{
                minWidth:38, height:38, borderRadius:10, fontSize:17, fontWeight:800,
                background: activeTable===n ? op.color : '#FFF6E5',
                color: activeTable===n ? '#FFF6E5' : '#1F3A2B',
                border:`2px solid ${activeTable===n ? op.color : 'var(--c-soft)'}`
              }}>{n}</button>
            ))}
          </div>
          <div style={{
            marginTop:8, border:`2px dashed ${op.color}`, borderRadius:14, padding:10,
            display:'grid', gridTemplateColumns:'repeat(auto-fit, minmax(90px,1fr))', gap:6, background:'#FFF6E5'
          }}>
            {Array.from({length:10}).map((_,i) => (
              <div key={i} style={{fontSize:13, fontWeight:700, color:'#1F3A2B', background:'#F2F8F4', borderRadius:8, padding:'4px 8px'}}>
                {activeTable} × {i+1} = {activeTable*(i+1)}
              </div>
            ))}
          </div>
        </div>
      )}

      {/* Single question */}
      <div style={{
        background: '#FFF6E5', borderRadius:18, padding:'18px', border:`3px solid ${op.color}`,
        marginBottom:12
      }}>
        <div style={{fontSize:34, fontWeight:800, color:'#1F3A2B', marginBottom:14}}>{q.q}</div>
        <div style={{display:'flex', gap:10, justifyContent:'center', flexWrap:'wrap'}}>
          {q.opts.map((opt, i) => (
            <button key={i} onClick={()=>handlePick(i)} className="squish" style={{
              minWidth:70, height:54, borderRadius:14, fontSize:22, fontWeight:800,
              background: picked===i ? (i===q.answer?'var(--c-mint)':'var(--c-clay)') : '#FFF6E5',
              color: picked===i ? '#FFF6E5' : '#2A1810',
              border:`3px solid ${picked===i ? (i===q.answer?'var(--c-mint)':'var(--c-clay)') : 'var(--c-soft)'}`,
              boxShadow:'0 4px 0 rgba(0,0,0,.08)'
            }}>{opt}</button>
          ))}
        </div>
        {picked===q.answer && <div style={{marginTop:10, fontSize:16, color:'var(--c-mint)', fontWeight:700}}>صحيح! +10 نقطة 🌟</div>}
        {picked!==null && picked!==q.answer && (
          <div style={{marginTop:10, fontSize:15, color:'var(--c-clay)', fontWeight:700}}>
            حاول مرة أخرى · تلميح: {q.tip}
          </div>
        )}
        {picked!==null && (
          <button onClick={()=>setPicked(null)} className="squish" style={{
            marginTop:10, padding:'8px 16px', borderRadius:999, background:op.color,
            color:'#FFF6E5', fontWeight:800, fontSize:14, border:'none'
          }}>سؤال آخر</button>
        )}
      </div>
    </div>
  );
}

function PuzzlePreview({ageBand='7-10', ctx}) {
  const ALL_IMGS = [
    {src:'assets/pazzel/Algeria.jpeg',              label:'الجزائر'},
    {src:'assets/pazzel/Algérie Constantine.jpeg',  label:'قسنطينة'},
    {src:'assets/pazzel/Hoggar illustration.jpeg',  label:'الهقار'},
    {src:'assets/pazzel/_ (34).jpeg',               label:'صورة ١'},
    {src:'assets/pazzel/_ (35).jpeg',               label:'صورة ٢'},
    {src:'assets/pazzel/_ (36).jpeg',               label:'صورة ٣'},
  ];

  const [chosenImg, setChosenImg] = useS_m(null);
  const [started, setStarted] = useS_m(false);
  const [dragMeta, setDragMeta] = useS_m(null);
  const [tray, setTray] = useS_m([]);
  const [board, setBoard] = useS_m([]);
  const [pointsGiven, setPointsGiven] = useS_m(false);
  const grid = ageBand === '3-6' ? 3 : ageBand === '11+' ? 6 : 4;
  const pieces = grid * grid;

  const makeShuffled = (size) => {
    const arr = Array.from({length:size}).map((_,i)=>i);
    for(let i=arr.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));const t=arr[i];arr[i]=arr[j];arr[j]=t;}
    return arr;
  };

  const choose = (img) => { setChosenImg(img); setStarted(false); setBoard([]); setTray([]); setPointsGiven(false); };

  const startGame = () => {
    setStarted(true);
    setTray(makeShuffled(pieces));
    setBoard(Array.from({length:pieces}).map(()=>null));
  };

  const onDragStart = (piece, source, sourceIndex) => setDragMeta({piece,source,sourceIndex});

  const dropOnCell = (cellIndex) => {
    if (!dragMeta || board[cellIndex] !== null) return;
    const nb=[...board], nt=[...tray];
    if(dragMeta.source==='tray') nt.splice(dragMeta.sourceIndex,1);
    else if(dragMeta.source==='board') nb[dragMeta.sourceIndex]=null;
    nb[cellIndex]=dragMeta.piece;
    setBoard(nb); setTray(nt); setDragMeta(null);
  };

  const dropOnTray = () => {
    if(!dragMeta||dragMeta.source!=='board') return;
    const nb=[...board],nt=[...tray,dragMeta.piece];
    nb[dragMeta.sourceIndex]=null;
    setBoard(nb);setTray(nt);setDragMeta(null);
  };

  const solved = started && board.length > 0 && board.every((p,idx)=>p===idx);

  useEffect_m(() => {
    if(solved && !pointsGiven){ ctx?.addPoints?.(50); setPointsGiven(true); }
  }, [solved]);

  const pieceStyle = (piece) => ({
    width:'100%', height:'100%', borderRadius:4,
    backgroundImage:`url(${chosenImg?.src})`,
    backgroundSize:`${grid*100}% ${grid*100}%`,
    backgroundPosition:`${-(piece%grid)*100/(grid-1||1)}% ${-Math.floor(piece/grid)*100/(grid-1||1)}%`,
    border:'1px solid rgba(0,0,0,.08)', cursor:'grab',
  });

  // ── IMAGE PICKER ──
  if (!chosenImg) {
    return (
      <div style={{marginTop:16}}>
        <div style={{fontFamily:'var(--font-display)', fontSize:22, fontWeight:700, color:'#1F3A2B', marginBottom:12, textAlign:'center'}}>
          اختر صورة للبازل
        </div>
        <div style={{display:'grid', gridTemplateColumns:'repeat(3, 1fr)', gap:12}}>
          {ALL_IMGS.map(img => (
            <button key={img.src} onClick={()=>choose(img)} className="squish" style={{
              borderRadius:16, overflow:'hidden', border:'3px solid var(--c-mint)',
              background:'#FFF6E5', padding:0, cursor:'pointer', position:'relative'
            }}>
              <img
                src={img.src}
                alt={img.label}
                style={{width:'100%', aspectRatio:'1', objectFit:'cover', display:'block'}}
                onError={e=>{e.target.style.display='none';}}
              />
              <div style={{
                background:'var(--c-mint)', color:'#FFF6E5',
                fontSize:12, fontWeight:800, padding:'6px', textAlign:'center'
              }}>{img.label}</div>
            </button>
          ))}
        </div>
      </div>
    );
  }

  // ── PUZZLE GAME ──
  return (
    <div style={{marginTop:16, background:'#FFF6E5', borderRadius:22, padding:16, border:'2px dashed var(--c-mint)'}}>
      <div style={{display:'flex', gap:12, alignItems:'center', marginBottom:12}}>
        <img src={chosenImg.src} alt="" style={{width:80, height:80, objectFit:'cover', borderRadius:10, border:'2px solid var(--c-soft)'}}/>
        <div style={{flex:1, textAlign:'right'}}>
          <div style={{fontFamily:'var(--font-display)', fontSize:18, fontWeight:700}}>{chosenImg.label} · {pieces} قطعة</div>
          <div style={{display:'flex', gap:8, marginTop:8}}>
            <button onClick={()=>setChosenImg(null)} style={{
              padding:'6px 12px', borderRadius:999, background:'#F0E5D0',
              fontSize:12, fontWeight:700, border:'2px solid #C7B89A', color:'#5a3a1f'
            }}>تغيير الصورة</button>
            <button onClick={startGame} className="squish" style={{
              padding:'6px 12px', borderRadius:999, background:'var(--c-mint)',
              color:'#FFF6E5', fontSize:12, fontWeight:800, border:'none'
            }}>{started?'إعادة':'ابدأ البازل'}</button>
          </div>
        </div>
      </div>

      {started && (
        <div style={{display:'grid', gridTemplateColumns:'1fr 1fr', gap:12}}>
          <div>
            <div style={{fontSize:12, fontWeight:800, color:'#1F3A2B', marginBottom:6}}>القطع</div>
            <div onDragOver={e=>e.preventDefault()} onDrop={dropOnTray}
              style={{minHeight:100, border:'2px dashed #C7B89A', borderRadius:12, padding:6,
                display:'grid', gridTemplateColumns:'repeat(auto-fill,minmax(40px,1fr))', gap:4, background:'#FAF4E7'}}>
              {tray.map((piece,i) => (
                <div key={`t-${piece}-${i}`} draggable onDragStart={()=>onDragStart(piece,'tray',i)} style={{aspectRatio:'1/1'}}>
                  <div style={pieceStyle(piece)}/>
                </div>
              ))}
            </div>
          </div>
          <div>
            <div style={{fontSize:12, fontWeight:800, color:'#1F3A2B', marginBottom:6}}>التركيب</div>
            <div style={{display:'grid', gridTemplateColumns:`repeat(${grid},1fr)`, gap:3,
              background:'#E8F4ED', border:'2px solid #BED8C8', borderRadius:12, padding:4, aspectRatio:'1/1'}}>
              {board.map((piece,cellIdx) => (
                <div key={`c-${cellIdx}`} onDragOver={e=>e.preventDefault()} onDrop={()=>dropOnCell(cellIdx)}
                  style={{background:'#FFF6E5', borderRadius:4, minHeight:20}}>
                  {piece!==null && (
                    <div draggable onDragStart={()=>onDragStart(piece,'board',cellIdx)} style={{width:'100%',height:'100%'}}>
                      <div style={pieceStyle(piece)}/>
                    </div>
                  )}
                </div>
              ))}
            </div>
          </div>
        </div>
      )}

      {solved && (
        <div style={{marginTop:10, color:'var(--c-mint)', fontWeight:800, fontSize:17, textAlign:'center'}}>
          ممتاز! أنهيت البازل +50 نقطة 🎉
        </div>
      )}
    </div>
  );
}

function SectionSpell({ctx}) {
  const ageBand = ctx?.profile?.ageBand || '7-10';
  const isYoung = ageBand === '3-6';
  const isOlder = ageBand === '11+';
  const title = isYoung ? 'الحروف والإملاء' : 'تعلم الإنجليزية';
  const subtitle = isYoung
    ? '4 ألعاب لتعلّم أبجد هوّز'
    : isOlder
      ? '4 ألعاب لمهارات لغة إنجليزية متقدمة'
      : '4 ألعاب لمفردات الإنجليزية الأساسية';
  const spellGamesByBand = {
    '3-6': SPELL_GAMES,
    '7-10': [
      {id:'eng-alpha', title:'English Alphabet', desc:'A-Z مع الصوت', icon:'🔤', level:'سهل', premium:false},
      {id:'eng-vocab', title:'Vocabulary Builder', desc:'ألوان وحيوانات وعائلة', icon:'🧠', level:'متوسط', premium:false},
      {id:'eng-listen', title:'Listening Quiz', desc:'اسمع واختر الإجابة الصحيحة', icon:'🎧', level:'متوسط', premium:false},
      {id:'eng-cvc', title:'CVC Words', desc:'cat / sun / pen', icon:'📖', level:'متوسط', premium:true},
    ],
    '11+': [
      {id:'eng-grammar', title:'Grammar Basics', desc:'nouns / verbs / adjectives', icon:'📚', level:'متقدم', premium:false},
      {id:'eng-writing', title:'Sentence Writing', desc:'كوّن جملة صحيحة', icon:'✍️', level:'متقدم', premium:false},
      {id:'eng-reading', title:'Reading Comprehension', desc:'اقرأ ثم أجب', icon:'📝', level:'متقدم', premium:false},
      {id:'eng-story', title:'Story Creator', desc:'ابدأ قصة قصيرة بالإنجليزية', icon:'✨', level:'متقدم', premium:true},
    ],
  };
  const sampleByBand = {
    '3-6': <AlphaSample/>,
    '7-10': <EnglishStarsSample/>,
    '11+': <EnglishAdvancedSample/>,
  };
  return <LockedGameGrid title={title} subtitle={subtitle}
    accent="#C0392B" bg="#FBE3DF" games={spellGamesByBand[ageBand] || spellGamesByBand['7-10']} ctx={ctx}
    sample={sampleByBand[ageBand] || sampleByBand['7-10']}/>;
}

function AlphaSample() {
  const letters = ['أ','ب','ت','ث','ج','ح','خ'];
  const [picked, setPicked] = useS_m('أ');
  return (
    <div style={{textAlign:'center'}}>
      <div style={{fontSize:14, fontWeight:700, color:'var(--c-clay)', letterSpacing:1}}>· جرب لعبة ·</div>
      <h3 style={{fontFamily:'var(--font-display)', fontSize:28, marginTop:6}}>اختر حرفًا لتسمعه</h3>
      <div style={{
        margin:'24px auto', width:200, height:200, borderRadius:24,
        background:'var(--c-clay)', color:'#FFF6E5', display:'grid', placeItems:'center',
        fontSize:140, fontFamily:'var(--font-display)', fontWeight:700,
        boxShadow:'0 8px 0 #8B2616'
      }}>{picked}</div>
      <div style={{display:'flex', gap:8, justifyContent:'center', flexWrap:'wrap'}}>
        {letters.map(l => (
          <button key={l} onClick={()=>setPicked(l)} className="squish" style={{
            width:50, height:50, borderRadius:14, fontSize:22, fontWeight:800,
            background: picked === l ? 'var(--c-clay)' : '#FFF6E5',
            color: picked === l ? '#FFF6E5' : '#2A1810',
            border:'3px solid var(--c-clay)'
          }}>{l}</button>
        ))}
      </div>
    </div>
  );
}

function EnglishStarsSample() {
  const [idx, setIdx] = useS_m(0);
  const [picked, setPicked] = useS_m(null);
  const [score, setScore] = useS_m(0);
  const questions = [
    {q:'What color is the sky?', opts:['Blue','Banana','Bread'], answer:0},
    {q:'Choose the animal: "Cat"', opts:['🚗 Car','🐱 Cat','🌳 Tree'], answer:1},
    {q:'Complete: I ___ a book.', opts:['am','is','read'], answer:2},
    {q:'How many apples? 🍎🍎🍎', opts:['Two','Three','Five'], answer:1},
  ];
  const cur = questions[idx];
  const onPick = (i) => {
    if (picked !== null) return;
    setPicked(i);
    if (i === cur.answer) setScore((s) => s + 1);
  };
  const next = () => {
    if (idx >= questions.length - 1) return;
    setIdx((v) => v + 1);
    setPicked(null);
  };
  const done = idx === questions.length - 1 && picked !== null;
  return (
    <div style={{textAlign:'center'}}>
      <div style={{fontSize:14, fontWeight:700, color:'var(--c-clay)', letterSpacing:1}}>· English for نجوم ·</div>
      <h3 style={{fontFamily:'var(--font-display)', fontSize:28, marginTop:6}}>Quick English Questions</h3>
      <div style={{fontSize:13, color:'#7a5538', marginTop:8}}>Question {idx + 1}/{questions.length} · Score: {score}</div>
      <div style={{fontSize:30, margin:'16px 0 12px', fontWeight:800, color:'#6D1E17'}}>{cur.q}</div>
      <div style={{display:'flex', gap:10, justifyContent:'center', flexWrap:'wrap'}}>
        {cur.opts.map((opt, i) => (
          <button key={opt} onClick={() => onPick(i)} className="squish" style={{
            minWidth:100, minHeight:52, borderRadius:14, padding:'0 14px', fontSize:18, fontWeight:700,
            background: picked === i ? (i === cur.answer ? 'var(--c-mint)' : 'var(--c-clay)') : '#FFF6E5',
            color: picked === i ? '#FFF6E5' : '#2A1810',
            border:`3px solid ${picked === i ? (i===cur.answer ? 'var(--c-mint)' : 'var(--c-clay)') : 'var(--c-soft)'}`
          }}>
            {opt}
          </button>
        ))}
      </div>
      {picked !== null && !done && (
        <button onClick={next} className="squish" style={{
          marginTop:14, padding:'10px 18px', borderRadius:999, background:'var(--c-clay)',
          color:'#FFF6E5', fontWeight:800, border:'2px solid #8B2616'
        }}>Next Question</button>
      )}
      {done && <div style={{marginTop:14, fontWeight:800, color:'var(--c-mint)'}}>Great! Final score: {score}/{questions.length}</div>}
    </div>
  );
}

function EnglishAdvancedSample() {
  const [picked, setPicked] = useS_m(null);
  const q = {
    prompt:'Choose the correct sentence:',
    opts:['She go to school every day.','She goes to school every day.','She going to school every day.'],
    answer:1,
  };
  return (
    <div style={{textAlign:'center'}}>
      <div style={{fontSize:14, fontWeight:700, color:'var(--c-clay)', letterSpacing:1}}>· English Advanced ·</div>
      <h3 style={{fontFamily:'var(--font-display)', fontSize:26, marginTop:6}}>Grammar Challenge</h3>
      <div style={{fontSize:28, margin:'16px 0 10px', fontWeight:800, color:'#6D1E17'}}>{q.prompt}</div>
      <div style={{display:'grid', gap:8, maxWidth:620, margin:'0 auto'}}>
        {q.opts.map((opt, i) => (
          <button key={opt} onClick={() => setPicked(i)} className="squish" style={{
            minHeight:50, borderRadius:14, padding:'0 14px', fontSize:16, fontWeight:700,
            background: picked === i ? (i === q.answer ? 'var(--c-mint)' : 'var(--c-clay)') : '#FFF6E5',
            color: picked === i ? '#FFF6E5' : '#2A1810',
            border:`3px solid ${picked === i ? (i===q.answer ? 'var(--c-mint)' : 'var(--c-clay)') : 'var(--c-soft)'}`
          }}>
            {opt}
          </button>
        ))}
      </div>
    </div>
  );
}

function LockedGameGrid({title, subtitle, accent, bg, games, ctx, sample, extraPreview=null}) {
  const [showPaywall, setShowPaywall] = useS_m(false);
  return (
    <div style={{padding:'30px 6% 60px', maxWidth:1280, margin:'0 auto'}}>
      <button onClick={()=>ctx.setSection('home')} style={{display:'flex', gap:8, alignItems:'center',
        fontSize:15, fontWeight:700, color:accent, marginBottom:16}}>
        <Icon.Back size={18} color={accent}/> الرئيسية
      </button>

      <div style={{textAlign:'center', marginBottom:32}}>
        <h1 style={{fontFamily:'var(--font-display)', fontSize:48, fontWeight:700}}>{title}</h1>
        <p style={{fontSize:17, color:'#7a5538', marginTop:8}}>{subtitle}</p>
      </div>

      {/* Sample game */}
      <div style={{
        background:bg, borderRadius:32, padding:'30px', border:`3px solid ${accent}`,
        marginBottom:32
      }}>
        {sample}
        {extraPreview}
      </div>

      <div style={{display:'grid', gridTemplateColumns:'repeat(auto-fit, minmax(220px,1fr))', gap:18}}>
        {games.map((g, i) => {
          const locked = g.premium && !ctx.premium;
          return (
            <button key={g.id} onClick={()=>locked ? setShowPaywall(true) : null} className="squish" style={{
              background: locked ? '#F0E5D0' : '#FFF6E5',
              borderRadius:24, padding:'24px 20px', textAlign:'center',
              border:`3px solid ${locked ? '#C7B89A' : accent}`,
              boxShadow:'0 6px 0 rgba(60,30,10,.08)',
              position:'relative', cursor:'pointer',
              opacity: locked ? .85 : 1
            }}>
              {locked && (
                <div style={{position:'absolute', top:12, insetInlineEnd:12,
                  background:'linear-gradient(135deg, #F9C74F, #E67E22)',
                  width:36, height:36, borderRadius:'50%', display:'grid', placeItems:'center',
                  boxShadow:'0 3px 0 rgba(0,0,0,.15)'
                }}>
                  <Icon.Lock size={18} color="#FFF6E5"/>
                </div>
              )}
              <div style={{fontSize:64, marginBottom:10, filter: locked?'grayscale(.4)':'none'}}>{g.icon}</div>
              <div style={{fontFamily:'var(--font-display)', fontSize:18, fontWeight:700}}>{g.title}</div>
              <div style={{fontSize:13, color:'#7a5538', marginTop:4}}>{g.desc}</div>
              <div style={{display:'inline-block', marginTop:12, background:'#FFF6E5',
                padding:'4px 12px', borderRadius:999, fontSize:11, fontWeight:700, color:accent,
                border:`2px solid ${accent}`}}>{g.level}</div>
            </button>
          );
        })}
      </div>

      {showPaywall && <Paywall onClose={()=>setShowPaywall(false)} onUnlock={()=>{ctx.setPremium(true); setShowPaywall(false);}}/>}
    </div>
  );
}

function Paywall({onClose, onUnlock}) {
  return (
    <div style={{
      position:'fixed', inset:0, background:'rgba(42,24,16,.7)', backdropFilter:'blur(4px)',
      display:'grid', placeItems:'center', zIndex:100, padding:20
    }} onClick={onClose}>
      <div onClick={e=>e.stopPropagation()} style={{
        background:'#FFF6E5', borderRadius:32, maxWidth:480, width:'100%',
        border:'4px solid var(--c-amber)', overflow:'hidden',
        boxShadow:'0 20px 60px rgba(0,0,0,.3)'
      }}>
        <div style={{
          background:'linear-gradient(135deg, var(--c-clay), var(--c-amber))',
          padding:'30px 24px', textAlign:'center', color:'#FFF6E5', position:'relative'
        }}>
          <button onClick={onClose} style={{position:'absolute', top:14, insetInlineStart:14, width:36, height:36,
            borderRadius:'50%', background:'rgba(255,255,255,.25)', display:'grid', placeItems:'center'}}>
            <Icon.Close size={18} color="#FFF6E5"/>
          </button>
          <Icon.Crown size={64} color="#F9C74F"/>
          <h2 style={{fontFamily:'var(--font-display)', fontSize:32, fontWeight:700, marginTop:10}}>افتح الكنز!</h2>
          <p style={{fontSize:14, marginTop:6, opacity:.95}}>اشترك في مقام مميّز واستمتع بكلّ الألعاب</p>
        </div>
        <div style={{padding:'24px'}}>
          {[
            'كلّ ألعاب الحساب 🔢',
            'كلّ ألعاب الحروف 📝',
            'القارئ الذكي بدون حدود 🎙',
            'كلّ مناطق الخريطة 🗺',
            'بطاقات نادرة حصرية ⭐',
          ].map((t,i) => (
            <div key={i} style={{display:'flex', gap:10, alignItems:'center', padding:'10px 0', fontSize:15}}>
              <Icon.Check size={20} color="var(--c-mint)"/>{t}
            </div>
          ))}
          <div style={{marginTop:20, padding:'16px', borderRadius:18, background:'#FFE9C4',
            border:'2px solid var(--c-amber)', display:'flex', justifyContent:'space-between', alignItems:'center'}}>
            <div>
              <div style={{fontSize:13, color:'#7a5538'}}>سنويًا</div>
              <div style={{fontFamily:'var(--font-display)', fontSize:30, fontWeight:700, color:'var(--c-clay)'}}>7999 <span style={{fontSize:14, color:'#7a5538'}}>دج</span></div>
            </div>
            <div style={{background:'var(--c-mint)', color:'#FFF6E5', padding:'4px 10px', borderRadius:999,
              fontSize:11, fontWeight:800}}>وفّر 25٪</div>
          </div>
          <button onClick={onUnlock} className="squish" style={{
            width:'100%', marginTop:18, background:'var(--c-clay)', color:'#FFF6E5',
            padding:'18px', borderRadius:999, fontSize:18, fontWeight:800,
            boxShadow:'0 6px 0 #8B2616'
          }}>اشترك الآن 👑</button>
          <button onClick={onClose} style={{
            width:'100%', marginTop:10, padding:'12px', fontSize:14,
            color:'#7a5538', fontWeight:600
          }}>ربما لاحقًا</button>
        </div>
      </div>
    </div>
  );
}

function SectionPazzel({ctx}) {
  const ageBand = ctx?.profile?.ageBand || '7-10';
  return (
    <div style={{padding:'30px 6% 60px', maxWidth:1280, margin:'0 auto'}}>
      <button onClick={()=>ctx.setSection('home')} style={{
        display:'flex', gap:8, alignItems:'center',
        fontSize:15, fontWeight:700, color:'#7B4CC2', marginBottom:16
      }}>
        <Icon.Back size={18} color="#7B4CC2"/> الرئيسية
      </button>
      <div style={{textAlign:'center', marginBottom:32}}>
        <h1 style={{fontFamily:'var(--font-display)', fontSize:48, fontWeight:700}}>بازل الصور</h1>
        <p style={{fontSize:17, color:'#7a5538', marginTop:8}}>ركّب الصورة قطعة بقطعة وتحدّى نفسك!</p>
      </div>
      <PuzzlePreview ageBand={ageBand} ctx={ctx}/>
    </div>
  );
}

function computeStarPoints(cx, cy, outerR, innerR, numPts) {
  let s = '';
  for (let i = 0; i < numPts * 2; i++) {
    const r = i % 2 === 0 ? outerR : innerR;
    const a = (i * Math.PI) / numPts - Math.PI / 2;
    s += `${cx + r * Math.cos(a)},${cy + r * Math.sin(a)} `;
  }
  return s.trim();
}

function ShapeGuide({levelId, W, H}) {
  const cx = W / 2, cy = H / 2;
  const r = Math.min(W, H) * 0.3;
  const d = {stroke:'#7B4CC2', strokeWidth:'4', fill:'none', strokeDasharray:'10,6', opacity:'0.65'};

  if (levelId === 1) return (
    <g>
      <line x1={W*0.08} y1={cy} x2={W*0.92} y2={cy} {...d}/>
      <circle cx={W*0.08} cy={cy} r="7" fill="#7B4CC2" opacity="0.7"/>
      <circle cx={W*0.92} cy={cy} r="7" fill="#7B4CC2" opacity="0.7"/>
      <text x={W*0.08} y={cy-14} fontSize="12" fill="#7B4CC2" opacity="0.8">ابدأ</text>
      <text x={W*0.88} y={cy-14} fontSize="12" fill="#7B4CC2" opacity="0.8">انته</text>
    </g>
  );

  if (levelId === 2) return (
    <g>
      <path d={`M ${cx-r} ${cy} A ${r} ${r} 0 0 0 ${cx+r} ${cy}`}
        stroke="#E67E22" strokeWidth="5" fill="none" opacity="0.85"/>
      <path d={`M ${cx-r} ${cy} A ${r} ${r} 0 0 1 ${cx+r} ${cy}`}
        stroke="#E67E22" strokeWidth="4" fill="none" opacity="0.35" strokeDasharray="10,6"/>
      <text x={cx} y={cy-r-10} textAnchor="middle" fontSize="12" fill="#E67E22" opacity="0.9">أكمل الدائرة ↑</text>
    </g>
  );

  if (levelId === 3) {
    const pts = Array.from({length:5}).map((_,i) => {
      const a = (i*2*Math.PI)/5 - Math.PI/2;
      return [cx+r*Math.cos(a), cy+r*Math.sin(a)];
    });
    return (
      <g>
        <polygon points={computeStarPoints(cx, cy, r, r*0.4, 5)} {...d}/>
        {pts.map(([x,y],i) => (
          <g key={i}>
            <circle cx={x} cy={y} r="10" fill="#F9C74F" opacity="0.85"/>
            <text x={x} y={y+4} textAnchor="middle" fontSize="10" fontWeight="bold" fill="#3a2614">{i+1}</text>
          </g>
        ))}
      </g>
    );
  }

  if (levelId === 4) {
    const rx = cx-r*1.4, ry = cy-r*0.85, rw = r*2.8, rh = r*1.7;
    return (
      <g>
        <rect x={rx} y={ry} width={rw} height={rh} {...d}/>
        {[[rx,ry],[rx+rw,ry],[rx+rw,ry+rh],[rx,ry+rh]].map(([x,y],idx)=>(
          <circle key={idx} cx={x} cy={y} r="6" fill="#C0392B" opacity="0.8"/>
        ))}
      </g>
    );
  }

  if (levelId === 5) {
    const fw=W*0.72, fh=H*0.58, fx=(W-fw)/2, fy=(H-fh)/2;
    const fcx=fx+fw/2, fcy=fy+fh/2, cr=fh*0.27;
    return (
      <g>
        <rect x={fx} y={fy} width={fw} height={fh} fill="none" stroke="#555" strokeWidth="3" opacity="0.5"/>
        <line x1={fcx} y1={fy} x2={fcx} y2={fy+fh} stroke="#555" strokeWidth="2" strokeDasharray="5,4" opacity="0.5"/>
        <text x={fx+fw*0.25} y={fcy+5} textAnchor="middle" fontSize="13" fill="#006233" fontWeight="bold" opacity="0.8">أخضر</text>
        <text x={fx+fw*0.75} y={fcy+5} textAnchor="middle" fontSize="13" fill="#888" fontWeight="bold" opacity="0.8">أبيض</text>
        <circle cx={fcx-cr*0.1} cy={fcy} r={cr} fill="none" stroke="#D21034" strokeWidth="3" strokeDasharray="8,5" opacity="0.7"/>
        <circle cx={fcx+cr*0.35} cy={fcy} r={cr*0.72} fill="white" stroke="none" opacity="0.45"/>
        <polygon points={computeStarPoints(fcx+cr*0.72, fcy, cr*0.23, cr*0.1, 5)}
          fill="none" stroke="#D21034" strokeWidth="2" strokeDasharray="4,3" opacity="0.85"/>
      </g>
    );
  }
  return null;
}

function ShapeDrawer({levelId, color, onDone}) {
  const canvasRef = useRef_m(null);
  const [drawing, setDrawing] = useS_m(false);
  const [hasDrawn, setHasDrawn] = useS_m(false);
  const W = 400, H = 260;

  const getXY = (e, canvas) => {
    const rect = canvas.getBoundingClientRect();
    const sx = canvas.width / rect.width, sy = canvas.height / rect.height;
    const src = e.touches ? e.touches[0] : e;
    return { x:(src.clientX-rect.left)*sx, y:(src.clientY-rect.top)*sy };
  };

  const startDraw = (e) => {
    e.preventDefault();
    const canvas = canvasRef.current; if(!canvas) return;
    const c = canvas.getContext('2d');
    const {x,y} = getXY(e, canvas);
    c.beginPath(); c.moveTo(x,y);
    setDrawing(true); setHasDrawn(true);
  };

  const doDraw = (e) => {
    e.preventDefault();
    if(!drawing) return;
    const canvas = canvasRef.current; if(!canvas) return;
    const c = canvas.getContext('2d');
    const {x,y} = getXY(e, canvas);
    c.strokeStyle = '#C0392B';
    c.lineWidth = 5; c.lineCap = 'round'; c.lineJoin = 'round';
    c.lineTo(x,y); c.stroke();
  };

  const endDraw = () => setDrawing(false);

  const clear = () => {
    const canvas = canvasRef.current; if(!canvas) return;
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
    setHasDrawn(false);
  };

  return (
    <div style={{display:'flex', flexDirection:'column', alignItems:'center', gap:12, marginTop:14}}>
      <div style={{position:'relative', borderRadius:16, overflow:'hidden', border:`3px solid ${color}`, background:'#FFFBF4', maxWidth:'100%'}}>
        <svg width={W} height={H} style={{position:'absolute', inset:0, pointerEvents:'none'}}>
          <ShapeGuide levelId={levelId} W={W} H={H}/>
        </svg>
        <canvas
          ref={canvasRef}
          width={W} height={H}
          style={{display:'block', touchAction:'none', cursor:'crosshair', maxWidth:'100%'}}
          onMouseDown={startDraw} onMouseMove={doDraw} onMouseUp={endDraw} onMouseLeave={endDraw}
          onTouchStart={startDraw} onTouchMove={doDraw} onTouchEnd={endDraw}
        />
      </div>

      <div style={{display:'flex', gap:10}}>
        <button onClick={clear} className="squish" style={{
          padding:'10px 20px', borderRadius:999, background:'#F0E5D0',
          color:'#5a3a1f', fontWeight:800, fontSize:14, border:'2px solid #C7B89A'
        }}>مسح</button>
        <button onClick={onDone} disabled={!hasDrawn} className="squish" style={{
          padding:'10px 24px', borderRadius:999,
          background: hasDrawn ? 'var(--c-mint)' : '#D4B89A',
          color:'#FFF6E5', fontWeight:800, fontSize:14, border:'none',
          opacity: hasDrawn ? 1 : 0.6, cursor: hasDrawn ? 'pointer' : 'not-allowed'
        }}>أنهيت الرسم ✓</button>
      </div>
    </div>
  );
}

function SectionSmartShapes({ctx}) {
  const LEVELS = [
    {id:1, title:'الخط المستقيم', desc:'تعلّم رسم خط مستقيم أفقي من نقطة إلى أخرى', color:'#7B4CC2', icon:'—'},
    {id:2, title:'الدائرة',       desc:'ارسم نصف دائرة أولًا ثم أكملها دائرة كاملة', color:'#E67E22', icon:'○'},
    {id:3, title:'النجمة',         desc:'صل النقاط الخمس المرقمة بخطوط متقاطعة', color:'#F9C74F', icon:'★'},
    {id:4, title:'المستطيل',       desc:'ارسم المستطيل بربط نقاط زواياه الأربع',   color:'#C0392B', icon:'▭'},
    {id:5, title:'علم الجزائر',    desc:'ارسم علم الجزائر: أخضر وأبيض وهلال ونجمة حمراء', color:'#006233', icon:'🇩🇿'},
  ];

  const [levelIdx, setLevelIdx] = useS_m(0);
  const [levelDone, setLevelDone] = useS_m(false);
  const [allDone, setAllDone] = useS_m(false);
  const level = LEVELS[levelIdx];

  const onShapeDone = () => {
    ctx?.addPoints?.(20);
    setLevelDone(true);
  };

  const nextLevel = () => {
    if (levelIdx < LEVELS.length - 1) {
      setLevelIdx(i => i + 1);
      setLevelDone(false);
    } else {
      setAllDone(true);
    }
  };

  if (allDone) return (
    <div style={{padding:'30px 6% 60px', maxWidth:900, margin:'0 auto', textAlign:'center'}}>
      <button onClick={()=>ctx.setSection('home')} style={{display:'flex',gap:8,alignItems:'center',fontSize:15,fontWeight:700,color:'var(--c-mint)',marginBottom:24}}>
        <Icon.Back size={18} color="var(--c-mint)"/> الرئيسية
      </button>
      <div style={{fontSize:80}}>🏆</div>
      <h1 style={{fontFamily:'var(--font-display)', fontSize:42, fontWeight:700, marginTop:16}}>أحسنت! أنهيت الرسم!</h1>
      <p style={{fontSize:18, color:'#7a5538', marginTop:10}}>رسمت جميع الأشكال وحصلت على {LEVELS.length * 20} نقطة 🌟</p>
      <button onClick={()=>ctx.setSection('home')} className="squish" style={{
        marginTop:24, padding:'14px 36px', borderRadius:999,
        background:'var(--c-mint)', color:'#FFF6E5', fontWeight:800, fontSize:18
      }}>العودة للرئيسية</button>
    </div>
  );

  return (
    <div style={{padding:'30px 6% 60px', maxWidth:900, margin:'0 auto'}}>
      <button onClick={()=>ctx.setSection('home')} style={{display:'flex', gap:8, alignItems:'center',
        fontSize:15, fontWeight:700, color:'var(--c-mint)', marginBottom:16}}>
        <Icon.Back size={18} color="var(--c-mint)"/> الرئيسية
      </button>

      <div style={{textAlign:'center', marginBottom:24}}>
        <h1 style={{fontFamily:'var(--font-display)', fontSize:42, fontWeight:700}}>رسم الأشكال</h1>
        <p style={{fontSize:16, color:'#7a5538', marginTop:6}}>تعلّم الرسم خطوة بخطوة من الخط إلى علم الجزائر</p>
      </div>

      {/* Level progress bar */}
      <div style={{display:'flex', gap:8, justifyContent:'center', marginBottom:24, flexWrap:'wrap'}}>
        {LEVELS.map((l, i) => (
          <div key={l.id} style={{
            width:44, height:44, borderRadius:'50%', display:'grid', placeItems:'center',
            fontSize:18, fontWeight:800,
            background: i < levelIdx ? 'var(--c-mint)' : i === levelIdx ? level.color : '#FFE9C4',
            color: i <= levelIdx ? '#FFF6E5' : '#A88E6F',
            border:`3px solid ${i < levelIdx ? 'var(--c-mint)' : i === levelIdx ? level.color : '#E5D4B0'}`,
            boxShadow: i === levelIdx ? `0 0 0 4px ${level.color}44` : 'none',
          }}>
            {i < levelIdx ? '✓' : l.id}
          </div>
        ))}
      </div>

      {/* Current level card */}
      <div style={{
        background:'#FFF6E5', borderRadius:28, padding:'28px',
        border:`3px solid ${level.color}`, boxShadow:'0 8px 0 rgba(60,30,10,.1)'
      }}>
        <div style={{display:'flex', gap:14, alignItems:'center', marginBottom:16}}>
          <div style={{
            width:56, height:56, borderRadius:18, background:level.color,
            display:'grid', placeItems:'center', fontSize:28, color:'#FFF6E5',
            flexShrink:0
          }}>{level.icon}</div>
          <div>
            <div style={{fontSize:11, fontWeight:800, color:level.color, letterSpacing:1}}>المستوى {level.id}</div>
            <div style={{fontFamily:'var(--font-display)', fontSize:24, fontWeight:700, marginTop:2}}>{level.title}</div>
            <div style={{fontSize:14, color:'#7a5538', marginTop:3}}>{level.desc}</div>
          </div>
        </div>

        {!levelDone ? (
          <ShapeDrawer key={levelIdx} levelId={level.id} color={level.color} onDone={onShapeDone}/>
        ) : (
          <div style={{textAlign:'center', padding:'20px 0'}}>
            <div style={{fontSize:52}}>🌟</div>
            <div style={{fontFamily:'var(--font-display)', fontSize:28, fontWeight:700, color:'var(--c-mint)', marginTop:8}}>
              أحسنت! +20 نقطة
            </div>
            <div style={{fontSize:15, color:'#7a5538', marginTop:6}}>
              رسمت {level.title} بنجاح!
            </div>
            <button onClick={nextLevel} className="squish" style={{
              marginTop:18, padding:'14px 36px', borderRadius:999,
              background: level.color, color:'#FFF6E5', fontWeight:800, fontSize:17, border:'none',
              boxShadow:`0 5px 0 rgba(0,0,0,.2)`
            }}>
              {levelIdx < LEVELS.length - 1 ? `المستوى التالي: ${LEVELS[levelIdx+1].title} →` : 'إنهاء 🏆'}
            </button>
          </div>
        )}
      </div>
    </div>
  );
}

window.SectionMath = SectionMath;
window.SectionSpell = SectionSpell;
window.SectionPazzel = SectionPazzel;
window.SectionSmartShapes = SectionSmartShapes;
