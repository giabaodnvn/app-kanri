<?php
namespace App\Filters;

class CategoryFilter extends QueryFilter
{
    /**
     * @param $categoryId
     * @return mixed
     */
    public function categoryId($categoryId)
    {
        return $this->builder->where('category_id', '=', $categoryId);
    }
}
