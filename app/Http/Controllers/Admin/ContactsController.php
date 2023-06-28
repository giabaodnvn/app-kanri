<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ContactRepository;
use App\Http\Requests\ContactCreateRequest;
use Illuminate\Support\Facades\DB;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ContactsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ContactsController extends Controller
{
    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * ContactsController constructor.
     *
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = $this->contactRepository->all();
        return view('admin.contacts.index')->with(['contacts' => $contacts]);
    }

    public function store(ContactCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'content' => $request->get('content'),
            ];

            $this->contactRepository->create($data);
            DB::commit();

            return redirect()->route('users-page');
        } catch (ValidatorException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

}
