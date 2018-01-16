<?php

namespace CodeFlix\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * CodeFlix\Models\Video
 *
 * @property-read \CodeFlix\Models\Serie $serie
 * @mixin \Eloquent
 */
class Video extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function serie(){
        return $this->belongsTo(Serie::class);
    }

}
