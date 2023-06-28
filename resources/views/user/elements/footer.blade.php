<footer id="footer" class="footer_area mt-115">
    <div class="container">
        <div class="footer_widget pt-70 pb-120">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6">
                    <div class="footer_about mt-50">
                        <div class="footer_logo">
                            <a href="#" class="logo"><img src="{{ asset('static/img/user/nta-logo-white.png') }}" alt=""></a>
                        </div>
                        <div class="footer_content">

                        </div>
                    </div> <!-- footer about -->
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="footer_link_wrapper d-flex flex-wrap">
                        <div class="footer_link mt-50">
                            <h2 class="footer_title">{!! trans('onepage.quick_links') !!}</h2>
                            <ul class="link">
                                <li><a href="#">{!! trans('onepage.company') !!}</a></li>
                                <li><a href="#">{!! trans('onepage.privacy_policy') !!}</a></li>
                                <li><a href="#">{!! trans('onepage.about') !!}</a></li>
                            </ul>
                        </div> <!-- footer link -->
                        <div class="footer_link mt-50">
                            <h2 class="footer_title">{!! trans('onepage.resources') !!}</h2>
                            <ul class="link">
                                <li><a href="#">{!! trans('onepage.support') !!}</a></li>
                                <li><a href="#">{!! trans('onepage.contact') !!}</a></li>
                                <li><a href="#">{!! trans('onepage.terms') !!}</a></li>
                            </ul>
                        </div> <!-- footer link -->
                    </div> <!-- footer link wrapper -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer_subscribe mt-50">
                        <h2 class="footer_title">{!! trans('onepage.newsletter') !!}</h2>
                        <div class="subscribe_form text-right">
                            <form action="#">
                                <input type="text" placeholder="{!! trans('onepage.enter_email') !!}">
                                <button class="main-btn">{!! trans('onepage.subscribe') !!}</button>
                            </form>
                        </div>
                    </div> <!-- footer subscribe -->
                </div>
            </div> <!-- row -->
        </div> <!-- footer widget -->
        <div class="footer_copyright d-sm-flex justify-content-between">
            <div class="footer_social text-center">
                <ul class="social">
                    <li><a href="https://www.facebook.com/nitrotechasia" target="_blank"><i class="lni lni-facebook-filled"></i></a></li>
                    <li><a href="#" target="_blank"><i class="lni lni-twitter-filled"></i></a></li>
                    <li><a href="#" target="_blank"><i class="lni lni-instagram-original"></i></a></li>
                    <li><a href="#" target="_blank"><i class="lni lni-linkedin-original"></i></a></li>
                </ul>
            </div> <!-- footer social -->
            <div class="footer_copyright_content  text-center">
                <p>Nitro Tech Asia Inc</p>
            </div> <!-- footer copyright content -->
        </div> <!-- footer copyright -->
    </div> <!-- container -->
</footer>
