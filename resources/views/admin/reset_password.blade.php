
@extends('layouts.master')

@section('content')
<div id="page-title" class="padding-tb-30px gradient-white text-center">
		<div class="container">
			<ol class="breadcrumb opacity-5">
				<li><a href="{{url('/')}}">Home</a></li>
				<li class="active">Reset password</li>
			</ol>
			<h1 class="font-weight-300">Reset password</h1>
		</div>
	</div>


	<div class="container margin-bottom-100px">
		
		<div id="log-in" class="site-form log-in-form box-shadow border-radius-10">
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
			<div class="form-output">
				<form  method="post">
					{{csrf_field()}}
					<div class="form-group label-floating">
						<label class="control-label">Your Email</label>
						<input class="form-control" name="email" value="{{$data->email}}" placeholder="" type="email">
					</div>
					<div class="form-group label-floating">
						<label class="control-label">Your Password</label>
						<input class="form-control" name="password" placeholder="" type="password">
					</div>
					<div class="form-group label-floating">
						<label class="control-label">Confirm Password</label>
						<input class="form-control" name="password_confirmation" placeholder="" type="password">
					</div>
					<button type="submit" class="btn btn-md btn-primary full-width">Reset Password</button>
				</form>
			</div>
		</div>

	</div>
@endsection