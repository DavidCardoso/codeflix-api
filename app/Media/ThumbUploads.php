<?php

namespace CodeFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;

trait ThumbUploads
{
    /**
     * @param $id
     * @param UploadedFile $file
     * @return \Illuminate\Database\Eloquent\Model;
     */
    public function uploadThumb($id, UploadedFile $file)
    {
        $model = $this->find($id);
        $name = $this->upload($model, $file);
        if ($name) {
            $model->thumb = $name;
            $model->save();
        }

        return $model;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
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
}