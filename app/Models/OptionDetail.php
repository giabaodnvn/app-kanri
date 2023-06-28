<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OptionDetail.
 *
 * @package namespace App\Models;
 */
class OptionDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option_id',
        'language_id',
        'content',
    ];

    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }

}
