<?php

namespace CodeFlix\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * CodeFlix\Models\Video
 *
 * @property-read \CodeFlix\Models\Serie $serie
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int|null $duration
 * @property string|null $file
 * @property string|null $thumb
 * @property int $completed
 * @property int $published
 * @property int|null $serie_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\CodeFlix\Models\Category[] $categories
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereSerieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\CodeFlix\Models\Video whereUpdatedAt($value)
 */
class Video extends Model implements Transformable, TableInterface
{
    use TransformableTrait;

    protected $fillable = [
        'title',
        'description',
        'duration',
        'published',
        'serie_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serie(){
        return $this->belongsTo(Serie::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#'];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
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
