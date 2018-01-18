<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 18/01/18
 * Time: 18:43
 */

namespace CodeFlix\Media;


trait SeriePaths
{
    use VideoStorages;

    /**
     * @return string
     */
    public function getThumbFolderStorageAttribute() { // mutator
        return "series/{$this->id}";
    }

    /**
     * @return string
     */
    public function getThumbRelativeAttribute() { // mutator
        return "{$this->thumb_folder_storage}/{$this->thumb}";
    }
}