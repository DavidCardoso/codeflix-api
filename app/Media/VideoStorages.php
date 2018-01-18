<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 18/01/18
 * Time: 18:39
 */

namespace CodeFlix\Media;


trait VideoStorages
{
    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getStorage() {
        return \Storage::disk($this->getDiskDriver());
    }

    /**
     * @return mixed
     */
    protected function getDiskDriver() {
        return config('filesystems.default');
    }
}