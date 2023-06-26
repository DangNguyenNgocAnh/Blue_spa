<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.view.coupons.list', [
            'tittle' => 'List Coupons',
            'coupons' => Coupon::orderBy('price')->paginate(10)
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        if (Gate::allows('isAdmin')) {
            try {
                Coupon::create($request->all());
                return redirect()->back()->with('success', 'Create new coupon successfull ! ');
            } catch (Exception $ex) {
                return redirect()->back()->with('failed', $ex->getMessage());
            }
        }
        return redirect()->back()->with('warning', 'No permission');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        if (Gate::allows('isAdmin')) {
            try {
                $coupon->fill($request->all());
                $coupon->save();
                return redirect()->back()->with('success', 'Edit coupon successfull ! ');
            } catch (Exception $ex) {
                return redirect()->back()->with('failed', $ex->getMessage());
            }
        }
        return redirect()->back()->with('warning', 'No permission');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        if (Gate::allows('isAdmin')) {
            try {
                $coupon->delete();
                return redirect()->back()->with('success', 'Delete coupon successfull ! ');
            } catch (Exception $ex) {
                return redirect()->back()->with('failed', $ex->getMessage());
            }
        }
        return redirect()->back()->with('warning', 'No permission');
    }
    public function listDeleted()
    {
        if (Gate::allows('isAdmin')) {
            return view('admin.view.coupons.listDeleted', [
                'tittle' => 'List Coupons deleted',
                'coupons' => Coupon::onlyTrashed()->orderBy('price')->paginate(10)
            ]);
        }
        return redirect()->back()->with('warning', 'No permission');
    }
    public function restore(String $id)
    {
        if (Gate::allows('isAdmin')) {

            try {
                Coupon::onlyTrashed()->where('id', $id)->restore();
                return redirect()->route('coupons.index')->with('success', 'Restore successful!');
            } catch (Exception $exception) {
                return redirect()->back()->with('failed', $exception->getMessage());
            }
        }
        return redirect()->back()->with('warning', 'No permission');
    }
}
