@extends('web.layout')
@section('title')
    Home
@endsection
@section('main')
    
    <!-- Home -->
    <div id="home" class="hero-area">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/home-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="home-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="white-text">{{__('web.sec_banner_title')}}</h1>
                        <p class="lead white-text">{{__('web.sec_banner_text')}}</p>
                        <a class="main-button icon-button" href="#">{{__('web.sec_banner_btn')}}</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Home -->

    <!-- Courses -->
    <div id="courses" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="section-header text-center">
                    <h2>{{__('web.sec_exams_title')}}</h2>
                    <p class="lead">{{__('web.sec_exams_text')}}</p>
                </div>
            </div>
            <!-- /row -->

            <!-- courses -->
            <div id="courses-wrapper">

                <!-- row -->
                <div class="row">

                    @foreach($categories as $category)
                        <!-- single course -->
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="course">
                                <a href="{{ url("categories/show/{$category->id}") }}" class="course-img">
                                    <img src="{{ asset("uploads/exams/exam$category->id.jpg") }}" alt="">
                                    <i class="course-link-icon fa fa-link"></i>
                                </a>
                                <a class="course-title" href="{{ url("categories/show/{$category->id}") }}">{{ $category->description }}</a>
                                <div class="course-details">
                                    <span class="course-category">{{ $category->name() }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- /single course -->
                    @endforeach

                </div>
            </div>
            <!-- /courses -->

            <div class="row">
                <div class="center-btn">
                    <a class="main-button icon-button" href="#">{{__('web.sec_exams_btn')}}</a>
                </div>
            </div>

        </div>
        <!-- container -->

    </div>
    <!-- /Courses -->



    <!-- Contact CTA -->
    <div id="contact-cta" class="section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/cta.jpg') }})"></div>
        <!-- Backgound Image -->

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="white-text">{{__('web.sec_contact_title')}}</h2>
                    <p class="lead white-text">{{__('web.sec_contact_text')}}.</p>
                    <a class="main-button icon-button" href="contact.html">{{__('web.sec_contact_btn')}}}}</a>
                </div>

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact CTA -->


@endsection