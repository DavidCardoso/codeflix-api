<?php

namespace CodeFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;

trait MediaStorages
{
    /**
     * @return mixed
     */
    protected function getDiskDriver()
    {
        return config('filesystems.default');
    }

    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getStorage(): FilesystemAdapter
    {
        return \Storage::disk($this->getDiskDriver());
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