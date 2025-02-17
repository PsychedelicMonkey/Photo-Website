<?php

namespace Database\Seeders;

use App\Models\Blog\Author;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Portfolio\Album;
use App\Models\Portfolio\Model as PortfolioModel;
use App\Models\Tag;
use App\Models\User;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\ProgressBar;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::raw('SET time_zone=\'+00:00\'');

        // Clear images.
        Storage::deleteDirectory('public');

        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $user = $this->withProgressBar(1, fn () => User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]));
        $this->command->info('Admin user created.');

        // Tags
        $this->command->warn(PHP_EOL . 'Creating tags...');
        $tags = $this->withProgressBar(100, fn () => Tag::factory(1)
            ->create());
        $this->command->info('Tags created.');

        // Portfolio
        $this->command->warn(PHP_EOL . 'Creating portfolio models and albums...');
        $this->withProgressBar(50, fn () => PortfolioModel::factory(1)
            ->has(
                Album::factory(5)
                    ->hasAttached($tags->random(rand(2, 6))),
                'albums'
            )
            ->create());
        $this->command->info('Portfolio models and albums created.');

        // Blog
        $this->command->warn(PHP_EOL . 'Creating blog categories...');
        $categories = $this->withProgressBar(20, fn () => Category::factory(1)
            ->create());
        $this->command->info('Blog categories created.');

        $this->command->warn(PHP_EOL . 'Creating blog authors and posts...');
        $this->withProgressBar(20, fn () => Author::factory(1)
            ->has(
                Post::factory(5)
                    ->hasAttached($tags->random(rand(3, 5)))
                    ->state(fn (array $attributes, Author $author) => ['blog_category_id' => $categories->random(1)->first()->id]),
                'posts'
            )
            ->create());
        $this->command->info('Blog authors and posts created.');
    }

    /** @return Collection<string, Model> */
    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection;

        foreach (range(1, $amount) as $item) {
            $items = $items->merge(
                $createCollectionOfOne()
            );

            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
