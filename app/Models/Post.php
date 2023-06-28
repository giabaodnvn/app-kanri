<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Filters\QueryFilter;

/**
 * Class Post.
 *
 * @package namespace App\Models;
 */
class Post extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author',
        'category_id',
        'thumbnail',
        'link',
        'always_show',
        'publish',
        'type'
    ];

    /**
     * @param $query
     * @param QueryFilter $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postDetail()
    {
        return $this->hasMany(PostDetail::class, 'post_id', 'id');
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
        $titleDefault = $this->postDetail()->where('language_id', $defaultLanguage->id)->first();
        return $titleDefault ? $titleDefault->title : '';
    }



}
