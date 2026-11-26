<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $article->title }} | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        @include('partials.public-nav')
        <main class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
            @if ($isPreview)
                <div class="mb-8 inline-flex rounded-full bg-cic-yellow px-3 py-2 text-xs font-bold uppercase tracking-wider text-cic-blue-dark">Preview only</div>
            @endif
            <div class="grid gap-12 lg:grid-cols-[minmax(0,1fr)_18rem] lg:items-start">
                <article class="min-w-0">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-blue">{{ str($article->type)->headline() }}</p>
            <h1 class="cic-display mt-5 text-5xl font-semibold tracking-tight text-cic-blue-dark text-balance sm:text-6xl">{{ $article->title }}</h1>
            <p class="mt-5 text-sm text-slate-500">Published {{ $article->published_at?->format('F j, Y') }} · By {{ $article->author->name }} · {{ $article->readingTimeMinutes() }} min read</p>
            @if ($article->cover_image_path)
                <img class="mt-12 max-h-[34rem] w-full rounded-3xl object-cover shadow-xl" src="{{ route('media.show', ['path' => $article->cover_image_path]) }}" alt="{{ $article->cover_image_alt ?: $article->title }}">
            @endif
            <div class="mt-8 flex flex-wrap gap-3">
                <button class="cic-action inline-flex items-center rounded-full border border-cic-blue px-5 py-3 font-bold text-cic-blue" type="button" data-copy-link="{{ url()->current() }}" data-analytics-event="article_share">
                    Copy article link
                </button>
                <a class="cic-action inline-flex items-center rounded-full border border-slate-300 px-5 py-3 font-bold text-slate-700" href="{{ route('articles.index') }}">Browse more stories</a>
            </div>
            <div class="cic-prose mt-12 max-w-3xl">
                {!! $article->content !!}
            </div>
                </article>
                @if ($relatedArticles->isNotEmpty())
                <aside class="lg:sticky lg:top-8" aria-labelledby="related-stories-heading">
                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-cic-green">Keep exploring</p>
                    <h2 id="related-stories-heading" class="mt-3 text-2xl font-semibold tracking-tight text-cic-blue-dark">More stories</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ($relatedArticles as $relatedArticle)
                            <article class="cic-interactive rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                                <p class="text-xs font-bold uppercase tracking-widest text-cic-blue">{{ str($relatedArticle->type)->headline() }}</p>
                                <h3 class="mt-4 text-xl font-bold leading-tight text-cic-blue-dark">
                                    <a class="focus-visible:outline-2 focus-visible:outline-cic-blue" href="{{ route('articles.show', $relatedArticle) }}">{{ $relatedArticle->title }}</a>
                                </h3>
                                <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-600">{{ $relatedArticle->excerpt }}</p>
                            </article>
                        @endforeach
                    </div>
                </aside>
                @endif
            </div>
        </main>
        @include('partials.public-footer')
    </body>
</html>
