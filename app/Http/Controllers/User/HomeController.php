<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\LanguageRepository;

/**
 * Class PostsController.
 *
 * @package namespace App\Http\Controllers;
 */
class HomeController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var $languageRepository
     */
    protected $languageRepository;

    /**
     * PostsController constructor.
     *
     */
    public function __construct(CategoryRepository $categoryRepository, LanguageRepository $languageRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->languageRepository = $languageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $langCode = [];
        $languages = $this->languageRepository->get();
        foreach ($languages as  $language) {
            array_push($langCode, $language->code);
        }

        $lang = $request->hasAny('lang') ? $request->get('lang') : config('constant.language_default_code');
        $lang = in_array($request->get('lang'), $langCode) ? $lang : config('constant.language_default_code');

        $langKey = $this->languageRepository->where('code', $lang)->first()->id;
        $categories = $this->categoryRepository->with(['categoryDetail' => function ($query) use ($langKey){
           $query->where('language_id', $langKey);
        }, 'posts' => function ($query) use ($langKey){
            $query->with(['postDetail' => function ($con) use ($langKey) {
                $con->where('language_id', $langKey);
            }])->where('publish', config('constant.publish.key.publish'))->whereNull('always_show')->orWhere('always_show', 0);
        }])->where('publish', config('constant.publish.key.publish'))->get();

        $data = [
            'business' => '',
            'ourServices' => '',
            'projects' => '',
            'blog' => '',
            'blogAlwaysShow' => '',
            'teams' => ''
        ];

        foreach ($categories as $category) {
            if ($category->title_default == 'About') {
                $data['business'] = $category;
            } else if ($category->title_default == 'Our Services') {
                $data['ourServices'] = $category;
            } else if ($category->title_default == 'My Projects') {
                $data['projects'] = $category;
            } else if ($category->title_default == 'Blog') {
                $data['blog'] = $category;
            } else if ($category->title_default == 'Teams') {
                $data['teams'] = $category;
            }
        }

        $blogAlwaysShows = $this->categoryRepository->with(['categoryDetail' => function ($query) use ($langKey){
            $query->where('language_id', $langKey);
        }, 'posts' => function ($query) use ($langKey){
            $query->with(['postDetail' => function ($con) use ($langKey) {
                $con->where('language_id', $langKey);
            }])->where('publish', config('constant.publish.key.publish'))->where('always_show', 1);
        }])->where('publish', config('constant.publish.key.publish'))->get();
        foreach ($blogAlwaysShows as $blogAlwaysShow) {
            $data['blogAlwaysShow'] = $blogAlwaysShow->title_default == 'Blog' ? $blogAlwaysShow : '';
        }

        return view('user.main')->with(['data' => $data]);
    }
}
