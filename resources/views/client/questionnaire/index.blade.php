<x-app-layout>
<x-slot name="header">Skin Analysis Quiz</x-slot>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin:0; padding:0; box-sizing:border-box; }
body { font-family:'Plus Jakarta Sans',sans-serif; background:#faf8ff; }

/* ── HERO ── */
.qz-hero {
    position:relative; overflow:hidden; padding:60px 10% 100px;
    background:linear-gradient(135deg,#b480ff 0%,#d3aa95 100%);
    margin:-32px -24px 0;
}
.qz-hero-glow { position:absolute; width:500px; height:500px; border-radius:50%; background:radial-gradient(circle,rgba(255,255,255,0.08),transparent 70%); top:-150px; right:-100px; animation:glowPulse 4s ease-in-out infinite; }
@keyframes glowPulse { 0%,100%{ transform:scale(1); opacity:0.7; } 50%{ transform:scale(1.15); opacity:1; } }
.qz-hero-content { position:relative; z-index:2; text-align:center; }
.qz-hero-tag { display:inline-flex; align-items:center; gap:8px; padding:6px 20px; border-radius:30px; background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); color:white; font-size:12px; font-weight:600; letter-spacing:1px; text-transform:uppercase; margin-bottom:20px; }
.qz-hero-title { font-family:'Playfair Display',serif; font-size:46px; font-weight:800; color:white; text-shadow:0 2px 16px rgba(0,0,0,0.2); margin-bottom:14px; line-height:1.2; }
.qz-hero-title span { -webkit-text-fill-color:rgba(255,255,255,0.75); text-decoration:underline; text-decoration-color:rgba(255,255,255,0.4); text-underline-offset:4px; }
.qz-hero-sub { font-size:15px; color:rgba(255,255,255,0.88); max-width:480px; margin:0 auto 32px; line-height:1.7; }
.qz-hero-features { display:flex; justify-content:center; gap:32px; flex-wrap:wrap; }
.qz-feat { display:flex; align-items:center; gap:8px; color:rgba(255,255,255,0.9); font-size:13px; font-weight:600; }
.qz-feat i { color:rgba(255,255,255,0.8); font-size:14px; }
.qz-wave { position:absolute; bottom:-2px; left:0; right:0; height:70px; background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 70'%3E%3Cpath fill='%23faf8ff' d='M0,35 C360,70 1080,0 1440,35 L1440,70 L0,70 Z'/%3E%3C/svg%3E") no-repeat bottom; background-size:cover; }

/* ── BODY ── */
.qz-body { max-width:680px; margin:0 auto; padding:40px 24px 80px; }

/* PROGRESS */
.qz-progress-wrap { background:white; border-radius:20px; padding:20px 24px; border:1px solid #ede9fe; box-shadow:0 4px 20px rgba(180,128,255,0.08); margin-bottom:20px; opacity:0; animation:fadeUp 0.5s 0.1s forwards; }
@keyframes fadeUp { from{ opacity:0; transform:translateY(16px); } to{ opacity:1; transform:translateY(0); } }
.qz-progress-top { display:flex; align-items:center; justify-content:space-between; margin-bottom:12px; }
.qz-progress-label { font-size:13px; font-weight:700; color:#1a1a2e; }
.qz-progress-count { font-size:12px; color:#b480ff; font-weight:600; }
.qz-progress-dots { display:flex; gap:6px; margin-bottom:12px; }
.qz-dot { width:32px; height:6px; border-radius:3px; background:#ede9fe; transition:all 0.4s; }
.qz-dot.done    { background:linear-gradient(to right,#b480ff,#d3aa95); }
.qz-dot.current { background:#b480ff; box-shadow:0 0 8px rgba(180,128,255,0.5); }
.qz-progress-bar-wrap { height:4px; background:#f3f0ff; border-radius:2px; overflow:hidden; }
.qz-progress-bar { height:100%; background:linear-gradient(to right,#b480ff,#d3aa95); border-radius:2px; transition:width 0.5s ease; }

/* QUESTION CARD */
.qz-question { background:white; border-radius:24px; padding:32px; border:1px solid #ede9fe; box-shadow:0 8px 32px rgba(180,128,255,0.1); opacity:0; animation:fadeUp 0.5s 0.2s forwards; transition:all 0.3s; }
.qz-q-num { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#c4b5fd; margin-bottom:10px; }
.qz-q-text { font-family:'Playfair Display',serif; font-size:22px; font-weight:700; color:#1a1a2e; margin-bottom:24px; line-height:1.4; }

/* OPTIONS */
.qz-options { display:flex; flex-direction:column; gap:10px; margin-bottom:28px; }
.qz-opt-input { display:none; }
.qz-opt-label { display:flex; align-items:center; gap:14px; padding:15px 18px; border:2px solid #ede9fe; border-radius:14px; cursor:pointer; transition:all 0.25s; background:white; position:relative; overflow:hidden; }
.qz-opt-label::before { content:''; position:absolute; left:0; top:0; bottom:0; width:0; background:linear-gradient(to right,rgba(180,128,255,0.08),transparent); transition:width 0.3s; }
.qz-opt-label:hover { border-color:#b480ff; transform:translateX(4px); }
.qz-opt-label:hover::before { width:100%; }
.qz-opt-input:checked + .qz-opt-label { border-color:#b480ff; background:rgba(180,128,255,0.04); box-shadow:0 4px 16px rgba(180,128,255,0.15); }
.qz-opt-input:checked + .qz-opt-label::before { width:100%; background:linear-gradient(to right,rgba(180,128,255,0.1),transparent); }
.qz-opt-radio { width:22px; height:22px; border-radius:50%; border:2px solid #ede9fe; flex-shrink:0; display:flex; align-items:center; justify-content:center; transition:all 0.25s; }
.qz-opt-input:checked + .qz-opt-label .qz-opt-radio { background:#b480ff; border-color:#b480ff; }
.qz-opt-input:checked + .qz-opt-label .qz-opt-radio::after { content:''; width:8px; height:8px; border-radius:50%; background:white; display:block; }
.qz-opt-text { font-size:14px; font-weight:500; color:#374151; flex:1; }
.qz-opt-input:checked + .qz-opt-label .qz-opt-text { color:#1a1a2e; font-weight:700; }

/* NAVIGATION */
.qz-nav { display:flex; align-items:center; justify-content:space-between; gap:12px; }
.qz-btn-prev { display:inline-flex; align-items:center; gap:6px; padding:11px 22px; border-radius:30px; font-size:13px; font-weight:600; background:white; color:#9ca3af; border:1.5px solid #ede9fe; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; }
.qz-btn-prev:hover { border-color:#b480ff; color:#b480ff; }
.qz-btn-next { display:inline-flex; align-items:center; gap:6px; padding:12px 28px; border-radius:30px; font-size:14px; font-weight:700; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; box-shadow:0 4px 16px rgba(180,128,255,0.35); }
.qz-btn-next:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(180,128,255,0.45); }
.qz-btn-submit { display:inline-flex; align-items:center; gap:8px; padding:13px 32px; border-radius:30px; font-size:15px; font-weight:800; background:linear-gradient(to right,#b480ff,#d3aa95); color:white; border:none; cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all 0.2s; box-shadow:0 6px 20px rgba(180,128,255,0.35); }
.qz-btn-submit:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(180,128,255,0.5); }
</style>

{{-- HERO --}}
<div class="qz-hero">
    <div class="qz-hero-glow"></div>
    <div class="qz-hero-content">
        <div class="qz-hero-tag"><i class="fa-solid fa-flask"></i> Skin Analysis</div>
        <h1 class="qz-hero-title">Discover Your <span>Skin Type</span></h1>
        <p class="qz-hero-sub">Answer 5 simple questions and get a personalized beauty routine tailored to your unique skin needs.</p>
        <div class="qz-hero-features">
            <div class="qz-feat"><i class="fa-solid fa-clock"></i> 2 minutes</div>
            <div class="qz-feat"><i class="fa-solid fa-list-check"></i> 5 questions</div>
            <div class="qz-feat"><i class="fa-solid fa-sparkles"></i> Instant results</div>
        </div>
    </div>
    <div class="qz-wave"></div>
</div>

<div class="qz-body" x-data="{
    etape: 1,
    total: {{ count($questions) }},
    reponses: {},
    get progression() { return ((this.etape - 1) / this.total) * 100; }
}">

    {{-- PROGRESS --}}
    <div class="qz-progress-wrap">
        <div class="qz-progress-top">
            <div class="qz-progress-label">Question <span x-text="etape"></span> of {{ count($questions) }}</div>
            <div class="qz-progress-count"><span x-text="Math.round(progression)"></span>% complete</div>
        </div>
        <div class="qz-progress-dots">
            @foreach($questions as $i => $_)
                <div class="qz-dot" :class="{ 'done': etape > {{ $i+1 }}, 'current': etape === {{ $i+1 }} }"></div>
            @endforeach
        </div>
        <div class="qz-progress-bar-wrap">
            <div class="qz-progress-bar" :style="'width:' + progression + '%'"></div>
        </div>
    </div>

    {{-- FORM --}}
    <form method="POST" action="{{ route('client.questionnaire.analyser') }}" id="qzForm">
        @csrf
        <div class="qz-container">
            @foreach($questions as $index => $question)
                <div x-show="etape === {{ $index + 1 }}"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-x-4"
                     x-transition:enter-end="opacity-100 transform translate-x-0"
                     class="qz-question"
                     style="{{ $index !== 0 ? 'display:none;' : '' }}">

                    <div class="qz-q-num">Question {{ $index + 1 }}</div>
                    <div class="qz-q-text">{{ $question['texte'] }}</div>

                    <div class="qz-options">
                        @foreach($question['options'] as $valeur => $label)
                            <div>
                                <input type="radio" name="{{ $question['id'] }}" id="{{ $question['id'] }}_{{ $valeur }}" value="{{ $valeur }}" class="qz-opt-input" x-model="reponses['{{ $question['id'] }}']">
                                <label for="{{ $question['id'] }}_{{ $valeur }}" class="qz-opt-label">
                                    <div class="qz-opt-radio"></div>
                                    <div class="qz-opt-text">{{ $label }}</div>
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <div class="qz-nav">
                        @if($index > 0)
                            <button type="button" class="qz-btn-prev" @click="etape--">
                                <i class="fa-solid fa-arrow-left"></i> Previous
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if($index < count($questions) - 1)
                            <button type="button" class="qz-btn-next" @click="etape++">
                                Next <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        @else
                            <button type="submit" class="qz-btn-submit">
                                <i class="fa-solid fa-wand-magic-sparkles"></i> Analyze My Skin
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </form>

</div>

</x-app-layout>