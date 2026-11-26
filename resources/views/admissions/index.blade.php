<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Explore the admissions pathway at City of Ilagan College.">
        <title>Admissions | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-cic-blue-dark focus:shadow-lg" href="#main-content">Skip to content</a>
        @include('partials.public-nav')
        <main id="main-content">
            <section class="cic-page-intro relative overflow-hidden bg-cic-blue-dark text-white">
                <img class="absolute inset-0 size-full object-cover object-center opacity-80" src="{{ \App\Support\CicImageCatalog::url('Outside CIC View front 4-edited.jpg') }}" alt="" aria-hidden="true">
                <div class="absolute inset-0 bg-gradient-to-r from-cic-blue-dark via-cic-blue-dark/95 to-cic-blue-dark/65" aria-hidden="true"></div>
                <div class="absolute -bottom-48 -left-24 size-[30rem] rounded-full bg-cic-cyan/15 blur-3xl" aria-hidden="true"></div>
                <div class="relative mx-auto max-w-7xl px-5 py-20 sm:px-8 lg:py-28">
                    <p class="cic-eyebrow text-cic-cyan">Admissions</p>
                    <h1 class="cic-display mt-4 max-w-4xl text-5xl font-semibold tracking-tight sm:text-6xl">Your next chapter starts with a conversation.</h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-blue-100">This page is ready for CIC's verified enrollment process, requirements, schedules, and official admissions contacts.</p>
                    <div class="mt-8 flex max-w-2xl items-start gap-3 rounded-2xl border border-cic-yellow/60 bg-cic-yellow/10 px-5 py-4 text-sm font-semibold text-cic-yellow">
                        <span class="grid size-6 shrink-0 place-items-center rounded-full bg-cic-yellow text-xs font-black text-cic-blue-dark" aria-hidden="true">!</span>
                        Official admissions details will be published here after confirmation.
                    </div>
                    <a class="cic-action mt-8 inline-flex items-center rounded-full bg-cic-yellow px-6 py-3.5 font-bold text-cic-blue-dark" href="#admissions-pathway" data-analytics-event="admissions_pathway">
                        See the pathway <span class="ml-2" aria-hidden="true">↓</span>
                    </a>
                </div>
            </section>
            <section id="admissions-pathway" class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                <div class="grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
                    <div>
                        <p class="cic-eyebrow">Your starting point</p>
                        <h2 class="cic-display mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">A simple path, with room for your questions.</h2>
                        <p class="mt-5 max-w-xl text-lg leading-8 text-slate-600">Use this guide to prepare while CIC finalizes the official requirements and enrollment schedule.</p>
                        <ol class="relative mt-10 grid gap-8 before:absolute before:left-5 before:top-6 before:h-[calc(100%-3rem)] before:w-px before:bg-slate-200">
                            <li class="relative flex gap-5">
                                <span class="z-10 grid size-10 shrink-0 place-items-center rounded-full bg-cic-blue font-bold text-white ring-8 ring-stone-50">1</span>
                                <div>
                                    <h3 class="text-xl font-bold text-cic-blue-dark">Explore programs</h3>
                                    <p class="mt-2 leading-7 text-slate-600">Review CIC's announced degree programs and consider the direction that fits your goals.</p>
                                    <a class="cic-action mt-3 inline-flex font-bold text-cic-blue" href="{{ route('programs.index') }}">View programs <span class="ml-2" aria-hidden="true">→</span></a>
                                </div>
                            </li>
                            <li class="relative flex gap-5">
                                <span class="z-10 grid size-10 shrink-0 place-items-center rounded-full bg-cic-green font-bold text-white ring-8 ring-stone-50">2</span>
                                <div>
                                    <h3 class="text-xl font-bold text-cic-blue-dark">Prepare your questions</h3>
                                    <p class="mt-2 leading-7 text-slate-600">Keep a list of questions about requirements, schedules, campus life, and your chosen program.</p>
                                    <a class="cic-action mt-3 inline-flex font-bold text-cic-blue" href="{{ route('about.index') }}">Learn about CIC <span class="ml-2" aria-hidden="true">→</span></a>
                                </div>
                            </li>
                            <li class="relative flex gap-5">
                                <span class="z-10 grid size-10 shrink-0 place-items-center rounded-full bg-cic-red font-bold text-white ring-8 ring-stone-50">3</span>
                                <div>
                                    <h3 class="text-xl font-bold text-cic-blue-dark">Ask for guidance</h3>
                                    <p class="mt-2 leading-7 text-slate-600">Use the official CIC contact channel once verified admissions details are available.</p>
                                    <a class="cic-action mt-3 inline-flex font-bold text-cic-blue" href="{{ route('contact.index') }}">Contact CIC <span class="ml-2" aria-hidden="true">→</span></a>
                                </div>
                            </li>
                        </ol>
                    </div>
                    <aside class="cic-editorial-card rounded-[2rem] p-7 sm:p-9 lg:sticky lg:top-28" aria-labelledby="admissions-status-heading">
                        <div class="flex items-start justify-between gap-5">
                            <div>
                                <p class="cic-eyebrow">Admissions status</p>
                                <h2 id="admissions-status-heading" class="cic-display mt-3 text-3xl font-semibold text-cic-blue-dark">Details are being verified.</h2>
                            </div>
                            <span class="grid size-11 shrink-0 place-items-center rounded-2xl bg-cic-yellow text-xl font-black text-cic-blue-dark" aria-hidden="true">!</span>
                        </div>
                        <p class="mt-5 leading-7 text-slate-600">We are keeping this page accurate by publishing official requirements, dates, fees, and contacts only after CIC confirmation.</p>
                        <div class="mt-7 grid gap-3 border-t border-slate-200 pt-6 text-sm">
                            @foreach (['Requirements', 'Enrollment schedule', 'Office contacts'] as $item)
                                <div class="flex items-center justify-between gap-4">
                                    <span class="font-semibold text-slate-700">{{ $item }}</span>
                                    <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-800">Pending</span>
                                </div>
                            @endforeach
                        </div>
                        <a class="cic-action mt-8 inline-flex w-full items-center justify-center rounded-full bg-cic-blue px-6 py-3.5 font-bold text-white" href="{{ route('contact.index') }}">Ask a question <span class="ml-2" aria-hidden="true">→</span></a>
                    </aside>
                </div>
            </section>
            <section class="bg-white">
                <div class="mx-auto grid max-w-7xl gap-10 px-5 py-16 sm:px-8 lg:grid-cols-[0.8fr_1.2fr] lg:py-24">
                    <div>
                        <p class="cic-eyebrow">What will be added</p>
                        <h2 class="cic-display mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">A clearer path for every applicant.</h2>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach (['Verified admission requirements', 'Enrollment steps and timelines', 'Official office hours and contacts', 'Frequently asked questions'] as $item)
                            <div class="rounded-2xl bg-stone-50 p-5">
                                <span class="text-cic-green" aria-hidden="true">✓</span>
                                <p class="mt-3 font-semibold text-slate-700">{{ $item }}</p>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Content pending CIC confirmation.</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="admissions-faq" aria-labelledby="admissions-faq-heading" class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                <div class="grid gap-10 lg:grid-cols-[0.75fr_1.25fr]">
                    <div>
                        <p class="cic-eyebrow">Questions, clarified</p>
                        <h2 id="admissions-faq-heading" class="cic-display mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">Start with what you know.</h2>
                        <p class="mt-5 max-w-md text-lg leading-8 text-slate-600">We will keep these answers updated as official admissions information is approved.</p>
                    </div>
                    <div class="grid gap-3">
                        @foreach ([
                            ['question' => 'Are official requirements available yet?', 'answer' => 'The requirements are still pending CIC confirmation. Please check this page again before preparing or submitting documents.'],
                            ['question' => 'Where can I compare programs?', 'answer' => 'Visit the Programs page to explore the degree programs currently published on the CIC website.', 'link' => route('programs.index'), 'link_label' => 'Explore programs'],
                            ['question' => 'Can I ask about enrollment now?', 'answer' => 'Yes. Use the official contact path to send your question while the complete admissions schedule is being prepared.', 'link' => route('contact.index'), 'link_label' => 'Contact CIC'],
                            ['question' => 'Where will dates and fees be published?', 'answer' => 'Verified schedules, fees, and office contacts will be published on this page once CIC confirms them.'],
                        ] as $index => $item)
                            <div class="cic-faq-item rounded-2xl border border-slate-200 bg-white shadow-sm">
                                <button class="cic-faq-toggle flex min-h-16 w-full items-center justify-between gap-4 p-5 text-left font-bold text-cic-blue-dark focus-visible:outline-2 focus-visible:outline-cic-cyan" type="button" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="admissions-faq-{{ $index }}" data-faq-toggle>
                                    <span>{{ $item['question'] }}</span>
                                    <span class="cic-faq-icon grid size-8 shrink-0 place-items-center rounded-full bg-blue-50 text-xl font-normal text-cic-blue" aria-hidden="true">+</span>
                                </button>
                                <div class="cic-faq-panel" id="admissions-faq-{{ $index }}" @if ($index !== 0) hidden @endif>
                                    <p class="px-5 pb-5 leading-7 text-slate-600">
                                        {{ $item['answer'] }}
                                        @isset($item['link'])
                                            <a class="mt-3 inline-flex font-bold text-cic-blue underline decoration-cic-cyan underline-offset-4" href="{{ $item['link'] }}">{{ $item['link_label'] }} <span class="ml-2" aria-hidden="true">→</span></a>
                                        @endisset
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
        @include('partials.public-footer')
    </body>
</html>
