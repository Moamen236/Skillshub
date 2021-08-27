@extends('web.layout');

@section('title')
    Contact
@endsection

@section('main')

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/page-background.jpg') }})"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="{{ url('/') }}">{{ __('web.home') }}</a></li>
							<li>{{ __('web.contact') }}</li>
						</ul>
						<h1 class="white-text">{{ __('web.sec_contact_title') }}</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- contact form -->
					<div class="col-md-6">
						<div class="contact-form">
							<h4>{{ __('web.sec_contact_send_msg') }}</h4>
                            {{-- @include('web.inc.messages') --}}
                            @include('web.inc.messages-ajax')
							<form id="contact-form"> <!--method="POST" action="{{ url('contact/message/send') }}"-->
                                @csrf
								<input class="input" type="text" name="name" placeholder="Name">
								<input class="input" type="email" name="email" placeholder="Email">
								<input class="input" type="text" name="subject" placeholder="Subject">
								<textarea class="input" name="body" placeholder="Enter your Message"></textarea>
								<button id="contact-form-btn" type="submit" class="main-button icon-button pull-right">{{ __('web.sec_contact_send') }}</button>
							</form>
						</div>
					</div>
					<!-- /contact form -->

					<!-- contact information -->
					<div class="col-md-5 col-md-offset-1">
						<h4>{{ __('web.sec_contact_info') }}</h4>
						<ul class="contact-details">
							<li><i class="fa fa-envelope"></i>{{ $setting->email }}</li>
							<li><i class="fa fa-phone"></i>{{ $setting->phone }}</li>
						</ul>

					</div>
					<!-- contact information -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->

        @section('scripts')
            <script>
                $('#success').hide()
                $('#error').hide()
                $('#contact-form-btn').click(function(e){
                    $('#success').hide()
                    $('#error').hide()
                    $('#success').empty()
                    $('#error').empty()
                    e.preventDefault();
                    let form_data = new FormData($('#contact-form')[0]);

                    $.ajax({
                        type: "POST", 
                        url: "{{ url('contact/message/send') }}", 
                        data: form_data,
                        contentType : false,
                        processData : false,
                        success : function(data){
                            $('#success').show()
                            $('#success').text(data.success)
                        },
                        error : function(xhr , status , error){
                            $('#error').show()
                            $.each(xhr.responseJSON.errors , function(key , item){
                                $('#error').append("<p>" + item + "</p>")
                            })
                        }
                    })
                })
            </script>
        @endsection

@endsection