<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_page_displays_a_published_mental_health_month_blog(): void
    {
        $author = User::factory()->create(['name' => 'EarlAdmin']);
        $article = Article::factory()->for($author, 'author')->create([
            'title' => 'Mental Health Month at CIC',
            'slug' => 'mental-health-month-at-cic',
            'type' => Article::TYPE_BLOG,
            'excerpt' => 'CIC recognizes the importance of mental wellbeing in student life.',
            'content' => '<h2>Making wellbeing a priority</h2><p>CIC encourages students to learn, connect, and seek support.</p>',
            'cover_image_path' => 'article-covers/mental-health-month.jpg',
            'cover_image_alt' => 'CIC Mental Health Month presentation and community activity',
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        $this->get(route('articles.show', $article))
            ->assertOk()
            ->assertSee('Mental Health Month at CIC')
            ->assertSee('Making wellbeing a priority')
            ->assertSee('/media/article-covers/mental-health-month.jpg', false);
    }

    public function test_public_listing_shows_published_non_expired_articles_only(): void
    {
        $author = User::factory()->create();
        $current = Article::factory()->for($author, 'author')->create([
            'title' => 'Current announcement',
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
            'featured_until' => now()->addDay(),
        ]);
        Article::factory()->for($author, 'author')->create([
            'title' => 'Expired announcement',
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
            'featured_until' => now()->subDay(),
        ]);
        Article::factory()->for($author, 'author')->create([
            'title' => 'Draft story',
            'status' => Article::STATUS_DRAFT,
        ]);

        $this->get(route('articles.index'))
            ->assertOk()
            ->assertSee($current->title)
            ->assertDontSee('Expired announcement')
            ->assertDontSee('Draft story');
    }

    public function test_public_listing_can_search_and_filter_by_type(): void
    {
        $author = User::factory()->create();
        Article::factory()->for($author, 'author')->create([
            'title' => 'Science fair achievement',
            'type' => Article::TYPE_ACHIEVEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);
        Article::factory()->for($author, 'author')->create([
            'title' => 'Campus news update',
            'type' => Article::TYPE_NEWS,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        $this->get(route('articles.index', ['q' => 'Science', 'type' => Article::TYPE_ACHIEVEMENT]))
            ->assertOk()
            ->assertSee('Science fair achievement')
            ->assertDontSee('Campus news update');
    }

    public function test_public_listing_promotes_the_active_featured_story_and_excludes_it_from_the_grid(): void
    {
        $author = User::factory()->create();
        $featured = Article::factory()->for($author, 'author')->create([
            'title' => 'Featured admissions update',
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
            'featured_until' => now()->addDay(),
        ]);
        Article::factory()->for($author, 'author')->create([
            'title' => 'Latest campus story',
            'type' => Article::TYPE_NEWS,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now()->subHour(),
        ]);

        $this->get(route('articles.index'))
            ->assertOk()
            ->assertSee('Featured story')
            ->assertSee($featured->title)
            ->assertSee('Read featured story');
    }

    public function test_public_listing_promotes_the_newest_story_and_paginates_older_stories_eight_at_a_time(): void
    {
        $author = User::factory()->create();
        $newestStory = Article::factory()->for($author, 'author')->create([
            'title' => 'Newest CIC blog',
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        foreach (range(1, 9) as $daysAgo) {
            Article::factory()->for($author, 'author')->create([
                'title' => "Older story {$daysAgo}",
                'status' => Article::STATUS_PUBLISHED,
                'published_at' => now()->subDays($daysAgo),
            ]);
        }

        $this->get(route('articles.index'))
            ->assertOk()
            ->assertSee('Latest story')
            ->assertSee($newestStory->title)
            ->assertSee('Older story 1')
            ->assertDontSee('Older story 9');

        $this->get(route('articles.index', ['page' => 2]))
            ->assertOk()
            ->assertDontSee('Latest story')
            ->assertSee('Older story 9');
    }

    public function test_public_listing_includes_a_featured_story_when_searching(): void
    {
        $featured = Article::factory()->for(User::factory(), 'author')->create([
            'title' => 'Featured admissions notice',
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
            'featured_until' => now()->addDay(),
        ]);

        $this->get(route('articles.index', ['q' => 'admissions']))
            ->assertOk()
            ->assertSee($featured->title);
    }

    public function test_article_listing_displays_a_minimum_reading_time(): void
    {
        $article = Article::factory()->for(User::factory(), 'author')->create([
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
            'content' => str_repeat('<p>Approved story content.</p>', 20),
        ]);

        $this->get(route('articles.index'))
            ->assertOk()
            ->assertSee($article->readingTimeMinutes().' min read');
    }

    public function test_invalid_article_type_filter_falls_back_to_all_published_stories(): void
    {
        $article = Article::factory()->for(User::factory(), 'author')->create([
            'title' => 'Published story',
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);

        $this->get(route('articles.index', ['type' => 'not-a-real-type']))
            ->assertOk()
            ->assertSee($article->title);
    }

    public function test_published_article_detail_remains_available_after_announcement_expiration(): void
    {
        $article = Article::factory()->for(User::factory(), 'author')->create([
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now()->subWeek(),
            'featured_until' => now()->subDay(),
            'content' => '<p>Approved <strong>announcement</strong>.</p><script>alert("unsafe");</script>',
        ]);

        $this->get(route('articles.show', $article))
            ->assertOk()
            ->assertSee('Approved <strong>announcement</strong>.', false)
            ->assertDontSee('<script>', false);
    }

    public function test_article_detail_preserves_safe_inline_storage_images(): void
    {
        Storage::fake('media');
        Storage::disk('media')->put('campaign-photo.jpg', 'campaign photo');
        Storage::disk('media')->put('article-content/editor-photo.jpg', 'editor photo');
        $storageImageUrl = Storage::disk('public')->url('campaign-photo.jpg');
        $article = Article::factory()->for(User::factory(), 'author')->create([
            'status' => Article::STATUS_PUBLISHED,
            'content' => '<p>Story</p><img src="'.$storageImageUrl.'" alt="Campaign photo" data-id="campaign-photo.jpg" onerror="alert(1)"><img src="'.Storage::disk('media')->url('article-content/editor-photo.jpg').'" alt="Editor photo"><img src="https://unsafe.example/storage/image.png">',
        ]);

        $this->get(route('articles.show', $article))
            ->assertOk()
            ->assertSee('src="/media/campaign-photo.jpg" alt="Campaign photo"', false)
            ->assertSee('src="/media/article-content/editor-photo.jpg" alt="Editor photo"', false)
            ->assertDontSee('onerror', false)
            ->assertDontSee('unsafe.example', false);

        $this->get(route('media.show', ['path' => 'campaign-photo.jpg']))
            ->assertOk();

        $this->get(route('media.show', ['path' => 'article-content/editor-photo.jpg']))
            ->assertOk();
    }

    public function test_inline_article_images_are_not_public_when_only_a_draft_references_them(): void
    {
        Storage::fake('media');
        Storage::disk('media')->put('article-content/draft-photo.jpg', 'draft photo');
        $author = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $article = Article::factory()->for($author, 'author')->create([
            'status' => Article::STATUS_DRAFT,
            'content' => '<p>Draft</p><img src="'.Storage::disk('media')->url('article-content/draft-photo.jpg').'" alt="Draft photo">',
        ]);

        $this->get(route('media.show', ['path' => 'article-content/draft-photo.jpg']))
            ->assertNotFound();

        $this->actingAs($author)
            ->get(route('media.show', ['path' => 'article-content/draft-photo.jpg']))
            ->assertOk();

        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);

        $this->actingAs($administrator)
            ->get(route('media.show', ['path' => 'article-content/draft-photo.jpg']))
            ->assertOk();
    }

    public function test_article_detail_shows_active_related_stories_of_the_same_type(): void
    {
        $author = User::factory()->create();
        $article = Article::factory()->for($author, 'author')->create([
            'type' => Article::TYPE_BLOG,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);
        $related = Article::factory()->for($author, 'author')->create([
            'title' => 'Related community blog',
            'type' => Article::TYPE_BLOG,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
        ]);
        Article::factory()->for($author, 'author')->create([
            'title' => 'Expired related announcement',
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'featured_until' => now()->subDay(),
            'published_at' => now()->subDays(2),
        ]);

        $this->get(route('articles.show', $article))
            ->assertOk()
            ->assertSee($related->title)
            ->assertSee('Copy article link')
            ->assertDontSee('Expired related announcement');
    }

    public function test_article_detail_falls_back_to_other_active_types_when_same_type_stories_are_unavailable(): void
    {
        $author = User::factory()->create();
        $article = Article::factory()->for($author, 'author')->create([
            'type' => Article::TYPE_BLOG,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);
        $fallback = Article::factory()->for($author, 'author')->create([
            'title' => 'Active fallback news',
            'type' => Article::TYPE_NEWS,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
        ]);

        $this->get(route('articles.show', $article))
            ->assertOk()
            ->assertSee($fallback->title);
    }

    public function test_contributor_can_preview_their_draft_but_public_route_cannot_open_it(): void
    {
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $draft = Article::factory()->for($contributor, 'author')->create([
            'title' => 'Draft preview article',
            'status' => Article::STATUS_DRAFT,
        ]);

        $this->actingAs($contributor)
            ->get(route('articles.preview', $draft))
            ->assertOk()
            ->assertSee('Preview only')
            ->assertSee($draft->title);

        $this->get(route('articles.show', $draft))
            ->assertNotFound();
    }

    public function test_article_policy_allows_contributors_to_submit_only_their_own_drafts(): void
    {
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $otherContributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $ownDraft = Article::factory()->for($contributor, 'author')->create();
        $otherDraft = Article::factory()->for($otherContributor, 'author')->create();

        $this->assertTrue($contributor->can('submit', $ownDraft));
        $this->assertFalse($contributor->can('submit', $otherDraft));
        $this->assertFalse($contributor->can('publish', $ownDraft));
    }

    public function test_administrators_can_publish_and_archive_drafts(): void
    {
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $draft = Article::factory()->for(User::factory(), 'author')->create([
            'status' => Article::STATUS_DRAFT,
        ]);

        $this->assertTrue($administrator->can('publish', $draft));
        $this->assertTrue($administrator->can('archive', $draft));
    }

    public function test_contributors_cannot_publish_or_archive_articles(): void
    {
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $draft = Article::factory()->for($contributor, 'author')->create();

        $this->assertFalse($contributor->can('publish', $draft));
        $this->assertFalse($contributor->can('archive', $draft));
    }

    public function test_administrator_can_open_an_article_editor_after_unpublishing_or_archiving(): void
    {
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $article = Article::factory()->for(User::factory(), 'author')->create([
            'status' => Article::STATUS_ARCHIVED,
            'cover_image_path' => null,
        ]);

        $this->actingAs($administrator)
            ->get(route('filament.admin.resources.articles.edit', ['record' => $article]))
            ->assertOk()
            ->assertSee($article->title);
    }

    public function test_article_list_does_not_wrap_each_cell_in_an_edit_link(): void
    {
        $administrator = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $article = Article::factory()->for($administrator, 'author')->create([
            'status' => Article::STATUS_DRAFT,
        ]);

        $response = $this->actingAs($administrator)
            ->get(route('filament.admin.resources.articles.index'));

        $response->assertOk()
            ->assertSee($article->title);

        $editUrl = route('filament.admin.resources.articles.edit', ['record' => $article]);

        $this->assertSame(1, substr_count($response->getContent(), $editUrl));
    }

    public function test_article_edit_policy_does_not_allow_contributors_to_edit_published_articles(): void
    {
        $contributor = User::factory()->create(['role' => User::ROLE_CONTRIBUTOR]);
        $published = Article::factory()->for($contributor, 'author')->create([
            'status' => Article::STATUS_PUBLISHED,
        ]);

        $this->assertFalse($contributor->can('update', $published));
        $this->assertTrue($contributor->can('update', $published->forceFill([
            'status' => Article::STATUS_DRAFT,
        ])));
    }

    public function test_replacing_or_deleting_an_article_cover_cleans_unreferenced_private_files(): void
    {
        Storage::fake('media');
        Storage::disk('media')->put('article-covers/old.png', 'old');
        Storage::disk('media')->put('article-covers/new.png', 'new');
        $article = Article::factory()->for(User::factory(), 'author')->create([
            'cover_image_path' => 'article-covers/old.png',
        ]);

        $article->update(['cover_image_path' => 'article-covers/new.png']);
        Storage::disk('media')->assertMissing('article-covers/old.png');
        Storage::disk('media')->assertExists('article-covers/new.png');

        $article->delete();
        Storage::disk('media')->assertMissing('article-covers/new.png');
    }
}
