@extends('backend.layout.layout')

@section('container')
    <!-- 麵包屑 Breadcrumb -->
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
            <li class="breadcrumb-item">前台設定</li>
            <li class="breadcrumb-item col">璽室映像</li>
        </ol>
    </nav>
    <div class="container-fluid p-3 m-1">

        <div class="card col-12 rounded-3 bg-white mb-4">
            <h2 class="fs-5 p-3 fw-bold border-bottom">璽室映像設定</h2>

            <div class="card-body border-bottom">
                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto">
                        <div class="dive_sub">英文小標</div>
                    </div>
                    <div class="w-auto input-group me-2">
                        <span class="input-group-text bg-white">ABOUT</span>
                        <input type="text" class="form-control" id="en_title"
                            value="{{ $data ? $data->en_title : '' }}">
                    </div>
                    <div class="w-auto">
                        <div class="dive_sub">中文大標</div>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="zh_title"
                            value="{{ $data ? $data->zh_title : '' }}">
                    </div>
                </div>

                <div class="d-flex justify-content-start gap-3 mb-3">
                    <div class="w-auto col-1">
                        <div class="dive_sub">媒體網址</div>
                    </div>
                    <div class="col">
                        <textarea id="media_url" class="form-control search_input easein mb-0" rows="2" placeholder="媒體網址">{{ $data ? $data->media_url : '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <a href="#" onclick="updateBtn({{ $data->id ?? null }})"
                    class="btn btn-secondary border-0 rounded-3 float-end shadow-sm px-3">確認送出</a>
            </div>
        </div>
    </div>

    <script>
        function updateBtn(id) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            const data = {
                id: id,
                en_title: $("#en_title").val(),
                zh_title: $("#zh_title").val(),
                media_url: $("#media_url").val(),
            };

            if (data.en_title == '') {
                Swal.fire({
                    icon: "error",
                    title: "英文小標不得空白!",
                    timer: 3000
                });
                return
            } else if (data.zh_title == '') {
                Swal.fire({
                    icon: "error",
                    title: "中文大標不得空白!",
                    timer: 3000
                });
                return
            } else if (data.media_url == '') {
                Swal.fire({
                    icon: "error",
                    title: "媒體網址不得空白!",
                    timer: 3000
                });
                return
            }

            $.ajax({
                url: "{{ route('backend.video.upsert') }}",
                type: "PATCH",
                headers: {
                    "X-CSRF-TOKEN": csrfToken
                },
                data: data,
                success: function(response) {
                    if (response.code == '00') {
                        Swal.fire({
                            title: '修改成功!',
                            icon: 'success',
                            timer: 3000
                        }).then((result) => {
                            location.reload();
                        });
                    }
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
