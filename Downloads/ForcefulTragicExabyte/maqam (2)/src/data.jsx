// All content data — Algerian regions, cards, stories, etc.

const REGIONS = [
  {id:'algiers',     name:'الجزائر',      subtitle:'العاصمة',      emoji:'🕌', x:50, y:9,  color:'#F2C94C', cardId:'casbah',     unlocked:true,  completed:true,  levelsDone:4,
   hero:{name:'مصطفى بن بولعيد',  img:'assets/charchters/mstf_bn_blaid.png',  bio:'أحد قادة الثورة الجزائرية ومؤسس الولاية الأولى. شهيد لا تُنسى تضحياته.'}},
  {id:'oran',        name:'وهران',        subtitle:'الباهية',      emoji:'⛵', x:36, y:11, color:'#56CCF2', cardId:'santa-cruz', unlocked:true,  completed:false, levelsDone:2,
   hero:{name:'لربي بن مهيدي',     img:'assets/charchters/larbi_bn_mhidi.png', bio:'بطل الثورة الذي أشعل نار الكفاح في الغرب الجزائري. رمز التضحية والشجاعة.'}},
  {id:'constantine', name:'قسنطينة',     subtitle:'مدينة الجسور',  emoji:'🏰', x:67, y:11, color:'#BB6BD9', cardId:'bridges',    unlocked:true,  completed:false, levelsDone:0,
   hero:{name:'ديدوش مراد',         img:'assets/charchters/ddch_mrd_1.png',     bio:'شهيد الثورة وقائد الولاية الثانية، سقط فداءً للجزائر وهو في ريعان الشباب.'}},
  {id:'bechar',      name:'بشار',         subtitle:'الواحات',      emoji:'🌴', x:28, y:32, color:'#F2994A', cardId:'oasis',      unlocked:false, completed:false, levelsDone:0,
   hero:{name:'كريم بلقاسم',        img:'assets/charchters/krim_blkcm.jpeg',    bio:'مفاوض اتفاقيات إيفيان ورمز الكفاح الأمازيغي والوطني الجزائري.'}},
  {id:'ouargla',     name:'ورقلة',        subtitle:'النخيل',       emoji:'🏝', x:58, y:36, color:'#6FCF97', cardId:'palms',      unlocked:false, completed:false, levelsDone:0,
   hero:{name:'محمد بوضياف',        img:'assets/charchters/mhmd_bdf_-_Copy.png',bio:'من مؤسسي جبهة التحرير الوطني، رمز وطني عاش وضحّى من أجل الجزائر الحرة.'}},
  {id:'tamanrasset', name:'تامنراست',    subtitle:'الهقار',       emoji:'⛺', x:58, y:78, color:'#EB5FA6', cardId:'hoggar',     unlocked:false, completed:false, levelsDone:0,
   hero:{name:'خريطة الجزائر',      img:'assets/charchters/algeria-map.png',    bio:'وطننا الجزائر — أرض الحضارات، من البحر الأبيض إلى صحراء الهقار الشاسعة.'}},
];

// 4 levels per region — each is a mini-challenge
const LEVELS = [
  {n:1, kind:'flag',   title:'تعرّف على العلم',   icon:'🚩'},
  {n:2, kind:'symbol', title:'رمز المنطقة',       icon:'✨'},
  {n:3, kind:'count',  title:'العدّ الذكي',       icon:'🔢'},
  {n:4, kind:'final',  title:'التحدي الأخير',    icon:'🏆'},
];
window.LEVELS = LEVELS;

const CARDS = {
  'casbah':     {name:'قصبة الجزائر', desc:'مدينة عتيقة على البحر، أزقتها تحكي ألف حكاية.', icon:'🏛', rarity:'rare',      region:'algiers'},
  'santa-cruz': {name:'سانتا كروز',   desc:'حصن وهران الذي يطل على البحر الأبيض.',         icon:'⛵', rarity:'common',    region:'oran'},
  'bridges':    {name:'جسور قسنطينة',desc:'سبعة جسور تربط مدينة معلّقة في السماء.',         icon:'🌉', rarity:'epic',      region:'constantine'},
  'oasis':      {name:'واحات بشار',   desc:'نخيل وماء في قلب الصحراء.',                     icon:'🌴', rarity:'rare',      region:'bechar'},
  'palms':      {name:'نخيل ورقلة',   desc:'بحر من النخل في الجنوب.',                       icon:'🏝', rarity:'common',    region:'ouargla'},
  'hoggar':     {name:'جبال الهقار', desc:'صخور سوداء في قلب الصحراء الكبرى.',              icon:'⛺', rarity:'legendary', region:'tamanrasset'},
};

const STORIES = [
  {id:'1nov',  date:'1 نوفمبر 1954',   title:'فجر الثورة',    subtitle:'اندلاع الثورة',        color:'#C0392B', cover:'🔥', duration:'8 دقائق', pages:6, excerpt:'في ليلة الفاتح من نوفمبر، انطلقت رصاصات الحرية في الجبال والمدن. كان الشعب يحلم بفجر جديد...', premium:false},
  {id:'8mai',  date:'8 ماي 1945',       title:'يوم لا يُنسى',  subtitle:'مجازر الثامن من ماي', color:'#2C7A51', cover:'🕊', duration:'6 دقائق', pages:5, excerpt:'بينما كان العالم يحتفل بنهاية الحرب، خرج الجزائريون يطالبون بالحرية...', premium:false},
  {id:'5juil', date:'5 جويلية 1962',    title:'يوم الاستقلال',subtitle:'فجر الجزائر الحرة',    color:'#E67E22', cover:'🇩🇿', duration:'7 دقائق', pages:5, excerpt:'بعد 132 سنة، رفرف العلم الأخضر والأبيض والأحمر فوق سماء الجزائر...', premium:false},
  {id:'11dec', date:'11 ديسمبر 1960',   title:'مظاهرات ديسمبر',subtitle:'صوت الشعب في الشوارع',color:'#F9C74F', cover:'✊', duration:'6 دقائق', pages:5, excerpt:'خرج الأطفال والنساء والرجال إلى الشوارع رافعين العلم، صائحين: تحيا الجزائر!', premium:false},
];

const MATH_GAMES = [
  {id:'count', title:'العد مع التمر', desc:'اعدد حبّات التمر', icon:'🌴', level:'سهل', premium:false},
  {id:'add',   title:'الجمع السحري',  desc:'اجمع الأرقام',     icon:'➕', level:'سهل', premium:false},
  {id:'sub',   title:'الطرح اللطيف',  desc:'اطرح بمتعة',       icon:'➖', level:'متوسط', premium:true},
  {id:'mul',   title:'الضرب المرح',   desc:'تعلم الضرب',       icon:'✖️', level:'متوسط', premium:true},
  {id:'shape', title:'الأشكال الذكية',desc:'تعرّف على الأشكال', icon:'🔷', level:'سهل', premium:true},
  {id:'puzzle',title:'لغز الأرقام',   desc:'حلّ الألغاز',       icon:'🧩', level:'صعب', premium:true},
];

const SPELL_GAMES = [
  {id:'alpha', title:'الحروف العربية', desc:'تعلّم أبجد هوّز',     icon:'📝', level:'سهل', premium:true},
  {id:'word',  title:'كوّن الكلمة',     desc:'رتّب الحروف',         icon:'🔤', level:'متوسط', premium:true},
  {id:'sound', title:'صوت الحرف',     desc:'استمع وتعرّف',         icon:'🔊', level:'سهل', premium:true},
  {id:'name',  title:'اسمي بالعربية',  desc:'اكتب اسمك',           icon:'✍️', level:'متوسط', premium:true},
];

const TODAY_HISTORY_EVENTS = {
  '11-01': {
    dateLabel:'1 نوفمبر',
    title:'بداية الثورة التحريرية',
    short:'في هذا اليوم انطلقت الثورة الجزائرية ضد الاستعمار.',
    story:[
      'في ليلة الفاتح من نوفمبر 1954، بدأ المجاهدون أولى العمليات من أجل حرية الجزائر.',
      'كان الهدف أن يستعيد الشعب كرامته وأن يعيش أطفاله في وطن مستقل.',
      'تعلمنا هذه الذكرى أن الشجاعة والصبر يصنعان المستقبل.',
    ],
  },
  '05-08': {
    dateLabel:'8 ماي',
    title:'ذكرى 8 ماي 1945',
    short:'يوم مهم في تاريخ الجزائر نتذكر فيه تضحيات كبيرة.',
    story:[
      'في 8 ماي 1945 خرج الجزائريون يطالبون بالحرية والحقوق.',
      'وقعت أحداث مؤلمة، لكنها زادت إصرار الشعب على الاستقلال.',
      'نتذكر هذا اليوم لنحافظ على وطننا ونقدّر قيمة السلام.',
    ],
  },
  '12-11': {
    dateLabel:'11 ديسمبر',
    title:'مظاهرات 11 ديسمبر 1960',
    short:'في هذا اليوم عبّر الشعب بصوت قوي عن حقه في الحرية.',
    story:[
      'خرجت مظاهرات كبيرة في عدة مدن جزائرية.',
      'رفع الناس الأعلام وهتفوا بحب الوطن.',
      'كان هذا اليوم رسالة واضحة للعالم: الجزائر تريد الاستقلال.',
    ],
  },
  '07-05': {
    dateLabel:'5 جويلية',
    title:'يوم الاستقلال',
    short:'ذكرى فرح كبيرة: استقلال الجزائر سنة 1962.',
    story:[
      'في 5 جويلية 1962 فرح الجزائريون باستقلال بلادهم.',
      'رفرف العلم الوطني عاليًا بعد سنوات من النضال.',
      'هذا اليوم يعلّمنا حب الوطن والعمل من أجله كل يوم.',
    ],
  },
};

const DAILY_WISDOM = [
  {author:'عمّي رشيد', text:'العلم نور، وكل يوم تتعلم فيه شيئًا جديدًا هو خطوة نحو حلمك.'},
  {author:'عمّي رشيد', text:'كن لطيفًا مع إخوتك، فالقلب الطيب يصنع بيتًا سعيدًا.'},
  {author:'عمّي رشيد', text:'لا تخف من الخطأ، فالخطأ بداية التعلّم.'},
  {author:'عمّي رشيد', text:'حب الوطن يبدأ من احترام المدرسة والشارع والناس.'},
  {author:'عمّي رشيد', text:'بالصبر والمثابرة تستطيع أن تصبح بطلًا في دراستك وحياتك.'},
];

window.REGIONS = REGIONS;
window.CARDS = CARDS;
window.STORIES = STORIES;
window.MATH_GAMES = MATH_GAMES;
window.SPELL_GAMES = SPELL_GAMES;
window.TODAY_HISTORY_EVENTS = TODAY_HISTORY_EVENTS;
window.DAILY_WISDOM = DAILY_WISDOM;
