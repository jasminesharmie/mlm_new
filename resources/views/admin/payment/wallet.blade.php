@extends('admin.layouts.app')
@section('admin/content')
@php
$date = $from ?? date('Y-m-01');
$to = $to ?? date('Y-m-d');
@endphp

<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0">
                <h6>Wallet</h6>
            </div>
            <!-- <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#addwithdrawal">
                <i class="fa fa-plus"></i> Withdrawal
            </button> -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Income Name</th>
                                        <th> Date</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Level Income</td>
                                        <td><?php echo date('d-m-Y'); ?></td>
                                        <td>{{ $levelIncome }} $</td>
                                        <td>
                                            <a href="#" class="btn btn-light" data-toggle="modal"
                                                data-target="#paymentModal">
                                                <i class="fa fa-plus"></i> Payment Progress
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Sponser Income</td>
                                        <td><?php echo date('d-m-Y'); ?></td>
                                        <td>{{ $sponserIncome }} $</td>
                                        <td>
                                            <a href="#" class="btn btn-light" data-toggle="modal"
                                                data-target="#paymentModal1">
                                                <i class="fa fa-plus"></i> Payment Progress
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Withdrawal Available Amount</td>
                                        <td><?php echo date('d-m-Y'); ?></td>
                                        <td>{{ Auth::user()->wallet }} $</td>
                                        <td>    <a href="#" class="btn btn-light" data-toggle="modal"
                                                data-target="#addwithdrawal">
                                                <i class="fa fa-plus"></i> Payment Withdrawal
                                            </a> </td>         
                                    </tr>
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog"
                            aria-labelledby="paymentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel">Payment Progress</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ url('admin/updatewallet_level') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                            <input type="hidden" name="amount" value="{{ $levelIncome }}">

                                            <p>Are you sure you want to move to your wallet ?</p>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Yes, Continue</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="paymentModal1" tabindex="-1" role="dialog"
                            aria-labelledby="paymentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="paymentModalLabel">Payment Progress</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <form action="{{ route('updatewallet_sponser') }}" method="POST">
                                            @csrf

                                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                            <input type="hidden" name="amount" value="{{ $sponserIncome }}">

                                            <p>
                                                Are you sure you want to move to your wallet ?
                                            </p>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Yes, Continue</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="addwithdrawal" tabindex="-1" role="dialog"
                            aria-labelledby="addplanLabel" aria-hidden="true">
                            <form action="{{ url('/addwithdrawal') }}" method="post">
                                @csrf
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Withdrawal</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="form-group row mb-3">
                                                <label for="wallet" class="col-sm-4 col-form-label">
                                                    <span style="color:red">*</span>Wallet Amount
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="wallet" id="wallet"
                                                        value="{{ Auth::user()->wallet }}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="withdrawal_amount" class="col-sm-4 col-form-label">
                                                    <span style="color:red">*</span>Withdrawal Amount
                                                </label>
                                                <div class="col-sm-8">
                                                    <input required type="number" class="form-control"
                                                        name="withdrawal_amount" id="withdrawal_amount"
                                                        placeholder="Withdrawal Amount">
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="new_balance" class="col-sm-4 col-form-label">
                                                    <span style="color:red">*</span>Balance Amount
                                                </label>
                                                <div class="col-sm-8">
                                                    <input required type="number" class="form-control"
                                                        name="new_balance" id="new_balance" placeholder="Balance Amount"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-3">
                                                <label for="message" class="col-sm-4 col-form-label">
                                                    <span style="color:red">*</span>Message
                                                </label>
                                                <div class="col-sm-8">
                                                    <textarea required type="text" class="form-control" rows="3"
                                                        name="message" id="message" placeholder="Message"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">
                                                Close
                                            </button>
                                            <input class="btn btn-primary" type="submit" value="Request Withdrawal" />
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script>
document.getElementById("withdrawal_amount").addEventListener("keyup", function() {
    let wallet = parseFloat(document.getElementById("wallet").value) || 0;
    let withdrawal = parseFloat(this.value) || 0;
    let balance = wallet - withdrawal;

    // prevent negative balance
    if (balance < 0) {
        balance = 0;
    }

    document.getElementById("new_balance").value = balance;
});
</script>
@endsection