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
                                    <input type="text" class="form-control" id="title" value="{{ $prop->title }}" name="title" placeholder="Enter title...">
                                    <small class="title errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="size">Size</label>
                                    <input type="text" class="form-control" id="size" value="{{ $prop->size }}" name="size" placeholder="Enter size...">
                                    <small class="size errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="" selected>-- choose --</option>
                                        <option {{ $prop->type == "Rent" ? "selected" : "" }}>Rent</option>
                                        <option {{ $prop->type == "Sale" ? "selected" : "" }}>Sale</option>
                                    </select>
                                    <small class="type errors-class" style="color: crimson"></small>
                                </div>
                                
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="ggs">
                                        <label for="plan">Plan</label>
                                        <div class="d-flex float-right"><button type="button" class="add-more-plan"><i class="fa fa-plus"></i></button></div>
                                        <div class="group appendInputsPlan" id="plan">
                                            @php
                                                $planList = json_decode($prop->plan);
                                                $f = array_shift($planList);
                                                echo '<div class="plan-input" style="display: flex;gap: 10px;align-items: center;">';
                                                echo '  <select name="apa-0[]" class="form-control col-md-4 plan 0 icon multiselFiltel"></select>';
                                                echo '  <input type="text" value="'. $f->description .'" class="form-control col-md-6 plan '. 0 .' descplan" placeholder="Description">';
                                                echo '</div>';

                                                if (!empty($planList)) {
                                                    foreach ($planList as $k => $pr) {
                                                        echo '<div class="plan-input" style="display: flex;gap: 10px;align-items: center;">';
                                                        echo '  <select name="apa'.++$k.'[]" class="form-control col-md-4 plan '. $k .' icon multiselFiltel"></select>';
                                                        echo '  <input type="text" value="'. $pr->description .'" class="form-control col-md-6 plan '. $k .' descplan" placeholder="Description">';
                                                        echo '  <span class="text-danger col-md-1 removeItPlan"><i class="fa fa-trash"></i></span>';
                                                        echo '</div>';
                                                    }
                                                }
                                            @endphp
                                        </div>
                                        <small class="plan errors-class" style="color: crimson"></small>
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="" selected>-- choose --</option>
                                        <option value="{{ $prop->status == 1 }}" {{ $prop->status == 1 ? "selected" : "" }}>Available</option>
                                        <option value="{{ $prop->status == 0 }}" {{ $prop->status == 0 ? "selected" : "" }}>Unavailable</option>
                                    </select>
                                    <small class="type errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="ggs">
                                        <label for="price">Price</label>
                                        <div class="d-flex float-right"><button type="button" class="add-more"><i class="fa fa-plus"></i></button></div>
                                        <div class="group appendInputs">
                                            @php
                                                $priceList = json_decode($prop->price);
                                                $f = array_shift($priceList);
                                                echo '<div class="price-input" style="display: flex;gap: 10px;align-items: center;">';
                                                echo '  <input type="number" value="'. $f->amount .'" class="form-control col-md-4 price '. 0 .' amount" placeholder="Amount">';
                                                echo '  <input type="text" value="'. $f->description .'" class="form-control col-md-6 price '. 0 .' descprice" placeholder="Description">';
                                                echo '</div>';

                                                if (!empty($priceList)) {
                                                    foreach ($priceList as $k => $pr) {
                                                        echo '<div class="price-input" style="display: flex;gap: 10px;align-items: center;">';
                                                        echo '  <input type="number" value="'. $pr->amount .'" class="form-control col-md-4 price '. ++$k .' amount" placeholder="Amount">';
                                                        echo '  <input type="text" value="'. $pr->description .'" class="form-control col-md-6 price '. ++$k .' descprice" placeholder="Description">';
                                                        echo '  <span class="text-danger col-md-1 removeIt"><i class="fa fa-trash"></i></span>';
                                                        echo '</div>';
                                                    }
                                                }
                                            @endphp
                                        </div>
                                        <small class="price errors-class" style="color: crimson"></small>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="loctext">Location Address</label>
                                    <input type="text" class="form-control" id="loctext" value="{{ $prop->loctext }}" name="loctext" placeholder="Enter location address...">
                                    <small class="loctext errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="location">Location (comma separated values)</label>
                                    @php
                                        $loc = json_decode($prop->location);
                                        $location = $loc->lat . ", " . $loc->long;
                                    @endphp
                                    <input type="text" class="form-control" id="location" value="{{ $location }}" name="location" placeholder="E.g. 0.00000, 1.23456">
                                    <small class="location errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="document">Document</label>
                                    <input type="text" class="form-control" id="document" value="{{ $prop->document }}" name="document" placeholder="Enter type of document...">
                                    <small class="document errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="link">Link (Instagram)</label>
                                    <input type="text" class="form-control" value="{{ $prop->link }}" id="link" name="link" placeholder="Enter property social link...">
                                    <small class="link errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="features">Features</label>
                                    <select type="text" class="form-control" id="features" multiple name="features[]"></select>
                                    <small class="features errors-class" style="color: crimson"></small>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter property details...">{{ $prop->description }}</textarea>
                                    <small class="description errors-class" style="color: crimson"></small>
                                </div>
                            </div>
                            <div class="row mt-3 pl-3">
                                <button type="button" id="sendBtn" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">Validation Form</h5>
                    <div class="card-body">
                        <form class="" id="sendFormImg">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="images" style="width: 100%;height: 68px;justify-content: center;align-items: center;display: flex;"><i style="font-size:2000px;" data-lucide="cloud-upload"></i></label>
                                    <small class="text-danger" id="image"></small>
                                    <input type="file" class="form-control upload__inputfile" multiple id="images"></input>
                                    <small id="spant images errors-class" style="color: crimson"></small>
                                    <div class="upload__img-wrap"></div>
                                </div>
                            </div>
                            <div class="row mt-3 pl-3">
                                <button type="button" id="sendBtnImg" class="btn btn-primary">Update</button>
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
        let isFormDirty = false;
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
        function handleIconRender() {
            setTimeout(() => {
            const spansSelect = document.querySelectorAll('span.selected-items span.item')
                spansSelect.forEach(spans => {

                    const tex = spans.childNodes[0]
                    const text = `<small class="d-flex align-items-center">${(tex).data}</small>`
                    if (tex.nodeType === Node.TEXT_NODE) {
                        spans.removeChild(tex);
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(text, 'text/html');
                        spans.insertBefore(doc.body.firstChild, spans.firstChild);
                    }
                    lucide.createIcons();
                });
            }, 200);
        }

        function multiselFilt() {
            return new Promise((resolve, reject) => {
                const baseLink = "{{ asset("") }}"
                $('.multiselFiltel').each(function() {
                    $(this).filterMultiSelect({
                        items: [
                            ['<img src="'+baseLink+'assets/img/icons/bed-icon.svg">Bedroom(s)', baseLink+"assets/img/icons/bed-icon.svg", false, false],
                            ['<img src="'+baseLink+'assets/img/icons/bath-icon.svg">Bathroom(s)', baseLink+"assets/img/icons/bath-icon.svg", false, false],
                            ['<img src="'+baseLink+'assets/img/icons/building-icon.svg">Size', baseLink+"assets/img/icons/building-icon.svg", false, false],
                            ['<img src="'+baseLink+'assets/img/icons/garage-icon.svg">Garage(s)', baseLink+"assets/img/icons/garage-icon.svg", false, false],
                            ['<img src="'+baseLink+'assets/img/icons/calender-icon.svg">Year built', baseLink+"assets/img/icons/calender-icon.svg", false, false]
                        ]
                    });
                });

                resolve('multiselFilt completed');
            })

        }

        function renderIconLabels(p="#plan") {
            const labelsPlan = document.querySelectorAll(p + ' .custom-control-label');
            // Loop through each label and replace innerText with innerHTML
            labelsPlan.forEach(label => {
                label.innerHTML = label.innerText;
            });
        }

        function renderIconPlan() {
            setTimeout(() => {
                const spansSelectplan = document.querySelectorAll('#plan span.selected-items span.item')
                spansSelectplan.forEach(spans => {
                    const tex = spans.childNodes[0]
                    const text = `<small class="d-flex align-items-center">${(tex).data}</small>`
                    if (tex.nodeType === Node.TEXT_NODE) {
                        spans.removeChild(tex);
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(text, 'text/html');
                        spans.insertBefore(doc.body.firstChild, spans.firstChild);
                    }
                });
            }, 200);
        }

        let baseLink = "{{ asset("") }}"
        function addIngDOM() {
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


            $("#plan div.dropdown-item.custom-control").on("click", function (e) {
                renderIconPlan()
            })

            const labelsPlan = document.querySelectorAll('#plan .custom-control-label');
            labelsPlan.forEach(label => {
                label.innerHTML = label.innerText;
            });
        }

        function updatePriceData() {
            priceData = []
            $(".price-input").each(function(e) {
                let inpses = $(this).find("input")
                priceData.push({'amount': inpses[0].value, 'descprice': inpses[1].value})
            })
            isFormDirty = true;
        }
        function updatePlanData() {
            planData = []
            $(".plan-input").each(function(e) {
                let description = ($(this).find("input.descplan"))[0].value
                let icon = $(this).find(".items.dropdown-item .dropdown-item.custom-control input:checked")[0]
                planData.push({'icon': (icon==undefined ? "" : icon.value), 'descplan': description})
            })
            isFormDirty = true;
        }

        function removeItBind() {
            let priceRem = $(".removeIt")
            let planRem = $(".removeItPlan")
            priceRem.each(function() { 
                // 'this' refers to the DOM element, so we need to wrap it in jQuery for chaining methods
                $(this).click(function() {
                    $(this).closest(".price-input").remove(); // Removes the closest parent with class .price-input
                    updatePriceData(); // Call the function to update the plan data
                });
            });
            planRem.each(function() { 
                // 'this' refers to the DOM element, so we need to wrap it in jQuery for chaining methods
                $(this).click(function() {
                    $(this).closest(".plan-input").remove(); // Removes the closest parent with class .price-input
                    updatePlanData(); // Call the function to update the plan data
                });
            });
        }

        removeItBind()


        $(document).ready(function() {
            $('#description').summernote({
                height: 150,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                // focus: true                  // set focus to editable area after initializing summernote
            });

            
            let actIng = (<?php echo json_encode(json_decode($prop->features, true)) ?>);
            let resources = [];
            for (let i = 0; i < actIng.length; i++) {
                resources.push(actIng[i]["name"] + "remitttta" + actIng[i]["icon"])
            }
            let items = [
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

            for (let i = 0; i < items.length; i++) {
                let key = items[i][1].replace("remitttta", "");
                for (let j = 0; j < resources.length; j++) {
                    if (resources[j] === items[i][1]) {
                        items[i][2] = true;
                        break;
                    }
                }
            }
            
            $('#features').filterMultiSelect({
                items: items
            })
            

            
            handleIconRender()
            setTimeout(() => {
                handleIconRender()
            }, 200)
            $("#features div.dropdown-item.custom-control").on("click", function () {
                handleIconRender()
            })

            const labels = document.querySelectorAll('#features .custom-control-label');
            // Loop through each label and replace innerText with innerHTML
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
                    <input type="text" class="form-control col-md-6 price ${cou} description" placeholder="Description">
                    <span class="text-danger col-md-1 removeIt"><i class="fa fa-trash"></i></span>
                `;

                (document.querySelector(".appendInputs")).appendChild(newPriceInput);
                
                const removeButton = newPriceInput.querySelector('.removeIt');
                removeButton.addEventListener('click', () => {
                    newPriceInput.remove();
                    updatePriceData()
                });
            });


            multiselFilt().then(() => {
                renderIconLabels("")
            }).then(() => {
                $("#plan div.dropdown-item.custom-control").on("click", function (e) {
                    renderIconPlan()
                })
            }).then(() => {
                let planPreload = (<?php echo json_encode(json_decode($prop->plan, true)) ?>);
                let forLabelProof = $('#plan');
                for (let i = 0; i < planPreload.length; i++) {
                    let task = forLabelProof.find(".plan-input")[i]
                    let dropDownMenu = task.querySelector(".dropdown .dropdown-menu")
                    let inputIt = dropDownMenu.querySelector('input[value="'+planPreload[i]["icon"]+'"]')
                    $(inputIt).siblings("label.custom-control-label")[0].click()
                    updatePlanData()
                    isFormDirty = false
                    
                }
            })
            const addMoreButPlan = document.querySelector('.add-more-plan');
            addMoreButPlan.addEventListener('click', () => {
                addIngDOM()
            });


            updatePriceData();
            $(document).on("input", ".price-input input", function() {
                updatePriceData();
            });

            updatePlanData();
            $(document).on("input", ".plan-input input", function() {
                updatePlanData();
            });


            
            if (window.File && window.FileList && window.FileReader) {
                // Attach event listener to file input
                const preImgs = (<?php echo json_encode(json_decode($prop->images, true)) ?>);
                let strImgConcat = "{{ asset('storage/images/') }}"

                let fullPreImgs = []

                // Function to convert URL to File object
                function urlToFile(url, filename) {
                    return fetch(url)
                        .then(response => response.blob())  // Fetch the image as a Blob
                        .then(blob => {
                            // Create a new File object from the Blob
                            const file = new File([blob], filename, { type: blob.type });
                            return file;
                        });
                }
                let filePromises = preImgs.map(function(img) {
                    // Create the full URL
                    let fullUrl = strImgConcat + '/' + img;
                    
                    // Generate the file from URL and add to array of promises
                    return urlToFile(fullUrl, img).then(file => {
                        fullPreImgs.push(file);  // Push the File object to the fullPreImgs array
                    });
                });

                Promise.all(filePromises).then(() => {
                    handleFileInputChange(fullPreImgs);  // Pass the array of File objects
                });

                handleFileInputChange(fullPreImgs);

                $("#images").on("change", function(e) {
                    handleFileInputChange(e.target.files);
                });
            } else {
                Swal("info", "Your browser doesn't support File preview; proceed", "info")
            }


            function handleBtnErr(btn) {
                $(".errors-class").text("")
                $("input.form-control").removeClass("is-invalid")
                $("#"+btn).attr("disabled", true)
                $("#"+btn).text("Processing Data...")
                $("body").toggleClass("wait");
            }
            function reverseDOM(btn) {
                $("#"+btn).attr("disabled", false)
                $("#"+btn).text("Update")
                $("#"+btn).css("cursor", "no-drop !important")
                $("body").removeClass("wait");
            }


            // Detect changes in form fields
            $('#sendForm :input').on('change input', function() {
                isFormDirty = true; // Set flag to true if any input changes
            });
            let noteEdit = $("div.note-editable.card-block").html()

            $("#sendBtn").on("click", function(e) {
                if ($("div.note-editable.card-block").html() != noteEdit) {
                    isFormDirty = true;
                }
                if (!isFormDirty) {
                    toastr["warning"]('Zero changes made to property');
                    return; // If form is not dirty, do not proceed with AJAX
                }

                const formData = new FormData(document.getElementById("sendForm"));
                // allImages.forEach((image) => {
                //     formData.append('images[]', image);
                // });

                priceData.forEach((item, index) => {
                    formData.append(`price[${index}][amount]`, item.amount);
                    formData.append(`price[${index}][descprice]`, item.descprice);
                });
                planData.forEach((item, index) => {
                    formData.append(`plan[${index}][icon]`, item.icon);
                    formData.append(`plan[${index}][descplan]`, item.descplan);
                });
                
                let featS = formData.getAll("features[]")
                featS[0] === "" || featS[0] === null ? featS.shift() : null
                formData.delete("features[]")
                formData.append("features[]", featS)

                e.preventDefault() && e.stopPropagation();
                handleBtnErr("sendBtn")
                let titLe = $("#title").val()
                $.ajax({
                    type: 'POST',
                    url: '{{ route('update-property',[$prop->uniqId]) }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType : 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr["success"](`${titLe}` + " updated successfully🎉")
                        setTimeout(() => {
                            window.location.reload()
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('.' + key).addClass('is-invalid');
                            $('small.' + key).text(value);
                            if (('.' + key).startsWith(".plan.")) {
                            }
                        });
                        reverseDOM("sendBtn")
                    },
                });
            });

            $("#sendBtnImg").on("click", function(e) {
                const formDataImg = new FormData();
                allImages.forEach((image) => {
                    formDataImg.append('images[]', image);
                });

                e.preventDefault() && e.stopPropagation();
                handleBtnErr("sendBtnImg")
                $.ajax({
                    type: 'POST',
                    url: '{{ route('update-property-images',[$prop->uniqId]) }}',
                    data: formDataImg,
                    processData: false,
                    contentType: false,
                    dataType : 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr["success"]("Images updated successfully🎉")
                        setTimeout(() => {
                            window.location.reload()
                        }, 2000);
                    },
                    error: function(xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr["error"]("Image upload failed😔")
                            setTimeout(() => {
                                window.location.reload()
                            }, 2000);
                        });
                        reverseDOM("sendBtn")
                    },
                });
            });
        });
    </script>
    
@endpush