<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterCriteria.
 *
 * @package namespace App\Criteria;
 */
class FilterCriteria implements CriteriaInterface
{
    /**
     * FilterCriteria constructor.
     * @param $filter
     */
    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    /**
     * Apply criteria in query repository
     *
     * @param object              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->filter($this->filter);
    }
}
