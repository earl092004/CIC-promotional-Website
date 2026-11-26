<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_programs_page_shows_the_announced_degree_programs(): void
    {
        $this->get(route('programs.index'))
            ->assertOk()
            ->assertViewIs('programs.index')
            ->assertSee('BS Psychology')
            ->assertSee('BS Medical Technology')
            ->assertSee('BS Radiologic Technology')
            ->assertSee('BS Information System')
            ->assertSee('CHED-RO2');
    }

    public function test_about_page_links_to_the_mission_vision_and_dedication_page(): void
    {
        $this->get(route('about.index'))
            ->assertOk()
            ->assertViewIs('about.index')
            ->assertSee('About City of Ilagan College')
            ->assertSee('Official history, leadership, and campus information')
            ->assertSee(route('mission-vision.index'), false)
            ->assertSee(route('programs.index'), false)
            ->assertSee(route('articles.index'), false);
    }

    public function test_mission_vision_page_shows_the_three_inscription_tablets_and_full_administration_roster(): void
    {
        $this->get(route('mission-vision.index'))
            ->assertOk()
            ->assertViewIs('mission-vision.index')
            ->assertSee('A premier higher educational institution in Asia')
            ->assertSee('To provide exceptional learning experiences')
            ->assertSee('With hearts steadfast in hope')
            ->assertSee('The doors once closed shall now stand open')
            ->assertSee('This edifice was built during the administration of')
            ->assertSee('Hon. Jay Eveson C. Diaz, RN, DPA')
            ->assertSee('City Mayor')
            ->assertSee('City Vice Mayor')
            ->assertSee('Sangguniang Panlungsod Members')
            ->assertSee('Hon. Rachel V. Garcia, RSW')
            ->assertSee('Hon. Eroll John R. Nebalasca')
            ->assertSee('Engr. Crisanta D. Concepcion')
            ->assertSee('John Jonard Miranda')
            ->assertSee('Ar. Tristan James A. Flores')
            ->assertSee('Mission, Vision &amp; Dedication', false);
    }

    public function test_admissions_page_uses_verified_content_placeholders_and_navigation(): void
    {
        $this->get(route('admissions.index'))
            ->assertOk()
            ->assertViewIs('admissions.index')
            ->assertSee('Your next chapter starts with a conversation.')
            ->assertSee('Official admissions details will be published here after confirmation.')
            ->assertSee(route('programs.index'), false)
            ->assertSee(route('about.index'), false);
    }

    public function test_contact_page_is_public_and_does_not_publish_unverified_contact_details(): void
    {
        $this->get(route('contact.index'))
            ->assertOk()
            ->assertViewIs('contact.index')
            ->assertSee('Contact CIC')
            ->assertSee('Official contact and location details will be published here after verification.')
            ->assertDontSee('example.com');
    }

    public function test_seo_endpoints_exclude_private_preview_paths_and_unpublished_content(): void
    {
        $this->get(route('seo.robots'))
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('Disallow: /admin')
            ->assertSee('Disallow: /articles/*/preview');

        $published = Article::factory()->for(User::factory(), 'author')->create([
            'slug' => 'published-sitemap-story',
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
        ]);
        Article::factory()->for(User::factory(), 'author')->create([
            'slug' => 'private-sitemap-draft',
            'status' => Article::STATUS_DRAFT,
        ]);

        $this->get(route('seo.sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee(route('mission-vision.index'), false)
            ->assertSee(route('articles.show', $published), false)
            ->assertDontSee('private-sitemap-draft');
    }

    /**
     * A basic test example.
     */
    public function test_the_homepage_returns_the_cic_landing_page(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertViewIs('welcome')
            ->assertSee('Start where your', false)
            ->assertSee('Explore admissions', false)
            ->assertSee('Sample content', false)
            ->assertSee('What would you like to explore?')
            ->assertSee('What we can answer today.')
            ->assertSee('Educatio Eximia Ad Progressum')
            ->assertSee('Quality Education Towards Progress')
            ->assertSee('data-cic-intro', false)
            ->assertSee('ilagan_city_college_intro.webp', false)
            ->assertSee('data-cic-intro-skip', false)
            ->assertSee('data-faq-toggle', false)
            ->assertSee('aria-expanded="false"', false)
            ->assertSee('data-back-to-top', false)
            ->assertSee('Back to top');
    }

    public function test_homepage_shows_active_featured_announcements_only(): void
    {
        $author = User::factory()->create();
        Article::factory()->for($author, 'author')->create([
            'title' => 'Featured campus update',
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
            'featured_until' => now()->addDay(),
        ]);
        Article::factory()->for($author, 'author')->create([
            'title' => 'Expired campus update',
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now()->subDay(),
            'featured_until' => now()->subDay(),
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Featured campus update')
            ->assertDontSee('Expired campus update');
    }

    public function test_homepage_keeps_latest_stories_in_one_feed_without_repeating_featured_announcements(): void
    {
        $author = User::factory()->create();
        $featured = Article::factory()->for($author, 'author')->create([
            'title' => 'Featured update',
            'type' => Article::TYPE_ANNOUNCEMENT,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now(),
            'featured_until' => now()->addDay(),
        ]);
        $story = Article::factory()->for($author, 'author')->create([
            'title' => 'Community blog story',
            'type' => Article::TYPE_BLOG,
            'status' => Article::STATUS_PUBLISHED,
            'published_at' => now()->subHour(),
        ]);

        $response = $this->get(route('home'));

        $response->assertSee($featured->title)
            ->assertSee($story->title);
        $this->assertSame(1, substr_count($response->getContent(), $featured->title));
        $this->assertStringContainsString('Featured', $response->getContent());
    }
}
