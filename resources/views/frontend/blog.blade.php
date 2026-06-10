<!DOCTYPE html>
<html lang="zh-TW">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ $blog->keyword }}">
    <meta name="google-site-verification" content="SyF3ANdA4MWsMr_aMl2aw40ermtbJCsOBCBSUteBnd0" />
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M7LSZPVZ');
    </script>
    <!-- End Google Tag Manager -->

    <title>{{ env('FRONTEND_NAME') }}</title>

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/frontend/bootstrap.min.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Work+Sans:300,400,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/frontend/style.min.css') }}">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    <!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

</head>

<body data-spy="scroll" data-target="#navbar-nav-header" class="single-layoutt static-layout">
    <div class="boxed-page">
        <nav id="gtco-header-navbar" class="navbar navbar-expand-lg py-4">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('frontend.index') }}">
                    <img src="{{ asset('images/logo.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-nav-header"
                    aria-controls="navbar-nav-header" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="lnr lnr-menu"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbar-nav-header">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.index') }}#Blog"><span
                                    class="lnr lnr-arrow-left"></span> Back to
                                List</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron d-flex align-items-center"
            style="background-image: url({{ asset('images/blog-slide.png') }})">
        </div>
        <!-- Contact Form Section -->
        <section id="gtco-single-content" class="bg-white">
            <div class="container">
                <div class="section-content blog-content">
                    <div class="title-wrap">
                        <h2 class="section-title">{{ $blog->title }}</h2>
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </section>
    </div>

    </div>
    <!-- External JS -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/isotope.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/app.min.js') }}"></script>
</body>

</html>
