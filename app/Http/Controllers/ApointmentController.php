<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApointmentRequest;
use App\Models\Apointment;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ApointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.view.apointments.list', [
            'tittle' => 'Apointment List',
            'apointments' => Apointment::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.view.apointments.create', [
            'tittle' => 'Apointment Create',
            'code' => Apointment::max('code') + 1,
            'customers' => User::whereHas('department', function ($query) {
                $query->where('name', 'Customer');
            })->get(),
            'staffs' => User::whereHas('department', function ($query) {
                $query->where('name', 'Staff');
            })->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApointmentRequest $request)
    {
        try {
            Apointment::create($request->all());
            return redirect()->route('apointments.index')->with('success', 'Success');
        } catch (Exception $excepiton) {
            return redirect()->back()->with('failed', $excepiton->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Apointment $apointment)
    {
        return view('admin.view.apointments.detail', [
            'tittle' => 'Detail Apointment',
            'apointment' => $apointment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apointment $apointment)
    {
        return view('admin.view.apointments.edit', [
            'tittle' => 'Edit Apointment',
            'apointment' => $apointment,
            'staffs' =>  User::whereHas('department', function ($query) {
                $query->where('name', 'Staff');
            })->get()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApointmentRequest $request, Apointment $apointment)
    {
        try {
            $apointment->fill($request->all());
            $apointment->save();
            return redirect()->route('apointments.index')->with('success', 'Update success');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apointment $apointment)
    {
        try {
            $apointment->delete();
            return redirect()->route('apointments.index')->with('success', 'Success');
        } catch (Exception $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
    public function sort(Request $request)
    {
        return view('admin.view.apointments.list', [
            'tittle' => 'Apointment List',
            'item' => $request->item,
            'mode' => $request->mode,
            'apointments' => Apointment::orderBy($request->item, $request->mode)->paginate(10)->withQueryString(),
        ]);
    }
    public function search(Request $request)
    {
        if ($request->item == 'code') {
            $apointments = Apointment::where($request->item, 'like', "%$request->key%")->orderBy('code')->paginate(10);
        } else {
            $apointments = Apointment::whereHas('customer', function ($query) use ($request) {
                $query->where('fullname', 'like', '%' . $request->key . '%');
            })->orderBy('code')->paginate(10);
        }
        return view('admin.view.apointments.list', [
            'tittle2' => "Kết quả tìm kiếm : $request->item = $request->key",
            'tittle' => 'Apointment List',
            'apointments' =>  $apointments->withQueryString(),
        ]);
    }
}
