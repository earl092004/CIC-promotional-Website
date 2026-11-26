<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="The CIC promotional website starter homepage. Official content will be added through the CMS.">

        <title>{{ config('app.name', 'CIC') }} | Discover what is possible</title>

        <script>
            (() => {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    return;
                }

                try {
                    if (window.sessionStorage.getItem('cic-intro-seen') === 'true') {
                        return;
                    }

                    window.sessionStorage.setItem('cic-intro-seen', 'true');
                    document.documentElement.dataset.cicIntroPending = 'true';

                    window.setTimeout(() => {
                        const root = document.documentElement;

                        if (root.dataset.cicIntroPending === 'true'
                            && root.dataset.cicIntroControllerReady !== 'true') {
                            console.warn('CIC intro skipped because its controller did not load.');
                            delete root.dataset.cicIntroPending;
                        }
                    }, 2500);
                } catch (error) {
                    console.warn('CIC intro skipped because session storage is unavailable.', error);
                }
            })();
        </script>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        <div class="cic-intro-overlay" data-cic-intro role="dialog" aria-modal="true" aria-label="City of Ilagan College introduction">
            <img class="cic-intro-image" data-cic-intro-image data-src="{{ asset('images/Intro website/ilagan_city_college_intro.webp') }}" width="720" height="720" alt="Animated City of Ilagan College seal" decoding="async" fetchpriority="high">
            <button class="cic-intro-skip" type="button" data-cic-intro-skip>Skip intro</button>
        </div>

        <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-cic-blue-dark focus:shadow-lg" href="#main-content">
            Skip to content
        </a>

        @include('partials.public-nav')

        <main id="main-content">
            <section class="relative overflow-hidden bg-cic-blue-dark text-white">
                <img class="absolute inset-0 size-full object-cover object-center opacity-100" src="{{ asset('images/CIC-Website-Images/Outside CIC View-edited.png') }}" alt="" aria-hidden="true">
                <div class="absolute inset-0 bg-gradient-to-r from-cic-blue-dark via-cic-blue-dark/90 to-cic-blue-dark/15" aria-hidden="true"></div>
                <div class="relative mx-auto grid max-w-7xl gap-12 px-5 py-20 sm:px-8 sm:py-28 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:gap-20">
                    <div class="cic-reveal">
                        <p class="mb-6 inline-flex items-center gap-2 rounded-full border border-cic-blue bg-cic-blue/30 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-cic-cyan">
                            <span class="size-2 rounded-full bg-cic-yellow"></span>
                            Educatio Eximia Ad Progressum
                        </p>
                        <h1 class="max-w-3xl text-5xl font-semibold tracking-tight text-balance sm:text-6xl lg:text-7xl">
                            Start where your <span class="text-cic-yellow">next chapter</span> begins.
                        </h1>
                        <p class="mt-7 max-w-xl text-lg leading-8 text-blue-100">
                            A welcoming digital home for City of Ilagan College. Discover a future-ready campus, meaningful opportunities, and a community built around your growth.
                        </p>
                        <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                            <a class="cic-action inline-flex items-center justify-center rounded-full bg-cic-yellow px-6 py-3.5 font-bold text-cic-blue-dark focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cic-yellow" href="{{ route('admissions.index') }}" data-analytics-event="homepage_admissions_cta">
                                Explore admissions
                                <span class="ml-2" aria-hidden="true">→</span>
                            </a>
                            <a class="cic-action inline-flex items-center justify-center rounded-full border border-cic-blue px-6 py-3.5 font-bold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cic-yellow" href="{{ route('about.index') }}">
                                Learn about CIC
                            </a>
                        </div>
                    </div>

                    <div class="cic-reveal relative [animation-delay:120ms]">
                        <div class="flex min-h-80 flex-col items-center justify-center rounded-[2rem] border border-white/70 bg-white p-7 text-cic-blue-dark shadow-2xl shadow-black/25 sm:min-h-96">
                            <img class="size-56 object-contain drop-shadow-xl sm:size-64" src="{{ asset('images/cic-logo.png') }}" alt="City of Ilagan College official seal">
                            <p class="mt-4 text-center text-sm font-semibold uppercase tracking-[0.2em] text-cic-blue">Learn boldly. Lead kindly.</p>
                        </div>
                        <div class="absolute -bottom-5 -left-4 rounded-2xl border-l-4 border-cic-green bg-white p-4 text-cic-blue-dark shadow-xl sm:-left-8">
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Built for</p>
                            <p class="mt-1 font-semibold">Curious minds</p>
                        </div>
                    </div>
                </div>
            </section>

            <section aria-labelledby="visitor-path-heading" class="bg-white">
                <div class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-20">
                    <div class="max-w-2xl">
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-green">Find your way</p>
                        <h2 id="visitor-path-heading" class="mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">What would you like to explore?</h2>
                        <p class="mt-5 text-lg leading-8 text-slate-600">Start with the path that matches what you need today. You can always return to the homepage using the CIC mark above.</p>
                    </div>
                    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <a class="cic-interactive rounded-3xl border border-slate-200 bg-stone-50 p-6 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-cic-cyan" href="{{ route('admissions.index') }}">
                            <span class="text-2xl text-cic-blue" aria-hidden="true">→</span>
                            <h3 class="mt-6 text-lg font-bold text-cic-blue-dark">I want to enroll</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">See the admissions pathway and what information is still being confirmed.</p>
                        </a>
                        <a class="cic-interactive rounded-3xl border border-slate-200 bg-stone-50 p-6 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-cic-cyan" href="{{ route('programs.index') }}">
                            <span class="text-2xl text-cic-green" aria-hidden="true">✦</span>
                            <h3 class="mt-6 text-lg font-bold text-cic-blue-dark">I want to explore programs</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Compare the announced CIC degree programs and facility previews.</p>
                        </a>
                        <a class="cic-interactive rounded-3xl border border-slate-200 bg-stone-50 p-6 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-cic-cyan" href="{{ route('articles.index') }}">
                            <span class="text-2xl text-cic-red" aria-hidden="true">◌</span>
                            <h3 class="mt-6 text-lg font-bold text-cic-blue-dark">I want the latest news</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Read published announcements, news, blogs, and achievements.</p>
                        </a>
                        <a class="cic-interactive rounded-3xl border border-slate-200 bg-stone-50 p-6 focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-cic-cyan" href="{{ route('contact.index') }}">
                            <span class="text-2xl text-cic-blue" aria-hidden="true">◎</span>
                            <h3 class="mt-6 text-lg font-bold text-cic-blue-dark">I want to contact CIC</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">Find verified contact information as soon as it is approved.</p>
                        </a>
                    </div>
                </div>
            </section>

            <section id="about" class="mx-auto max-w-7xl px-5 py-20 sm:px-8 lg:py-28">
                <div class="grid gap-12 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">A place to grow</p>
                        <h2 class="mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">Your story deserves a strong beginning.</h2>
                    </div>
                    <p class="max-w-2xl text-lg leading-8 text-slate-600">CIC is being shaped into a campus experience where students can build practical skills, find their people, and prepare for meaningful work. Official institutional copy will be managed through the CMS.</p>
                </div>
                <div class="mt-14 grid gap-5 sm:grid-cols-3">
                    <article class="cic-interactive rounded-3xl border-t-4 border-cic-blue bg-white p-7 shadow-sm ring-1 ring-slate-200">
                        <span class="text-3xl text-cic-blue" aria-hidden="true">◎</span>
                        <h3 class="mt-8 text-xl font-bold text-cic-blue-dark">Learn with purpose</h3>
                        <p class="mt-3 leading-7 text-slate-600">A clear path from classroom curiosity to confident action.</p>
                    </article>
                    <article class="cic-interactive rounded-3xl border-t-4 border-cic-green bg-cic-blue-dark p-7 text-white shadow-xl shadow-cic-blue-dark/10">
                        <span class="text-3xl text-cic-cyan" aria-hidden="true">↗</span>
                        <h3 class="mt-8 text-xl font-bold">Make your mark</h3>
                        <p class="mt-3 leading-7 text-indigo-200">Opportunities to create, collaborate, and contribute.</p>
                    </article>
                    <article class="cic-interactive rounded-3xl border-t-4 border-cic-red bg-cic-yellow p-7 text-cic-blue-dark shadow-sm">
                        <span class="text-3xl" aria-hidden="true">✦</span>
                        <h3 class="mt-8 text-xl font-bold">Belong here</h3>
                        <p class="mt-3 leading-7 text-indigo-900/80">A supportive community that sees your possibilities.</p>
                    </article>
                </div>
            </section>

            <section id="admissions" class="bg-white">
                <div class="mx-auto grid max-w-7xl gap-10 px-5 py-20 sm:px-8 lg:grid-cols-[1fr_0.8fr] lg:items-center lg:py-28">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">Admissions</p>
                        <h2 class="mt-4 max-w-2xl text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">Ready to take the next step?</h2>
                        <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">This admissions section is ready for verified requirements, schedules, and official contact details. Until then, use the contact path below for guidance.</p>
                        <a class="cic-action mt-8 inline-flex rounded-full bg-cic-blue px-6 py-3.5 font-bold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cic-blue" href="{{ route('contact.index') }}">Ask about admissions <span class="ml-2" aria-hidden="true">→</span></a>
                    </div>
                    <div class="cic-interactive rounded-3xl bg-stone-100 p-7 sm:p-9">
                        <p class="text-sm font-bold uppercase tracking-widest text-slate-500">Coming soon</p>
                        <ul class="mt-6 space-y-5 text-indigo-950">
                            <li class="flex gap-4"><span class="grid size-8 shrink-0 place-items-center rounded-full bg-cic-cyan font-bold">1</span><span><strong class="block">Choose your direction</strong><small class="mt-1 block text-slate-600">Verified program information will appear here.</small></span></li>
                            <li class="flex gap-4"><span class="grid size-8 shrink-0 place-items-center rounded-full bg-cic-green font-bold text-white">2</span><span><strong class="block">Prepare your application</strong><small class="mt-1 block text-slate-600">Requirements and dates will be published by CIC.</small></span></li>
                            <li class="flex gap-4"><span class="grid size-8 shrink-0 place-items-center rounded-full bg-cic-red font-bold text-white">3</span><span><strong class="block">Meet your next chapter</strong><small class="mt-1 block text-slate-600">Connect with the admissions team for help.</small></span></li>
                        </ul>
                    </div>
                </div>
            </section>

            <section id="programs" class="bg-cic-blue-dark text-white">
                <div class="mx-auto grid max-w-7xl gap-10 px-5 py-20 sm:px-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-center lg:py-24">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-cyan">Programs offered</p>
                        <h2 class="mt-4 text-4xl font-semibold tracking-tight sm:text-5xl">Find a direction for your next chapter.</h2>
                        <p class="mt-5 leading-8 text-blue-100">CIC has announced four degree programs connected to its RRPA milestone with CHED-RO2.</p>
                        <a class="cic-action mt-7 inline-flex rounded-full bg-cic-yellow px-6 py-3.5 font-bold text-cic-blue-dark" href="{{ route('programs.index') }}">Explore programs <span class="ml-2" aria-hidden="true">→</span></a>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($programs as $program)
                            <a class="cic-interactive rounded-3xl border border-cic-blue bg-white/10 p-6 text-white backdrop-blur-sm" href="{{ route('programs.show', $program) }}">
                                <span class="text-sm font-bold text-cic-cyan">0{{ $loop->iteration }}</span>
                                <h3 class="mt-5 text-xl font-bold">{{ $program->name }}</h3>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="stories" class="mx-auto max-w-7xl px-5 py-20 sm:px-8 lg:py-28">
                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">From the community</p>
                        <h2 class="mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">What’s happening at CIC.</h2>
                    </div>
                    <p class="max-w-sm text-sm leading-6 text-slate-500">Published announcements, news, blogs, and achievements from the CIC community, shown together in one feed.</p>
                </div>
                <div class="mt-12 grid gap-5 md:grid-cols-3">
                    @forelse ($stories as $article)
                        <article class="cic-interactive group overflow-hidden rounded-3xl border {{ $announcements->contains('id', $article->id) ? 'border-cic-yellow bg-cic-yellow/10' : 'border-slate-200 bg-white' }}">
                            @if ($article->cover_image_path)
                                <div class="cic-image-frame h-44 bg-slate-100">
                                    <img class="size-full object-cover" src="{{ route('media.show', ['path' => $article->cover_image_path]) }}" alt="{{ $article->cover_image_alt ?: $article->title }}" loading="lazy">
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between gap-3">
                                    <p class="text-xs font-bold uppercase tracking-widest text-cic-blue">{{ str($article->type)->headline() }}</p>
                                    @if ($announcements->contains('id', $article->id))
                                        <span class="rounded-full bg-cic-yellow px-2.5 py-1 text-[0.65rem] font-bold uppercase tracking-wider text-cic-blue-dark">Featured</span>
                                    @endif
                                </div>
                                <h3 class="mt-6 text-2xl font-bold leading-tight text-cic-blue-dark"><a class="focus-visible:outline-2 focus-visible:outline-cic-blue" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h3>
                                <p class="mt-4 line-clamp-3 text-sm leading-6 text-slate-600">{{ $article->excerpt }}</p>
                                <a class="mt-8 inline-block font-bold text-cic-blue group-hover:text-cic-blue-dark" href="{{ route('articles.show', $article) }}">Read {{ $announcements->contains('id', $article->id) ? 'announcement' : 'story' }} <span aria-hidden="true">→</span></a>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-7 md:col-span-3">
                            <p class="text-xs font-bold uppercase tracking-widest text-cic-blue">Stories coming soon</p>
                            <p class="mt-4 text-lg leading-7 text-slate-600">Published announcements, news, blogs, and achievements will appear here after administrator review.</p>
                        </div>
                    @endforelse
                </div>
                @if ($stories->isNotEmpty())
                    <a class="cic-action mt-8 inline-flex rounded-full border border-cic-blue px-5 py-3 font-bold text-cic-blue" href="{{ route('articles.index') }}">View all stories <span class="ml-2" aria-hidden="true">→</span></a>
                @endif
            </section>

            <section id="gallery" class="bg-white">
                <div class="mx-auto max-w-7xl px-5 py-20 sm:px-8 lg:py-28">
                    <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
                        <div>
                            <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-green">Campus gallery</p>
                            <h2 class="mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">See CIC in motion.</h2>
                        </div>
                        <p class="max-w-sm text-sm leading-6 text-slate-500">Approved gallery images uploaded through the CMS will appear here.</p>
                    </div>
                    <div class="mt-12 grid grid-cols-2 gap-4 md:grid-cols-3">
                        @foreach ($campusGallery as $image)
                            <figure class="cic-interactive cic-image-frame overflow-hidden rounded-3xl bg-slate-100 {{ $loop->first ? 'col-span-2 row-span-2' : '' }}">
                                <img class="size-full min-h-40 object-cover {{ $loop->first ? 'min-h-80' : '' }}" src="{{ \App\Support\CicImageCatalog::url($image['file']) }}" alt="{{ $image['alt'] }}" loading="lazy">
                                <figcaption class="sr-only">{{ $image['title'] }}</figcaption>
                            </figure>
                        @endforeach
                    </div>
                    <a class="cic-action mt-8 inline-flex rounded-full border border-cic-blue px-5 py-3 font-bold text-cic-blue" href="{{ route('gallery.index') }}">View full gallery <span class="ml-2" aria-hidden="true">→</span></a>
                </div>
            </section>

            <section id="faq" aria-labelledby="faq-heading" class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                <div class="grid gap-10 lg:grid-cols-[0.75fr_1.25fr]">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">Visitor questions</p>
                        <h2 id="faq-heading" class="mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">What we can answer today.</h2>
                        <p class="mt-5 max-w-md text-lg leading-8 text-slate-600">These answers intentionally separate verified project information from details CIC still needs to confirm.</p>
                    </div>
                    <div class="space-y-3">
                        <div class="cic-faq-item rounded-2xl border border-slate-200 bg-white shadow-sm">
                            <button class="cic-faq-toggle flex w-full items-center justify-between gap-4 p-5 text-left font-bold text-cic-blue-dark focus-visible:outline-2 focus-visible:outline-cic-cyan" type="button" aria-expanded="false" aria-controls="faq-programs" data-faq-toggle>
                                <span>What programs are currently shown on the website?</span><span class="cic-faq-icon grid size-8 shrink-0 place-items-center rounded-full bg-blue-50 text-xl font-normal text-cic-blue" aria-hidden="true">+</span>
                            </button>
                            <div class="cic-faq-panel" id="faq-programs" hidden><p class="px-5 pb-5 leading-7 text-slate-600">The website currently presents BS Psychology, BS Medical Technology, BS Radiologic Technology, and BS Information System based on the CIC information supplied for this project.</p></div>
                        </div>
                        <div class="cic-faq-item rounded-2xl border border-slate-200 bg-white shadow-sm">
                            <button class="cic-faq-toggle flex w-full items-center justify-between gap-4 p-5 text-left font-bold text-cic-blue-dark focus-visible:outline-2 focus-visible:outline-cic-cyan" type="button" aria-expanded="false" aria-controls="faq-admissions" data-faq-toggle>
                                <span>Where can I find admission requirements and dates?</span><span class="cic-faq-icon grid size-8 shrink-0 place-items-center rounded-full bg-blue-50 text-xl font-normal text-cic-blue" aria-hidden="true">+</span>
                            </button>
                            <div class="cic-faq-panel" id="faq-admissions" hidden><p class="px-5 pb-5 leading-7 text-slate-600">The Admissions page is ready for these details, but official requirements, schedules, fees, and contact information should be added only after CIC verifies them.</p></div>
                        </div>
                        <div class="cic-faq-item rounded-2xl border border-slate-200 bg-white shadow-sm">
                            <button class="cic-faq-toggle flex w-full items-center justify-between gap-4 p-5 text-left font-bold text-cic-blue-dark focus-visible:outline-2 focus-visible:outline-cic-cyan" type="button" aria-expanded="false" aria-controls="faq-updates" data-faq-toggle>
                                <span>How can I see official updates?</span><span class="cic-faq-icon grid size-8 shrink-0 place-items-center rounded-full bg-blue-50 text-xl font-normal text-cic-blue" aria-hidden="true">+</span>
                            </button>
                            <div class="cic-faq-panel" id="faq-updates" hidden><p class="px-5 pb-5 leading-7 text-slate-600">Browse the published Stories and Gallery sections, and follow the <a class="font-semibold text-cic-blue underline decoration-cic-cyan underline-offset-4" href="https://www.facebook.com/cityofilagancollege" target="_blank" rel="noopener noreferrer">official CIC Facebook page</a> for public updates.</p></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('partials.public-footer')
    </body>
</html>
