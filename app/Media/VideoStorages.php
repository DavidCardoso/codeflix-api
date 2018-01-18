<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 18/01/18
 * Time: 18:39
 */

namespace CodeFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;

trait VideoStorages
{
    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getStorage(): FilesystemAdapter
    {
        return \Storage::disk($this->getDiskDriver());
    }

    /**
     * @return mixed
     */
    protected function getDiskDriver()
    {
        return config('filesystems.default');
    }

    /**
     * @param FilesystemAdapter $storage
     * @param string $fileRelativePath
     * @return mixed
     */
    protected function getAbsolutePath(FilesystemAdapter $storage, $fileRelativePath)
    {
        return $storage->getDriver()->getAdapter()->applyPathPrefix($fileRelativePath);
    }
}