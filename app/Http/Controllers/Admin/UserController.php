<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * @var  UserRepository
     */
    private $userRepository;

    /**
     * TagController Constructor
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->all();

        return view('admin.users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('_token');
            $data['password'] = Hash::make($data['password']);
            $data['registered_at'] = now();
            $this->userRepository->create($data);
            DB::commit();

            return redirect()->route('admin.users.users-list')->with(['message' => 'Create new user success!', 'type' => 'success']);
        } catch (ValidatorException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);
        unset($user->password);

        return view('admin.users.edit')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = [
                'username' => $request->get('username'),
                'status'   => $request->get('status'),
                'role'     => $request->get('role'),
            ];
            if ($request->has('password') && !empty($request->get('password'))) {
                $data['password'] = Hash::make($request->get('password'));
            }
            $this->userRepository->update($data, $id);
            DB::commit();

            return redirect()->route('admin.users.users-list')->with(['message' => 'update user success!', 'type' => 'success']);
        } catch (ValidatorException $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->userRepository->delete($id);

        return redirect()->back()->with(['message' => 'Delete user success!', 'type' => 'success']);
    }
}
