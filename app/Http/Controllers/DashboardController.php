<?php

namespace App\Http\Controllers;

use App\Models\Apointment;
use App\Models\Package;
use App\Models\User;
use App\Models\UserPackage;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function sumPricePackage($arr = [])
    {
        return Package::whereIn('id', $arr)
            ->sum('price');
    }
    public function sort($arr, $item)
    {
        for ($i = 0; $i < count($arr) - 1; $i++) {
            for ($j = $i + 1; $j < count($arr); $j++) {
                if ($arr[$i][$item] < $arr[$j][$item]) {
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
        return array_slice($arr, 0, 10);
    }
    public function admin()
    {
        $packageThis = UserPackage::where(function ($query) {
            $query->whereMonth('created_at', now());
        })->pluck('package_id')->toArray();
        $packageLast = UserPackage::where(function ($query) {
            $query->whereMonth('created_at', now()->subMonth()->format('m'));
        })->pluck('package_id');
        $sumPackageThis = (Package::whereIn('id', $packageThis)
            ->sum('price'));
        $sumPackageLast = (Package::whereIn('id', $packageLast)
            ->sum('price'));
        $arrTopPackage =  Package::whereIn('id', $packageThis)
            ->select('id', 'price', 'name')->get()->toArray();

        //topPackage
        $arrCountPackage = array_count_values($packageThis);
        foreach ($arrTopPackage as &$package) {
            $package['price'] = str_replace(",", "", $package['price']);
            $package['count'] = $arrCountPackage[$package['id']];
            $package['sum'] = $package['count'] * $package['price'];
        }

        //topCustomer
        $customerThis = UserPackage::where(function ($query) {
            $query->whereMonth('created_at', now());
        })->select('user_id', 'package_id')->get()->groupBy('user_id')
            ->map(function ($item) {
                return $item->pluck('package_id')->toArray();
            })->toArray();
        foreach ($customerThis as $key => &$customer) {
            $customer['sum'] = $this->sumPricePackage($customer);
            $customer['name'] = User::where('id', $key)->value('fullname');
            $customer['code'] = User::where('id', $key)->value('code');
            $customer['id'] = $key;
        }
        //typePackage
        $typePackage =  Package::groupBy('types')
            ->select('types', DB::raw('count(*) as count'))
            ->get()->toArray();
        //listApointmentToday
        $listApointment = Apointment::whereDay('time', now())
            ->select('id', 'code', 'customer_id', 'time', 'status')->orderBy('time')->get()->toArray();
        foreach ($listApointment as &$apointment) {
            $apointment['customerName'] = User::where('id', $apointment['customer_id'])->value('fullname');
        }
        return view('admin.view.dashboard', [
            'tittle' => 'Dashboard',
            'packages' => [
                'count' => count($packageThis),
                'compare' => (count($packageThis) > count($packageLast)) ? (count($packageThis) - count($packageLast)) / count($packageThis) : (count($packageLast) - count($packageThis)) / count($packageThis),
                'increase' => (count($packageThis) > count($packageLast)) ? true : false
            ],
            'revenue' => [
                'sum' => number_format($sumPackageThis),
                'compare' => ($sumPackageThis > $sumPackageLast) ? ($sumPackageThis - $sumPackageLast) / $sumPackageThis : ($sumPackageLast - $sumPackageThis) / $sumPackageThis,
                'increase' => ($sumPackageThis > $sumPackageLast) ? true : false
            ],
            'customers' => [
                'count' => User::where('department_id', 5)->whereYear('created_at', now())->count()
            ],

            'topPackages' => [
                'arrTopPackage' => $this->sort($arrTopPackage, 'sum')
            ],
            'topCustomer' => [
                'customerThis' => $this->sort(array_values($customerThis), 'sum')
            ],
            'typePackage' => $typePackage,
            'listApointment' => $listApointment,

        ]);
    }
    public function user()
    {
        return view('user.view.dashboard', [
            'tittle' => 'Dashboard'
        ]);
    }
    public function about()
    {
        return view('user.view.about', [
            'tittle' => 'About'
        ]);
    }
    public function list()
    {
        return view('user.view.listItem', [
            'tittle' => 'List Item'
        ]);
    }
}
