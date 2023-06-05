<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\Package;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.view.users.list', [
            'tittle' => 'Customer List',
            'users' => User::whereHas('department', function ($query) {
                $query->where('name', 'Customer');
            })->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('notCustomer')) {
            return view('admin.view.users.create', [
                'tittle' => 'Create Customer',
                'code' => User::max('code') + 1,
                'route_create' => route('users.store'),
                'route_index' => route('users.index'),
                'title_index' => 'Customer',
                'departments' => Department::where('name', 'Customer')->get()
            ]);
        }
        return redirect()->back()->with('warning', 'No permission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            User::create($request->all());
            return redirect()->route('users.index')->with('success', 'Success');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.view.users.detail', [
            'tittle' => 'Customer Detail',
            'user' => $user,
            'packages' => $user->packages
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Gate::allows('notCustomer')) {
            return view('admin.view.users.edit', [
                'tittle' => 'Edit Customer',
                'user' => $user,
                'route_index' => route('users.index'),
                'title_index' => 'Customer',
                'route_update' => route('users.update', $user->id),
                'departments' => Department::where('name', 'Customer')->get()

            ]);
        }
        return redirect()->back()->with('warning', 'No permission');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            $user->fill($request->all());
            $user->save();
            return redirect()->route('users.index')->with('success', 'Update success');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (Gate::allows('notCustomer')) {
            try {
                $user->delete();
                return redirect()->route('users.index')->with('success', 'Success');
            } catch (Exception $exception) {
                return redirect()->back()->with('failed', $exception->getMessage());
            }
        }
        return redirect()->back()->with('warning', 'No permission');
    }

    public function search(Request $request)
    {
        return view('admin.view.users.list', [
            'tittle2' => "Kết quả tìm kiếm : $request->item = $request->input",
            'tittle' => 'Customer List',
            'users' => User::whereHas('department', function ($query) {
                $query->where('name', 'Customer');
            })
                ->where($request->item, 'like', "%$request->input%")->orderby('code')
                ->paginate(10)->withQueryString(),
        ]);
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::find($request->id);
        if (Hash::check($request->currentPass, $user->password)) {
            try {
                $user->password = Hash::make($request->newPass);
                $user->save();
                return redirect()->back()->with('success', 'Update password success');
            } catch (Exception $ex) {
                return redirect()->back()->with('failed', $ex->getMessage());
            }
        }
        $errors = new MessageBag();
        $errors->add('currentPass', 'Password is incorrect');
        return redirect()->back()->withErrors($errors);
    }
    public function formAddPackage(User $user)
    {
        if (Gate::allows('notCustomer')) {
            return view('admin.view.packages.userAddPackage', [
                'tittle' => 'Add package',
                'user' => $user,
                'packageAdds' => Package::whereDoesntHave('users', function ($query) use ($user) {
                    $query->where('id', $user->id);
                })->where('status', 'Coming')
                    ->paginate(10),
                'packagesOfUser' => $user->packages()->get()
            ]);
        }
        return redirect()->back()->with('warning', 'No permission');
    }
    public function addPackage(Request $request, User $user)
    {
        if (empty($request->package_id)) {
            return redirect()->back()->with('failed', 'Please select one or more customer.');
        }
        try {
            $list_id = array_values($request->package_id);
            foreach ($list_id as $package_id) {
                Package::find($package_id)->users()->attach($user->id);
            }
            return redirect()->route('users.show', $user->id)->with('success', 'Add successfull !');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
    public function searchAddPackage(Request $request, User $user)
    {
        return view('admin.view.packages.userAddPackage', [
            'tittle' => 'Add package',
            'user' => $user,
            'packageAdds' => Package::whereDoesntHave('users', function ($query) use ($user) {
                $query->where('id', $user->id);
            })->where('status', 'Coming')->where($request->item, 'like', "%$request->key%")
                ->paginate(10),
            'packagesOfUser' => $user->packages()->get(),
            'condition' => "Package có $request->item bao gồm $request->key",
        ]);
    }
    public function getListDeleted()
    {
        return view('admin.view.staff.listDeleted', [
            'tittle' =>  'List Customer Deleted',
            'item' => 'Customer',
            'route_index' => route('users.index'),
            'route_search' => route('users.search'),
            'name_route_restore' => 'users.restore',
            'users' => User::onlyTrashed()->whereHas('department', function ($query) {
                $query->where('name', 'Customer');
            })->paginate(10),

            'count' => User::onlyTrashed()->whereHas('department', function ($query) {
                $query->where('name', 'Customer');
            })->count()
        ]);
    }
    public function restoreCustomer(String $id)
    {
        try {
            User::onlyTrashed()->where('id', $id)->restore();
            return redirect()->route('users.index')->with('success', 'Restore successful!');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
}
