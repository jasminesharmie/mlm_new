@extends('admin.layouts.app')

@section('admin/content')
<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0">
                <h6>Withdrawal</h6>
            </div>
            <!-- <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#addwithdrawal">
                <i class="fa fa-plus"></i> Withdrawal
            </button> -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="row mb-2">
                                <div class="col-md-1">
                                    <select class="form-control" name="pageper" id="pageper"
                                        onchange="this.form.submit()">
                                        <option value="25" {{ request('pageper') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('pageper') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('pageper') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3 offset-md-8">
                                    <div class="input-group">
                                        <input type="text" name="search" value="{{ request('search') }}" id="search"
                                            class="form-control" placeholder="Search...">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Go</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>From</th>
                                        <th>Amount</th>
                                        <th>Payment Status</th>
                                        @if(auth()->user()->user_type_id == 1)
                                        <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($withdrawal as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->from_name }}</td>
                                        <td>{{ $item->withdrawal_amount }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                            Pending
                                            @else
                                            Completed
                                            @endif
                                        </td>
                                        @if(auth()->user()->user_type_id == 1)
                                        <td width="10%" style="white-space: nowrap">
                                            <a onclick="update_withdrawal('{{ $item->id }}','{{ $item->withdrawal_amount }}','{{ $item->status }}')"
                                                href="#" class="btn btn-light"><i class="bx bx-edit"></i>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No withdrawals found.</td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        <div class="mt-2">
                            {!! $withdrawal->links('pagination::bootstrap-4') !!}
                        </div>

                        <div class="modal fade" id="addwithdrawal" tabindex="-1" role="dialog"
                            aria-labelledby="addplanLabel" aria-hidden="true">
                            <form action="{{ url('/addwithdrawal') }}" method="post">
                                @csrf
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Withdrawal</h4>
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
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <input class="btn btn-primary" type="submit" value="Request Withdrawal" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal fade" id="updatewithdrawal" tabindex="-1" aria-hidden="true">
                            <form action="{{ url('/updatewithdrawal') }}" method="post">
                                {{ csrf_field() }}
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalScrollable">Withdrawal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="withdrawal_id" id="withdrawal_id">

                                                    <div class="form-group row mb-3">
                                                        <label for="withdrawal_amount" class="col-sm-4 col-form-label">
                                                            <span style="color:red">*</span>Withdrawal
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <input required="required" type="text" class="form-control"
                                                                name="withdrawal_amount" maxlength="50"
                                                                id="edit_withdrawal_amount" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-3">
                                                        <label for="editstatus" class="col-sm-4 col-form-label">
                                                            <span style="color:red">*</span>Status
                                                        </label>
                                                        <div class="col-sm-8">
                                                            <select id="editstatus" name="status" class="form-control">
                                                                <option value="1">Pending</option>
                                                                <option value="2">Completed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" type="submit" value="Submit" />
                                            </div>
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
$(document).on('input', '#withdrawal_amount', function() {
    let wallet = parseFloat($('#wallet').val()) || 0;
    let withdrawal = parseFloat($(this).val()) || 0;
    let balanceField = $('#new_balance');

    $('#withdrawal-error').remove();

    if (withdrawal > wallet) {
        $(this).after('<small id="withdrawal-error" class="text-danger">Insufficient balance</small>');
        balanceField.val('0.00');
    } else {
        let balance = wallet - withdrawal;
        balanceField.val(balance.toFixed(2));
    }
});
</script>
<script>
function update_withdrawal(id, withdrawal_amount, status) {
    $("#edit_withdrawal_amount").val(withdrawal_amount);
    $("#editstatus").val(status);
    $('#withdrawal_id').val(id);
    $("#updatewithdrawal").modal("show");
}
</script>
@endsection