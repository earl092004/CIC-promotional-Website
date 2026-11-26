<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class MentalHealthMonthArticleSeeder extends Seeder
{
    public function run(): void
    {
        $author = User::query()
            ->where('email', 'earl@Admin')
            ->firstOrFail();

        Article::query()->updateOrCreate(
            ['slug' => 'mental-health-month-at-cic'],
            [
                'title' => 'Mental Health Month at CIC',
                'type' => Article::TYPE_BLOG,
                'excerpt' => 'CIC recognizes the importance of mental wellbeing and encourages students to learn, connect, and seek support.',
                'content' => <<<'HTML'
<h2>Making wellbeing a priority</h2>
<p>Good mental health helps students participate fully in learning, relationships, and daily campus life.</p>
<h2>What we can practice together</h2>
<p>At CIC, Mental Health Month is a reminder to check in with ourselves and support one another with kindness, patience, and respect.</p>
<ul>
    <li>Notice stress and pause when you need to recharge.</li>
    <li>Stay connected with trusted classmates, teachers, family, and friends.</li>
    <li>Ask for help early from a qualified professional or a person you trust.</li>
</ul>
<h2>Support is strength</h2>
<p>Talking about mental health is an important step toward understanding and care. If you or someone you know is experiencing distress, consider reaching out to a qualified counselor or medical professional.</p>
HTML,
                'cover_image_path' => 'article-covers/mental-health-month.jpg',
                'cover_image_alt' => 'CIC Mental Health Month presentation and community activity',
                'status' => Article::STATUS_PUBLISHED,
                'author_id' => $author->id,
                'reviewer_id' => $author->id,
                'published_at' => now(),
                'revision_notes' => null,
            ],
        );
    }
}
