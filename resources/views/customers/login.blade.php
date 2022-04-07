
@extends('layouts.master')

@section('content')
<div id="page-title" class="padding-tb-30px gradient-white text-center">
		<div class="container">
			<ol class="breadcrumb opacity-5">
				<li><a href="{{url('/')}}">Home</a></li>
				<li class="active">login</li>
			</ol>
			<h1 class="font-weight-300">Login</h1>
		</div>
	</div>


	<div class="container margin-bottom-100px">
		
		<div id="log-in" class="site-form log-in-form box-shadow border-radius-10">
			@if (session()->has('error'))
                         
                                <div class=" alert alert-warning">
                                  
                                    
                                  
                                    <i class="fa fa-exclamation-triangle"></i> {{session()->get('error')}}
                                  
                                </div>
                        @endif
			<div class="form-output">
				<form action="{{url('check/user')}}" method="post">
					{{csrf_field()}}
					<div class="form-group label-floating">
						<label class="control-label">Your Email</label>
						<input class="form-control" name="email" placeholder="" type="email">
					</div>
					<div class="form-group label-floating">
						<label class="control-label">Your Password</label>
						<input class="form-control" name="password" placeholder="" type="password">
					</div>

					<div class="remember">
						<div class="checkbox">
							<label><input name="remmberme"  type="checkbox">Remember Me</label>
						</div>
						<a href="{{url('forget/password')}}" class="forgot">Forgot my Password</a>
					</div>

					<button type="submit" class="btn btn-md btn-primary full-width">Login</button>

				

					<p>Don't you have an account? <a href="{{url('/user/register')}}">Register Now!</a> </p>
				</form>
			</div>
		</div>
		<!--======= // log_in_page =======-->

	</div>
@endsection