<footer id="contact" class="cic-site-footer mt-16">
    <div class="mx-auto grid max-w-7xl gap-10 px-5 py-14 sm:px-8 lg:grid-cols-[1.4fr_0.8fr_0.8fr]">
        <div>
            <p class="cic-eyebrow text-cic-cyan">City of Ilagan College</p>
            <h2 class="cic-display mt-4 max-w-md text-3xl font-semibold text-white sm:text-4xl">Learn with purpose. Lead with possibility.</h2>
            <p class="mt-5 max-w-md leading-7 text-blue-100">Explore CIC programs, campus stories, and the next steps toward your college journey.</p>
        </div>
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-white">Explore</p>
            <nav class="mt-5 grid gap-3 text-sm text-blue-100" aria-label="Footer navigation">
                <a class="hover:text-cic-cyan focus-visible:text-cic-cyan" href="{{ route('about.index') }}">About CIC</a>
                <a class="hover:text-cic-cyan focus-visible:text-cic-cyan" href="{{ route('mission-vision.index') }}">Mission, Vision &amp; Dedication</a>
                <a class="hover:text-cic-cyan focus-visible:text-cic-cyan" href="{{ route('programs.index') }}">Programs</a>
                <a class="hover:text-cic-cyan focus-visible:text-cic-cyan" href="{{ route('articles.index') }}">Stories</a>
                <a class="hover:text-cic-cyan focus-visible:text-cic-cyan" href="{{ route('gallery.index') }}">Gallery</a>
            </nav>
        </div>
        <div>
            <p class="text-sm font-bold uppercase tracking-widest text-white">Start here</p>
            <nav class="mt-5 grid gap-3 text-sm text-blue-100" aria-label="Footer calls to action">
                <a class="hover:text-cic-cyan focus-visible:text-cic-cyan" href="{{ route('admissions.index') }}">Admissions</a>
                <a class="hover:text-cic-cyan focus-visible:text-cic-cyan" href="{{ route('contact.index') }}">Contact CIC</a>
                <a class="hover:text-cic-cyan focus-visible:text-cic-cyan" href="https://www.facebook.com/cityofilagancollege" target="_blank" rel="noopener noreferrer">Official Facebook <span aria-hidden="true">↗</span></a>
            </nav>
        </div>
    </div>
    <div class="border-t border-white/15">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-5 py-5 text-xs text-blue-200 sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <span>© {{ date('Y') }} City of Ilagan College</span>
            <span>Educatio Eximia Ad Progressum</span>
            <span>Sample content is replaced with verified institutional information.</span>
        </div>
    </div>
</footer>
