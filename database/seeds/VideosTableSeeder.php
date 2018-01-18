<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Collection;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Collection $series */
        $series = \CodeFlix\Models\Serie::all();
        /** @var Collection $categories */
        $categories = \CodeFlix\Models\Category::all();

        factory(\CodeFlix\Models\Video::class, 100)
            ->create()
            ->each(function ($video) use ($series, $categories){
                $video->categories()->attach($categories->random(4)->pluck('id'));
                $num = mt_rand(1,3);
                if ($num%2===0) {
                    $serie = $series->random();
                    $video->serie()->associate($serie);
                    $video->save();
                }
            });
    }
}
