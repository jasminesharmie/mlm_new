@extends('admin.layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0">
                <h6>Sponsor</h6>
            </div>
        </div>
        <form method="GET" action="{{ route('sponserlist') }}" class="mb-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <input type="date" class="form-control" name="from" value="{{ $from }}">
                </div>

                <div class="col-md-3">
                    <input type="date" class="form-control" name="to" value="{{ $to }}">
                </div>

                <div class="col-md-1">
                    <button class="btn btn-primary"><i class="bx bx-search"></i></button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From ID</th>
                                        <th>From Name</th>
                                        <th>Sponser Amount 50% ($)</th>
                                        <th>Package Amount ($)</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($spornsers as $key => $spornser)
                                    <tr>
                                        <td>{{ ($spornsers->currentPage() - 1) * $spornsers->perPage() + $key + 1 }}
                                        </td>
                                        <td>{{ $spornser->from_username }}</td>
                                        <td>{{ $spornser->from_name }}</td>
                                        <td>{{ $spornser->amount }} $</td>
                                        <td>{{ $spornser->plan_amount }} $</td>
                                        <td>{{ $spornser->reason_name }}</td>
                                        <td>{{ $spornser->created_at }}</td>
                                    </tr>
                                    @endforeach
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
<script>
$(document).ready(function() {
    $('#example2').DataTable()
});
</script>
@endsection