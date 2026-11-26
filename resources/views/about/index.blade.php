<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Learn about City of Ilagan College and its growing academic community.">
        <title>About CIC | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-cic-blue-dark focus:shadow-lg" href="#main-content">Skip to content</a>
        @include('partials.public-nav')
        <main id="main-content">
            <section class="relative overflow-hidden bg-cic-blue-dark text-white">
                <img class="absolute inset-0 size-full object-cover object-center opacity-25" src="{{ \App\Support\CicImageCatalog::url('Outside CIC View-edited.jpg') }}" alt="" aria-hidden="true">
                <div class="absolute inset-0 bg-gradient-to-r from-cic-blue-dark via-cic-blue-dark/95 to-cic-blue-dark/70" aria-hidden="true"></div>
                <div class="absolute -right-40 -top-40 size-[28rem] rounded-full bg-cic-blue/50 blur-3xl" aria-hidden="true"></div>
                <div class="relative mx-auto max-w-7xl px-5 py-20 sm:px-8 lg:py-28">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-cyan">About City of Ilagan College</p>
                    <h1 class="cic-display mt-4 max-w-4xl text-5xl font-semibold tracking-tight sm:text-6xl">A place to grow, contribute, and belong.</h1>
                    <p class="mt-6 max-w-3xl text-lg leading-8 text-blue-100">CIC is being shaped into a welcoming college community where students can build practical skills, find their people, and prepare for meaningful work.</p>
                </div>
            </section>
            <section class="mx-auto grid max-w-7xl gap-12 px-5 py-16 sm:px-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-start lg:py-24">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">Our direction</p>
                    <h2 class="mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark sm:text-5xl">Learning with purpose.</h2>
                </div>
                <div class="space-y-6 text-lg leading-8 text-slate-600">
                    <p>This page is a foundation for CIC's institutional story. Official history, leadership, and campus information can be added here as the college approves the content. The college's mission, vision, and dedication are presented on their own page.</p>
                    <p><a class="font-semibold text-cic-blue underline decoration-cic-cyan underline-offset-4" href="{{ route('mission-vision.index') }}">Read CIC's mission, vision, and dedication</a></p>
                    <p>For now, the public site focuses on helping prospective students discover CIC's announced degree programs, follow campus stories, and explore the growing academic community.</p>
                </div>
            </section>
            <section class="mx-auto max-w-7xl px-5 pb-16 sm:px-8 lg:pb-24">
                <div class="grid gap-5 md:grid-cols-2">
                    <figure class="cic-image-frame cic-interactive overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                        <img class="aspect-[16/10] size-full object-cover" src="{{ \App\Support\CicImageCatalog::url('Inside CIC Logo, mission Vision-edited.jpg') }}" alt="CIC logo with mission and vision display" loading="lazy">
                        <figcaption class="p-5 text-sm font-semibold text-cic-blue-dark">CIC mission and vision</figcaption>
                    </figure>
                    <figure class="cic-image-frame cic-interactive overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                        <img class="aspect-[16/10] size-full object-cover" src="{{ \App\Support\CicImageCatalog::url('Inside CIC inside View -edited.jpg') }}" alt="Interior view of the City of Ilagan College campus" loading="lazy">
                        <figcaption class="p-5 text-sm font-semibold text-cic-blue-dark">Inside the CIC campus</figcaption>
                    </figure>
                </div>
            </section>
            <section class="bg-white">
                <div class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                    <div class="grid gap-5 md:grid-cols-3">
                        <article class="cic-interactive rounded-3xl border-t-4 border-cic-blue bg-stone-50 p-7">
                            <span class="text-3xl text-cic-blue" aria-hidden="true">◎</span>
                            <h2 class="mt-7 text-xl font-bold text-cic-blue-dark">Learn with purpose</h2>
                            <p class="mt-3 leading-7 text-slate-600">Build knowledge and practical confidence for the next chapter.</p>
                        </article>
                        <article class="cic-interactive rounded-3xl border-t-4 border-cic-green bg-stone-50 p-7">
                            <span class="text-3xl text-cic-green" aria-hidden="true">↗</span>
                            <h2 class="mt-7 text-xl font-bold text-cic-blue-dark">Make your mark</h2>
                            <p class="mt-3 leading-7 text-slate-600">Create, collaborate, and contribute to a growing community.</p>
                        </article>
                        <article class="cic-interactive rounded-3xl border-t-4 border-cic-red bg-stone-50 p-7">
                            <span class="text-3xl text-cic-red" aria-hidden="true">✦</span>
                            <h2 class="mt-7 text-xl font-bold text-cic-blue-dark">Belong here</h2>
                            <p class="mt-3 leading-7 text-slate-600">Find a supportive environment for curiosity and possibility.</p>
                        </article>
                    </div>
                </div>
            </section>
            <section class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                <div class="rounded-[2rem] bg-cic-yellow p-8 sm:p-12">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">Continue exploring</p>
                    <h2 class="mt-3 max-w-2xl text-3xl font-semibold tracking-tight text-cic-blue-dark sm:text-4xl">See the programs and stories shaping CIC.</h2>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a class="cic-action rounded-full bg-cic-blue px-6 py-3.5 font-bold text-white" href="{{ route('programs.index') }}">Explore programs <span class="ml-2" aria-hidden="true">→</span></a>
                        <a class="cic-action rounded-full border border-cic-blue px-6 py-3.5 font-bold text-cic-blue" href="{{ route('articles.index') }}">Read CIC stories <span class="ml-2" aria-hidden="true">→</span></a>
                    </div>
                </div>
            </section>
        </main>
        @include('partials.public-footer')
    </body>
</html>
