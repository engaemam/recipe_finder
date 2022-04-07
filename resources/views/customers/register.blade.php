
@extends('layouts.master')

@section('content')
<div id="page-title" class="padding-tb-30px gradient-white text-center">
		<div class="container">
			<ol class="breadcrumb opacity-5">
				<li><a href="{{url('/')}}">Home</a></li>
				<li class="active">Sign up</li>
			</ol>
			<h1 class="font-weight-300">Sign up</h1>
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
		      @if (session()->has('success'))
		    
		            <div class="alert alert-success">
		              
		                <i class="fa fa-check-circle-o"></i> {{session()->get('success')}}
		              
		          </div>
		    @endif
			<div class="form-output">
				<form action="{{url('/user/doregister')}}" method="post"  enctype="multipart/form-data">
					{{csrf_field()}}
					<div class="form-group label-floating">
						<label class="control-label">Your Name</label>
						<input class="form-control" value="{{old('name')}}" required="" name="name" placeholder="" type="text">
					</div>
					<div class="form-group label-floating">
						<label class="control-label">Your Email</label>
						<input class="form-control" value="{{old('email')}}" required="" name="email" placeholder="" type="email">
					</div>
					<div class="form-group label-floating">
						<label class="control-label">Your Password</label>
						<input class="form-control" value="{{old('password')}}" required="" name="password" placeholder="" type="password">
					</div>

					<div class="form-group label-floating">
						<label class="control-label">Your Address</label>
						<input class="form-control" value="{{old('address')}}" required="" name="address" placeholder="" type="text">
					</div>
					<div class="form-group label-floating">
						<label class="control-label">Your Phone</label>
						<input class="form-control" value="{{old('phone')}}" required="" name="phone" placeholder="" type="text">
					</div>
					<div class="form-group label-floating">
					<label class="control-label">Your Biography</label>
					<textarea class="form-control"  required="" name="biography" placeholder="write your bio..." name="biography" id="exampleTextarea" style="height: 250px;">{{old('method')}}</textarea>
				   </div>
				   <div class="form-group label-floating">
                        <label><i class="far fa-images margin-right-10px"></i> Image </label>
			              <span class="btn btn-danger btn-file" style="margin-bottom: 10px;">
			              <i class="fa fa-image"></i>Select Photo<input type="file" name="img" style=" opacity:0; height: 10px; width: 50px;">
			              </span>
                    </div>

					<button type="submit" class="btn btn-md btn-primary full-width">Register</button>

					
				</form>
			</div>
		</div>
		<!--======= // log_in_page =======-->

	</div>
@endsection