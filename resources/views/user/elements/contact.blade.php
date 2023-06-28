<section id="contact" class="contact_area pt-115">
    <div class="contact_image d-flex align-items-center justify-content-end">
        <div class="image">
            <img class="wow fadeInLeftBig" data-wow-duration="2s" data-wow-delay="0.4s" src="{{ asset('static/img/user/contact.svg') }}" alt="about">
        </div>
    </div> <!-- about image -->

    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-6">
                <div class="contact_wrapper mt-45 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.9s">
                    <div class="section_title pb-15">
                        <h5 class="sub_title">{!! trans('onepage.contact') !!}</h5>
                        <h4 class="main_title">{!! trans('onepage.get_in_touch') !!}</h4>

                    </div> <!-- section title -->

                    <div class="contact_form">
                        <form id="contact-form" action="{{ route('admin.contacts.contacts-store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input name="name" type="text" placeholder="{!! trans('onepage.name') !!}" required>
                                        @if($errors->has('name'))
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                        @endif
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input name="email" type="email" placeholder="{!! trans('onepage.email') !!}" required>
                                        @if($errors->has('email'))
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                        @endif
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="single_form">
                                        <input name="subject" type="text" placeholder="{!! trans('onepage.subject') !!}" required>
                                        @if($errors->has('subject'))
                                            <small class="text-danger">{{ $errors->first('subject') }}</small>
                                        @endif
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="single_form">
                                        <textarea name="content" placeholder="{!! trans('onepage.content') !!}" required></textarea>
                                        @if($errors->has('content'))
                                            <small class="text-danger">{{ $errors->first('content') }}</small>
                                        @endif
                                    </div> <!-- single form -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="single_form">
                                        <button class="main-btn">{!! trans('onepage.submit') !!}</button>
                                    </div> <!-- single form -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- contact form -->
                </div> <!-- contact wrapper -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>
