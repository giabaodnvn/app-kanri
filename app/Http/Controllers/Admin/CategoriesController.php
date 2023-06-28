<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\CategoryDetailRepository;
use App\Repositories\Interfaces\LanguageRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class CategoriesController.
 *
 * @package namespace App\Http\Controllers;
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var CategoryDetailRepository
     */
    protected $categoryDetailRepository;

    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * @var string
     */
    protected $pathUpload;

    /**
     * @param CategoryRepository $categoryRepository
     * @param LanguageRepository $languageRepository
     */
    public function __construct(CategoryRepository $categoryRepository, LanguageRepository $languageRepository, CategoryDetailRepository $categoryDetailRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryDetailRepository = $categoryDetailRepository;
        $this->languageRepository = $languageRepository;
        $this->pathUpload = 'categories/';
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->with(['user', 'categoryDetail' => function ($query) {
            $query->whereHas('language', function ($con) {
                $con->where('name', config('constant.language_default_code'));
            });
        }])->get();

        return view('admin.categories.index')->with(['categories' => $categories]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $languages = $this->languageRepository->all();
        $categories = $this->categoryRepository->where('publish', config('constant.publish.key.publish'))->get();

        return view('admin.categories.create')->with(['languages' => $languages, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CategoryCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $adminLogin = getAdminLogin();
            $data = [
                'parent' => $request->has('parent') ? $request->get('parent') : '',
                'author' => $adminLogin->id,
                'publish' => $request->get('publish'),
            ];
            // create category
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $data['thumbnail'] = uploadFileImage($thumbnail, $this->pathUpload);
            }
            $category = $this->categoryRepository->create($data);

            // create category_detail
            $titles = $request->get('title');
            if (!empty($titles)) {
                foreach ($titles as $key => $title) {
                    if (!empty($title)) {
                        $languageId = $this->languageRepository->where('code', $key)->first()->id;
                        $this->categoryDetailRepository->create([
                            'category_id' => $category->id,
                            'author' => $adminLogin->id,
                            'language_id' => $languageId,
                            'title'     => $title,
                            'slug' => Str::of($title)->slug('-'),
                            'description' => $request->get('description')[$key],
                        ]);
                    }
                }
            }
            DB::commit();

            return redirect()->route('admin.categories.categories-list')->with(['message' => 'Create new Category success!', 'type' => 'success']);
        } catch (ValidatorException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $languages = $this->languageRepository->all();
        $categories = $this->categoryRepository->where('publish', config('constant.publish.key.publish'))->get();
        $category = $this->categoryRepository->find($id);

        return view('admin.categories.edit')->with(['languages' => $languages, 'categories' => $categories, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $adminLogin = getAdminLogin();
            $data = [
                'publish' => $request->get('publish'),
            ];

            if ($request->hasFile('thumbnail')) {
                deleteImage($this->categoryRepository->find($id)->thumbnail);
                $thumbnail = $request->file('thumbnail');
                $data['thumbnail'] = uploadFileImage($thumbnail, $this->pathUpload);
            }

            $category = $this->categoryRepository->update($data, $id);

            // create category_detail
            $titles = $request->get('title');
            if (!empty($titles)) {
                foreach ($titles as $key => $title) {
                    if (!empty($title)) {
                        $languageId = $this->languageRepository->where('code', $key)->first()->id;
                        $this->categoryDetailRepository->updateOrCreate(
                            [
                                'category_id' => $category->id,
                                'language_id' => $languageId,
                            ],
                            [
                                'author' => $adminLogin->id,
                                'title'     => $title,
                                'slug' => Str::of($title)->slug('-'),
                                'description' => $request->get('description')[$key],
                            ]);
                    }
                }
            }
            DB::commit();

            return redirect()->route('admin.categories.categories-list')->with(['message' => 'Update Category success!', 'type' => 'success']);
        } catch (ValidatorException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->find($id);
            deleteImage($category->thumbnail);
            $this->categoryRepository->delete($id);

            DB::commit();
            return redirect()->back()->with(['message' => config('Delete category success!') . ' Success', 'type' => 'success']);
        } catch (ValidatorException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
