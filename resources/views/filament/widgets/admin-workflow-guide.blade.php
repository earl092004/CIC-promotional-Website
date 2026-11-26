<x-filament-widgets::widget class="cic-admin-workflow-widget">
    <div class="cic-admin-hero">
        <div class="cic-admin-hero-orb cic-admin-hero-orb-yellow" aria-hidden="true"></div>
        <div class="cic-admin-hero-orb cic-admin-hero-orb-cyan" aria-hidden="true"></div>
        <div class="cic-admin-hero-content">
            <div class="max-w-2xl">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-cyan-200">
                    {{ $isContributor ? 'Contributor workspace' : 'Administrator workspace' }}
                </p>
                <h2 class="mt-2 text-2xl font-semibold tracking-tight">
                    {{ $isContributor ? 'Keep your next story moving.' : 'Keep the CIC content queue moving.' }}
                </h2>
                <p class="mt-2 text-sm leading-6 text-blue-100">
                    {{ $isContributor
                        ? 'Create a draft, add accessible media details, then submit it when it is ready for review.'
                        : 'Review submitted stories, guide contributors with clear revision notes, and publish approved content.' }}
                </p>
            </div>

            <div class="cic-admin-action-grid">
                <a
                    class="cic-admin-action-card"
                    href="{{ route('filament.admin.resources.articles.index') }}"
                >
                    <span class="block text-lg font-bold">1</span>
                    <span class="mt-1 block text-xs font-semibold text-blue-100">{{ $isContributor ? 'Open articles' : 'Review articles' }}</span>
                </a>
                @if ($isContributor)
                    <a
                        class="cic-admin-action-card"
                        href="{{ route('filament.admin.resources.articles.create') }}"
                    >
                        <span class="block text-lg font-bold">2</span>
                        <span class="mt-1 block text-xs font-semibold text-blue-100">Start a draft</span>
                    </a>
                    <a
                        class="cic-admin-action-card"
                        href="{{ route('filament.admin.resources.media-assets.index') }}"
                    >
                        <span class="block text-lg font-bold">3</span>
                        <span class="mt-1 block text-xs font-semibold text-blue-100">Manage media</span>
                    </a>
                @else
                    <a
                        class="cic-admin-action-card"
                        href="{{ $submittedArticlesUrl }}"
                    >
                        <span class="block text-lg font-bold">{{ $submittedCount }}</span>
                        <span class="mt-1 block text-xs font-semibold text-blue-100">Awaiting review</span>
                    </a>
                    <a
                        class="cic-admin-action-card"
                        href="{{ route('filament.admin.resources.users.index') }}"
                    >
                        <span class="block text-lg font-bold">3</span>
                        <span class="mt-1 block text-xs font-semibold text-blue-100">Manage users</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="mt-6 border-t border-white/15 pt-4 text-xs text-blue-100">
            @if ($isContributor)
                @if ($changesRequestedCount > 0)
                    <span class="font-semibold text-cyan-200">{{ $changesRequestedCount }} article{{ $changesRequestedCount === 1 ? '' : 's' }} need{{ $changesRequestedCount === 1 ? 's' : '' }} your attention.</span>
                    <a class="ml-1 font-semibold underline underline-offset-4" href="{{ $changesRequestedArticlesUrl }}">View revision requests</a>
                @else
                    Your submitted work will appear here while an Administrator reviews it.
                @endif
            @else
                {{ $submittedCount }} submitted article{{ $submittedCount === 1 ? '' : 's' }} currently {{ $submittedCount === 1 ? 'needs' : 'need' }} review.
            @endif
        </div>
    </div>
</x-filament-widgets::widget>
