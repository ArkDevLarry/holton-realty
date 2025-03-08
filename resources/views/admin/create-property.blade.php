@extends("admin.layout")

@push("styles")
    <link rel="stylesheet" href="{{ asset('assets/vendor/filter/filter_multi_select.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/summernote/css/summernote-bs4.css') }}">
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
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title...">
                                    <small class="title errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="size">Size</label>
                                    <input type="text" class="form-control" id="size" name="size" placeholder="Enter size...">
                                    <small class="size errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="ggs">
                                        <label for="plan">Plan</label>
                                        <div class="d-flex float-right"><button type="button" class="add-more-plan"><i class="fa fa-plus"></i></button></div>
                                        <div class="group appendInputsPlan" id="plan">
                                            <div class="plan-input" style="display: flex;gap: 10px;align-items: center;">
                                                <select name="apa-0[]" class="form-control col-md-4 plan 0 icon multiselFiltel"></select>
                                                <input type="text" class="form-control col-md-6 plan 0 descplan" placeholder="Description">
                                            </div>
                                        </div>
                                        <small class="plan errors-class" style="color: crimson"></small>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="" selected>-- choose --</option>
                                        <option>Rent</option>
                                        <option>Sale</option>
                                    </select>
                                    <small class="type errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="ggs">
                                        <label for="price">Price</label>
                                        <div class="d-flex float-right"><button type="button" class="add-more"><i class="fa fa-plus"></i></button></div>
                                        <div class="group appendInputs">
                                            <div class="price-input" style="display: flex;gap: 10px;align-items: center;">
                                                <input type="number" class="form-control col-md-4 price 0 amount" placeholder="Amount">
                                                <input type="text" class="form-control col-md-6 price 0 descprice" placeholder="Description">
                                            </div>
                                        </div>
                                        <small class="price errors-class" style="color: crimson"></small>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="loctext">Location Address</label>
                                    <input type="text" class="form-control" id="loctext" name="loctext" placeholder="Enter location address...">
                                    <small class="loctext errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="location">Location (comma separated values)</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="E.g. 0.00000, 1.23456">
                                    <small class="location errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="document">Document</label>
                                    <input type="text" class="form-control" id="document" name="document" placeholder="Enter type of document...">
                                    <small class="document errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="link">Link (Instagram)</label>
                                    <input type="text" class="form-control" id="link" name="link" placeholder="Enter property social link...">
                                    <small class="link errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="features">Features</label>
                                    <select type="text" class="form-control" id="features" multiple name="features[]"></select>
                                    <small class="features errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="images" class="images" style="width: 100%;height: 68px;justify-content: center;align-items: center;display: flex;"><i data-lucide="cloud-upload"></i></label>
                                    <small class="text-danger" id="image"></small>
                                    <input type="file" class="form-control upload__inputfile" multiple id="images"></input>
                                    <small id="images errors-class" style="color: crimson"></small>
                                    <div class="upload__img-wrap"></div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter property details..."></textarea>
                                    <small class="description errors-class" style="color: crimson"></small>
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
    <script src="{{ asset('assets/vendor/filter/filter-multi-select-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/summernote/js/summernote-bs4.js') }}"></script>

    <!-- Development version -->
        <script src="{{ asset("assets/libs/js/lucide.js") }}"></script>


    <!-- Production version -->
    {{-- <script src="https://unpkg.com/lucide@latest"></script> --}}
    
    <script>
        let priceData = [];
        let planData = [];



        let allImages = []; // Array to store all selected files

        // Function to display all selected files
        function displayImages() {
            const imageContainer = document.querySelector(".upload__img-wrap") // Clear existing images
            imageContainer.innerHTML = ""
            allImages.forEach((image) => {
                const div = document.createElement('div');
                div.classList.add("upload__img-box");
                const img = document.createElement('img');
                img.classList.add("img-bg", "w-100");
                img.src = URL.createObjectURL(image);
                div.appendChild(img);

                img.onclick = () => {
                    const index = allImages.indexOf(image);
                    if (index !== -1) {
                        allImages.splice(index, 1);
                        div.remove();
                    }
                };

                imageContainer.appendChild(div);
            });
        }

        function handleFileInputChange(files) {
            const newImages = Array.from(files);
            allImages = allImages.concat(newImages); // Merge new files with existing files

            // Display all selected files
            displayImages();
        }

        function multiselFilt() {
            const baseLink = "{{ asset("") }}"
            $('.multiselFiltel').filterMultiSelect({
                items: [
                    ['<img src="'+baseLink+'assets/img/icons/bed-icon.svg">Bedroom(s)', baseLink+"assets/img/icons/bed-icon.svg", false, false],
                    ['<img src="'+baseLink+'assets/img/icons/bath-icon.svg">Bathroom(s)', baseLink+"assets/img/icons/bath-icon.svg", false, false],
                    ['<img src="'+baseLink+'assets/img/icons/building-icon.svg">Size', baseLink+"assets/img/icons/building-icon.svg", false, false],
                    ['<img src="'+baseLink+'assets/img/icons/garage-icon.svg">Garage(s)', baseLink+"assets/img/icons/garage-icon.svg", false, false],
                    ['<img src="'+baseLink+'assets/img/icons/calender-icon.svg">Year built', baseLink+"assets/img/icons/calender-icon.svg", false, false]
                ]
            })
        }

        function renderIconPlan() {
            setTimeout(() => {
                const spansSelect = document.querySelectorAll('#plan span.selected-items span.item')
                console.log(spansSelect);
                spansSelect.forEach(spans => {
                    const tex = spans.childNodes[0]
                    const text = `<small class="d-flex align-items-center">${(tex).data}</small>`
                    // console.log(text);
                    if (tex.nodeType === Node.TEXT_NODE) {
                        spans.removeChild(tex);
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(text, 'text/html');
                        // console.log(text);
                        spans.insertBefore(doc.body.firstChild, spans.firstChild);
                    }
                    
                });
            }, 200);
        }

        $(document).ready(function() {
            $('#description').summernote({
                height: 200,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                // focus: true                  // set focus to editable area after initializing summernote
            });
            
            $('#features').filterMultiSelect({
                items: [
                    ["<i data-lucide='bed-double'></i>" + " All Room En-suite", "All Room En-suiteremittttaBedDouble", false, false],
                    ["<i data-lucide='utensils'></i>" + " Fitted Kitchen", "Fitted KitchenremittttaUtensils", false, false],
                    ["<i data-lucide='home'></i>" + " POP Ceiling", "POP CeilingremittttaHome", false, false],
                    ["<i data-lucide='expand'></i>" + " Open Terrace", "Open TerraceremittttaExpand", false, false],
                    ["<i data-lucide='shirt'></i>" + " Walk-In Closet", "Walk-In ClosetremittttaShirt", false, false],
                    ["<i data-lucide='shower-head'></i>" + " Walk-In Shower", "Walk-In ShowerremittttaShowerHead", false, false],
                    ["<i data-lucide='lightbulb'></i>" + " Chandelier", "ChandelierremittttaLightbulb", false, false],
                    ["<i data-lucide='monitor'></i>" + " TV Console", "TV ConsoleremittttaMonitor", false, false],
                    ["<i data-lucide='parking-square'></i>" + " Ample Parking Space", "Ample Parking SpaceremittttaParkingSquare", false, false],
                    ["<i data-lucide='building-2'></i>" + " Stamp Concrete", "Stamp ConcreteremittttaBuilding2", false, false],
                    ["<i data-lucide='camera'></i>" + " CCTV", "CCTVremittttaCamera", false, false],
                    ["<i data-lucide='shield-check'></i>" + " 24/7 Security", "24/7 SecurityremittttaShieldCheck", false, false]
                ]
            })
            
            $("#features div.dropdown-item.custom-control").on("click", function () {
                setTimeout(() => {
                    const spansSelect = document.querySelectorAll('#features span.selected-items span.item')
                    spansSelect.forEach(spans => {

                        const tex = spans.childNodes[0]
                        const text = `<small class="d-flex align-items-center">${(tex).data}</small>`
                        // console.log(text);
                        if (tex.nodeType === Node.TEXT_NODE) {
                            spans.removeChild(tex);
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(text, 'text/html');
                            // console.log(text);
                            spans.insertBefore(doc.body.firstChild, spans.firstChild);
                        }
                        lucide.createIcons();
                    });
                }, 200);
            })

            const labels = document.querySelectorAll('#features .custom-control-label');
            labels.forEach(label => {
                label.innerHTML = label.innerText;
            });

            setTimeout(() => {
                lucide.createIcons();
            }, 200);

            const addMoreButton = document.querySelector('.add-more');
            addMoreButton.addEventListener('click', () => {
                let cou = parseInt(document.querySelectorAll(".price-input").length)
                const newPriceInput = document.createElement('div');
                newPriceInput.classList.add('price-input');
                newPriceInput.innerHTML = `
                    <input type="number" class="form-control col-md-4 price ${cou} amount" placeholder="Amount">
                    <input type="text" class="form-control col-md-6 price ${cou} descprice" placeholder="Description">
                    <span class="text-danger col-md-1 removeIt"><i class="fa fa-trash"></i></span>
                `;

                (document.querySelector(".appendInputs")).appendChild(newPriceInput);
                
                const removeButton = newPriceInput.querySelector('.removeIt');
                removeButton.addEventListener('click', () => {
                    newPriceInput.remove();
                    updatePriceData()
                });
            });


            multiselFilt()
            renderIconPlan()
            const addMoreButPlan = document.querySelector('.add-more-plan');
            addMoreButPlan.addEventListener('click', () => {
                let baseLink = "{{ asset("") }}"
                let cou = parseInt(document.querySelectorAll(".plan-input").length)
                const newPlanInput = document.createElement('div');
                newPlanInput.classList.add('plan-input');
                newPlanInput.innerHTML = `
                    <select name="apa${cou+1}[]" class="form-control col-md-4 plan ${cou} icon multiselFiltel"></select>
                    <input type="text" class="form-control col-md-6 plan ${cou} descplan" placeholder="Description">
                    <span class="text-danger col-md-1 removeItPlan"><i class="fa fa-trash"></i></span>
                `;

                (document.querySelector(".appendInputsPlan")).appendChild(newPlanInput);
                multiselFilt()
                const remBut = newPlanInput.querySelector('.removeItPlan');
                remBut.addEventListener('click', () => {
                    newPlanInput.remove();
                    updatePlanData()
                });


                $("#plan div.dropdown-item.custom-control").on("click", function () {
                    renderIconPlan()
                })

                const labelsPlan = document.querySelectorAll('#plan .custom-control-label');
                labelsPlan.forEach(label => {
                    label.innerHTML = label.innerText;
                });
            });


            updatePriceData();
            $(document).on("input", ".price-input input", function() {
                updatePriceData();
            });
            
            updatePlanData();
            $(document).on("input", ".plan-input input", function() {
                updatePlanData();
            });


            function updatePriceData() {
                priceData = []
                $(".price-input").each(function(e) {
                    let inpses = $(this).find("input")
                    priceData.push({'amount': inpses[0].value, 'descprice': inpses[1].value})
                })
            }
            function updatePlanData() {
                planData = []
                $(".plan-input").each(function(e) {
                    let description = ($(this).find("input.descplan"))[0].value
                    let icon = $(this).find(".items.dropdown-item .dropdown-item.custom-control input:checked")[0]
                    planData.push({'icon': (icon==undefined ? "" : icon.value), 'descplan': description})
                })
            }




            
            if (window.File && window.FileList && window.FileReader) {

                // Attach event listener to file input
                $("#images").on("change", function(e) {
                    handleFileInputChange(e.target.files);
                });


            } else {
                Swal("info", "Your browser doesn't support File preview; proceed", "info")
            }


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
                const formData = new FormData(document.getElementById("sendForm"));
                allImages.forEach((image) => {
                    formData.append('images[]', image);
                });
                
                priceData.forEach((item, index) => {
                    // Here we are adding 'priceData[0][amount]', 'priceData[0][description]' etc.
                    formData.append(`price[${index}][amount]`, item.amount);
                    formData.append(`price[${index}][descprice]`, item.descprice);
                });
                console.log(priceData);
                planData.forEach((item, index) => {
                    // Here we are adding 'planData[0][amount]', 'planData[0][description]' etc.
                    formData.append(`plan[${index}][icon]`, item.icon);
                    formData.append(`plan[${index}][descplan]`, item.descplan);
                });
                console.log(planData, formData.getAll("plan[]"));
                
                let featS = formData.getAll("features[]")
                featS[0] === "" || featS[0] === null ? featS.shift() : null
                formData.delete("features[]")
                formData.append("features[]", featS)
                // console.log(formData.getAll("images[]"));

                e.preventDefault() && e.stopPropagation();
                handleBtnErr()
                let titLe = $("#title").val()
                $.ajax({
                    type: 'POST',
                    url: '{{ route('property.store') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType : 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr["success"](`${titLe}` + " listed successfully🎉")
                        // console.log(response);
                        $("form")[0].reset()
                        setTimeout(() => {
                            window.location.reload()
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        // console.log(xhr);
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('.' + key).addClass('is-invalid');
                            $('small.' + key).text(value);
                            if (('.' + key).startsWith(".plan.")) {
                                // console.log($("."+key));
                            }
                            // console.log(key, value);
                        });
                        reverseDOM()
                    },
                });
            });
        });
    </script>
@endpush