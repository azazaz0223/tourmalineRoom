@extends('backend.layout.layout')

@section('container')
    <!-- 麵包屑 Breadcrumb -->
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
            <li class="breadcrumb-item">前台設定</li>
            <li class="breadcrumb-item col">璽室體驗</li>
        </ol>
    </nav>
    <div class="container-fluid p-3 m-1">

        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">璽室體驗編輯</h2>

            <form id="update">
                <div class="card-body border-bottom">
                    <div class="d-flex justify-content-start gap-3 mb-3">
                        <div class="w-auto">
                            <div class="dive_sub">首頁大標</div>
                        </div>
                        <div class="col">
                            <input type="text" name="title" class="form-control" placeholder="請輸入首頁大標"
                                value="{{ $product->title }}">
                        </div>
                        <div class="w-auto">
                            <div class="dive_sub">首頁副標</div>
                        </div>
                        <div class="col-3">
                            <input type="text" name="subtitle" class="form-control" placeholder="請輸入首頁副標"
                                value="{{ $product->subtitle }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-start gap-3 mb-3">
                        <div class="w-auto col-1">
                            <div class="dive_sub">排序</div>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="sort" min="0"
                                value="{{ $product->sort }}">
                        </div>
                        <div class="w-auto col-1">
                            <div class="dive_sub">上架設定</div>
                        </div>
                        <div class="col">
                            <select class="select form-control" name="status">
                                <option value="">請選擇上下架</option>
                                <option value="1" @selected($product->status == 1)>上架</option>
                                <option value="0" @selected($product->status == 0)>下架</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start gap-3 mb-3">
                        <div class="w-auto col-1">
                            <div class="dive_sub">內文描述</div>
                        </div>
                        <div class="col">
                            <textarea name="content" class="form-control search_input easein mb-0" rows="2" placeholder="請輸入內文描述">{{ $product->content }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card-body border-bottom d-flex justify-content-between gap-3">
                    <div class="col-4 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">上傳首頁縮圖<span style="color: red">(只接受jpg、png,尺寸建議1200*800)</span></label>
                        <div class="c-mainCard__item">
                            <div class="l-upload l-upload--notSpace">
                                <div class="card-body fs-6 gray_l rounded-3">
                                    <input type="file" name="image" id="product" onchange="reviewImage(this,true)"
                                        class="form-control search_input product-hover easein">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">預覽首頁縮圖</label>
                        <div class="p-0">
                            <img id="productImg" class="mt-3" src="{{ asset($product->image) }}">
                        </div>
                    </div>
                </div>

                <div class="card-body border-bottom d-flex justify-content-between gap-3">
                    <div class="col-4 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">上傳體驗內容圖</label>
                        <div class="c-mainCard__item">
                            <div class="l-upload l-upload--notSpace">
                                <div class="card-body fs-6 gray_l rounded-3">
                                    <input type="file" name="content_image" id="productContent"
                                        onchange="reviewImage(this,false)"
                                        class="form-control search_input product-hover easein">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-8 card-body fs-6 gray_l rounded-3">
                        <label class="mb-2">預覽體驗內容圖</label>
                        <div class="p-0">
                            <img id="productContentImg" class="mt-3" src="{{ asset($product->content_image) }}">
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">
                <button type="button" onclick="updateBtn({{ $product->id }})"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3 me-2">確認修改</button>
                <a href="{{ route('backend.product.index') }}"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3 me-2">返回列表</a>
            </div>
        </div>
    </div>

    <script>
        function reviewImage(element, flag) {
            if (element.files && element.files[0]) {
                const file = element.files[0];
                const img = new Image();


                img.onload = function() {
                    if (flag) {
                        if (this.width !== 1200 || this.height !== 800) {
                            Swal.fire({
                                icon: "error",
                                title: "圖片尺寸必須為 1200x800px",
                                timer: 3000
                            });

                            element.value = "";
                            return;
                        }
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

        function updateBtn(id) {
            url = "{{ route('backend.product.update', ':id') }}";
            url = url.replace(':id', id);

            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            let data = new FormData($('#update')[0]);
            data.append('_method', 'PATCH');

            for (var pair of data.entries()) {
                switch (pair[0]) {
                    case 'title':
                        if (pair[1] == '') {
                            return
                            Swal.fire({
                                icon: "error",
                                title: "請輸入標題!",
                                timer: 3000
                            });
                            return
                        }
                }
            };

            $.ajax({
                url: url,
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
