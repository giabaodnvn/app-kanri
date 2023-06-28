<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\OptionRepository;
use App\Models\Option;
use App\Validators\OptionValidator;

/**
 * Class OptionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class OptionRepositoryEloquent extends BaseRepository implements OptionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Option::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
