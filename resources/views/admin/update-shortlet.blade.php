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
                                                echo '  <input type="text" value="'. $f->description .'" class="form-control col-md-6 price '. 0 .' description" placeholder="Description">';
                                                echo '</div>';

                                                if (!empty($priceList)) {
                                                    foreach ($priceList as $k => $pr) {
                                                        echo '<div class="price-input" style="display: flex;gap: 10px;align-items: center;">';
                                                        echo '  <input type="number" value="'. $pr->amount .'" class="form-control col-md-4 price '. ++$k .' amount" placeholder="Amount">';
                                                        echo '  <input type="text" value="'. $pr->description .'" class="form-control col-md-6 price '. ++$k .' description" placeholder="Description">';
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
                                    <label for="images"><i data-lucide="cloud-upload"></i></label>
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
        let priceData = [];



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
        }


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
            $("div.dropdown-item.custom-control").on("click", function () {
                handleIconRender()
            })

            const labels = document.querySelectorAll('.custom-control-label');
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


            updatePriceData();
            $(document).on("input", ".price-input input", function() {
                updatePriceData();
            });
            function updatePriceData() {
                priceData = []
                $(".price-input").each(function(e) {
                    let inpses = $(this).find("input")
                    // priceData.push(inpses[0].value + "remitttta" + inpses[1].value)
                    priceData.push({'amount': inpses[0].value, 'description': inpses[1].value})
                })
            }


            
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

            $("#sendBtn").on("click", function(e) {
                const formData = new FormData(document.getElementById("sendForm"));
                // allImages.forEach((image) => {
                //     formData.append('images[]', image);
                // });

                priceData.forEach((item, index) => {
                    // Here we are adding 'priceData[0][amount]', 'priceData[0][description]' etc.
                    formData.append(`price[${index}][amount]`, item.amount);
                    formData.append(`price[${index}][description]`, item.description);
                });
                
                let featS = formData.getAll("features[]")
                featS[0] === "" || featS[0] === null ? featS.shift() : null
                formData.delete("features[]")
                formData.append("features[]", featS)
                // console.log(formData.getAll("features[]"));

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
                        // console.log(xhr);
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('.' + key).addClass('is-invalid');
                            $('small.' + key).text(value);
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
                        // console.log(xhr);
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