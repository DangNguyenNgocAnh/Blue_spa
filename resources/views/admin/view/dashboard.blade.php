@extends('admin.layouts.master')
@section('tittle')
{{ $tittle }}
@endsection

@section('content')

<main id="main" class="main">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{session('success')}}
        {{session()->forget('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-1"></i>
        {{session('warning')}}
        {{session()->forget('warning')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif (session('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-1"></i>
        {{session('failed')}}
        {{session()->forget('warning')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Packages <span>| This month</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$packages['count']}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{number_format($packages['compare']*100,2)}}
                                            %</span>
                                        <span class="text-muted small pt-2 ps-1">{{$packages['increase']? 'increase' : 'decrease'}}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Revenue <span>| This Month</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$revenue['sum']}}</h6>
                                        <span class="text-success small pt-1 fw-bold">{{round($revenue['compare']*100,2)}}%</span>
                                        <span class="text-muted small pt-2 ps-1">{{$revenue['increase']? 'increase' : 'decrease'}}</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-12">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Customers <span>| This Year</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$customers['count']}}</h6> Customer
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Top Package <span>| This month</span></h5>
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Sold</th>
                                            <th scope="col">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($topPackages['arrTopPackage'] as $key=>$package)
                                        <tr>
                                            <th scope="row">{{++$key}}
                                            </th>
                                            <td><a href="{{route('packages.show',$package['id'])}}" class="text-primary fw-bold">{{$package['name']}}</a></td>
                                            <td>{{number_format($package['price']) }} VND</td>
                                            <td class="fw-bold">{{$package['count']}}</td>
                                            <td>{{number_format($package['sum'])}} VND</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <th scope="row">NULL
                                            </th>

                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Top Customer <span>| This month</span></h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Code</th>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Total money</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($topCustomer['customerThis'] as $key=>$customer)
                                        <tr>
                                            <th scope="row">{{++$key}}
                                            </th>
                                            <td><a href="{{route('users.show',$customer['id'])}}" class="text-primary fw-bold">{{$customer['code']}}</a></td>
                                            <td><a href="{{route('users.show',$customer['id'])}}" class="text-primary fw-bold">{{$customer['name']}}</a></td>
                                            <td>{{number_format($customer['sum']) }} VND</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <th scope="row">NULL
                                            </th>

                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Type of package</h5>
                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                echarts.init(document.querySelector("#trafficChart")).setOption({
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {
                                        top: '5%',
                                        left: 'center'
                                    },
                                    series: [{
                                        name: 'Access From',
                                        type: 'pie',
                                        radius: ['40%', '70%'],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: 'center'
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: '18',
                                                fontWeight: 'bold'
                                            }
                                        },
                                        labelLine: {
                                            show: false
                                        },
                                        data: [
                                            <?php
                                            if (isset($typePackage)) {
                                                $str = '';
                                                foreach ($typePackage as $package) {
                                                    echo  "{value:" . $package['count'] . ",name:'" . $package['types'] . "'},";
                                                }
                                            }
                                            ?>
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Apointments <span>| Today</span></h5>

                        <div class="activity">
                            @forelse($listApointment as $apointment)
                            <div class="activity-item d-flex">
                                <div class="activite-label">{{ substr($apointment['time'], 0, 5)}}
                                </div>
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    <b> <a style="color:black" href="{{route('apointments.show',$apointment['id'])}}">{{ $apointment['code']}}</a></b><br>
                                    <a href="{{route('users.show',$apointment['customer_id'])}}" class="fw-bold text-dark">{{ $apointment['customerName']}}</a><br>
                                    {{ $apointment['status']}}
                                </div>
                            </div>
                            @empty
                            <div class="activity-item d-flex">
                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                <div class="activity-content">
                                    Don't have apointment today
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
