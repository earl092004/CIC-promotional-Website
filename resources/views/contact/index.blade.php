<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Find verified contact and location information for City of Ilagan College.">
        <title>Contact CIC | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-cic-blue-dark focus:shadow-lg" href="#main-content">Skip to content</a>
        @include('partials.public-nav')
        <main id="main-content">
            <section class="relative overflow-hidden bg-cic-blue-dark text-white">
                <img class="absolute inset-0 size-full object-cover object-center opacity-25" src="{{ \App\Support\CicImageCatalog::url('Outside CIC View 2-edited.jpg') }}" alt="" aria-hidden="true">
                <div class="absolute inset-0 bg-gradient-to-r from-cic-blue-dark via-cic-blue-dark/95 to-cic-blue-dark/65" aria-hidden="true"></div>
                <div class="absolute -right-40 -top-40 size-[28rem] rounded-full bg-cic-blue/50 blur-3xl" aria-hidden="true"></div>
                <div class="relative mx-auto max-w-7xl px-5 py-20 sm:px-8 lg:py-28">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-cyan">Contact and location</p>
                    <h1 class="cic-display mt-4 max-w-4xl text-5xl font-semibold tracking-tight sm:text-6xl">Let’s connect when you’re ready.</h1>
                    <p class="mt-6 max-w-2xl text-lg leading-8 text-blue-100">This page is prepared for CIC’s verified campus address, office hours, telephone numbers, email addresses, and map location.</p>
                </div>
            </section>
            <section class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ([
                        ['label' => 'Visit the campus', 'text' => 'Official campus address and map directions will appear here after verification.', 'border' => 'border-cic-blue'],
                        ['label' => 'Ask a question', 'text' => 'Verified admissions and general information contacts will appear here.', 'border' => 'border-cic-green'],
                        ['label' => 'Follow updates', 'text' => 'Use CIC’s official Facebook page for the latest verified public announcements.', 'border' => 'border-cic-red'],
                    ] as $item)
                        <article class="cic-interactive rounded-3xl border-t-4 {{ $item['border'] }} bg-white p-7 shadow-sm">
                            <h2 class="text-xl font-bold text-cic-blue-dark">{{ $item['label'] }}</h2>
                            <p class="mt-4 leading-7 text-slate-600">{{ $item['text'] }}</p>
                        </article>
                    @endforeach
                </div>
                <div class="mt-10 rounded-[2rem] bg-cic-yellow p-8 sm:p-12">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">Information pending confirmation</p>
                    <h2 class="mt-4 max-w-2xl text-3xl font-semibold tracking-tight text-cic-blue-dark sm:text-4xl">Official contact and location details will be published here after verification.</h2>
                    <p class="mt-5 max-w-2xl leading-7 text-cic-blue-dark/80">Until then, please avoid relying on unofficial phone numbers, email addresses, schedules, or map pins. Administrators can add approved information through the CMS in a future update.</p>
                    <a class="cic-action mt-7 inline-flex rounded-full bg-cic-blue px-6 py-3.5 font-bold text-white" href="https://www.facebook.com/cityofilagancollege" target="_blank" rel="noopener noreferrer">Visit official Facebook page <span class="ml-2" aria-hidden="true">↗</span></a>
                </div>
            </section>
        </main>
        @include('partials.public-footer')
    </body>
</html>
