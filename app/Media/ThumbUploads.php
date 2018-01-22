<?php

namespace CodeFlix\Media;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Imagine\Image\Box;

trait ThumbUploads
{
    /**
     * @param $id
     * @param UploadedFile $file
     * @return Model;
     */
    public function uploadThumb($id, UploadedFile $file): Model
    {
        /** @var Model $model */
        $model = $this->find($id);
        /** @var string|false $name */
        $name = $this->upload($model, $file);
        if ($name) {
            $this->deleteThumbsOld($model);
            $model->thumb = $name;
            $this->makeThumbSmall($model);
            $model->save();
        }

        return $model;
    }

    /**
     * @param Model $model
     * @param UploadedFile $file
     * @return string|false
     */
    public function upload($model, UploadedFile $file)
    {
        /** @var FilesystemAdapter $storage */
        $storage = $model->getStorage();
        /** @var string $name */
        $name = md5(time()."{$model->id}-{$file->getClientOriginalName()}").".{$file->guessExtension()}";
        /** @var string|false $result */
        $result = $storage->putFileAs($model->thumb_folder_storage, $file, $name);

        return $result ? $name : $result;
    }

    /**
     * @param Model $model
     */
    protected function makeThumbSmall($model): void
    {
        /** @var FilesystemAdapter $storage */
        $storage = $model->getStorage();
        /** @var string $thumbFile */
        $thumbFile = $model->thumb_path;
        $format = \Image::format($thumbFile);
        $thumbnailSmall = \Image::open($thumbFile)->thumbnail(new Box(64,64));
        $storage->put($model->thumb_small_relative, $thumbnailSmall->get($format));
    }

    /**
     * @param Model $model
     */
    public function deleteThumbsOld($model): void
    {
        /** @var FilesystemAdapter $storage */
        $storage = $model->getStorage();
        if ($storage->exists($model->thumb_relative)) {
            $storage->delete([$model->thumb_relative]);
        }
        if ($storage->exists($model->thumb_small_relative)) {
            $storage->delete([$model->thumb_small_relative]);
        }
    }
}