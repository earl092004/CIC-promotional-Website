<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Latest stories | {{ config('app.name', 'CIC') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-stone-50 font-sans text-slate-950 antialiased">
        @include('partials.public-nav')
        <main class="mx-auto max-w-7xl px-5 py-16 sm:px-8 lg:py-24">
            <p class="cic-eyebrow">CIC stories</p>
            <h1 class="cic-display mt-4 text-5xl font-semibold tracking-tight text-cic-blue-dark sm:text-6xl">The latest from CIC.</h1>
            <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">News, achievements, blogs, and announcements from the CIC community.</p>
            @if ($displayFeatured)
                <article class="cic-editorial-card mt-12 grid overflow-hidden rounded-[2rem] {{ $featured->cover_image_path ? 'lg:grid-cols-[1.05fr_0.95fr]' : 'lg:grid-cols-1' }}">
                    @if ($featured->cover_image_path)
                        <div class="cic-image-frame min-h-64 bg-slate-100 lg:min-h-[30rem]">
                            <img class="size-full object-cover" src="{{ route('media.show', ['path' => $featured->cover_image_path]) }}" alt="{{ $featured->cover_image_alt ?: $featured->title }}" fetchpriority="high" decoding="async">
                        </div>
                    @endif
                    <div class="flex flex-col justify-center p-7 sm:p-10">
                        <p class="cic-eyebrow text-cic-green">{{ $featuredLabel }}</p>
                        <h2 class="cic-display mt-4 text-3xl font-semibold leading-tight text-cic-blue-dark sm:text-4xl"><a class="focus-visible:outline-2 focus-visible:outline-cic-blue" href="{{ route('articles.show', $featured) }}">{{ $featured->title }}</a></h2>
                        <p class="mt-4 leading-7 text-slate-600">{{ $featured->excerpt }}</p>
                        <p class="mt-6 text-sm text-slate-500">{{ $featured->published_at?->format('F j, Y') }} · {{ $featured->readingTimeMinutes() }} min read</p>
                        <a class="cic-action mt-7 inline-flex w-fit rounded-full bg-cic-blue px-5 py-3 font-bold text-white" href="{{ route('articles.show', $featured) }}" data-analytics-event="featured_story_open">Read {{ strtolower($featuredLabel) }} <span class="ml-2" aria-hidden="true">→</span></a>
                    </div>
                </article>
            @endif
            <form class="cic-interactive mt-10 grid gap-4 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:grid-cols-[1fr_12rem_auto] sm:items-end" method="GET" action="{{ route('articles.index') }}">
                <div>
                    <label class="text-sm font-bold text-cic-blue-dark" for="article-search">Search stories</label>
                    <input class="mt-2 w-full rounded-2xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-cic-blue focus:ring-cic-blue" id="article-search" name="q" type="search" value="{{ $search }}" placeholder="Search by title or summary">
                </div>
                <div>
                    <label class="text-sm font-bold text-cic-blue-dark" for="article-type">Filter by type</label>
                    <select class="mt-2 w-full rounded-2xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-cic-blue focus:ring-cic-blue" id="article-type" name="type">
                        <option value="">All stories</option>
                        <option value="announcement" @selected($type === 'announcement')>Announcements</option>
                        <option value="news" @selected($type === 'news')>News</option>
                        <option value="blog" @selected($type === 'blog')>Blogs</option>
                        <option value="achievement" @selected($type === 'achievement')>Achievements</option>
                    </select>
                </div>
                <div class="flex gap-3">
                    <button class="cic-action inline-flex flex-1 items-center justify-center rounded-full bg-cic-blue px-5 py-3 font-bold text-white" type="submit">Apply</button>
                    @if ($search !== '' || $type !== '')
                        <a class="cic-action inline-flex items-center justify-center rounded-full border border-cic-blue px-5 py-3 font-bold text-cic-blue" href="{{ route('articles.index') }}">Clear</a>
                    @endif
                </div>
            </form>
            @if ($search !== '' || $type !== '')
                <p class="mt-5 text-sm font-semibold text-slate-500">
                    Showing filtered results{{ $search !== '' ? ' for “'.$search.'”' : '' }}{{ $type !== '' ? ' in '.str($type)->headline() : '' }}.
                </p>
            @endif
            <section id="older-stories" class="mt-12" aria-labelledby="older-stories-heading">
                <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="cic-eyebrow">{{ $search !== '' || $type !== '' ? 'Explore the archive' : 'Keep exploring' }}</p>
                        <h2 id="older-stories-heading" class="cic-display mt-2 text-3xl font-semibold tracking-tight text-cic-blue-dark sm:text-4xl">{{ $search !== '' || $type !== '' ? 'Matching stories' : ($featured ? 'More stories' : 'All stories') }}</h2>
                    </div>
                    @if ($articles->total() > 0)
                        <p class="text-sm text-slate-500">Showing {{ $articles->firstItem() }}–{{ $articles->lastItem() }} of {{ $articles->total() }} {{ $articles->total() === 1 ? 'story' : 'stories' }}</p>
                    @endif
                </div>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @forelse ($articles as $article)
                        <article class="cic-editorial-card cic-interactive overflow-hidden rounded-3xl">
                            @if ($article->cover_image_path)
                                <div class="cic-image-frame h-52 bg-slate-100">
                                    <img class="size-full object-cover" src="{{ route('media.show', ['path' => $article->cover_image_path]) }}" alt="{{ $article->cover_image_alt ?: $article->title }}" loading="lazy" decoding="async">
                                </div>
                            @endif
                            <div class="p-7">
                                <p class="cic-eyebrow">{{ str($article->type)->headline() }}</p>
                                <h2 class="mt-4 text-2xl font-bold leading-tight text-cic-blue-dark"><a class="focus-visible:outline-2 focus-visible:outline-cic-blue" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h2>
                                <p class="mt-3 line-clamp-3 leading-7 text-slate-600">{{ $article->excerpt }}</p>
                                <p class="mt-6 text-sm text-slate-500">{{ $article->published_at?->format('F j, Y') }} · {{ $article->readingTimeMinutes() }} min read</p>
                            </div>
                        </article>
                    @empty
                        <p class="rounded-3xl bg-white p-8 text-slate-600 ring-1 ring-slate-200 md:col-span-2 lg:col-span-3">No published stories are available yet.</p>
                    @endforelse
                </div>
                <div class="mt-10">{{ $articles->links() }}</div>
            </section>
        </main>
        @include('partials.public-footer')
    </body>
</html>
