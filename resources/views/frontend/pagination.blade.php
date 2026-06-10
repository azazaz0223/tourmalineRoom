@if ($paginator->hasPages())

    <div class="text-center load-more-container d-flex justify-content-center">
        {{-- 上一頁 --}}
        @if ($paginator->onFirstPage())
            <button class="post-btn blog-btn form-control" disabled id="prevBtn">
                <i class="fa fa-arrow-left"></i>
            </button>
        @else
            <button class="post-btn blog-btn form-control" id="prevBtn">
                <i class="fa fa-arrow-left"></i>
            </button>
        @endif

        {{-- 頁數 select --}}
        <select id="blogPageSelect" class="form-selectt form-control blog-select">
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <option value="{{ $i }}" {{ $i == $paginator->currentPage() ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>

        {{-- 下一頁 --}}
        @if ($paginator->hasMorePages())
            <button class="post-btn blog-btn form-control" id="nextBtn">
                <i class="fa fa-arrow-right"></i>
            </button>
        @else
            <button class="post-btn blog-btn form-control" disabled id="nextBtn">
                <i class="fa fa-arrow-right"></i>
            </button>
        @endif
    </div>
@endif
