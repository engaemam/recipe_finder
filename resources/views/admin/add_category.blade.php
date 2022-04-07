@extends('layouts.master')

@section('content')

<div id="page-title" class="padding-tb-10px gradient-white">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active"><a href="">Add category</a></li>
            </ol>
            <h1 class="font-weight-300">Add category</h1>
        </div>
    </div>

    <div class="container">
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

        <div class="col-sm-6 col-sm-offset-3" style="margin-left: 250px;">
        <div class="margin-tb-30px full-width">
            <h4 class="padding-lr-30px padding-tb-20px background-white box-shadow border-radius-10"><i class="far fa-list-alt margin-right-10px text-main-color"></i>Category Informations</h4>
            <div class="padding-30px padding-bottom-30px background-white border-radius-10">
                <form action="{{url('/category/save')}}" method="post" id="cat_form" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group margin-bottom-20px ">
                        <label><i class="far fa-list-alt margin-right-10px"></i> Category Title</label>
                        <input type="text" required="" class="form-control form-control-sm" name="name" id="ListingTitle" placeholder="Listing Title">
                    </div>

                    
                <div class="row">
                    
                <div class="col-md-6 margin-bottom-20px">
                <label><i class="far fa-images margin-right-10px"></i> Image:</label>
              <span class="btn btn-danger btn-file" style="margin-bottom: 10px;">
              <i class="fa fa-image"></i>select Photo<input type="file" name="img" style=" opacity:0; height: 10px; width: 50px;">
              </span>
                    </div>
                </div>
            </div>
        </div>
        <a onclick="document.getElementById('cat_form').submit();" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase border-radius-10 padding-10px margin-bottom-20px">Add category !</a>

                </form>
            </div>
        </div>


        

    </div>

</div>


@endsection