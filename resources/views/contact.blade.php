@extends('layouts.master')

@section('content')

	<div class="map-distributors-in">
		<div id="map-distributors">

			<iframe src="https://maps.google.com/maps?q=jaddah&hl=es;z=14&amp;output=embed" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

		</div>
	</div>
	<!-- //  Map -->


	<!-- Page Output -->
	<section class="padding-tb-100px">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6">
					@if ($errors->any())
                    <div class=" alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> <i class="fa fa-exclamation-triangle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                 @endif
                 @if (session()->has('error'))
                         
                                <div class=" alert alert-warning">
                                    <i class="fa fa-exclamation-triangle"></i> {{session()->get('error')}}
                                </div>
                    @endif
                    @if (session()->has('success'))
                         
                                <div class=" alert alert-success">
                                    <i class="fa fa-check"></i> {{session()->get('success')}}
                                </div>
                    @endif
					<form method="post" id="send_message" action="{{url('/send/message')}}">
                          {{csrf_field()}}
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputName">Full Name</label>
								<input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
							</div>
							<div class="form-group col-md-6">
								<label for="inputEmail4">Email</label>
								<input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<label for="inputAddress">Subject</label>
							<input type="text" class="form-control" name="subject" id="inputAddress" placeholder="Subject">
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Message</label>
							<textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						<a href="#" onclick="document.getElementById('send_message').submit();" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px">Send</a>
					</form>
				</div>
				<div class="col-lg-6 col-md-6">
					<p>Checkout our wesite to know more recipes and subsripe to get new updates and adding your new recipes .</p>
					<h6>Phone :</h6>
					<span class="d-block"><i class="fa fa-phone text-main-color margin-right-10px" aria-hidden="true"></i> +222 333 019</span>
					<span class="d-block"><i class="fa fa-mobile text-main-color margin-right-10px" aria-hidden="true"></i> +01026220967</span>
					<h6 class="margin-top-20px">Address :</h6>
					<span class="d-block"><i class="fa fa-map text-main-color margin-right-10px" aria-hidden="true"></i> 234 ryadh, SA </span>
					<h6 class="margin-top-20px">Email :</h6>
					<span class="d-block"><i class="fa fa-envelope-open text-main-color margin-right-10px" aria-hidden="true"></i> online-recipes@gmail.com </span>
				</div>
			</div>
		</div>
	</section>
	<!-- // Page Output -->

@endsection