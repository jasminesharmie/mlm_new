@extends('admin.layouts.app')
@section('admin/content')

<div class="page-wrapper">
    <div class="page-content">
        <h3>{{ auth()->user()->name }} - {{ auth()->user()->user_name }}</h3>

        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0">
                @if (request()->segment(3) =='1')
                <h6>Active Members List</h6>
                @else
                <h6>Inactive Members List</h6>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>User ID</th>
                                        <th>User Phone</th>
                                        @if(auth()->user()->id == 1)
                                        <th>Reference Name</th>
                                        <th>Reference ID</th>
                                        <th>Reference Phone</th>
                                        @endif
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $key => $member)
                                    @php
                                    $referral = DB::table('users')->where('id', $member->referral_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{ ($members->currentPage() - 1) * $members->perPage() + $key + 1 }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->user_name }}</td>
                                        <td>{{ $member->phone }}</td>

                                        @if(auth()->user()->id == 1)
                                        <td>{{ $referral->name ?? 'Admin' }}</td>
                                        <td>{{ $referral->user_name ?? 'Admin' }}</td>
                                        <td>{{ $referral->phone ?? 'Admin' }}</td>
                                        @endif

                                        <td style="white-space: nowrap">
                                            @if(auth()->user()->user_type_id == 1)
                                            <a href="#" class="btn btn-success viewmemberBtn"
                                                data-photo="{{ $member->photo ? asset($member->photo) : asset('upload/profile_photo/user.png') }}"
                                                data-name="{{ $member->name ?? '' }}"
                                                data-user_name="{{ $member->user_name ?? '' }}"
                                                data-cpassword="{{ $member->cpassword ?? '' }}"
                                                data-email="{{ $member->email ?? '' }}"
                                                data-phone="{{ $member->phone ?? '' }}"
                                                data-wallet_address="{{ $member->wallet_address ?? '' }}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @endif

                                            <a href="{{ url('admin/geneology?r=') }}{{ $member->id }}"
                                                class="btn btn-success">
                                                <i class="far fas fa-tree nav-icon"></i>
                                            </a>

                                            @if(auth()->user()->user_type_id == 1)
                                            <a href="#" class="btn btn-success editmemberBtn"
                                                data-id="{{ $member->id }}" data-name="{{ $member->name }}"
                                                data-email="{{ $member->email }}" data-phone="{{ $member->phone }}"
                                                data-status="{{ $member->status }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ url('admin/manual_activation') }}/{{ $member->id }}"
                                                class="btn btn-success">
                                                <i class="fa fa-coins"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 d-flex justify-content-start">
                                {!! $members->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="viewmemberModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">Member Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="mb-3">
                            <img src="" id="member_photo" alt="Member Photo" class="rounded-circle" width="120"
                                height="120" style="object-fit: cover;">
                        </div>

                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th width="30%">Name</th>
                                    <td id="view_name"></td>
                                </tr>
                                <tr>
                                    <th width="30%">User Name</th>
                                    <td id="view_user_name"></td>
                                </tr>
                                <tr>
                                    <th width="30%">Password</th>
                                    <td id="view_cpassword"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td id="view_email"></td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td id="view_phone"></td>
                                </tr>
                                <tr>
                                    <th>Wallet Address</th>
                                    <td id="view_wallet_address"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editmemberModal" tabindex="-1" aria-hidden="true">
            <form action="{{ url('/updatemember') }}" method="post">
                @csrf
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">Edit Member</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="user_id" id="edit_user_id">

                            <div class="mb-3">
                                <label><strong>Full Name</strong></label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label><strong>Email</strong></label>
                                <input type="email" name="email" id="edit_email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label><strong>Phone</strong></label>
                                <input type="text" name="phone" id="edit_phone" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label><strong>Status</strong></label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update member</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script>
$(document).on('click', '.viewmemberBtn', function(e) {
    e.preventDefault();
    $('#member_photo').attr('src', $(this).data('photo'));
    $('#view_name').text($(this).data('name'));
    $('#view_user_name').text($(this).data('user_name'));
    $('#view_cpassword').text($(this).data('cpassword'));
    $('#view_email').text($(this).data('email'));
    $('#view_phone').text($(this).data('phone'));
    $('#view_wallet_address').text($(this).data('wallet_address'));
    $('#viewmemberModal').modal('show');
});

$(document).on('click', '.editmemberBtn', function(e) {
    e.preventDefault();
    $('#edit_user_id').val($(this).data('id'));
    $('#edit_name').val($(this).data('name'));
    $('#edit_email').val($(this).data('email'));
    $('#edit_phone').val($(this).data('phone'));
    $('#edit_status').val($(this).data('status'));
    $('#editmemberModal').modal('show');
});

$(document).ready(function() {
    function fetchMembers(extraData = {}) {
        let url = "{{ url()->current() }}";
        let data = Object.assign({
            search: $('#search').val(),
            pageper: $('#pageper').val()
        }, extraData);

        $.ajax({
            url: url,
            type: "GET",
            data: data,
            success: function(response) {
                let html = $(response).find('#membersTable').html();
                $('#membersTable').html(html);
            }
        });
    }

    $('#search').on('keyup', function() {
        fetchMembers();
    });

    $('#pageper').on('change', function() {
        fetchMembers();
    });

    $(document).on('click', '#membersTable .pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetchMembers({
            page: page
        });
    });
});
</script>
@endsection