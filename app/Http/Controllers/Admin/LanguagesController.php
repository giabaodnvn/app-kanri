<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageCreateRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Repositories\Interfaces\LanguageRepository;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class LanguagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class LanguagesController extends Controller
{
    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * @var string $pathImage
     */
    protected $pathImage;

    /**
     * LanguagesController constructor.
     *
     * @param LanguageRepository $languageRepository
     */
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
        $this->pathImage = 'languages/';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = $this->languageRepository->all();

        return view('admin.languages.index')->with(['languages' => $languages]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LanguageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(LanguageCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->get('name'),
                'code' => $request->get('code'),
            ];
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $data['thumbnail'] = uploadFileImage($thumbnail, $this->pathImage);
            }
            $this->languageRepository->create($data);
            DB::commit();

            return redirect()->route('admin.languages.languages-list')->with(['message' => 'Create new language success!', 'type' => 'success']);
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
        $language = $this->languageRepository->find($id);

        return view('admin.languages.edit')->with(['language' => $language]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LanguageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LanguageUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->get('name'),
                'code' => $request->get('code'),
            ];

            $language = $this->languageRepository->find($id);
            if ($request->file('thumbnail')) {
                deleteImage($language->thumbnail);

                $thumbnail = $request->file('thumbnail');
                $data['thumbnail'] = uploadFileImage($thumbnail, $this->pathImage);
                $this->languageRepository->update($data, $id);
            }
            DB::commit();

            return redirect()->route('admin.languages.languages-list')->with(['message' => 'Update language success!', 'type' => 'success']);
        } catch (ValidatorException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $language = $this->languageRepository->find($id);
            deleteImage($language->thumbnail);
            $this->languageRepository->delete($id);

            return redirect()->back()->with(['message' => config('Delete language success!') . ' Success', 'type' => 'success']);
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
