<section class="header_area">
    <div class="header_navbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand logo" href="{{ route('users-page') }}">
                            <img src="{{ asset('static/img/user/nta-logo.png') }}" alt="Logo">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="page-scroll" href="#home">{!! trans('onepage.home') !!}</a>
                                </li>
                                @if(isset($data['business']) && !empty($data['business']) && isset($data['business']->categoryDetail[0]))
                                <li class="nav-item">
                                    <a class="page-scroll" href="#about">{!! trans('onepage.about') !!}</a>
                                </li>
                                @endif
                                @if(isset($data['ourServices']) && !empty($data['ourServices']) && isset($data['ourServices']->categoryDetail[0]))
                                <li class="nav-item">
                                    <a class="page-scroll" href="#services">{!! trans('onepage.services') !!}</a>
                                </li>
                                @endif
                                @if(isset($data['projects']) && !empty($data['projects']) && isset($data['projects']->categoryDetail[0]))
                                <li class="nav-item">
                                    <a class="page-scroll" href="#work">{!! trans('onepage.projects') !!}</a>
                                </li>
                                @endif
                                @if(isset($data['teams']) && !empty($data['teams']) && isset($data['teams']->categoryDetail[0]))
                                <li class="nav-item">
                                    <a class="page-scroll" href="#team">{!! trans('onepage.teams') !!}</a>
                                </li>
                                @endif
                                @if(isset($data['blog']) && !empty($data['blog']) && isset($data['blog']->categoryDetail[0]))
                                <li class="nav-item">
                                    <a class="page-scroll" href="#blog">{!! trans('onepage.blog') !!}</a>
                                </li>
                                @endif
                                <li class="nav-item">
                                    <a class="page-scroll" href="#info">{!! trans('onepage.Information.menu') !!}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="#contact">{!! trans('onepage.contact') !!}</a>
                                </li>
                                <li class="nav-item-lang en-US en first">
                                    <a class="{{ empty($_GET['lang']) ? 'active-lang' : '' }}" rel="alternate" hreflang="en-US" href="{{ route('users-page') }}" title="英語">English</a>
                                </li>
                                <li class="nav-item-lang ja current last">
                                    <a class="@if(!empty($_GET['lang'])) {{($_GET['lang'] == 'jp') ? 'active-lang' : ''}} @endif" rel="alternate" hreflang="ja" href="{{ route('users-page', ['lang' => 'jp']) }}" title="日本語">日本語</a>
                                </li>
                            </ul>
                        </div> <!-- navbar collapse -->
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header navbar -->

    <div id="home" class="header_hero d-lg-flex align-items-center">
        <div class="hero_shape shape_1">
            <img src="{{ asset('static/img/user/shape/shape-1.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_2">
            <img src="{{ asset('static/img/user/shape/shape-2.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_3">
            <img src="{{ asset('static/img/user/shape/shape-3.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_4">
            <img src="{{ asset('static/img/user/shape/shape-4.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_6">
            <img src="{{ asset('static/img/user/shape/shape-1.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_7">
            <img src="{{ asset('static/img/user/shape/shape-4.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_8">
            <img src="{{ asset('static/img/user/shape/shape-3.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_9">
            <img src="{{ asset('static/img/user/shape/shape-2.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_10">
            <img src="{{ asset('static/img/user/shape/shape-4.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_11">
            <img src="{{ asset('static/img/user/shape/shape-1.svg') }}" alt="shape">
        </div><!-- hero shape -->
        <div class="hero_shape shape_12">
            <img src="{{ asset('static/img/user/shape/shape-2.svg') }}" alt="shape">
        </div><!-- hero shape -->

        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header_hero_content">
                        <h2 class="hero_title wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">{!! trans('onepage.head_title_1') !!}<span class="nta-color">{!! trans('onepage.head_title_2') !!}</span></h2>
                        <p class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.6s">{!! trans('onepage.head_content') !!}</p>
                    </div> <!-- header hero content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
        <div class="header_shape d-none d-lg-block"></div>

        <div class="header_image d-flex align-items-center">
            <div class="image">
                <img class="wow fadeInRightBig" data-wow-duration="2s" data-wow-delay="1.6s" src="{{ asset('static/img/user/header-image.svg') }}" alt="Header Image">
            </div>
        </div> <!-- header image -->
    </div> <!-- header hero -->
</section>
