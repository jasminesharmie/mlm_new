@extends('admin.layouts.app')
@section('content')

<div class="page-wrapper">
    <div class="page-content">

        <div class="page-breadcrumb d-flex align-items-center justify-content-between mb-3">
            <div class="mb-0">
                <h6>All User Type List</h6>
            </div>
            <button type="button" class="btn btn-sm btn-secondary float-right" data-toggle="modal"
                data-target="#addcenter"><i class="fa fa-plus"> </i> Add user_type</button>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User Type Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_type as $centerslist)
                                    <tr>
                                        <td>{{ $centerslist->id }}</td>
                                        <td>{{ $centerslist->usertype_name }}</td>
                                        @if ($centerslist->status == 1)
                                        <td>Active</td>
                                        @else
                                        <td>Inactive</td>
                                        @endif
                                        <td width="10%" style="white-space: nowrap">
                                            <a onclick="edit_user_type('{{ $centerslist->id }}','{{ $centerslist->usertype_name }}','{{ $centerslist->status }}')"
                                                href="#" class="btn btn-light editmemberBtn"><i class="bx bx-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addcenter">
            <form action="{{ url('/adduser_type') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add User Type</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row mb-3">
                                        <label for="usertype_name" class="col-sm-4 col-form-label"><span
                                                style="color:red">*</span>User Type Name</label>
                                        <div class="col-sm-8">
                                            <input required="required" type="text" class="form-control"
                                                name="usertype_name" maxlength="50" placeholder="User Type Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" type="submit" value="Submit" />
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="modal fade" id="editcenters" tabindex="-1" aria-hidden="true">
            <form action="{{ url('/updateuser_type') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollable">Edit User Type</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row mb-3">
                                        <input type="hidden" name="user_id" id="user_id">
                                        <label for="usertype_name" class="col-sm-4 col-form-label"><span
                                                style="color:red">*</span>User Type Name</label>
                                        <div class="col-sm-8">
                                            <input required="required" type="text" class="form-control"
                                                name="usertype_name" maxlength="50" id="edit_user_type_name">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="email" class="col-sm-4 col-form-label"><span
                                                style="color:red">*</span>Status</label>
                                        <div class="col-sm-8">
                                            <select id="editstatus" name="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input class="btn btn-primary" type="submit" value="Submit" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function edit_user_type(id, usertype_name, status) {
    $("#edit_user_type_name").val(usertype_name);
    $("#editstatus").val(status);
    $('#user_id').val(id);
    $("#editcenters").modal("show");
}
</script>
@endsection