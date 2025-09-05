@extends('admin.layouts.app')
@section('admin/content')
<div class="page-wrapper">
    <div class="page-content">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                    aria-label="close">&times;</a>
                <strong style="color:white !important"> {{ session('success') }} </strong>
            </div>
        @endif

        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
        <br>
        <div class="row row-cols-7 g-1">
            @foreach ($plans as $plan)
                @php
                if (in_array($plan->id, $userPlans)) {
                    $colorClass = 'bg-info ';
                } elseif ($plan->id == $nextPlanId) {
                    $colorClass = 'bg-warning text-dark';
                } else {
                    $colorClass = 'bg-gray ';
                }
                @endphp
                <div class="col">
                    <div class="card rounded-2 {{ $colorClass }} mini-plan-card">
                        <div class="card-body p-1">
                            <div class="text-center">
                                <div class="plan-name">{{ Str::limit($plan->plan_name, 8) }}</div>
                                <div class="plan-amount">${{ $plan->plan_amount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <style>
        .bg-gray {
            background-color: #6c757d !important;
        }
        
        .small-plan-card {
            min-height: 70px;
            transition: transform 0.2s ease;
        }
        
        .small-plan-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .plan-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        
        .plan-name {
            font-size: 0.7rem;
            font-weight: 500;
            line-height: 1.1;
            margin-bottom: 0.25rem !important;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            width: 100%;
        }
        
        .plan-amount {
            font-size: 0.8rem;
            font-weight: 600;
            line-height: 1;
        }
        
        /* Mobile specific adjustments */
        @media (max-width: 575.98px) {
            .small-plan-card {
                min-height: 60px;
            }
            
            .plan-name {
                font-size: 0.6rem;
            }
            
            .plan-amount {
                font-size: 0.7rem;
            }
            
            .card-body {
                padding: 0.5rem 0.25rem !important;
            }
        }
        
        /* Tablet adjustments */
        @media (min-width: 576px) and (max-width: 991.98px) {
            .plan-name {
                font-size: 0.65rem;
            }
            
            .plan-amount {
                font-size: 0.75rem;
            }
        }
        
        /* Desktop adjustments */
        @media (min-width: 992px) {
            .small-plan-card {
                min-height: 80px;
            }
            
            .plan-name {
                font-size: 0.75rem;
            }
            
            .plan-amount {
                font-size: 0.85rem;
            }
        }
        </style>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
            <a href="{{ url('admin/members/1') }}">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Active Members</p>
                                    <h4 class="my-1 ">{{ $ActiveMembers }}</h4>
                                    <p class="mb-0 font-13 ">{{ $LastWeekActiveMembers }} from last week</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="lni lni-users"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('admin/members/2') }}">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Inactive Members</p>
                                    <h4 class="my-1 ">{{ $InactiveMembers }}</h4>
                                    <p class="mb-0 font-13 ">{{ $LastWeekInactiveMembers }} from last week</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="lni lni-users"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('admin/user_activate_plan') }}">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Next Active Plan</p>
                                    <h4 class="my-1 ">{{ $nextPlanName }}</h4>
                                    <p class="mb-0 font-13 "> Remaining pending plan
                                        ({{ $remainingPlansCount }})</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-trophy"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ url('admin/wallet') }}">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Wallet</p>
                                    <h4 class="my-1 ">{{ Auth::user()->wallet }} $</h4>
                                    <p class="mb-0 font-13 ">{{ $LastWeekwalletIncome }} $ from last week</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('admin/spornser') }}">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Sponsor Income (50%)</p>
                                    <h4 class="my-1 ">{{ $sponserIncome }} $</h4>
                                    <p class="mb-0 font-13 ">{{ $LastWeeksponserIncome }} $ from last week</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-dollar-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ url('admin/upgrade') }}">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Total Upgrade Package</p>
                                    <h4 class="my-1 ">{{ Auth::user()->upgrade ?? 0 }} $</h4>
                                    <p class="mb-0 font-13 ">Upgrade Amount</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-dollar-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="#" data-bs-toggle="modal" data-bs-target="#rebirthIncome">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Total Global Rebirth</p>
                                    <h4 class="my-1 ">{{ $rebirthIncome }} $</h4>
                                    <p class="mb-0 font-13 ">{{ $LastWeekrebirthIncome }} Global Regain User</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-dollar-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="modal fade" id="rebirthIncome" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-primary ">
                            <h5 class="modal-title">Global Rebirth Income</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Amount ($)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Travel Amount</td>
                                            <td><strong>{{ $GRTravel }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Travel Allowance</td>
                                            <td><strong>{{ $GRTravelAllo }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Upgrade</td>
                                            <td><strong>{{ $GRUpgrade }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Admin</td>
                                            <td><strong>{{ $GRAdmin }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="table-secondary text-end"><strong>Total</strong>
                                            </td>
                                            <td class="table-secondary"><strong>{{ $GRTotal }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a href="{{ url('admin/global_rebirth') }}" class="btn btn-primary">Read More</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <a href="#" data-bs-toggle="modal" data-bs-target="#levelIncome">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Total 10 level Income</p>
                                    <h4 class="my-1 ">{{ $levelIncome }} $</h4>
                                    <p class="mb-0 font-13 ">{{ $LastWeekInlevelIncome }} $ from last week
                                    </p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-dollar-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="modal fade" id="levelIncome" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-primary ">
                            <h5 class="modal-title">level Income</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Amount ($)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Travel Amount</td>
                                            <td><strong>{{ $LITravel }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Travel Allowance</td>
                                            <td><strong>{{ $LITravelAllo }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Upgrade</td>
                                            <td><strong>{{ $LIUpgrade }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Admin</td>
                                            <td><strong>{{ $LIAdmin }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="table-secondary text-end"><strong>Total</strong>
                                            </td>
                                            <td class="table-secondary"><strong>{{ $LITotal }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a href="{{ url('admin/level') }}" class="btn btn-primary">Read More</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <a href="#" data-bs-toggle="modal" data-bs-target="#uplineIncome">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Total 7 Upline Sponsor Income</p>
                                    <h4 class="my-1 ">{{ $uplineIncome }} $</h4>
                                    <p class="mb-0 font-13 ">{{ $LastWeekInuplineIncome }} $ from last
                                        week
                                    </p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-dollar-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <div class="modal fade" id="uplineIncome" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-primary ">
                            <h5 class="modal-title">Upline Sponsor Income</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Amount ($)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Travel Amount</td>
                                            <td><strong>{{ $UPTravel }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Travel Allowance</td>
                                            <td><strong>{{ $UPTravelAllo }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Upgrade</td>
                                            <td><strong>{{ $UPUpgrade }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Admin</td>
                                            <td><strong>{{ $UPAdmin }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="table-secondary text-end"><strong>Total</strong>
                                            </td>
                                            <td class="table-secondary"><strong>{{ $UPTotal }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <a href="{{ url('admin/upline_spornser') }}" class="btn btn-primary">Read More</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ url('admin/travel_amount') }}">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Travel Amount</p>
                                    <h4 class="my-1 ">{{ Auth::user()->travel_amount ?? 0 }} $</h4>
                                    <p class="mb-0 font-13 ">Travel Amount Amount</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-dollar-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ url('admin/travel_allowance') }}">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Travel Allowance</p>
                                    <h4 class="my-1 ">{{ Auth::user()->travel_allownace ?? 0 }} $</h4>
                                    <p class="mb-0 font-13 ">Travel Allowance Amount</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-dollar-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ url('admin/withdrawal') }}/1">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Withdrawal Request</p>
                                    <h4 class="my-1 ">{{ $Withdrawal }} $</h4>
                                    <p class="mb-0 font-13 ">{{ $LastWeekWithdrawal }} from last week</p>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto"><i
                                        class="bx bxs-dollar-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#coinDetailsModal">
                <div class="col">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 ">Total Coins</p>
                                    <h4 class="my-1 ">{{ $total_coin }}</h4>
                                </div>
                                <div class="widgets-icons bg-light-transparent  ms-auto">
                                    <i class="bx bxs-coin coin-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            @if(auth()->user()->id == 1)
                <a href="{{ url('admin/admin_payment') }}">
                    <div class="col">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="mb-0 ">Total Admin Amount ($)</p>
                                        <h4 class="my-1 ">{{ $totalAdminAmount }} $</h4>
                                    </div>
                                    <div class="widgets-icons bg-light-transparent  ms-auto">
                                        <i class="bx bxs-dollar-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        </div>

        <!--end row-->

        <!-- Modal -->
        <div class="modal fade" id="coinDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-primary ">
                        <h5 class="modal-title">Coin Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Coin Name</th>
                                        <th>Coins</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>SHIB Coin</td>
                                        <td><strong>{{ $coinDetails['shib_coin'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>PEPE Coin</td>
                                        <td><strong>{{ $coinDetails['pepe_coin'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>BONK Coin</td>
                                        <td><strong>{{ $coinDetails['bonk_coin'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>FLOKI Coin</td>
                                        <td><strong>{{ $coinDetails['floki_coin'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>BTT Coin</td>
                                        <td><strong>{{ $coinDetails['btt_coin'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>BABY DOGE Coin</td>
                                        <td><strong>{{ $coinDetails['baby_doge_coin'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>TFC Coin</td>
                                        <td><strong>{{ $coinDetails['tfc_coin'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="table-secondary text-end"><strong>Total Coins</strong>
                                        </td>
                                        <td class="table-secondary"><strong>{{ $total_coin }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="row">
            <div class="col-12 col-lg-8 col-xl-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="mb-0">Performance</h5>
                            <div class="dropdown options ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>

                        <div
                            class="hstack flex-wrap align-items-center justify-content-between gap-3 gap-sm-4 mb-3 border p-3 radius-10">
                            <div class="">
                                <h5 class="mb-0">974 <span class=" font-13">56% <i
                                            class='bx bx-up-arrow-alt'></i></span></h5>
                                <p class="mb-0">Page Views</p>
                            </div>
                            <div class="vr"></div>
                            <div class="">
                                <h5 class="mb-0">1,218 <span class=" font-13">34% <i
                                            class='bx bx-down-arrow-alt'></i></span></h5>
                                <p class="mb-0">Total Sales</p>
                            </div>
                            <div class="vr"></div>
                            <div class="">
                                <h5 class="mb-0">42.8% <span class=" font-13">22% <i
                                            class='bx bx-up-arrow-alt'></i></span></h5>
                                <p class="mb-0">Conversion Rate</p>
                            </div>
                        </div>

                        <div class="chart-js-container1">
                            <canvas id="chart1"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xl-4 d-flex">
                <div class="card radius-10 overflow-hidden w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="mb-0">Top Categories</h5>
                            <div class="dropdown options ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="chart-js-container2 mt-4">
                            <div class="piechart-legend">
                                <h2 class="mb-1">8,452</h2>
                                <h6 class="mb-0">Total Sessions</h6>
                            </div>
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-top bg-transparent">
                            Clothing
                            <span class="badge bg-white rounded-pill text-dark">558</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                            Electronics
                            <span class="badge bg-white bg-opacity-50 rounded-pill">204</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-transparent">
                            Furniture
                            <span class="badge bg-white bg-opacity-25 rounded-pill">108</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card radius-10 w-100">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Weekly Visits</h5>
                    </div>
                    <div class="dropdown options ms-auto">
                        <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                            <i class='bx bx-dots-horizontal-rounded'></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-js-container3">
                    <canvas id="chart3"></canvas>
                </div>
            </div>
        </div>

        <div class="card radius-10 w-100">
            <div class="card-body">

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-3">
                    <div class="col">
                        <div class="p-3 text-center border radius-10">
                            <span class="donut"
                                data-peity='{ "fill": ["#fff", "rgb(255 255 255 / 12%)"], "innerRadius": 50, "radius": 32 }'>4/5</span>

                            <h6 class="mb-0 mt-3">Total Orders : 4K</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 text-center border radius-10">
                            <span class="donut"
                                data-peity='{ "fill": ["#fff", "rgb(255 255 255 / 12%)"], "innerRadius": 50, "radius": 32 }'>2/5</span>

                            <h6 class="mb-0 mt-3">Pending : 1.2K</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 text-center border radius-10">
                            <span class="donut"
                                data-peity='{ "fill": ["#fff", "rgb(255 255 255 / 12%)"], "innerRadius": 50, "radius": 32 }'>3/5</span>

                            <h6 class="mb-0 mt-3">Delivered : 2.4</h6>
                        </div>
                    </div>
                    <div class="col">
                        <div class="p-3 text-center border radius-10">
                            <span class="donut"
                                data-peity='{ "fill": ["#fff", "rgb(255 255 255 / 12%)"], "innerRadius": 50, "radius": 32 }'>2/5</span>

                            <h6 class="mb-0 mt-3">Received : 492</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row row-cols-1 row-cols-lg-3">
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">New Customers</h5>
                            </div>
                            <div class="dropdown options ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="customers-list p-3 mb-3">
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Emy Jackson</h6>
                                <p class="mb-0 font-13 text-light-2">emy_jac@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-4.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Martin Hughes</h6>
                                <p class="mb-0 font-13 text-light-2">martin.hug@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-23.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Laura Madison</h6>
                                <p class="mb-0 font-13 text-secondary">laura_01@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-24.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Shoan Stephen</h6>
                                <p class="mb-0 font-13 text-light-2">s.stephen@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-20.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Keate Medona</h6>
                                <p class="mb-0 font-13 text-light-2">Keate@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-16.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Paul Benn</h6>
                                <p class="mb-0 font-13 text-light-2">pauly.b@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-25.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Winslet Maya</h6>
                                <p class="mb-0 font-13 text-light-2">winslet_02@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-11.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Bruno Bernard</h6>
                                <p class="mb-0 font-13 text-light-2">bruno.b@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-17.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Merlyn Dona</h6>
                                <p class="mb-0 font-13 text-light-2">merlyn.d@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                        <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                            <div class="">
                                <img src="assets/images/avatars/avatar-7.png" class="rounded-circle" width="46"
                                    height="46" alt="" />
                            </div>
                            <div class="ms-2">
                                <h6 class="mb-1 font-14">Alister Campel</h6>
                                <p class="mb-0 font-13 text-light-2">alister_42@xyz.com</p>
                            </div>
                            <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                    class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                                <a href="javascript:;" class="list-inline-item"><i
                                        class='bx bx-dots-vertical-rounded'></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-1">Top Products</h5>
                            </div>
                            <div class="dropdown options ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="product-list p-3 mb-3">


                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 border radius-10">
                                <div class="">
                                    <img src="assets/images/products/14.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Yellow Tshirt</h6>
                                    <p class="mb-0">278 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$24K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 border radius-10">
                                <div class="">
                                    <img src="assets/images/products/19.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Titan Watch </h6>
                                    <p class="mb-0">155 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$35K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 border radius-10">
                                <div class="">
                                    <img src="assets/images/products/04.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Red Sofa</h6>
                                    <p class="mb-0">234 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$54K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 border radius-10">
                                <div class="">
                                    <img src="assets/images/products/18.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">iPhone Pro 7</h6>
                                    <p class="mb-0">450 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$86K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 border radius-10">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Light Chair</h6>
                                    <p class="mb-0">345 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$49K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 border radius-10">
                                <div class="">
                                    <img src="assets/images/products/08.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Rounded Chair</h6>
                                    <p class="mb-0">146 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$38K0.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 border radius-10">
                                <div class="">
                                    <img src="assets/images/products/03.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Fancy Sofa</h6>
                                    <p class="mb-0">560 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$69K.00</h6>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="col d-flex">
                <div class="card radius-10 w-100 overflow-hidden">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="mb-0">Social Leads</h5>
                            </div>
                            <div class="dropdown options ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="social-leads">
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small  bg-light"><i
                                        class='bx bxl-facebook-circle'></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Facebook</h6>
                                    <p class="mb-0">175</p>
                                </div>
                                <div class="">45%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small  bg-light"><i class='bx bxl-google'></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Google</h6>
                                    <p class="mb-0">960</p>
                                </div>
                                <div class="">24%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small  bg-light"><i class='bx bxl-twitter'></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Twitter</h6>
                                    <p class="mb-0">245</p>
                                </div>
                                <div class="">53%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small  bg-light"><i class='bx bxl-linkedin'></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Linkedin</h6>
                                    <p class="mb-0">784</p>
                                </div>
                                <div class="">10%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small  bg-light"><i class='bx bxl-dribbble'></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Dribbble</h6>
                                    <p class="mb-0">568</p>
                                </div>
                                <div class="">15%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small  bg-light"><i class='bx bxl-behance'></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Behance</h6>
                                    <p class="mb-0">790</p>
                                </div>
                                <div class="">22%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Orders Summary</h5>
                    </div>
                    <div class="font-22 ms-auto"><i class='bx bx-dots-horizontal-rounded'></i>
                    </div>
                </div>
                <hr />
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order id</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#897656</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="assets/images/products/12.png" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Light Blue Chair</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>Brooklyn Zeo</td>
                                <td>12 Jul 2020</td>
                                <td>$64.00</td>
                                <td>
                                    <div class="d-grid">
                                        <a href="javascript:;" class="btn btn-sm btn-light radius-30">Pending</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions gap-3">
                                        <a href="javascript:;"><i class='bx bx-trash'></i></a>
                                        <a href="javascript:;"><i class='bx bx-cloud-download'></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#987549</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="assets/images/icons/shoes.png" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Green Sport Shoes</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>Martin Hughes</td>
                                <td>14 Jul 2020</td>
                                <td>$45.00</td>
                                <td>
                                    <div class="d-grid">
                                        <a href="javascript:;" class="btn btn-sm btn-light radius-30">Dispatched</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions gap-3">
                                        <a href="javascript:;"><i class='bx bx-trash'></i></a>
                                        <a href="javascript:;"><i class='bx bx-cloud-download'></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#685749</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="assets/images/icons/headphones.png" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Red Headphone 07</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>Shoan Stephen</td>
                                <td>15 Jul 2020</td>
                                <td>$67.00</td>
                                <td>
                                    <div class="d-grid">
                                        <a href="javascript:;" class="btn btn-sm btn-light radius-30">Completed</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions gap-3">
                                        <a href="javascript:;"><i class='bx bx-trash'></i></a>
                                        <a href="javascript:;"><i class='bx bx-cloud-download'></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#887459</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="assets/images/icons/idea.png" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Mini Laptop Device</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>Alister Campel</td>
                                <td>18 Jul 2020</td>
                                <td>$87.00</td>
                                <td>
                                    <div class="d-grid">
                                        <a href="javascript:;" class="btn btn-sm btn-light radius-30">Completed</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions gap-3">
                                        <a href="javascript:;"><i class='bx bx-trash'></i></a>
                                        <a href="javascript:;"><i class='bx bx-cloud-download'></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#335428</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="assets/images/icons/user-interface.png" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Purple Mobile Phone</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>Keate Medona</td>
                                <td>20 Jul 2020</td>
                                <td>$75.00</td>
                                <td>
                                    <div class="d-grid">
                                        <a href="javascript:;" class="btn btn-sm btn-light radius-30">Pending</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions gap-3">
                                        <a href="javascript:;"><i class='bx bx-trash'></i></a>
                                        <a href="javascript:;"><i class='bx bx-cloud-download'></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#224578</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="assets/images/icons/watch.png" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Smart Hand Watch</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>Winslet Maya</td>
                                <td>22 Jul 2020</td>
                                <td>$80.00</td>
                                <td>
                                    <div class="d-grid">
                                        <a href="javascript:;" class="btn btn-sm btn-light radius-30">Dispatched</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions gap-3">
                                        <a href="javascript:;"><i class='bx bx-trash'></i></a>
                                        <a href="javascript:;"><i class='bx bx-cloud-download'></i></a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>#447896</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="recent-product-img">
                                            <img src="assets/images/icons/tshirt.png" alt="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">T-Shirt Blue</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>Emy Jackson</td>
                                <td>28 Jul 2020</td>
                                <td>$96.00</td>
                                <td>
                                    <div class="d-grid">
                                        <a href="javascript:;" class="btn btn-sm btn-light radius-30">Pending</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex order-actions gap-3">
                                        <a href="javascript:;"><i class='bx bx-trash'></i></a>
                                        <a href="javascript:;"><i class='bx bx-cloud-download'></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection