<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\OptionDetailRepository;
use App\Models\OptionDetail;
use App\Validators\OptionDetailValidator;

/**
 * Class OptionDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class OptionDetailRepositoryEloquent extends BaseRepository implements OptionDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OptionDetail::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
