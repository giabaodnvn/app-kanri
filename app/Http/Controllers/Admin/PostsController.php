<?php

namespace App\Http\Controllers\Admin;

use App\Criteria\FilterCriteria;
use App\Filters\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\Interfaces\PostRepository;
use App\Repositories\Interfaces\CategoryRepository;
use App\Repositories\Interfaces\LanguageRepository;
use App\Repositories\Interfaces\PostDetailRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class PostsController.
 *
 * @package namespace App\Http\Controllers;
 */
class PostsController extends Controller
{
    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * @var PostDetailRepository
     */
    protected $postDetailRepository;

    /**
     * @param PostRepository $postRepository
     * @param CategoryRepository $categoryRepository
     * @param LanguageRepository $languageRepository
     * @param PostDetailRepository $postDetailRepository
     */
    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, LanguageRepository $languageRepository, PostDetailRepository $postDetailRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->languageRepository = $languageRepository;
        $this->postDetailRepository = $postDetailRepository;
        $this->pathUploadPost = 'posts/';
        $this->pathUploadPage = 'pages/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryFilter $filter)
    {
        $this->postRepository->pushCriteria(new FilterCriteria($filter));

        $categories = $this->categoryRepository->get();
        $posts = $this->postRepository->with('category')->findWhere(['type' => config('constant.post_type.post')]);
        $type = config('constant.post_type.post');

        return view('admin.posts.index')->with(['posts' => $posts, 'type' => $type, 'categories' => $categories]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPagesList()
    {
        $posts = $this->postRepository->findWhere(['type' => config('constant.post_type.page')]);
        $type = config('constant.post_type.page');

        return view('admin.posts.index')->with(['posts' => $posts, 'type' => $type]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $languages = $this->languageRepository->all();
        $categories = $this->categoryRepository->get();
        $type = config('constant.post_type.post');

        return view('admin.posts.create')->with(['languages' => $languages, 'categories' => $categories, 'type' => $type]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createPage()
    {
        $languages = $this->languageRepository->all();
        $categories = $this->categoryRepository->get();
        $type = config('constant.post_type.page');

        return view('admin.posts.create')->with(['languages' => $languages, 'categories' => $categories, 'type' => $type]);
    }

    /**
     * @param PostCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $adminLogin = getAdminLogin();
            $data = [
                'author' => $adminLogin->id,
                'publish' => $request->get('publish'),
                'type' => $request->get('type'),
                'link' => $request->get('link'),
            ];
            if ($data['type'] ==  config('constant.post_type.post')) {
                $data['category_id'] = $request->get('category_id');
            }
            // create post
            $pathUpload = ($data['type'] == config('constant.post_type.post')) ? $this->pathUploadPost : $this->pathUploadPage;

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $data['thumbnail'] = uploadFileImage($thumbnail, $pathUpload);
            }
            $post = $this->postRepository->create($data);

            // create post_detail
            $titles = $request->get('title');
            if (!empty($titles)) {
                foreach ($titles as $key => $title) {
                    if (!empty($title)) {
                        $languageId = $this->languageRepository->where('code', $key)->first()->id;
                        $this->postDetailRepository->create([
                            'post_id' => $post->id,
                            'author' => $adminLogin->id,
                            'language_id' => $languageId,
                            'title'     => $title,
                            'slug' => Str::of($title)->slug('-'),
                            'description' => $request->get('description')[$key],
                        ]);
                    }
                }
            }
            $reponse = [];
            if ($post->type == config('constant.post_type.post')) {
                $reponse['route'] = 'admin.posts.posts-list';
                $reponse['message'] = 'Create new Post success!';
            } else {
                $reponse['route'] = 'admin.pages.pages-list';
                $reponse['message'] = 'Create new Page success!';
            }
            DB::commit();

            return redirect()->route($reponse['route'])->with(['message' => $reponse['message'], 'type' => 'success']);
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
        $post = $this->postRepository->with('category')->find($id);

        return view('admin.posts.edit')->with(['languages' => $languages, 'post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PostUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $adminLogin = getAdminLogin();
            $post = $this->postRepository->find($id);
            $data = [
                'publish' => $request->get('publish'),
                'link' => $request->get('link'),
            ];

            if ($request->hasFile('thumbnail')) {
                $pathUpload = ($post->type == config('constant.post_type.post')) ? $this->pathUploadPost : $this->pathUploadPage;
                deleteImage($post->thumbnail);
                $thumbnail = $request->file('thumbnail');
                $data['thumbnail'] = uploadFileImage($thumbnail, $pathUpload);
            }

            $this->postRepository->update($data, $id);

            // create category_detail
            $titles = $request->get('title');
            if (!empty($titles)) {
                foreach ($titles as $key => $title) {
                    if (!empty($title)) {
                        $languageId = $this->languageRepository->where('code', $key)->first()->id;
                        $this->postDetailRepository->updateOrCreate(
                            [
                                'post_id' => $post->id,
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
            $reponse = [];
            if ($post->type == config('constant.post_type.post')) {
                $reponse['route'] = 'admin.posts.posts-list';
                $reponse['message'] = 'Update Post success!';
            } else {
                $reponse['route'] = 'admin.pages.pages-list';
                $reponse['message'] = 'Update Page success!';
            }
            DB::commit();

            return redirect()->route($reponse['route'])->with(['message' => $reponse['message'], 'type' => 'success']);
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
        try {
            $this->postRepository->delete($id);

            return redirect()->back()->with(['message' => 'Delete success!', 'type' => 'success']);
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param $id
     * @return void
     */
    public function changeAlwaysShow(Request $request)
    {
        $postId = $request->get('id');
        $value = $request->get('value');

        $this->postRepository->update(['always_show' => $value], $postId);
        return response()->json([], 200);
    }
}
