@extends('backend.layout.layout')

@section('container')
    <style>
        .card-header {
            background-color: white;
            border-bottom: 1px solid #eee;
            padding: 15px 25px;
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-ivy {
            background-color: #007bff;
            color: white;
        }

        .btn-ivy:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
    <!-- 麵包屑 Breadcrumb -->
    <nav class="" aria-label="breadcrumb">
        <ol class="breadcrumb d-flex justify-content-start lh-lg m-0 ms-3">
            <li class="breadcrumb-item">前台設定</li>
            <li class="breadcrumb-item col">部落格</li>
        </ol>
    </nav>

    <div class="container-fluid p-3 m-1">
        <div class="card col-12 rounded-3 bg-white mb-4">
            <div class="card-header p-3">
                <span class="fs-5">文章列表</span>
                <button class="btn btn-ivy btn-sm shadow-sm"
                    onclick="javascript:location.href='{{ route('backend.blog.create') }}'">
                    <i class="fas fa-plus me-1"></i> 新增文章
                </button>
            </div>

            <div class="card-body toScroll text-nowrap">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class=""></th>
                            <th>標題</th>
                            <th>關鍵字</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($list as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->keyword }}</td>
                                <td>
                                    <button type="button" class="btn btn-light rounded-3 shadow-sm"
                                        onclick="javascript:location.href='{{ route('backend.blog.detail', $blog->id) }}'"><i
                                            class="far fa-edit"></i></button>
                                    <button class="btn btn-light rounded-3 shadow-sm"
                                        onclick="window.open('{{ route('frontend.blog.show', $blog->id) }}')"><i
                                            class="fas fa-eye"></i></button>
                                    <button type="button" onclick="deleteConfirmBtn({{ $blog->id }})"
                                        class="btn btn-light rounded-3 shadow-sm"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @empty(!$list)
                    {{ $list->links('backend.pagination.pagination') }}
                @endempty
            </div>
        </div>
    </div>
@endsection
