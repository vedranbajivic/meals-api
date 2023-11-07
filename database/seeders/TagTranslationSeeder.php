<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TagTranslation;
use App\Models\Tag;

class TagTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = config('translatable.locales');
        $tags = Tag::all();
        
        foreach ($tags as $tag) {
            foreach ($locales as $locale) {
                TagTranslation::factory()->create([
                    'tag_id' => $tag->id,
                    'locale' => $locale,
                ]);
            }
        }
    }
}
