<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        return view('admin.view.dashboard', [
            'tittle' => 'Dashboard Admin'
        ]);
    }
    public function index()
    {
        return view('admin.view.staff.list', [
            'tittle' => 'Staff List',
            'users' => User::whereHas('department', function ($query) {
                $query->whereNot('name', 'Customer');
            })->paginate(10),
            'count' => User::whereHas('department', function ($query) {
                $query->whereNot('name', 'Customer');
            })->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.view.users.create', [
                'tittle' => 'Create Staff',
                'code' => User::max('code') + 1,
                'route_create' => route('staff.store'),
                'route_index' => route('staff.index'),
                'title_index' => 'Staff',
                'departments' => Department::whereNot('name', 'Customer')->get()
            ]);
        }
        if (Gate::allows('isManager')) {
            return view('admin.view.users.create', [
                'tittle' => 'Create Staff',
                'code' => User::max('code') + 1,
                'route_create' => route('staff.store'),
                'route_index' => route('staff.index'),
                'title_index' => 'Staff',
                'departments' => Department::whereNotIn('name', ['Admin', 'Manager', 'Customer'])->get()
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
            return redirect()->route('staff.index')->with('success', 'Success');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.view.staff.detail', [
            'tittle' => 'Staff Detail',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.view.users.edit', [
                'tittle' => 'Edit Staff',
                'user' => $user,
                'route_index' => route('staff.index'),
                'title_index' => 'Staff',
                'route_update' => route('staff.update', $user->id),
                'departments' => Department::whereNot('name', 'Customer')->get()
            ]);
        }
        if (
            Gate::allows('isManager') && !in_array($user->department_id, [1, 2])
        ) {
            return view('admin.view.users.edit', [
                'tittle' => 'Edit Staff',
                'user' => $user,
                'route_index' => route('staff.index'),
                'title_index' => 'Staff',
                'route_update' => route('staff.update', $user->id),
                'departments' => Department::whereNotIn('name', ['Admin', 'Manager', 'Customer'])->get()
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
            return redirect()->route('staff.index')->with('success', 'Update success');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ((Gate::allows('isAdmin')) ||
            (Gate::allows('isManager') && !in_array($user->roles, ['Admin', 'Manager'])
                && $user->department_id === Auth::user()->department_id)
        ) {
            try {
                $user->delete();
                return redirect()->route('staff.index')->with('success', 'Success');
            } catch (Exception $exception) {
                return redirect()->back()->with('failed', $exception->getMessage());
            }
        }
        return redirect()->back()->with('warning', 'No permission');
    }

    public function search(Request $request)
    {
        return view('admin.view.staff.list', [
            'tittle2' => "Kết quả tìm kiếm : $request->item = $request->input",
            'tittle' => 'Staff List',
            'users' => User::whereHas('department', function ($query) {
                $query->whereNot('name', 'Customer');
            })
                ->where($request->item, 'like', "%$request->input%")->orderby('code')
                ->paginate(10)->withQueryString(),
            'count' => User::whereHas('department', function ($query) {
                $query->whereNot('name', 'Customer');
            })
                ->where($request->item, 'like', "%$request->input%")->orderby('code')->count()
        ]);
    }
    public function getListDeleted()
    {
        return view('admin.view.staff.listDeleted', [
            'tittle' => 'Staff List Deleted',
            'item' => 'Staff',
            'route_index' => route('staff.index'),
            'route_search' => route('staff.search'),
            'name_route_restore' => 'staff.restore',
            'users' => User::onlyTrashed()->whereHas('department', function ($query) {
                $query->whereNot('name', 'Customer');
            })->paginate(10),
            'count' => User::onlyTrashed()->whereHas('department', function ($query) {
                $query->whereNot('name', 'Customer');
            })->count()
        ]);
    }
    public function restoreStaff(String $id)
    {
        try {
            User::onlyTrashed()->where('id', $id)->restore();
            return redirect()->route('staff.index')->with('success', 'Restore successful!');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
}
