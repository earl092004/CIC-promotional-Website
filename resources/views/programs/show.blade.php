<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="{{ $program->overview }}">
        <title>{{ $program->name }} | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-cic-blue-dark focus:shadow-lg" href="#main-content">Skip to content</a>
        @include('partials.public-nav')
        <main id="main-content">
            <section class="bg-cic-blue-dark text-white">
                <div class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-cyan">Program preview</p>
                    <h1 class="cic-display mt-4 max-w-4xl text-4xl font-semibold tracking-tight sm:text-6xl">{{ $program->name }}</h1>
                    <p class="mt-6 max-w-3xl text-lg leading-8 text-blue-100">{{ $program->overview }}</p>
                </div>
            </section>
            <section class="mx-auto grid max-w-7xl gap-12 px-5 py-16 sm:px-8 lg:grid-cols-[1fr_0.7fr] lg:py-24">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-green">Learning spaces</p>
                    <h2 class="mt-4 text-4xl font-semibold tracking-tight text-cic-blue-dark">Facilities and laboratory preview</h2>
                    <p class="mt-5 text-lg leading-8 text-slate-600">{{ $program->laboratory_description }}</p>
                    @if (count($program->image_paths ?? []))
                        @php($imageAlts = is_array($program->image_alts) ? $program->image_alts : [])
                        <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3">
                            @foreach ($program->image_paths as $index => $path)
                                <figure class="cic-image-frame cic-interactive overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200 {{ $loop->first ? 'col-span-2 sm:col-span-3' : '' }}">
                                    <button class="block size-full cursor-zoom-in text-left focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-cic-cyan" type="button" data-lightbox-trigger data-lightbox-src="{{ route('media.show', ['path' => $path]) }}" data-lightbox-alt="{{ $imageAlts[$index] ?? $program->name.' laboratory facility' }}" data-lightbox-caption="{{ $program->name }} facility preview">
                                        <img class="size-full min-h-40 object-cover {{ $loop->first ? 'max-h-[28rem]' : '' }}" src="{{ route('media.show', ['path' => $path]) }}" alt="{{ $imageAlts[$index] ?? $program->name.' laboratory facility' }}" loading="lazy">
                                        <span class="sr-only">Open image preview</span>
                                    </button>
                                </figure>
                            @endforeach
                        </div>
                    @elseif (count($facilityImages))
                        <div class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-3">
                            @foreach ($facilityImages as $image)
                                <figure class="cic-image-frame cic-interactive overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200 {{ $loop->first ? 'col-span-2 sm:col-span-3' : '' }}">
                                    <button class="block size-full cursor-zoom-in text-left focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-cic-cyan" type="button" data-lightbox-trigger data-lightbox-src="{{ \App\Support\CicImageCatalog::url($image['file']) }}" data-lightbox-alt="{{ $image['alt'] }}" data-lightbox-caption="{{ $program->name }} facility preview">
                                        <img class="size-full min-h-40 object-cover {{ $loop->first ? 'max-h-[28rem]' : '' }}" src="{{ \App\Support\CicImageCatalog::url($image['file']) }}" alt="{{ $image['alt'] }}" loading="lazy">
                                        <span class="sr-only">Open image preview</span>
                                    </button>
                                </figure>
                            @endforeach
                        </div>
                    @else
                        <div class="mt-10 rounded-3xl border border-dashed border-slate-300 bg-white p-8">
                            <p class="text-lg leading-7 text-slate-600">Approved laboratory and campus images will appear here as CIC adds them through the CMS.</p>
                        </div>
                    @endif
                </div>
                <aside class="h-fit rounded-3xl bg-cic-yellow p-7 text-cic-blue-dark shadow-sm lg:sticky lg:top-8">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">Interested in CIC?</p>
                    <h2 class="mt-4 text-2xl font-bold">Start a conversation.</h2>
                    <p class="mt-4 leading-7 text-cic-blue-dark/80">Enrollment announcements and official updates are shared through CIC's public channels.</p>
                    <a class="cic-action mt-7 inline-flex rounded-full bg-cic-blue px-6 py-3.5 font-bold text-white" href="{{ route('contact.index') }}">Contact CIC <span class="ml-2" aria-hidden="true">→</span></a>
                </aside>
            </section>
            @if ($suggestedPrograms->isNotEmpty())
                <section class="bg-white">
                    <div class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-20">
                        <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">Explore more</p>
                        <h2 class="mt-3 text-3xl font-semibold tracking-tight text-cic-blue-dark">Other programs</h2>
                        <div class="mt-8 grid gap-5 md:grid-cols-3">
                            @foreach ($suggestedPrograms as $suggestedProgram)
                                <a class="cic-interactive rounded-3xl border border-slate-200 bg-stone-50 p-6" href="{{ route('programs.show', $suggestedProgram) }}">
                                    <span class="text-xs font-bold uppercase tracking-widest text-cic-green">Program preview</span>
                                    <h3 class="mt-4 text-xl font-bold text-cic-blue-dark">{{ $suggestedProgram->name }}</h3>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        </main>
        @include('partials.lightbox')
        @include('partials.public-footer')
    </body>
</html>
