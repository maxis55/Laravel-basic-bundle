<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;

    //comment next 4 lines if there is 1 type of post in app
    const TYPE_DEFAULT='default';
    const POST_TYPES=[
        self::TYPE_DEFAULT
    ];

    protected $fillable = [
        'name',
        'slug',
        'content',
        'short_desc',
        'cover',
        'type',
    ];


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
