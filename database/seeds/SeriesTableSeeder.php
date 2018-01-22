<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class SeriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $rootPath = config('filesystems.disks.videos_local.root');
        \File::deleteDirectory($rootPath, true);

        /** @var Collection $series */
        $series = factory(\CodeFlix\Models\Serie::class, 5)->create();

        /** @var \CodeFlix\Repositories\SerieRepository $repository */
        $repository = app(\CodeFlix\Repositories\SerieRepository::class);

        /** @var \Illuminate\Support\Collection $collectionThumbs */
        $collectionThumbs = $this->getThumb();

        $series->each(function ($serie) use ($repository, $collectionThumbs){
            $repository->uploadThumb($serie->id, $collectionThumbs->random());
        });
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    protected function getThumb(): \Illuminate\Support\Collection
    {
        return new \Illuminate\Support\Collection([
            new \Illuminate\Http\UploadedFile(
                storage_path('app/files/faker/thumbs/thumb.png'),
                'thumb.png'
            )
        ]);
    }
}
