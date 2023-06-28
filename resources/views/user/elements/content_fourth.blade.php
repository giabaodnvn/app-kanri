@if(isset($data['blog']) && !empty($data['blog']) && isset($data['blog']->categoryDetail[0]))
<section id="blog" class="blog_area pt-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center pb-25">
                    <h5 class="sub_title">{{ $data['blog']->categoryDetail[0]->title }}</h5>
                    <h4 class="main_title">{{ $data['blog']->categoryDetail[0]->description }}</h4>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row justify-content-center">
            @php
                $countAlwaysShow = (count($data['blogAlwaysShow']->posts) <= 3) ? count($data['blogAlwaysShow']->posts) : 3;
            @endphp
            @for($i = 0; $i < $countAlwaysShow; $i++)
                <div class="col-lg-4 col-md-7">
                    <div class="single_blog mt-30 wow fadeIn business-card" data-wow-duration="0.5s" data-wow-delay="0.6s">
                        <div class="blog_image">
                            <img src="{{ $data['blogAlwaysShow']->posts[$i]->thumbnail ? assetStorage($data['blogAlwaysShow']->posts[$i]->thumbnail) : ""}}">
                        </div>
                        <div class="blog_content">
                            <ul class="blog_meta d-flex justify-content-between">
                                <li>By: <a href="#">{{ $data['blogAlwaysShow']->posts[$i]->user->username }}</a></li>
                                <li>{{ ($data['blogAlwaysShow']->posts[$i]->created_at)->format('Y/m/d') }}</li>
                            </ul>
                            <h3 class="blog_title"><a href="{{ $data['blogAlwaysShow']->posts[$i]->link }}" target="_blank">{{ $data['blogAlwaysShow']->posts[$i]->postDetail[0]->title }}</a></h3>
                            <a href="{{ $data['blogAlwaysShow']->posts[$i]->link }}" target="_blank" class="more">{!! trans('onepage.read_more') !!}</a>
                        </div>
                    </div> <!-- row -->
                </div>
            @endfor
            @for($i = 0; $i < (3 - $countAlwaysShow); $i++)
                @if(isset($data['blog']->posts[$i]) && isset($data['blog']->posts[$i]->postDetail[0]))
                    <div class="col-lg-4 col-md-7">
                        <div class="single_blog mt-30 wow fadeIn business-card" data-wow-duration="0.5s" data-wow-delay="0.6s">
                            <div class="blog_image">
                                <img src="{{ $data['blog']->posts[$i]->thumbnail ? assetStorage($data['blog']->posts[$i]->thumbnail) : ""}}">
                            </div>
                            <div class="blog_content">
                                <ul class="blog_meta d-flex justify-content-between">
                                    <li>By: <a href="#">{{ $data['blog']->posts[$i]->user->username }}</a></li>
                                    <li>{{ ($data['blog']->posts[$i]->created_at)->format('Y/m/d') }}</li>
                                </ul>
                                <h3 class="blog_title"><a href="{{ $data['blog']->posts[$i]->link }}" target="_blank">{{ $data['blog']->posts[$i]->postDetail[0]->title }}</a></h3>
                                <a href="{{ $data['blog']->posts[$i]->link }}" target="_blank" class="more">{!! trans('onepage.read_more') !!}</a>
                            </div>
                        </div> <!-- row -->
                    </div>
                @endif
            @endfor
        </div> <!-- row -->
    </div> <!-- container -->
</section>
@endif
