<x-filament-widgets::widget class="cic-admin-review-widget">
    <x-filament::section heading="Content review queue" description="Prioritized work that may need administrator attention.">
        <div class="cic-review-grid">
            <section class="cic-review-column cic-review-column-info" aria-labelledby="submitted-heading">
                <div class="cic-review-heading">
                    <span class="cic-review-icon" aria-hidden="true">✓</span>
                    <div>
                        <h3 id="submitted-heading">Awaiting review</h3>
                        <p>New submissions from contributors</p>
                    </div>
                    <span class="cic-review-count">{{ $submittedArticles->count() }}</span>
                </div>
                <div class="cic-review-items">
                    @forelse ($submittedArticles as $article)
                        <a class="cic-review-item" href="{{ route('filament.admin.resources.articles.edit', ['record' => $article]) }}">
                            <span class="cic-review-item-title">{{ $article->title }}</span>
                            <span class="cic-review-item-meta"><b>{{ $article->author?->name ?? 'Unknown author' }}</b><span>{{ $article->submitted_at?->diffForHumans() ?? 'Recently submitted' }}</span></span>
                        </a>
                    @empty
                        <div class="cic-review-empty"><span aria-hidden="true">✓</span><p>All caught up. No articles are waiting for review.</p></div>
                    @endforelse
                </div>
            </section>

            <section class="cic-review-column cic-review-column-warning" aria-labelledby="changes-heading">
                <div class="cic-review-heading">
                    <span class="cic-review-icon" aria-hidden="true">!</span>
                    <div>
                        <h3 id="changes-heading">Changes requested</h3>
                        <p>Stories waiting for updates</p>
                    </div>
                    <span class="cic-review-count">{{ $revisionRequests->count() }}</span>
                </div>
                <div class="cic-review-items">
                    @forelse ($revisionRequests as $article)
                        <a class="cic-review-item" href="{{ route('filament.admin.resources.articles.edit', ['record' => $article]) }}">
                            <span class="cic-review-item-title">{{ $article->title }}</span>
                            <span class="cic-review-item-meta"><b>{{ $article->author?->name ?? 'Unknown author' }}</b><span>Updated {{ $article->updated_at->diffForHumans() }}</span></span>
                        </a>
                    @empty
                        <div class="cic-review-empty"><span aria-hidden="true">✓</span><p>No revision requests are open.</p></div>
                    @endforelse
                </div>
            </section>

            <section class="cic-review-column cic-review-column-danger" aria-labelledby="expiring-heading">
                <div class="cic-review-heading">
                    <span class="cic-review-icon" aria-hidden="true">⏱</span>
                    <div>
                        <h3 id="expiring-heading">Expiring soon</h3>
                        <p>Featured announcements</p>
                    </div>
                    <span class="cic-review-count">{{ $expiringAnnouncements->count() }}</span>
                </div>
                <div class="cic-review-items">
                    @forelse ($expiringAnnouncements as $article)
                        <a class="cic-review-item" href="{{ route('filament.admin.resources.articles.edit', ['record' => $article]) }}">
                            <span class="cic-review-item-title">{{ $article->title }}</span>
                            <span class="cic-review-item-meta"><b>Featured</b><span>Until {{ $article->featured_until->format('M j, Y') }}</span></span>
                        </a>
                    @empty
                        <div class="cic-review-empty"><span aria-hidden="true">✓</span><p>No featured announcements expire within seven days.</p></div>
                    @endforelse
                </div>
            </section>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
