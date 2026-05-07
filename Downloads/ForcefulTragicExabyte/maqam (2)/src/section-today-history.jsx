// What happened today section — kid-friendly Algerian history by date
function SectionTodayHistory({ctx}) {
  const { useState: useS_th } = React;
  const [showVideo, setShowVideo] = useS_th(false);
  const now = new Date();
  const key = `${String(now.getMonth()+1).padStart(2,'0')}-${String(now.getDate()).padStart(2,'0')}`;
  const fallback = TODAY_HISTORY_EVENTS['05-08'];
  const event = TODAY_HISTORY_EVENTS[key] || fallback;
  const ageBand = ctx?.profile?.ageBand || '7-10';

  const eventVideos = {
    '11-01': 'assets/STORIES/IMG_9697.MP4',
    '05-08': 'assets/STORIES/IMG_9697.MP4',
    '12-11': 'assets/STORIES/oran.MP4',
    '07-05': 'assets/STORIES/IMG_9697.MP4',
  };
  const videoSrc = eventVideos[key] || 'assets/STORIES/IMG_9697.MP4';

  const eventByBand = {
    short: {
      '3-6': 'قصة اليوم بطريقة بسيطة وممتعة للصغار.',
      '7-10': event.short,
      '11+': `قراءة أعمق لحدث "${event.title}" مع فهم سياقه التاريخي.`,
    },
    story: {
      '3-6': [
        `في ${event.dateLabel} حدث أمر مهم في تاريخ الجزائر.`,
        'كان الناس يحبون وطنهم، وتعاونوا من أجل مستقبل أجمل.',
        'نتعلم من هذا اليوم أن الشجاعة والعمل معًا يصنعان الفرق.',
      ],
      '7-10': event.story,
      '11+': [
        `يُعد ${event.dateLabel} محطة مهمة ضمن مسار تشكّل الوعي الوطني الجزائري.`,
        'تكشف هذه الذكرى ارتباط الحدث التاريخي بالتحولات الاجتماعية والسياسية في تلك المرحلة.',
        'فهم هذا السياق يساعد على قراءة التاريخ كعملية متراكمة لا كحدث معزول.',
      ],
    },
  };
  const shortText = eventByBand.short[ageBand] || event.short;
  const storyParts = eventByBand.story[ageBand] || event.story;

  return (
    <div style={{padding:'30px 6% 60px', maxWidth:1080, margin:'0 auto'}}>
      <button onClick={()=>ctx.setSection('home')} style={{display:'flex', gap:8, alignItems:'center',
        fontSize:15, fontWeight:700, color:'var(--c-clay)', marginBottom:16}}>
        <Icon.Back size={18} color="var(--c-clay)"/> الرئيسية
      </button>

      <div style={{
        background:'linear-gradient(135deg, #FFF6E5, #FFE9C4)',
        border:'3px solid var(--c-amber)', borderRadius:28, padding:'26px 24px',
        display:'grid', gridTemplateColumns:'120px 1fr', gap:18, alignItems:'center'
      }}>
        <img src="assets/storyteller.png" alt="الراوي" style={{width:110, height:110, objectFit:'contain'}}/>
        <div>
          <div style={{fontSize:13, fontWeight:800, color:'var(--c-amber)'}}>ماذا حدث في هذا اليوم؟</div>
          <h1 style={{fontFamily:'var(--font-display)', fontSize:38, marginTop:6}}>{event.title}</h1>
          <div style={{fontSize:14, color:'#7a5538', marginTop:8}}>{event.dateLabel}</div>
        </div>
      </div>

      <div style={{
        marginTop:18, background:'#FFFBF1', border:'3px solid var(--c-soft)', borderRadius:24, padding:'24px'
      }}>
        <p style={{fontSize:18, color:'#5a3a1f', lineHeight:1.9, marginBottom:14}}>{shortText}</p>
        <div style={{display:'grid', gap:10}}>
          {storyParts.map((part, i) => (
            <div key={i} style={{
              background:'#FFF6E5', borderRadius:16, border:'2px solid var(--c-soft)',
              padding:'14px 16px', fontSize:17, lineHeight:1.9
            }}>
              {part}
            </div>
          ))}
        </div>
      </div>

      {/* Video Section */}
      <div style={{
        marginTop:18, background:'#1A0A2E', borderRadius:24,
        border:'3px solid #BB6BD9', overflow:'hidden'
      }}>
        <button
          onClick={()=>setShowVideo(v=>!v)}
          style={{
            width:'100%', padding:'18px 24px',
            background:'linear-gradient(135deg, #6B21A8, #9B51E0)',
            color:'#FFF6E5', border:'none', cursor:'pointer',
            display:'flex', gap:12, alignItems:'center', justifyContent:'center'
          }}
        >
          <Icon.Play size={22} color="#FFF6E5"/>
          <span style={{fontFamily:'var(--font-display)', fontSize:20, fontWeight:700}}>
            {showVideo ? 'إخفاء الفيديو' : 'شاهد فيديو الحدث'}
          </span>
        </button>

        {showVideo && (
          <div style={{padding:'16px', background:'rgba(0,0,0,.3)'}}>
            <div style={{fontSize:13, color:'rgba(255,255,255,.7)', textAlign:'center', marginBottom:10}}>
              الراوي يحكي لك عن {event.title}
            </div>
            <video
              src={videoSrc}
              controls
              preload="metadata"
              style={{
                width:'100%', borderRadius:14, background:'#000',
                maxHeight:360, display:'block'
              }}
            />
          </div>
        )}
      </div>
    </div>
  );
}

window.SectionTodayHistory = SectionTodayHistory;
