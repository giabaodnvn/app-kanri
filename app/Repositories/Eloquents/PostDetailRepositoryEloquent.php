<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\PostDetailRepository;
use App\Models\PostDetail;
use App\Validators\PostDetailValidator;

/**
 * Class PostDetailRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class PostDetailRepositoryEloquent extends BaseRepository implements PostDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PostDetail::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
