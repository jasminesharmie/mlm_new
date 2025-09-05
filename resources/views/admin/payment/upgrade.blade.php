@extends('admin.layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0">
                <h6>Upgrade</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Sponsor Income (5%)</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primaryglobal" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Global Regain Income</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primaryhome" role="tab"
                                    aria-selected="true">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Level Income (10%)</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab"
                                    aria-selected="false">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-title">Upline Income (10%)</div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="primaryprofile" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>From</th>
                                                <th>From Name</th>
                                                <th>Income ($)</th>
                                                <th>Package Amount ($)</th>
                                                <th>Reason</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sponserQuery as $key => $spornser)
                                            @php
                                            $plan = DB::table('plans')->where('id',$spornser->plan_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $spornser->from_username }}</td>
                                                <td>{{ $spornser->name }}</td>
                                                <td>{{ $spornser->amount }} $</td>
                                                <td>{{ $plan->plan_amount }} $</td>
                                                <td>{{ $spornser->reasonname }}</td>
                                                <td>{{ $spornser->created_at }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            @php
                                            $sumamount = DB::table('sponser_income')
                                            ->where('pay_reason_id', 5)
                                            ->where('to_id', auth()->user()->id)
                                            ->sum('amount');
                                            @endphp
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Total Income ($)</strong></td>
                                                <td><strong>{{ $sumamount }} $</strong></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="primaryhome" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>From</th>
                                                <th>From Name</th>
                                                <th>Income ($)</th>
                                                <th>Package Amount ($)</th>
                                                <th>Level</th>
                                                <th>Reason</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($levelQuery as $key => $levelinc)
                                            @php $plan = DB::table('plans')->where('id',$levelinc->plan_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $levelinc->from_username }}</td>
                                                <td>{{ $levelinc->name }}</td>
                                                <td>{{ $levelinc->amount }} $</td>
                                                <td>{{ $plan->plan_amount }} $</td>
                                                <td>{{ $levelinc->level }}</td>
                                                <td>{{ $levelinc->reasonname }}</td>
                                                <td>{{ $levelinc->created_at }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            @php
                                            $sumlevelamount = DB::table('level_income')
                                            ->where('pay_reason_id', 5)
                                            ->where('to_id', auth()->user()->id)
                                            ->sum('amount');
                                            @endphp
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Total Income ($)</strong></td>
                                                <td><strong>{{ $sumlevelamount }} $</strong></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="example2" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>From</th>
                                                <th>From Name</th>
                                                <th>Income ($)</th>
                                                <th>Package Amount ($)</th>
                                                <th>Reason</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($uplineQuery as $key => $upline)
                                            @php $plan = DB::table('plans')->where('id',$upline->plan_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}
                                                </td>
                                                <td>{{ $upline->from_username }}</td>
                                                <td>{{ $upline->name }}</td>
                                                <td>{{ $upline->amount }} $</td>
                                                <td>{{ $plan->plan_amount }} $</td>
                                                <td>{{ $upline->reasonname }}</td>
                                                <td>{{ $upline->created_at }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            @php
                                            $sumuplineamount = DB::table('upline_income')
                                            ->where('pay_reason_id', 5)
                                            ->where('to_id', auth()->user()->id)
                                            ->sum('amount');
                                            @endphp
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Total Income ($)</strong></td>
                                                <td><strong>{{ $sumuplineamount }} $</strong></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="primaryglobal" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>From</th>
                                                <th>From Name</th>
                                                <th>Income ($)</th>
                                                <th>Package Amount ($)</th>
                                                <th>Reason</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($globalQuery as $key => $global)
                                            @php $plan = DB::table('plans')->where('id',$global->plan_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}
                                                </td>
                                                <td>{{ $global->from_username }}</td>
                                                <td>{{ $global->to_username }}</td>
                                                <td>{{ $global->amount }} $</td>
                                                <td>{{ $plan->plan_amount }} $</td>
                                                <td>{{ $global->reasonname }}</td>
                                                <td>{{ $global->created_at }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            @php
                                            $sumrebirthamount = DB::table('global_regain')
                                            ->where('pay_reason_id', 5)
                                            ->where('to_id', auth()->user()->id)
                                            ->sum('amount');
                                            @endphp
                                            <tr>
                                                <td colspan="3" class="text-end"><strong>Total Income ($)</strong></td>
                                                <td><strong>{{ $sumrebirthamount }} $</strong></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-latest.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable()
        $('#example1').DataTable()
        $('#example2').DataTable()
        $('#example3').DataTable()
    });
    </script>

    @endsection