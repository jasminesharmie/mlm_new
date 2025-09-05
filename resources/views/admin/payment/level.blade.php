@extends('admin.layouts.app')
@section('content')
@php
$date = $from ?? date('Y-m-01');
$toDate = $to ?? date('Y-m-d');
@endphp

<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Level Income</h4>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        @foreach ($plans as $planlt)
                                        <th width="100px" style="text-align:left">{{ $planlt->plan_name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($plans as $planli)
                                        @php
                                        $ftIncome = 0;
                                        $planId = $planli->id;

                                        $ftIncome = DB::table('level_income')->where('level_income.pay_reason_id',
                                        3)->where('to_id', Auth::user()->id)->where('plan_id', $planId)->count();
                                        @endphp
                                        <td>@php echo '<b>'.$ftIncome.'</b>'; if($ftIncome!=0) { @endphp
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="button-align:right"
                                                type="button" class="btn btn-default btn-sm fa fa-eye"
                                                data-toggle="modal" data-target="#modal-xl{{ $planId }}"
                                                title="View"></button>

                                            <div class="modal fade" id="modal-xl{{ $planId }}" tabindex="-1"
                                                role="dialog" aria-labelledby="addplanLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Level Income</h4>
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table id="example1"
                                                                class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>S No</th>
                                                                        <th>Full Name</th>
                                                                        <th>User Name</th>
                                                                        <th>Income ($)</th>
                                                                        <th>Level</th>
                                                                        <th>Package Amount ($)</th>
                                                                        <th>Date</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                    $getFTdata = DB::table('level_income')
                                                                    ->select('users.name','users.user_name','level_income.from_id','level_income.amount','level_income.created_at','plans.plan_amount','level_income.level')
                                                                    ->join('users','users.id','=','level_income.to_id')
                                                                    ->join('plans','plans.id','=','level_income.plan_id')
                                                                    ->where('level_income.to_id',
                                                                    Auth::user()->id)->where('level_income.pay_reason_id',
                                                                    3)->where('level_income.plan_id', $planId)->get();
                                                                    $j = 1;
                                                                    @endphp
                                                                    @foreach ($getFTdata as $key => $data)
                                                                    @php
                                                                    $userData =
                                                                    DB::table('level_income')->select('users.name','users.user_name')->join('users','users.id','=','level_income.from_id')->where('from_id',
                                                                    $data->from_id)->where('level_income.pay_reason_id',
                                                                    3)->where('level_income.plan_id', $planId)->first();
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{$j++}}</td>
                                                                        <td>{{ $userData->name }}</td>
                                                                        <td>{{ $userData->user_name }}</td>
                                                                        <td>{{ $data->amount }} $</td>
                                                                        <td>{{ $data->level }}</td>
                                                                        <td>{{ $data->plan_amount }} $</td>
                                                                        <td>{{ $data->created_at }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    @php
                                                                    $sumlevelamount =
                                                                    DB::table('level_income')->where('level_income.pay_reason_id',
                                                                    3)->where('to_id',
                                                                    Auth::user()->id)->where('plan_id', $planId)
                                                                    ->sum('amount');
                                                                    @endphp
                                                                    <tr>
                                                                        <td colspan="3" class="text-end"><strong>Total
                                                                                Income ($)</strong></td>
                                                                        <td><strong>{{ $sumlevelamount }} $</strong>
                                                                        </td>
                                                                        <td colspan="3"></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->


                                            @php } @endphp
                                        </td>


                                        @endforeach
                                    </tr>

                                    </tfoot>
                            </table>

                            </tr>

                            </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
@endsection