<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\User\Http\Requests\UserRequest;
use Modules\User\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $sortType = $request->sortBy ? $request->sortBy : 'id';
        $order = $request->order ? $request->order : 'asc';
        $searchValue = $request->searchValue ? $request->searchValue : '';
        $users = User::where('name','like',"%$searchValue%")->orderBy($sortType, $order)->paginate(5);
        return view('user::index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createForm()
    {
        return view('user::addMember');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function create(UserRequest $request)
    {
        $data = $request->except('_token');

        $u_data = new User();

        $u_data->fill($data);

        $u_data->password = Hash::make($request->password);

        $u_data->save();

        $user = $u_data->fresh();

        if ($request->member_role == 'admin') {
            $user->syncRoles(['admin']);
        } else {
           $user->syncRoles(['member']);
        }

        return $u_data->fresh();
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editForm($id)
    {
        $user = User::find($id);
        return view('user::editMember', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $data = $request->except('_token');

        if ($request->password === '********') {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($request->password);
        }
        $user = User::Where('id', $id)->first();

        $user->fill($data);

        $user->syncRoles([$request->member_role]);

        $user->save();

        return $user->fresh();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->syncRoles([]);
        $user->delete();
        return redirect(route('user'));
    }
}
