@if(isset($data['ourServices']) && !empty($data['ourServices']) && isset($data['ourServices']->categoryDetail[0]))
<section id="services" class="services_area pt-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center pb-25">
                    <h5 class="sub_title">{{ $data['ourServices']->categoryDetail[0]->title }}</h5>
                    <h4 class="main_title">{{ $data['ourServices']->categoryDetail[0]->description }}</h4>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="single_services text-center mt-30 wow fadeIn business-card" data-wow-duration="0.5s" data-wow-delay="0.5s">
                    <div class="services_icon">
                        <i class="lni lni-mobile"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="94" height="92" viewBox="0 0 94 92">
                            <path class="services_shape" id="Polygon_12" data-name="Polygon 12" d="M42.212,2.315a11,11,0,0,1,9.576,0l28.138,13.6a11,11,0,0,1,5.938,7.465L92.83,54.018A11,11,0,0,1,90.717,63.3L71.22,87.842A11,11,0,0,1,62.607,92H31.393a11,11,0,0,1-8.613-4.158L3.283,63.3A11,11,0,0,1,1.17,54.018L8.136,23.383a11,11,0,0,1,5.938-7.465Z" />
                        </svg>
                    </div>
                    @if(isset($data['ourServices']->posts[0]) && isset($data['ourServices']->posts[0]->postDetail[0]))
                        <div class="services_content">
                            <h3 class="services_title"><a href="#">{{ $data['ourServices']->posts[0]->postDetail[0]->title }}</a></h3>
                            <p>{{ $data['ourServices']->posts[0]->postDetail[0]->description }}</p>
                        </div>
                    @endif
                </div> <!-- single services -->
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single_services text-center mt-30 wow fadeIn business-card" data-wow-duration="0.5s" data-wow-delay="1s">
                    <div class="services_icon">
                        <i class="lni lni-layout"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="94" height="92" viewBox="0 0 94 92">
                            <path class="services_shape" id="Polygon_12" data-name="Polygon 12" d="M42.212,2.315a11,11,0,0,1,9.576,0l28.138,13.6a11,11,0,0,1,5.938,7.465L92.83,54.018A11,11,0,0,1,90.717,63.3L71.22,87.842A11,11,0,0,1,62.607,92H31.393a11,11,0,0,1-8.613-4.158L3.283,63.3A11,11,0,0,1,1.17,54.018L8.136,23.383a11,11,0,0,1,5.938-7.465Z" />
                        </svg>
                    </div>
                    @if(isset($data['ourServices']->posts[1]) && isset($data['ourServices']->posts[1]->postDetail[0]))
                        <div class="services_content">
                            <h3 class="services_title"><a href="#">{{ $data['ourServices']->posts[1]->postDetail[0]->title }}</a></h3>
                            <p>{{ $data['ourServices']->posts[1]->postDetail[0]->description }}</p>
                        </div>
                    @endif
                </div> <!-- single services -->
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="single_services text-center mt-30 wow fadeIn business-card" data-wow-duration="0.5s" data-wow-delay="1.5s">
                    <div class="services_icon">
                        <i class="lni lni-layers"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="94" height="92" viewBox="0 0 94 92">
                            <path class="services_shape" id="Polygon_12" data-name="Polygon 12" d="M42.212,2.315a11,11,0,0,1,9.576,0l28.138,13.6a11,11,0,0,1,5.938,7.465L92.83,54.018A11,11,0,0,1,90.717,63.3L71.22,87.842A11,11,0,0,1,62.607,92H31.393a11,11,0,0,1-8.613-4.158L3.283,63.3A11,11,0,0,1,1.17,54.018L8.136,23.383a11,11,0,0,1,5.938-7.465Z" />
                        </svg>
                    </div>
                    @if(isset($data['ourServices']->posts[2]) && isset($data['ourServices']->posts[2]->postDetail[0]))
                        <div class="services_content">
                            <h3 class="services_title"><a href="#">{{ $data['ourServices']->posts[2]->postDetail[0]->title }}</a></h3>
                            <p>{{ $data['ourServices']->posts[2]->postDetail[0]->description }}</p>
                        </div>
                    @endif
                </div> <!-- single services -->
            </div>

        </div> <!-- row -->
    </div> <!-- container -->
</section>
@endif
