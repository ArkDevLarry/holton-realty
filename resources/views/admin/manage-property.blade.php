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
                                        <th>Title</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Document</th>
                                        <th>Type</th>
                                        <th>Sold</th>
                                        <th width="10%">Status</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $key => $a)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $a->title }}</td>
                                        <td>{{ $a->size }}</td>
                                        <td>
                                            @php
                                                $priceList = json_decode($a->price);
                                                print("<span>" . count($priceList) . " price(s)</span><br>");
                                            @endphp
                                        </td>
                                        <td>{{ $a->document }}</td>
                                        <td>{{ $a->type }}</td>
                                        <td>{{ $a->type == "Rent" ? "Rent" : ($a->sold == 0 ? "No" : "Yes") }}</td>
                                        <td>
                                            @if ($a->status == 1)
                                                <span class="badge badge-success status" status="{{ $a->uniqId }}" style="cursor: pointer">Available</span>
                                            @else
                                                <span class="badge badge-danger status" status="{{ $a->uniqId }}" style="cursor: pointer">Unavailable</span>
                                            @endif
                                        </td>
                                        <td>{{ $a->created_at }}</td>
                                        <td>
                                            <span class="badge badge-primary" style="cursor: pointer">
                                                <a href="{{ env('APP_FRONTURLSINGLE'). '/' .$a->uniqId }}" class="text-white" target="_blank"><i class="fa fa-eye"></i></a>
                                            </span>
                                            <span class="badge badge-warning" style="cursor: pointer">
                                                <a href="{{ route("update-property", [$a->uniqId]) }}" class="text-white"><i class="fa fa-edit"></i></a>
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
                                        <th width="5%">#</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                        <th>Price</th>
                                        <th>Document</th>
                                        <th>Type</th>
                                        <th>Sold</th>
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
        // function deleteAdmin(data) {
        //     $.ajax({
        //         type: 'DELETE',
        //         url: '{{ route("admin.destroy",23030) }}'.replace('23030', data),
        //         data: {"user":data},
        //         dataType : 'json',
        //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         success: function(response) {
        //             toastr["success"]("Property listing removed from system🎉")
        //             setTimeout(() => {window.location.reload()}, 1000);
        //         },
        //         error: function(xhr, status, error) {
        //             Swal.fire({title: "Error", text: "Unable to remove admin", icon: "error"})
        //         },
        //     });
        // }

        function statusProperty(data) {
            $.ajax({
                type: 'PATCH',
                url: '{{ route("property-status",23030) }}'.replace('23030', data),
                data: {"user":data},
                dataType : 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                    toastr["success"]("Property status toggled successfully")
                    setTimeout(() => {window.location.reload()}, 1000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({title: "Error", text: "Unable to update property", icon: "error"})
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
                swalConfirm(undefined, undefined, statusProperty, data)
            })
        });
    </script>
@endpush