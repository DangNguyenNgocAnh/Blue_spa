<?php

namespace App\Http\Controllers;

use App\Http\Requests\PackageRequest;
use App\Models\Category;
use App\Models\Package;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.view.packages.list', [
            'tittle' => 'Packages List',
            'packages' => Package::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            return view('admin.view.packages.create', [
                'tittle' => 'Packages Create',
                'code' => Package::max('code') + 1,
                'categories' => Category::all()
            ]);
        }
        return redirect()->route('packages.index')->with('warning', 'No permission');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PackageRequest $request)
    {
        try {
            Package::create($request->all());
            return redirect()->route('packages.index')->with('success', "Success");
        } catch (Exception $exception) {
            return redirect()->route('packages.index')->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return view('admin.view.packages.detail', [
            'tittle' => 'Detail Package',
            'package' => $package,
            'users' => $package->users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {

            return view('admin.view.packages.edit', [
                'tittle' => 'Edit Package',
                'package' => $package,
                'categories' => Category::all()
            ]);
        }
        return redirect()->route('packages.index')->with('warning', 'No permission');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PackageRequest $request, Package $package)
    {
        try {
            $package->fill($request->all());
            $package->save();
            return redirect()->route('packages.index')->with('success', 'Sucess');
        } catch (Exception $exception) {
            return redirect()->route('packages.index')->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            try {
                $package->delete();
                return redirect()->route('packages.index')->with('success', 'Success');
            } catch (Exception $exception) {
                return redirect()->route('packages.index')->with('failed', $exception->getMessage());
            }
        }
        return redirect()->route('packages.index')->with('warning', 'No permission');
    }
    public function sort(Request $request)
    {
        return view('admin.view.packages.list', [
            'tittle' => 'Packages List',
            'item' => $request->item,
            'mode' => $request->mode,
            'packages' => Package::orderBy($request->item, $request->mode)->paginate(10)
                ->withQueryString(),
        ]);
    }
    public function search(Request $request)
    {
        return view('admin.view.packages.list', [
            'tittle2' => "Kết quả tìm kiếm : $request->item = $request->key",
            'tittle' => 'Package List',
            'packages' => Package::where($request->item, 'like', "%$request->key%")->orderBy('code')
                ->paginate(10)->withQueryString(),
        ]);
    }
    public function getFormAddUser(Package $package)
    {
        if ($package->status == 'Coming') {
            return view('admin.view.packages.addUser', [
                'tittle' => 'Add member',
                'package' => $package,
                'users' => User::whereHas('department', function ($query) {
                    $query->where('name', 'Customer');
                })
                    ->whereDoesntHave('packages', function ($query) use ($package) {
                        $query->where('id', $package->id);
                    })
                    ->paginate(10),
                'members' => $package->users()->get()
            ]);
        }
        return redirect()->back()->with('warning', 'This package was closed, cant to add user !!');
    }
    public function searchAddUser(Request $request, Package $package)
    {
        return view('admin.view.packages.addUser', [
            'tittle' => 'Add member',
            'package' => $package,
            'condition' => "Thành viên có $request->item bao gồm $request->key",
            'users' =>  User::whereHas('department', function ($query) {
                $query->where('name', 'Customer');
            })
                ->whereDoesntHave('packages', function ($query) use ($package) {
                    $query->where('id', $package->id);
                })
                ->where($request->item, 'like', "%$request->key%")
                ->paginate(10)->withQueryString(),
            'members' => $package->users()->get()
        ]);
    }
    public function addUser(Request $request, Package $package)
    {
        if (empty($request->user_id)) {
            return redirect()->back()->with('failed', 'Please select one or more customer.');
        }
        try {
            $list_id = array_values($request->user_id);
            foreach ($list_id as $user_id) {
                User::find($user_id)->packages()->attach($package->id, ['created_at' => now(), 'updated_at' => now()]);
            }
            return redirect()->route('packages.show', $package->id)->with('success', 'Add successfull !');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
    public function getListDeleted()
    {
        return view('admin.view.packages.listDeleted', [
            'tittle' => 'List Package Deleted',
            'item' => 'Package',
            'route_index' => route('packages.index'),
            'route_search' => route('packages.search'),
            'name_route_restore' => 'packages.restore',
            'packages' => Package::onlyTrashed()->paginate(10),
            'count' => Package::onlyTrashed()->count()
        ]);
    }
    public function restorePackage(String $id)
    {
        try {
            Package::onlyTrashed()->where('id', $id)->restore();
            return redirect()->route('packages.index')->with('success', 'Restore successful!');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
}
