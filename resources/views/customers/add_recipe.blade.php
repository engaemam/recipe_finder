@extends('layouts.master')

@section('content')

<div id="page-title" class="padding-tb-10px gradient-white">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active"><a href="">Add Recipe</a></li>
            </ol>
            <h1 class="font-weight-300">Add Recipe</h1>
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

        <div class="margin-tb-30px full-width">
            <h4 class="padding-lr-30px padding-tb-20px background-white box-shadow border-radius-10"><i class="far fa-list-alt margin-right-10px text-main-color"></i>Recipe Informations</h4>
            <div class="padding-30px padding-bottom-30px background-white border-radius-10">
                <form action="{{url('/recipe/save')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" id="p_scnt_no" value="1" name="p_scnt_no" >
                    <div class="form-group margin-bottom-20px">
                        <label><i class="far fa-list-alt margin-right-10px"></i> Recipe Title</label>
                        <input type="text" required="" class="form-control form-control-sm" name="name" id="ListingTitle" placeholder="Listing Title">
                    </div>

                    <div class="form-group margin-bottom-20px" id="p_scents">
                        <p>
                        <label><i class="far fa-list-alt margin-right-10px"></i> Recipe Ingredient</label>
                        <input type="text" required="" id="p_scnt" name="p_scnt_1" class="form-control form-control-sm"  placeholder="Listing Title">
                    </p>
                    </div>
                    <a href="#" id="addScnt" class="btn box-shadow margin-top-50px padding-tb-10px btn-sm border-2 border-radius-30 btn-inline-block width-210px background-dark text-white">Add Ingredient</a>

                    <div class="form-group margin-bottom-20px">
                        <div class="row">
                            <div class="col-md-6">
                                <label><i class="far fa-folder-open margin-right-10px"></i> Category</label>
                                <select class="form-control form-control-sm" name="category_id">
                                    @foreach(App\Category::all() as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group margin-bottom-20px">
                                    <label><i class="far fa-flag margin-right-10px"></i> Keywords</label>
                                    <input type="text" name="key_words" class="form-control form-control-sm" id="ListingKeywords" placeholder="Keywords">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="margin-bottom-45px full-width">
            <h4 class="padding-lr-30px padding-tb-20px background-white box-shadow border-radius-10"><i class="far fa-list-alt margin-right-10px text-main-color"></i>Description</h4>
            <div class="padding-30px padding-bottom-30px background-white border-radius-10">
                <div class="margin-bottom-20px">
                    <textarea class="form-control" required="" name="method" placeholder="Html Tag Enabled" name="details" id="exampleTextarea" rows="8"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="fas fa-video margin-right-10px"></i> Video URL</label>
                        <input type="text" name="v_url" required="" class="form-control form-control-sm" placeholder="http://www./">
                    </div>
                    <div class="col-md-6 margin-bottom-20px">
                        <label><i class="far fa-images margin-right-10px"></i> Image</label>
              <span class="btn btn-danger btn-file" style="margin-bottom: 10px;">
              <i class="fa fa-image"></i>select Photo<input type="file" name="img" style=" opacity:0; height: 10px; width: 50px;">
              </span>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-lg border-2  ba-1 text-white margin-bottom-80px btn-block border-radius-15 padding-15px box-shadow" value="Add Recipe">

                </form>
            </div>
        </div>

        

    </div>




@endsection