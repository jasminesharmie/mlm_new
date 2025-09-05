@extends('admin.layouts.app')
@section('content')
@php
$date = $from ?? date('Y-m-01');
$to = $to ?? date('Y-m-d');
@endphp

<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Upline Spornser</h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align:left">LEVEL NO</th>
                                @foreach ($plans as $planlt)
                                <th style="text-align:left">{{ $planlt->plan_name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $planli)
                            <tr>
                                <td>Level {{ $planli->id }}</td>
                                @php
                                $ftIncome = 0;
                                $planId = $planli->id;
                                $planNme = $planli->plan_name;
                                for($i = 1;$i <= 7;$i++) { $ftIncome=DB::table('upline_income')->where('to_id',
                                    Auth::user()->id)->where('upline_income.pay_reason_id', 4)->where('plan_id',
                                    $planId)->count();
                                    @endphp

                                    <td>@php if($planId == $i) { echo '<b>'.$ftIncome.'</b>'; if($ftIncome!=0) { @endphp
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button style="button-align:right" type="button"
                                            class="btn btn-default btn-sm fa fa-eye" data-toggle="modal"
                                            data-target="#modal-xl{{ $planId }}" title="Vewu "></button>

                                        <div class="modal fade" id="modal-xl{{ $planId }}">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ $planNme }} Upline Income</h4>
                                                        <button type="button" class="btn btn-primary"
                                                            data-dismiss="modal">X</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="example1" class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>S No</th>
                                                                    <th>Full Name</th>
                                                                    <th>User Name</th>
                                                                    <th>Income ($)</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                $getFTdata =
                                                                DB::table('upline_income')->select('users.name','users.user_name','upline_income.from_id','upline_income.amount','upline_income.created_at')->join('users','users.id','=','upline_income.to_id')->where('upline_income.pay_reason_id',
                                                                4)->where('upline_income.to_id',
                                                                Auth::user()->id)->where('upline_income.plan_id',
                                                                $planId)->get();
                                                                $j = 1;
                                                                @endphp
                                                                @foreach ($getFTdata as $key => $data)
                                                                @php
                                                                $userData =
                                                                DB::table('upline_income')->select('users.name','users.user_name')->join('users','users.id','=','upline_income.from_id')->where('from_id',
                                                                $data->from_id)->where('upline_income.pay_reason_id',
                                                                4)->where('upline_income.plan_id', $planId)->first();
                                                                @endphp
                                                                <tr>
                                                                    <td>{{$j++}}</td>
                                                                    <td>{{ $userData->name }}</td>
                                                                    <td>{{ $userData->user_name }}</td>
                                                                    <td>{{ $data->amount }} $</td>
                                                                    <td>{{ $data->created_at }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @php } } else { echo 0; } @endphp
                                    </td>
                                    @php } @endphp
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
@endsection