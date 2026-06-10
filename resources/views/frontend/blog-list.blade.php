@foreach ($data['blogs'] as $blog)
    @php
        $isLeft = $loop->index % 2 == 0;
    @endphp

    <div class="col-lg-6">
        <div class="single-rpost d-sm-flex align-items-center" data-aos="{{ $isLeft ? 'fade-right' : 'fade-left' }}"
            data-aos-duration="800">
            <div class="post-thumb {{ $isLeft ? 'order-sm-2' : '' }}">
                <img class="img-fluid" src="{{ asset($blog->image) }}">
            </div>
            <div class="post-content {{ $isLeft ? 'text-sm-right order-sm-1' : '' }}">
                <time datetime="2026-03-01">{{ $blog->created_at->format('Y-m-d') }}</time>
                <h3><a href="{{ route('frontend.blog.show', $blog->id) }}">{{ $blog->title }}</a>
                </h3>
                <a class="post-btn" href="{{ route('frontend.blog.show', $blog->id) }}"><i
                        class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
@endforeach
