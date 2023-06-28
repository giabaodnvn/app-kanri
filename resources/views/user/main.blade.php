@include('user.elements.header')
<body>
<!--[if IE]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->


<!--====== PRELOADER PART START ======-->

<div class="preloader">
    <div class="loader">
        <div class="ytp-spinner">
            <div class="ytp-spinner-container">
                <div class="ytp-spinner-rotator">
                    <div class="ytp-spinner-left">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                    <div class="ytp-spinner-right">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--====== PRELOADER PART ENDS ======-->

<!--====== HEADER PART START ======-->

@include('user.elements.header_part')

<!--====== HEADER PART ENDS ======-->

<!--====== SERVICES PART START ======-->

@include('user.elements.content_first')

<!--====== SERVICES PART ENDS ======-->

<!--====== ABOUT PART START ======-->

@include('user.elements.content_second')

<!--====== ABOUT PART ENDS ======-->

<!--====== SERVICES PART START ======-->

@include('user.elements.content_third')

<!--====== SERVICES PART ENDS ======-->

<!--====== WORK PART START ======-->
@if(isset($data['projects']) && !empty($data['projects']) && isset($data['projects']->categoryDetail[0]))
<section id="work" class="work_area pt-115 pb-120">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="section_title text-center pb-25">
                <h5 class="sub_title">{{ $data['projects']->categoryDetail[0]->title }}</h5>
                <h4 class="main_title">{{ $data['projects']->categoryDetail[0]->description }}</h4>
            </div> <!-- section title -->
        </div>
    </div>
    <div class="card-container card-slider">
        @if(isset($data['projects']->posts[0]) && isset($data['projects']->posts[0]->postDetail[0]))
            @foreach($data['projects']->posts as $post)
                <div class="card">
                    <img src="{{$post['thumbnail'] ? assetStorage($post['thumbnail']) : ""}}" class="card-img">
                    <div class="card-body">
                        <h3 class="card-title">{{ $post->postDetail[0]->title }}</h3>
                        <p class="card-text">{{ $post->postDetail[0]->description }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>
@endif

<!--====== WORK PART ENDS ======-->

<!--====== PRICING PLAN PART START ======-->

{{--<section id="pricing" class="pricing_area pt-115 pb-120">--}}
{{--</section>--}}

<!--====== PRICING PLAN PART ENDS ======-->

<!--====== TEAM PART START ======-->

{{--<section id="team" class="team_area pt-115 pb-120">--}}
{{--</section>--}}
@if(isset($data['teams']) && !empty($data['teams']) && isset($data['teams']->categoryDetail[0]))
    <section id="team" class="team_area pt-115 pb-120">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center pb-25">
                    <h5 class="sub_title">{{ $data['teams']->categoryDetail[0]->title }}</h5>
                    <h4 class="main_title">{{ $data['teams']->categoryDetail[0]->description }}</h4>
                </div> <!-- section title -->
            </div>
        </div>
        <div class="card-container card-slider">
            @if(isset($data['teams']->posts[0]) && isset($data['teams']->posts[0]->postDetail[0]))
                @foreach($data['teams']->posts as $post)
                    <div class="card">
                        <img src="{{$post['thumbnail'] ? assetStorage($post['thumbnail']) : ""}}" class="card-img">
                        <div class="card-body">
                            <h3 class="card-title">{{ $post->postDetail[0]->title }}</h3>
                            <p class="card-text">{{ $post->postDetail[0]->description }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endif

<!--====== TEAM PART ENDS ======-->

<!--====== BLOG PART START ======-->

@include('user.elements.content_fourth')

<!--====== BLOG PART ENDS ======-->

<!--====== INFO PART START ======-->

@include('user.elements.content_info')

<!--====== INFO PART ENDS ======-->

<!--====== CONTACT PART START ======-->

@include('user.elements.contact')

<!--====== CONTACT PART ENDS ======-->

<!--====== FOOTER PART START ======-->

@include('user.elements.footer')

<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TOP TOP PART START ======-->

<a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>

<!--====== BACK TOP TOP PART ENDS ======-->

<!--====== PART START ======-->

<!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-">

                </div>
            </div>
        </div>
    </section>
-->

<!--====== PART ENDS ======-->




<!--====== Jquery js ======-->
<script src="{{ asset('static/js/user/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('static/js/user/vendor/modernizr-3.7.1.min.js') }}"></script>

<!--====== Bootstrap js ======-->
<script src="{{ asset('static/js/user/popper.min.js') }}"></script>
<script src="{{ asset('static/js/user/bootstrap.min.js') }}"></script>

<!--====== Scrolling Nav js ======-->
<script src="{{ asset('static/js/user/jquery.easing.min.js') }}"></script>
<script src="{{ asset('static/js/user/scrolling-nav.js') }}"></script>

<!--====== Wow js ======-->
<script src="{{ asset('static/js/user/wow.min.js') }}"></script>

<!--====== Main js ======-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="{{ asset('static/js/user/main.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.card-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        // JS load more info table
        const toggleBtns = document.querySelectorAll('.toggle-btn');

        toggleBtns.forEach((btn) => {
            const row = btn.parentNode.parentNode;
            const rows = row.parentNode.querySelectorAll('tr:not(:first-child, :nth-child(2))');

            rows.forEach((row) => {
                // row.style.display = 'none';
                row.classList.add('hidden');
            });
        });

        toggleBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                const row = btn.parentNode.parentNode;
                const rows = row.parentNode.querySelectorAll('tr:not(:first-child, :nth-child(2))');

                rows.forEach((row) => {
                    if (row.classList.contains('hidden')) {
                    // if (row.style.display === 'none') {
                        // row.style.display = '';
                        row.classList.remove('hidden');
                        row.classList.add('visible');
                    } else {
                        row.classList.add('hidden');
                        row.classList.remove('visible');
                        // row.style.display = 'none';
                    }
                });

                const icon = btn.querySelector('i');
                icon.classList.toggle('lni-angle-double-down');
                icon.classList.toggle('lni-angle-double-up');
            });
        });
    });
</script>
</body>

</html>
