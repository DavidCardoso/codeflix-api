<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use CodeFlix\Media\SeriePaths;
use Illuminate\Database\Eloquent\Model;

/**
 * CodeFlix\Models\Serie
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $thumb
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Serie whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $thumb_folder_storage
 * @property-read mixed $thumb_path
 * @property-read string $thumb_relative
 * @property-read mixed $thumb_small_path
 * @property-read string $thumb_small_relative
 * @property-read \Illuminate\Database\Eloquent\Collection|\CodeFlix\Models\Video[] $videos
 */
class Serie extends Model implements TableInterface
{
    use SeriePaths;

    protected $fillable = ['title', 'description'];

    public function videos(){
        return $this->hasMany(Video::class);
    }

    /**
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#'];
    }

    /**
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
                break;
        }
    }

}
