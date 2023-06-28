<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\CategoryDetailRepository;
use App\Models\CategoryDetail;
use App\Validators\CategoryDetailValidator;

/**
 * Class CategoryDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class CategoryDetailRepositoryEloquent extends BaseRepository implements CategoryDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryDetail::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
