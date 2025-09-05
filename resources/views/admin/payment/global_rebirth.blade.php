@extends('admin.layouts.app')
<<<<<<< HEAD
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Global Rebirth</h4>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
                            @foreach($Userplans as $Userplan)
                            <a data-toggle="modal" data-target="#modal-xl{{ $Userplan->id }}">
                                <div class="col">
                                    <div class="card radius-10">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <p class="mb-0 text-white">{{ $Userplan->plan_name }}</p>
                                                    <h4 class="my-1 text-white">{{ $Userplan->plan_amount }} $</h4>
                                                </div>
                                                <div class="widgets-icons bg-light-transparent text-white ms-auto"><i
                                                        class="lni lni-users"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="modal fade" id="modal-xl{{ $Userplan->id }}">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">{{ $Userplan->plan_name }} Global Regain Income</h4>
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">X</button>
                                        </div>
                                        <div class="modal-body">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Full Name</th>
                                                        <th>User Name</th>
                                                        <th>Income ($)</th>
                                                        <th>Package Amount ($)</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $getFTdata = DB::table('global_regain')
                                                    ->select('users.name','users.user_name','global_regain.amount','global_regain.created_at','global_regain.plan_id',
                                                    'global_regain.to_id')
                                                    ->join('users','users.id','=','global_regain.from_id')
                                                    ->where('global_regain.pay_reason_id', 2)
                                                    ->where('global_regain.from_id', auth()->user()->id)
                                                    ->where('global_regain.plan_id', $Userplan->id)->get();
                                                    @endphp
                                                    @foreach ($getFTdata as $key=> $data)
                                                    @php
                                                    $plan = DB::table('plans')->where('id',$data->plan_id)->first();
                                                    $user = DB::table('users')->where('id',$data->to_id)->first();
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->user_name }}</td>
                                                        <td>{{ $data->amount }} $</td>
                                                        <td>{{ $plan->plan_amount }} $</td>
                                                        <td>{{ $data->created_at }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

=======
@section('admin/content')

<section class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Global Rebirth</h4>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @foreach($Userplans as $Userplan)
            <div class="col-lg-3 col-6">
                <!-- Small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h4>{{ $Userplan->plan_amount }} $</h4>
                        <p>{{ $Userplan->plan_name }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#modal-xl{{ $Userplan->id }}" class="small-box-footer">
                        View Details <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="modal fade" id="modal-xl{{ $Userplan->id }}">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title">
                                {{ $Userplan->plan_name }} - Global Regain Income
                            </h4>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>S.No</th>
                                        <th>Full Name</th>
                                        <th>User Name</th>
                                        <th>Income ($)</th>
                                        <th>Package Amount ($)</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $getFTdata = DB::table('global_regain')
                                    ->select('users.name','users.user_name','global_regain.amount',
                                    'global_regain.created_at','global_regain.plan_id',
                                    'global_regain.to_id')
                                    ->join('users','users.id','=','global_regain.from_id')
                                    ->where('global_regain.pay_reason_id', 2)
                                    ->where('global_regain.from_id', auth()->user()->id)
                                    ->where('global_regain.plan_id', $Userplan->id)
                                    ->get();
                                    @endphp

                                    @foreach ($getFTdata as $key => $data)
                                    @php
                                    $plan = DB::table('plans')->where('id',$data->plan_id)->first();
                                    $user = DB::table('users')->where('id',$data->to_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->user_name }}</td>
                                        <td>{{ $data->amount }} $</td>
                                        <td>{{ $plan->plan_amount }} $</td>
                                        <td>{{ date('d M Y h:i A', strtotime($data->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
>>>>>>> 50bccf5691bd6e1b3dc743b5baf1ac9cb96dfbd6
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    @endsection
=======
            @endforeach
        </div>
    </div>
</section>
@endsection
>>>>>>> 50bccf5691bd6e1b3dc743b5baf1ac9cb96dfbd6
