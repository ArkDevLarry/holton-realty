@extends("admin.layout")

@push("styles")

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
            <div class="col-xl-9 col-lg-9 col-md-10 col-sm-11 col-11">
                <div class="card">
                    <h5 class="card-header">Validation Form</h5>
                    <div class="card-body">
                        <form class="" id="sendForm">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter fullname..." required>
                                    <small class="name errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        </div>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter valid username..." aria-describedby="inputGroupPrepend" required>
                                    </div>
                                    <small class="username errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter valid address..." required>
                                    <small class="email errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password.." required>
                                    <small class="password errors-class" style="color: crimson"></small>
                                </div>
                            </div>
                            <div class="row mt-3 pl-3">
                                <button type="button" id="sendBtn" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        $(document).ready(function() {
            function handleBtnErr() {
                $(".errors-class").text("")
                $("input.form-control").removeClass("is-invalid")
                $("#sendBtn").attr("disabled", true)
                $("#sendBtn").text("Processing Data...")
                $("body").toggleClass("wait");
            }
            function reverseDOM() {
                $("#sendBtn").attr("disabled", false)
                $("#sendBtn").text("Create")
                $("#sendBtn").css("cursor", "no-drop !important")
                $("body").removeClass("wait");
            }

            $("#sendBtn").on("click", function(e) {
                e.preventDefault() && e.stopPropagation();
                handleBtnErr()
        
                let $data = $("#sendForm").serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.store') }}',
                    data: $data,
                    dataType : 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr["success"]("Admin account created successfully🎉")
                        $("form")[0].reset()
                        window.location.reload()
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('small.' + key).text(value);
                        });
                        reverseDOM()
                    },
                });
            });
        });
    </script>
@endpush