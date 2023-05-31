<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Termwind\Components\Dd;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.view.departments.list', [
            'tittle' => 'Department List',
            'departments' => Department::orderBy('code')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.view.departments.create', [
                'tittle' => 'Create Department',
                'departments' => Department::all()
            ]);
        }
        return redirect()->back()->with('warning', 'No permission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try {
            Department::create($request->all());
            session()->flash('success', 'Success');
            return redirect()->route('departments.index');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('admin.view.departments.detail', [
            'tittle' => "Detail Department",
            'department' => $department,
            'users' => $department->users()->paginate(10)

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.view.departments.edit', [
                'tittle' => "Update Department",
                'department' => $department
            ]);
        }
        return redirect()->back()->with('warning', 'No permission');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try {
            $department->fill($request->all());
            $department->save();
            session()->flash('success', 'Success');
            return redirect()->route('departments.index');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if (Gate::allows('isAdmin')) {
            try {
                $department->delete();
                session()->flash('success', 'Success');
                return redirect()->route('departments.index');
            } catch (Exception $exception) {
                return redirect()->back()->with('failed', $exception->getMessage());
            }
        }
        return redirect()->back()->with('warning', 'No permission');
    }
    public function showUser(Department $department)
    {
        return view('admin.view.departments.listUser', [
            'tittle2' => "MemberList",
            'tittle' => "$department->name",
            'users' => $department->users()->paginate(10)
        ]);
    }
    public function formAddUser(Department $department)
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.view.departments.addUser', [
                'tittle' => 'Add member',
                'department' => $department,
                'users' => User::whereNot('roles', 'Customer')->whereNot('department_id', $department->id)->paginate(10),
                'members' => $department->users()->get()
            ]);
        }
        return redirect()->back()->with('warning', 'No permission');
    }
    public function addMember(Request $request, Department $department)
    {
        if (empty($request->user_id)) {
            return redirect()->back()->with('failed', 'Please select one or more members.');
        }
        $list_id = array_values($request->user_id);
        try {
            User::whereIn('id', $list_id)->update(['department_id' => $department->id]);
            return redirect()->route('departments.show', $department->id)->with('success', 'Add successfull !');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
    public function search(Request $request, Department $department)
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.view.departments.addUser', [
                'tittle' => 'Add member',
                'department' => $department,
                'condition' => "Thành viên có $request->item bao gồm $request->key",
                'users' => User::whereNot('roles', 'Customer')->whereNot('department_id', $department->id)->where($request->item, 'like', "%$request->key%")
                    ->paginate(10)->withQueryString(),
                'members' => $department->users()->get()
            ]);
        }
        return redirect()->back()->with('warning', 'No permission');
    }
}
