<header class="cic-site-header sticky top-0 z-40 border-b border-slate-200/90 bg-white/95 shadow-sm backdrop-blur">
    <div class="hidden border-b border-slate-100 bg-slate-50/80 sm:block">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-2 text-[0.68rem] font-semibold uppercase tracking-[0.14em] text-slate-500 sm:px-8">
            <span>City of Ilagan College</span>
            <span class="text-cic-blue">Educatio Eximia Ad Progressum</span>
        </div>
    </div>
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-5 py-4 sm:px-8">
        <a class="cic-brand-mark flex items-center gap-3 text-cic-blue-dark" href="{{ route('home') }}" aria-label="CIC home">
            <span class="grid size-12 place-items-center rounded-full bg-white ring-1 ring-slate-200 sm:size-14">
                <img class="size-10 object-contain sm:size-12" src="{{ asset('images/cic-logo.png') }}" alt="City of Ilagan College seal">
            </span>
            <span class="min-w-0">
                <strong class="block text-sm font-bold leading-tight text-cic-blue sm:text-base">City of Ilagan College</strong>
                <small class="mt-1 block text-[0.65rem] font-semibold italic leading-tight tracking-wide text-slate-500">Educatio Eximia Ad Progressum</small>
                <small class="block text-[0.6rem] leading-tight text-slate-400">Quality Education Towards Progress</small>
            </span>
        </a>
        <nav class="hidden items-center gap-2 text-sm font-semibold lg:flex lg:gap-3 xl:gap-5" aria-label="Public navigation">
            <a class="cic-nav-link hidden rounded px-1 sm:inline {{ request()->routeIs('home') ? 'text-cic-blue' : '' }}" href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
            <a class="cic-nav-link hidden rounded px-1 sm:inline {{ request()->routeIs('about.*') ? 'text-cic-blue' : '' }}" href="{{ route('about.index') }}" @if (request()->routeIs('about.*')) aria-current="page" @endif>About</a>
            <a class="cic-nav-link hidden rounded px-1 sm:inline {{ request()->routeIs('mission-vision.*') ? 'text-cic-blue' : '' }}" href="{{ route('mission-vision.index') }}" @if (request()->routeIs('mission-vision.*')) aria-current="page" @endif>Mission &amp; Vision</a>
            <a class="cic-nav-link hidden rounded px-1 sm:inline {{ request()->routeIs('admissions.*') ? 'text-cic-blue' : '' }}" href="{{ route('admissions.index') }}" @if (request()->routeIs('admissions.*')) aria-current="page" @endif>Admissions</a>
            <a class="cic-nav-link hidden rounded px-1 sm:inline {{ request()->routeIs('articles.*') ? 'text-cic-blue' : '' }}" href="{{ route('articles.index') }}" @if (request()->routeIs('articles.*')) aria-current="page" @endif>Stories</a>
            <a class="cic-nav-link hidden rounded px-1 sm:inline {{ request()->routeIs('programs.*') ? 'text-cic-blue' : '' }}" href="{{ route('programs.index') }}" @if (request()->routeIs('programs.*')) aria-current="page" @endif>Programs</a>
            <a class="cic-nav-link hidden rounded px-1 sm:inline {{ request()->routeIs('gallery.*') ? 'text-cic-blue' : '' }}" href="{{ route('gallery.index') }}" @if (request()->routeIs('gallery.*')) aria-current="page" @endif>Gallery</a>
            <a class="cic-action rounded-full bg-cic-blue px-4 py-2.5 text-white sm:px-5" href="{{ route('contact.index') }}" data-analytics-event="contact_cta">Contact CIC <span class="ml-1" aria-hidden="true">→</span></a>
        </nav>
        <button class="cic-action rounded-full border border-cic-blue px-4 py-2 text-sm font-semibold text-cic-blue lg:hidden" type="button" aria-controls="public-mobile-menu" aria-expanded="false" data-mobile-menu-toggle>
            <span data-mobile-menu-label>Menu</span>
        </button>
    </div>
    <nav class="hidden border-t border-slate-100 bg-stone-50 px-5 py-3 lg:hidden" id="public-mobile-menu" aria-label="Mobile public navigation">
        <div class="mx-auto grid max-w-7xl gap-1 text-sm font-semibold">
            <a class="cic-nav-link rounded-xl px-3 py-3 {{ request()->routeIs('home') ? 'bg-blue-50 text-cic-blue' : '' }}" href="{{ route('home') }}" @if (request()->routeIs('home')) aria-current="page" @endif>Home</a>
            <a class="cic-nav-link rounded-xl px-3 py-3 {{ request()->routeIs('about.*') ? 'bg-blue-50 text-cic-blue' : '' }}" href="{{ route('about.index') }}" @if (request()->routeIs('about.*')) aria-current="page" @endif>About</a>
            <a class="cic-nav-link rounded-xl px-3 py-3 {{ request()->routeIs('mission-vision.*') ? 'bg-blue-50 text-cic-blue' : '' }}" href="{{ route('mission-vision.index') }}" @if (request()->routeIs('mission-vision.*')) aria-current="page" @endif>Mission, Vision &amp; Dedication</a>
            <a class="cic-nav-link rounded-xl px-3 py-3 {{ request()->routeIs('admissions.*') ? 'bg-blue-50 text-cic-blue' : '' }}" href="{{ route('admissions.index') }}" @if (request()->routeIs('admissions.*')) aria-current="page" @endif>Admissions</a>
            <a class="cic-nav-link rounded-xl px-3 py-3 {{ request()->routeIs('articles.*') ? 'bg-blue-50 text-cic-blue' : '' }}" href="{{ route('articles.index') }}" @if (request()->routeIs('articles.*')) aria-current="page" @endif>Stories</a>
            <a class="cic-nav-link rounded-xl px-3 py-3 {{ request()->routeIs('programs.*') ? 'bg-blue-50 text-cic-blue' : '' }}" href="{{ route('programs.index') }}" @if (request()->routeIs('programs.*')) aria-current="page" @endif>Programs</a>
            <a class="cic-nav-link rounded-xl px-3 py-3 {{ request()->routeIs('gallery.*') ? 'bg-blue-50 text-cic-blue' : '' }}" href="{{ route('gallery.index') }}" @if (request()->routeIs('gallery.*')) aria-current="page" @endif>Gallery</a>
            <a class="cic-action mt-2 rounded-full bg-cic-blue px-4 py-3 text-center text-white" href="{{ route('contact.index') }}">Contact CIC</a>
        </div>
    </nav>
</header>
@include('partials.back-to-top')
