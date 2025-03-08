@extends("admin.layout")

@push("styles")
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
@endpush

@section("content")
    <div class="container-fluid  dashboard-content">
        <!-- ============================================================== -->
        <!-- pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">{{ $pg }} </h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="#" class="breadcrumb-link">{{ $pg }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                <div class="card">
                    <h5 class="card-header">Admin List</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email address</th>
                                        <th width="10%">Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $key => $a)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->username }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>
                                            @if (Auth::user()->id != $a->id)
                                                @if ($a->status == 1)
                                                    <span class="badge badge-success status" status="{{ $a->id }}" style="cursor: pointer">Enabled</span>
                                                @else
                                                    <span class="badge badge-danger status" status="{{ $a->id }}" style="cursor: pointer">Disabled</span>
                                                @endif
                                            @else
                                                <span class="badge badge-info" style="cursor: pointer">Current</span>
                                            @endif
                                        </td>
                                        <td>{{ $a->created_at }}</td>
                                        <td>
                                            <span class="badge badge-warning" style="cursor: pointer">
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            <span class="badge badge-danger delete" delete="{{ $a->id }}" style="cursor: pointer">
                                                <i class="fa fa-trash"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email address</th>
                                        <th width="10%">Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        function deleteAdmin(data) {
            $.ajax({
                type: 'DELETE',
                url: '{{ route("admin.destroy",23030) }}'.replace('23030', data),
                data: {"user":data},
                dataType : 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    toastr["success"]("Admin account removed from system🎉")
                    setTimeout(() => {window.location.reload()}, 1000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({title: "Error", text: "Unable to remove admin", icon: "error"})
                },
            });
        }

        function statusAdmin(data) {
            $.ajax({
                type: 'PATCH',
                url: '{{ route("admin.status",23030) }}'.replace('23030', data),
                data: {"user":data},
                dataType : 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    toastr["success"]("Admin account toggled successfully")
                    setTimeout(() => {window.location.reload()}, 1000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({title: "Error", text: "Unable to update admin", icon: "error"})
                },
            });
        }
    </script>
    <script>
        jQuery(document).ready(function($) {
            'use strict';

            if ($("table.first").length) {

                $(document).ready(function() {
                    $('table.first').DataTable();
                });
            }

            $(".delete").on("click", function (e) {
                let data = $(this).attr("delete")
                swalConfirm(undefined, undefined, deleteAdmin, data)
            })
            $(".status").on("click", function (e) {
                let data = $(this).attr("status")
                swalConfirm(undefined, undefined, statusAdmin, data)
            })
        });
    </script>
@endpush