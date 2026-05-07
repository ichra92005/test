import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';

// Side-effect imports to register globals on window
import '../tweaks-panel.jsx';
import './icons.jsx';
import './data.jsx';
import './landing.jsx';
import './app-shell.jsx';
import './section-game.jsx';
import './section-stories.jsx';
import './section-math.jsx';
import './section-spell.jsx';
import './section-coloring.jsx';
import './section-today-history.jsx';
import './section-parent-dashboard.jsx';
import './section-kitchen.jsx';
import './section-dresses.jsx';
import './section-passport.jsx';
import './section-puzzles.jsx';
import './section-national-history.jsx';
import './section-daily-wisdom.jsx';

const { useState: useS_main, useEffect: useE_main } = React;

const PALETTES = {
  warm:   {name:'الدفء الجزائري', clay:'#C0392B', amber:'#E67E22', sun:'#F9C74F', mint:'#2C7A51', cream:'#FFF6E5', paper:'#FFFBF1', soft:'#FFE9C4'},
  cool:   {name:'برودة البحر',     clay:'#2A6FDB', amber:'#3FA9C9', sun:'#7FE4D6', mint:'#1F8A5B', cream:'#EAF6FB', paper:'#F4FBFE', soft:'#D7EDF7'},
  desert: {name:'رمال الصحراء',    clay:'#B5651D', amber:'#D4A574', sun:'#F4D8A8', mint:'#7C8C5B', cream:'#FBF3E2', paper:'#FFF8EA', soft:'#F0E2BF'},
};

function getSessionProfile() {
  try {
    const u = JSON.parse(sessionStorage.getItem('makam_user') || 'null');
    if (u && u.type === 'child') {
      const gender = u.gender || 'boy';
      return {
        id:     u.id,
        name:   u.fname,
        gender,
        avatar: gender === 'girl' ? '/assets/pfp/girl.png' : '/assets/pfp/boy.png',
        age:    u.age || 0,
      };
    }
  } catch {}
  return null;
}

class ErrorBoundary extends React.Component {
  constructor(props) {
    super(props);
    this.state = { hasError: false, error: null, info: null };
  }
  static getDerivedStateFromError(error) { return { hasError: true, error }; }
  componentDidCatch(error, info) {
    this.setState({ info });
    console.error('ErrorBoundary:', error, info);
  }
  render() {
    if (this.state.hasError) {
      return (
        <div style={{padding:40, background:'red', color:'white', minHeight:'100vh', direction:'ltr', textAlign:'left'}}>
          <h1>Something went wrong.</h1>
          <pre>{this.state.error?.toString()}</pre>
          <pre>{this.state.info?.componentStack}</pre>
        </div>
      );
    }
    return this.props.children;
  }
}

function App() {
  const sessionProfile = getSessionProfile();

  // Go straight to app if a real child session exists, otherwise show landing
  const [view, setView]           = useS_main(sessionProfile ? 'app' : 'landing');
  const [activeProfile]           = useS_main(sessionProfile);

  const [t, setTweak] = useTweaks(/*EDITMODE-BEGIN*/{
    "palette": "warm",
    "landingVariant": "hero"
  }/*EDITMODE-END*/);

  useE_main(() => {
    const p = PALETTES[t.palette] || PALETTES.warm;
    const r = document.documentElement.style;
    r.setProperty('--c-clay',  p.clay);
    r.setProperty('--c-amber', p.amber);
    r.setProperty('--c-sun',   p.sun);
    r.setProperty('--c-mint',  p.mint);
    r.setProperty('--c-cream', p.cream);
    r.setProperty('--c-paper', p.paper);
    r.setProperty('--c-soft',  p.soft);
  }, [t.palette]);

  useE_main(() => {
    const l = document.getElementById('loading');
    if (l) l.style.display = 'none';
  }, []);

  const profile = activeProfile || {
    id:'guest', name:'طفل', gender:'boy', avatar:'/assets/pfp/boy.png', age:8,
  };

  return (
    <ErrorBoundary>
      {view === 'landing' && (
        <Landing onEnter={() => setView('app')} variant={t.landingVariant}/>
      )}
      {view === 'app' && (
        <AppShell onExit={() => setView('landing')} palette={t.palette} profile={profile}/>
      )}
      <TweaksPanel title="إعدادات">
        <TweakSection label="النسخة">
          <TweakRadio
            label="الصفحة الرئيسية"
            value={t.landingVariant}
            onChange={v => setTweak('landingVariant', v)}
            options={[{value:'hero', label:'بطل'},{value:'scroll', label:'قصة'}]}
          />
        </TweakSection>
        <TweakSection label="الألوان">
          <TweakColor
            label="اللوحة"
            value={t.palette}
            onChange={v => setTweak('palette', v)}
            options={['warm','cool','desert']}
          />
        </TweakSection>
        <TweakSection label="تنقّل">
          <TweakButton label="الصفحة الرئيسية" onClick={() => setView('landing')}/>
          <TweakButton label="صفحة الطفل"      onClick={() => setView('app')}/>
        </TweakSection>
      </TweaksPanel>
    </ErrorBoundary>
  );
}

ReactDOM.createRoot(document.getElementById('root')).render(<App/>);
