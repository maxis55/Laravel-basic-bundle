<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\Posts\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Controllers\Admin\Users\Requests\CreateUserRequest;
use App\Http\Requests\Controllers\Admin\Users\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereRoleIs(Role::USER);
        if (auth()->user()->hasRole(Role::SUPER_ADMIN)) {
            $users->orWhereRoleIs(Role::ADMIN);
        }

        return view('admin.users.index', ['users' => $users->paginate(20)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole(Role::SUPER_ADMIN)) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '=', Role::USER)->get();
        }

        return view('admin.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest|Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $additional_parameters = ['_token', '_method', 'roles'];
        $params                = $request->except($additional_parameters);
        $params['password']    = Hash::make($params['password']);
        $user                  = new User($params);
        $user->save();

        $user->roles()->sync($request->input('roles'));

        return redirect()->route('admin.users.edit', $user->id)->with('message', 'Создание успешно');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        if (auth()->user()->hasRole(Role::SUPER_ADMIN)) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '=', Role::USER)->get();
        }

        return view('admin.users.edit',
            [
                'user'           => $user,
                'roles'          => $roles,
                'selected_roles' => $user->roles()->pluck('role_id')->all()
            ]
        );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function profile()
    {
        $roles = Role::all();

        return view('admin.users.edit',
            [
                'user'           => auth()->user(),
                'roles'          => $roles,
                'selected_roles' => auth()->user()->roles()->pluck('role_id')->all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $additional_parameters = ['_token', '_method', 'roles','password'];
        $params                = $request->except($additional_parameters);

        if ( ! empty($request->input('password'))) {
            $params['password'] = Hash::make($request->input('password'));
        }
        $user->update($params);

        $user->roles()->sync($request->input('roles'));

        $user->save();

        $request->session()->flash('message', 'Редактирование успешно');

        return redirect()->route('admin.users.edit', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            request()->session()->flash('message', 'Удаление успешно');
        } catch (\Exception $e) {
            request()->session()->flash('message', 'Удаление не успешно. ' . $e->getMessage());
        }

        return redirect()->route('admin.users.index');
    }


}
