<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionCreateRequest;
use App\Http\Requests\OptionUpdateRequest;
use App\Repositories\Interfaces\OptionRepository;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\Interfaces\LanguageRepository;
use App\Repositories\Interfaces\OptionDetailRepository;

/**
 * Class OptionsController.
 *
 * @package namespace App\Http\Controllers;
 */
class OptionsController extends Controller
{
    /**
     * @var OptionRepository
     */
    protected $optionRepository;

    /**
     * @var LanguageRepository
     */
    protected $languageRepository;

    /**
     * @var OptionDetailRepository
     */
    protected $optionDetailRepository;

    /**
     * @param OptionRepository $optionRepository
     * @param LanguageRepository $languageRepository
     * @param OptionDetailRepository $optionDetailRepository
     */
    public function __construct(OptionRepository $optionRepository, LanguageRepository  $languageRepository, OptionDetailRepository $optionDetailRepository)
    {
        $this->optionRepository = $optionRepository;
        $this->languageRepository = $languageRepository;
        $this->optionDetailRepository = $optionDetailRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $options = $this->optionRepository->all();

        return view('admin.options.index')->with(['options' => $options]);
    }

    public function create()
    {
        $languages = $this->languageRepository->all();

        return view('admin.options.create')->with(['languages' => $languages]);
    }

    /**
     * @param OptionCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OptionCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $option = $this->optionRepository->create(['label' => $request->get('label')]);
            $contents = $request->get('content');
            if (!empty($contents)) {
                foreach ($contents as $key => $content) {
                    if (!empty($content)) {
                        $languageId = $this->languageRepository->where('code', $key)->first()->id;
                        $this->optionDetailRepository->create([
                            'option_id'   => $option->id,
                            'language_id' => $languageId,
                            'content'     => $content,
                        ]);
                    }
                }
            }
            DB::commit();

            return redirect()->route('admin.options.options-list')->with(['message' => config('Create new Option success!') . ' Success', 'type' => 'success']);
        } catch (ValidatorException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $option = $this->optionRepository->with('optionDetail')->find($id);
        $languages = $this->languageRepository->all();

        foreach ($languages as $language) {
            $optionDetail = $this->optionDetailRepository->findWhere(['option_id' => $id, 'language_id' => $language->id])->first();
            $language['content'] = '';
            if ($optionDetail) {
                $language['content'] = $optionDetail->content;
            }
        }

        return view('admin.options.edit')->with(['option' => $option, 'languages' => $languages]);
    }

    /**
     * @param OptionUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OptionUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->optionRepository->update(['label' => $request->get('label')], $id);
            $contents = $request->get('content');
            if (!empty($contents)) {
                foreach ($contents as $key => $content) {
                    if (!empty($content)) {
                        $languageId = $this->languageRepository->where('code', $key)->first()->id;
                        $this->optionDetailRepository->updateOrCreate(
                            [
                                'option_id' => $id,
                                'language_id' => $languageId
                            ],
                            ['content' => $content]);
                    }
                }
            }
            DB::commit();

            return redirect()->route('admin.options.options-list')->with(['message' => config('Update Option success!') . ' Success', 'type' => 'success']);
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
        $this->optionRepository->delete($id);

        return redirect()->back()->with(['message' => config('Delete option success!') . ' Success', 'type' => 'success']);
    }
}
