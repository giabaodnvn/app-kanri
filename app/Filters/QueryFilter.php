<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var
     */
    protected $builder;

    /**
     * QueryFilter constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name) && !empty($value)) {
                call_user_func_array([$this, Str::camel($name)], array_filter([$value]));
            }
        }
        return $this->builder;
    }

    /**
     * @return array
     */
    public function filters()
    {
        $request = [];
        foreach ($this->request->all() as $key => $value) {
            $request[Str::camel($key)] = $value;
        }
        return $request;
    }
}
