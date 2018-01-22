<?php

namespace CodeFlix\Media;


trait SeriePaths
{
    use MediaStorages;

    /**
     * @return string
     */
    public function getThumbFolderStorageAttribute(): string
    { // mutator thumb_folder_storage
        return "series/{$this->id}";
    }

    /**
     * @return string
     */
    public function getThumbRelativeAttribute(): string
    { // mutator thumb_relative
        return "{$this->thumb_folder_storage}/{$this->thumb}";
    }

    /**
     * @return mixed
     */
    public function getThumbPathAttribute()
    { // mutator thumb_path
        return $this->getAbsolutePath($this->getStorage(), $this->thumb_relative);
    }

    /**
     * @return string
     */
    public function getThumbSmallRelativeAttribute(): string
    { // mutator thumb_small_relative
        [$name, $extension] = explode('.', $this->thumb);
        return "{$this->thumb_folder_storage}/{$name}_small.{$extension}";
    }

    /**
     * @return mixed
     */
    public function getThumbSmallPathAttribute()
    { // mutator thumb_small_path
        return $this->getAbsolutePath($this->getStorage(), $this->thumb_small_relative);
    }

    /**
     * @return string
     */
    public function getThumbAssetAttribute(): string
    { // mutator thumb_asset
        return route('admin.series.thumb_asset', ['serie' => $this->id]);
    }

    /**
     * @return string
     */
    public function getThumbSmallAssetAttribute(): string
    { // mutator thumb_small_asset
        return route('admin.series.thumb_small_asset', ['serie' => $this->id]);
    }
}