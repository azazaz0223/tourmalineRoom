@extends('backend.layout.layout')

@section('container')
    <div class="card">
        <div class="card-header p-3">
            <span class="fs-5" id="editorTitle">修改部落格文章</span>
        </div>
        <div class="card-body border-bottom">
            <form id="update">
                <div class="row">
                    <!-- 左側：主要內容 -->
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">文章標題</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="請輸入文章標題"
                                value="{{ $blog->title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">文章內容</label>
                            <textarea class="form-control" name="blog_content" id="blog_content">{{ $blog->content }}</textarea>
                        </div>
                    </div>

                    <!-- 右側：設定欄位 -->
                    <div class="col-md-4 border-start">
                        <div class="mb-4 text-center">
                            <label class="form-label fw-bold d-block text-start">列表預覽圖</label>
                            <label for="image" id="imagePreview"
                                class="bg-light border rounded d-flex align-items-center justify-content-center mb-2"
                                style="height: 180px; cursor: pointer;">
                                @if (isset($blog->image))
                                    <img src="{{ asset($blog->image) }}" class="img-fluid h-100">
                                @else
                                    <div class="text-muted">
                                        <i class="fas fa-cloud-upload-alt fa-2x d-block mb-2"></i>
                                        點擊上傳圖片
                                    </div>
                                @endif
                            </label>

                            <input type="file" name="image" id="image" class="d-none" accept="image/*"
                                onchange="reviewImage(this)">
                            <small class="text-muted">建議尺寸: 1200x800px</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">關鍵字 (Tags)</label>
                            <textarea class="form-control" name="keyword" id="keyword">{{ $blog->keyword }}</textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3"
                onclick="updateBtn()">確認修改</a>
            <a href="#" class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3 me-2"
                onclick="javascript:location.href='{{ route('backend.blog.index') }}'">返回列表</a>
        </div>
    </div>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('blog_content', {
            language: 'zh',
            filebrowserBrowseUrl: "{{ route('ckfinder_browser') }}",
            filebrowserUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files",
        });

        function reviewImage(element) {
            const preview = document.getElementById('imagePreview');

            if (element.files && element.files[0]) {
                const file = element.files[0];
                const img = new Image();

                img.onload = function() {
                    if (this.width !== 1200 || this.height !== 800) {
                        $("#alert_text").text("圖片尺寸必須為 1200x800px");
                        $("#alert").modal("show");

                        // 清掉 input
                        element.value = "";
                        preview.innerHTML =
                            `<div class="text-muted"><i class="fas fa-cloud-upload-alt fa-2x d-block mb-2"></i>點擊上傳圖片</div>`;
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" class="img-fluid h-100">`;
                    };
                    reader.readAsDataURL(file);
                };

                img.src = URL.createObjectURL(file);
            }
        }

        function updateBtn() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            let formData = new FormData($('#update')[0]);

            let content = CKEDITOR.instances['blog_content'].getData();
            formData.set('content', content);

            if (!formData.get('title')) {
                $("#alert_text").text("請輸入文章標題");
                $("#alert").modal("show");
                return;
            } else if (!formData.get('keyword')) {
                $("#alert_text").text("請輸入關鍵字");
                $("#alert").modal("show");
                return;
            }

            formData.append('_method', 'PATCH');

            $.ajax({
                url: "{{ route('backend.blog.update', $blog->id) }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.code == '00') {
                        $("#alert_text").text("修改成功");
                        $("#alert").modal("show");
                    };
                },
                error: function(xhr, status, error) {
                    let alert_text = "發生不可預期的錯誤";

                    if (xhr.status == '403') {
                        alert_text = "無此權限";
                    }
                    $("#alert_text").text(alert_text);
                    $("#alert").modal("show");
                }
            });
        }
    </script>
@endsection
