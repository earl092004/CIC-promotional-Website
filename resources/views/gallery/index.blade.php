<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Explore approved campus images from City of Ilagan College.">
        <title>Campus Gallery | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        <a class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-full focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-cic-blue-dark focus:shadow-lg" href="#main-content">Skip to content</a>
        @include('partials.public-nav')
        <main id="main-content" class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
            <div class="max-w-3xl">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-green">Campus gallery</p>
                <h1 class="cic-display mt-4 text-5xl font-semibold tracking-tight text-cic-blue-dark sm:text-6xl">See CIC in motion.</h1>
                <p class="mt-5 text-lg leading-8 text-slate-600">Approved images shared by the CIC community through the content management system.</p>
            </div>
            <div class="mt-12 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($campusImages as $image)
                    <figure class="cic-interactive cic-image-frame overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                        <button class="block w-full cursor-zoom-in text-left focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-cic-cyan" type="button" data-lightbox-trigger data-lightbox-src="{{ \App\Support\CicImageCatalog::url($image['file']) }}" data-lightbox-alt="{{ $image['alt'] }}" data-lightbox-caption="{{ $image['title'] }}">
                            <img class="aspect-square size-full object-cover" src="{{ \App\Support\CicImageCatalog::url($image['file']) }}" alt="{{ $image['alt'] }}" loading="lazy">
                            <span class="sr-only">Open image preview</span>
                        </button>
                        <figcaption class="p-4">
                            <p class="font-semibold text-cic-blue-dark">{{ $image['title'] }}</p>
                        </figcaption>
                    </figure>
                @endforeach
                @forelse ($assets as $asset)
                    <figure class="cic-interactive cic-image-frame overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                        <button class="block w-full cursor-zoom-in text-left focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-cic-cyan" type="button" data-lightbox-trigger data-lightbox-src="{{ route('media.show', ['path' => $asset->file_path]) }}" data-lightbox-alt="{{ $asset->alt_text }}" data-lightbox-caption="{{ $asset->caption ?: $asset->title }}">
                            <img class="aspect-square size-full object-cover" src="{{ route('media.show', ['path' => $asset->file_path]) }}" alt="{{ $asset->alt_text }}" loading="lazy">
                            <span class="sr-only">Open image preview</span>
                        </button>
                        <figcaption class="p-4">
                            <p class="font-semibold text-cic-blue-dark">{{ $asset->title }}</p>
                            @if ($asset->caption)
                                <p class="mt-1 text-sm leading-6 text-slate-600">{{ $asset->caption }}</p>
                            @endif
                        </figcaption>
                    </figure>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-8 md:col-span-3 lg:col-span-4">
                        <p class="text-lg leading-7 text-slate-600">The campus gallery is being prepared. Approved images will appear here.</p>
                    </div>
                @endforelse
            </div>
            @if ($assets->hasPages())
                <div class="mt-10">{{ $assets->links() }}</div>
            @endif
        </main>
        @include('partials.lightbox')
        @include('partials.public-footer')
    </body>
</html>
