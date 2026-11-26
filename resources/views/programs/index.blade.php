<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Explore degree programs reported by City of Ilagan College.">
        <title>Programs Offered | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:z-50 focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-cic-blue-dark focus:shadow-lg" href="#main-content">Skip to content</a>
        @include('partials.public-nav')
        <main id="main-content">
            <section class="relative overflow-hidden bg-cic-blue-dark text-white">
                <div class="absolute -right-32 -top-32 size-96 rounded-full bg-cic-blue/50 blur-3xl" aria-hidden="true"></div>
                <div class="relative mx-auto max-w-7xl px-5 py-20 sm:px-8 lg:py-28">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-cyan">Programs offered</p>
                    <h1 class="cic-display mt-4 max-w-4xl text-5xl font-semibold tracking-tight sm:text-6xl">Build your next chapter at CIC.</h1>
                    <p class="mt-6 max-w-3xl text-lg leading-8 text-blue-100">Explore the degree programs named in CIC's Reports on the Result of the Preliminary Assessment (RRPA) from the Commission on Higher Education – Regional Office 2 (CHED-RO2).</p>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                <div class="grid gap-6 md:grid-cols-2">
                    @foreach ($programs as $program)
                        <article class="cic-interactive group rounded-3xl border border-slate-200 border-t-4 border-t-cic-blue bg-white p-7 shadow-sm sm:p-9">
                            @php($facilityImage = collect(\App\Support\CicImageCatalog::forProgram($program->slug))->first())
                            @if ($facilityImage)
                                <div class="cic-image-frame mb-7 overflow-hidden rounded-2xl bg-slate-100">
                                    <img class="aspect-[16/9] size-full object-cover" src="{{ \App\Support\CicImageCatalog::url($facilityImage['file']) }}" alt="{{ $facilityImage['alt'] }}" loading="lazy">
                                </div>
                            @endif
                            <span class="grid size-12 place-items-center rounded-2xl bg-cic-blue/10 text-xl font-bold text-cic-blue" aria-hidden="true">{{ $loop->iteration }}</span>
                            <h2 class="mt-8 text-2xl font-bold text-cic-blue-dark sm:text-3xl"><a class="focus-visible:outline-2 focus-visible:outline-cic-blue" href="{{ route('programs.show', $program) }}">{{ $program->name }}</a></h2>
                            <p class="mt-3 leading-7 text-slate-600">{{ $program->overview }}</p>
                            <a class="mt-6 inline-block font-bold text-cic-blue" href="{{ route('programs.show', $program) }}">View program preview <span aria-hidden="true">→</span></a>
                        </article>
                    @endforeach
                </div>
            </section>

            <section class="bg-cic-yellow">
                <div class="mx-auto grid max-w-7xl gap-10 px-5 py-16 sm:px-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-center lg:py-20">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">A CIC milestone</p>
                        <h2 class="mt-3 text-3xl font-semibold tracking-tight text-cic-blue-dark sm:text-4xl">A step toward accessible, quality higher education.</h2>
                        <p class="mt-5 max-w-3xl text-lg leading-8 text-cic-blue-dark/80">CIC proudly received the RRPA from CHED-RO2 for these programs. This milestone reflects the college's commitment to academic excellence and compliance with CHED standards.</p>
                    </div>
                    <div class="rounded-3xl bg-white/75 p-7 shadow-sm">
                        <p class="text-lg font-bold text-cic-blue-dark">We are now accepting enrollees.</p>
                        <p class="mt-3 leading-7 text-slate-600">Be part of CIC's growing academic community and begin a journey of learning, innovation, and success.</p>
                        <a class="cic-action mt-6 inline-flex rounded-full bg-cic-blue px-6 py-3.5 font-bold text-white" href="{{ route('home') }}#contact">Ask about enrollment <span class="ml-2" aria-hidden="true">→</span></a>
                    </div>
                </div>
            </section>

            <section class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                <div class="rounded-[2rem] bg-cic-blue-dark p-8 text-white sm:p-12">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-cyan">Official updates</p>
                    <h2 class="mt-3 text-3xl font-semibold tracking-tight sm:text-4xl">Follow CIC for announcements.</h2>
                    <p class="mt-4 max-w-2xl leading-7 text-blue-100">For the latest enrollment announcements and official updates, visit the City of Ilagan College Facebook page.</p>
                    <a class="cic-action mt-7 inline-flex rounded-full border border-cic-cyan px-6 py-3.5 font-bold text-white" href="https://www.facebook.com/cityofilagancollege" target="_blank" rel="noopener noreferrer">Visit official Facebook page <span class="ml-2" aria-hidden="true">↗</span></a>
                </div>
            </section>
        </main>
        @include('partials.public-footer')
    </body>
</html>
