@extends('backend.layout.layout')

@section('container')
    <!-- 麵包屑 Breadcrumb -->
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
            <li class="breadcrumb-item">前台設定</li>
            <li class="breadcrumb-item col">LOGO與輪播設定</li>
        </ol>
    </nav>
    <div class="container-fluid p-3 m-1">
        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">LOGO設定</h2>

            <form id="updateLogo">
                <div class="card-body border-bottom d-flex justify-content-between gap-3">
                    <div class="col-4 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">更改LOGO</label>
                        <input type="file" name="logo" id="logo" onchange="reviewImage(this)"
                            class="form-control search_input product-hover easein">
                        <img id="logoImg" class="mt-3" src="{{ asset('images/backend/defaultImage.png') }}">
                    </div>

                    <div class="col-8 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">LOGO</label>
                        <div class="card-body bg-white rounded-3">
                            <img src="{{ asset('images/logo.png') }}" style="height: 100px;">
                        </div>
                    </div>
                </div>
            </form>

            <div class="card-body">
                <button type="button" onclick="updateLogoBtn()"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3">確認送出</button>
            </div>
        </div>

        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">輪播設定
                <button type="button" onclick="addColumnsBtn()"
                    class="w-auto btn btn-danger btn-sm rounded-pill float-end shadow-sm lh-sm"><i
                        class="fas fa-plus"></i></button>
            </h2>

            <form id="updateCarousel">
                <div id="upload_div">
                    @foreach ($list as $carousel)
                        <div class="card-body border-bottom d-flex justify-content-between gap-3">
                            <input type="hidden" name="updateIds[]" value="{{ $carousel->id }}">

                            <div class="col-4 card-body fs-6 gray_l rounded-3">
                                <label class="mb-2">上傳封面圖片<span
                                        style="color: red">(只接受jpg、png,尺寸建議1920*750)</span></label>
                                <input type="file" name="updateImages[]" id="carousel{{ $carousel->id }}"
                                    onchange="reviewImage(this)" class="form-control search_input product-hover easein">
                                <img id="carousel{{ $carousel->id }}Img" class="mt-3" src="{{ asset($carousel->image) }}">

                                <label class="mb-2">上傳內容圖片<span
                                        style="color: red">(只接受jpg、png,尺寸建議1920*750)</span></label>
                                <input type="file" name="updateContentImages[]" id="carouselContent{{ $carousel->id }}"
                                    onchange="reviewImage(this)" class="form-control search_input product-hover easein">
                                <img id="carouselContent{{ $carousel->id }}Img" class="mt-3"
                                    src="{{ asset($carousel->content_image) }}">
                            </div>

                            <div class="col-8 card-body fs-6 gray_l rounded-3">
                                <div class="col-1 float-end text-end px-0" id="{{ $carousel->id }}">
                                    <button type="button" onclick="delColumnsBtn(this)" class="btn-close btn-sm p-0"
                                        aria-label="Close"></button>
                                </div>
                                <div class="w-auto col-1">
                                    <div class="dive_sub">標題</div>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control border bg-white" name="updateTitles[]"
                                        value="{{ $carousel->title }}">
                                </div>
                                <div class="w-auto col-1">
                                    <div class="dive_sub">副標題</div>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control border bg-white" name="updateSubtitles[]"
                                        value="{{ $carousel->subtitle }}">
                                </div>
                                <div class="w-auto col-1">
                                    <div class="dive_sub">按鈕文字</div>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="form-control border bg-white" name="updateButtonTexts[]"
                                        value="{{ $carousel->button_text }}">
                                </div>
                                <div class="w-auto col-1">
                                    <div class="dive_sub">內文類別</div>
                                </div>
                                <div class="input-group">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input content-type-radio"
                                            name="updateContentTypes[]" id="updateContentType0_{{ $carousel->id }}"
                                            value="0" {{ ($carousel->content_type ?? 0) == 0 ? 'checked' : '' }}>

                                        <label class="form-check-label" for="updateContentType0_{{ $carousel->id }}">自訂內文
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input content-type-radio"
                                            name="updateContentTypes[]" id="updateContentType1_{{ $carousel->id }}"
                                            value="1" {{ ($carousel->content_type ?? 0) == 1 ? 'checked' : '' }}>

                                        <label class="form-check-label" for="updateContentType1_{{ $carousel->id }}"> URL
                                            跳轉 </label>
                                    </div>
                                </div>

                                <div
                                    class="content-type-section    {{ ($carousel->content_type ?? 0) == 0 ? '' : 'd-none' }}">

                                    <div class="w-auto col-1">
                                        <div class="dive_sub">內容</div>
                                    </div>
                                    <div class="input-group">
                                        <textarea name="updateContents[]" class="form-control border bg-white" rows="2">{{ $carousel->content }}</textarea>
                                    </div>

                                    <div class="w-auto col-1">
                                        <div class="dive_sub">內容文字</div>
                                    </div>
                                    <div class="input-group">
                                        <textarea name="updateContentTexts[]" class="form-control border bg-white" rows="2">{{ $carousel->content_text }}</textarea>
                                    </div>
                                </div>

                                <div
                                    class="url-type-section    {{ ($carousel->content_type ?? 0) == 1 ? '' : 'd-none' }}">

                                    <div class="w-auto col-1">
                                        <div class="dive_sub">URL</div>
                                    </div>
                                    <div class="input-group">
                                        <input type="url" class="form-control border bg-white" name="updateUrls[]"
                                            value="{{ $carousel->url }}" placeholder="https://example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>

            <div class="card-body">
                <button type="button" onclick="updateBtn()"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3">確認送出</button>
            </div>
        </div>
    </div>

    <script>
        $(document).on('change', '.content-type-radio', function() {
            const type = $(this).val();
            const parent = $(this).closest('.col-8');

            parent.find('.content-type-section')
                .toggleClass('d-none', type !== '0');

            parent.find('.url-type-section')
                .toggleClass('d-none', type !== '1');
        });

        image_id = {{ count($list) + 1 }};

        function updateLogoBtn() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            let data = new FormData($('#updateLogo')[0]);

            $.ajax({
                url: "{{ route('backend.carousel.updateLogo') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == '00') {
                        Swal.fire({
                            title: '修改成功!',
                            icon: 'success',
                            timer: 3000
                        }).then((result) => {
                            location.reload();
                        });
                    };
                },
                error: function(xhr, status, error) {
                    let alert_text = "發生不可預期的錯誤";

                    if (xhr.status == '403') {
                        alert_text = "無此權限";
                    }

                    Swal.fire({
                        icon: "error",
                        title: alert_text,
                        timer: 3000
                    });
                    return
                }
            });
        }

        function reviewImage(element) {
            if (element.files && element.files[0]) {
                const file = element.files[0];
                const img = new Image();


                img.onload = function() {
                    console.log(this.width, this.height);
                    if (this.width !== 1920 || this.height !== 750) {
                        Swal.fire({
                            icon: "error",
                            title: "圖片尺寸必須為 1920x750px",
                            timer: 3000
                        });

                        element.value = "";
                        return;
                    }

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#" + element.id + "Img").attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                };

                img.src = URL.createObjectURL(file);
            }
        }

        function addColumnsBtn() {
            html = `            
            <div class="card-body border-bottom d-flex justify-content-between gap-3">
                <div class="col-4 card-body fs-6 gray_l rounded-3">
                    <label class="mb-2">上傳封面圖片<span style="color: red">(只接受jpg、png,尺寸建議1920*750)</span></label>
                    <input type="file" name="images[]" id="carousel${image_id}" onchange="reviewImage(this)"
                        class="form-control search_input product-hover easein">
                    <img id="carousel${image_id}Img" class="mt-3"
                        src="{{ asset('images/backend/defaultImage.png') }}">

                    <label class="mb-2">上傳內容圖片<span style="color: red">(只接受jpg、png,尺寸建議1920*750)</span></label>
                    <input type="file" name="contentImages[]" id="carouselContent${image_id}"
                        onchange="reviewImage(this)" class="form-control search_input product-hover easein">
                    <img id="carouselContent${image_id}Img" class="mt-3"
                        src="{{ asset('images/backend/defaultImage.png') }}">
                </div>

                <div class="col-8 card-body fs-6 gray_l rounded-3">
                    <div class="col-1 float-end text-end px-0"><button type="button" onclick="delColumnsBtn(this)"
                            class="btn-close btn-sm p-0" aria-label="Close"></button></div>
                    <div class="w-auto col-1">
                        <div class="dive_sub">標題</div>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control border bg-white" name="titles[]" value="">
                    </div>
                    <div class="w-auto col-1">
                        <div class="dive_sub">副標題</div>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control border bg-white" name="subtitles[]" value="">
                    </div>
                    <div class="w-auto col-1">
                        <div class="dive_sub">按鈕文字</div>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control border bg-white" name="updateButtonTexts[]"
                            value="">
                    </div>

                    <div class="w-auto col-1">
                        <div class="dive_sub">內文類別</div>
                    </div>
                    <div class="input-group">
                        <div class="form-check">
                            <input type="radio" class="form-check-input content-type-radio"
                                name="contentTypes[${image_id}]"
                                id="contentType0_${image_id}" value="0" checked>

                            <label class="form-check-label" for="contentType0_${image_id}">自訂內文
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input content-type-radio"
                                name="contentTypes[${image_id}]"
                                id="contentType1_${image_id}" value="1">

                            <label class="form-check-label" for="contentType1_${image_id}"> URL
                                跳轉 </label>
                        </div>
                    </div>

                    <div class="content-type-section">
                        <div class="w-auto col-1">
                            <div class="dive_sub">內容</div>
                        </div>
                        <div class="input-group">
                            <textarea name="contents[]" class="form-control border bg-white" rows="2"></textarea>
                        </div>

                        <div class="w-auto col-1">
                            <div class="dive_sub">內容文字</div>
                        </div>
                        <div class="input-group">
                            <textarea name="contentTexts[]" class="form-control border bg-white" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="url-type-section d-none>
                        <div class="w-auto col-1">
                            <div class="dive_sub">URL</div>
                        </div>
                        <div class="input-group">
                            <input type="url" class="form-control border bg-white" name="urls[]" placeholder="https://example.com">
                        </div>
                    </div>
                </div>
            </div>
        `;

            $("#upload_div").append(html);
            image_id++;
        }

        function delColumnsBtn(element) {
            parentElement = element.parentNode.parentNode.parentNode;
            parentElement.remove();
            html = `<input type="hidden" name="deletes[]" value="` + element.parentNode.id + `">`;
            $("#upload_div").append(html);
        }

        function updateBtn() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            let data = new FormData($('#updateCarousel')[0]);
            let isValid = true;

            for (var pair of data.entries()) {
                switch (pair[0]) {
                    case 'images[]':
                        if (pair[1].size == "0") {
                            Swal.fire({
                                icon: "error",
                                title: "請選擇圖片!",
                                timer: 3000
                            });
                            return
                        }
                }
            };

            $('#updateCarousel .content-type-radio:checked').each(function() {
                if ($(this).val() !== '1') {
                    return;
                }

                const parent = $(this).closest('.col-8');
                const input = parent.find('.url-type-section input')[0];
                const url = input.value.trim();

                if (!url || !input.checkValidity() || !/^https?:\/\//i.test(url)) {
                    Swal.fire({
                        icon: 'error',
                        title: '請輸入正確的 URL！',
                        timer: 3000
                    });

                    isValid = false;
                    return false;
                }
            });

            if (!isValid) {
                return;
            }

            $.ajax({
                url: "{{ route('backend.carousel.upsert') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == '00') {
                        Swal.fire({
                            title: '修改成功!',
                            icon: 'success',
                            timer: 3000
                        }).then((result) => {
                            location.reload();
                        });
                    };
                },
                error: function(xhr, status, error) {
                    let alert_text = "發生不可預期的錯誤";

                    if (xhr.status == '403') {
                        alert_text = "無此權限";
                    }

                    Swal.fire({
                        icon: "error",
                        title: alert_text,
                        timer: 3000
                    });
                    return
                }
            });
        }
    </script>
@endsection
