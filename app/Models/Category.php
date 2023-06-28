<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @package namespace App\Models;
 */
class Category extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author',
        'parent',
        'thumbnail',
        'publish',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryDetail()
    {
        return $this->hasMany(CategoryDetail::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    /**
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
     */
    public function getTitleDefaultAttribute()
    {
        $defaultLanguage = Language::where('code', config('constant.language_default_code'))->firstOrFail();
        $titleDefault = $this->categoryDetail()->where('language_id', $defaultLanguage->id)->first();
        return $titleDefault ? $titleDefault->title : '';
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

}
