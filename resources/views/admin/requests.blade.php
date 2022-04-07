@extends('layouts.master')

@section('content')

    <div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-left">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">recipes</li>
            </ol>
            <h1 class="font-weight-300"> Pending Recipes</h1>
        </div>
    </div>
     
     <div class="margin-tb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
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

                    @foreach($recipes as $recipe)
                    <div class="blog-entry background-white border-1 border-grey-1 margin-bottom-35px box-shadow border-radius-10 overflow-hidden">
                        <div class="row no-gutters">
                            <div class="img-in col-lg-5"><a href="#"><img src="/assets/img/{{$recipe->img}}" style="height: 260px;" alt=""></a></div>
                            <div class="col-lg-7">
                                <div class="padding-lr-25px padding-tb-50px">
                                    <a class="d-block h4  text-capitalize margin-bottom-8px" href="{{url('/recipe/details',['id'=>$recipe->id])}}">{{$recipe->name}} </a>
                                    <div class="meta">
                                        <span class="margin-right-20px text-extra-small">By : <a href="{{url('/user/profile',['id'=>$recipe->user_id])}}" class="text-main-color">{{App\User::find($recipe->user_id)->name}}</a></span>
                                        <span class="margin-right-20px text-extra-small">Date :  <a href="{{url('/recipe/details',['id'=>$recipe->id])}}" class="text-main-color">{{$recipe->created_at}}</a></span>
                                        <span class="text-extra-small">Category :  <a href="{{url('/recipe/details',['id'=>$recipe->id])}}" class="text-main-color">{{App\Category::where('id',$recipe->category_id)->first()->name}}</a></span>
                                        <br>
                                        <span class="text-extra-small">Key Words :  <a href="{{url('/recipe/details',['id'=>$recipe->id])}}" class="text-main-color">{{$recipe->key_words}}</a></span>
                                        

                                    </div>
                                    <div  class="margin-top-40px margin-left-80px">
                                     <a href="{{url('/accept/request',['id'=>$recipe->id])}}" class="btn btn-success">Accept</a>
                                     <a href="{{url('/refuse/request',['id'=>$recipe->id])}}" class="btn btn-danger">Block</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach


                    

                </div>


                <div class="col-lg-4">

                   <div class="listing-search box-shadow background-main-color padding-30px margin-bottom-30px">
                    <form class="row no-gutters" id="search_form" action="{{url('recipes/search')}}" method="post">
                                    {{csrf_field()}}
                                    <input  type="hidden" id="tcat" name="cat_id" value="0">
                        <div class="col-md-12">
                            <div class="keywords">
                                <input class="listing-form first border-radius-10 margin-bottom-10px" name="key_word" type="text" placeholder="Keywords..." value="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="categories dropdown">
                                <a class="listing-form d-block text-nowrap border-radius-10 margin-bottom-10px" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Categories</a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    @foreach(App\Category::all() as $cat)
                                                  <button class="dropdown-item text-up-small" onclick="document.getElementById('dropdownMenu2').innerHTML='{{$cat->name}}';
                                                document.getElementById('tcat').value='{{$cat->id}}';" type="button">{{$cat->name}}</button>
                                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a onclick="document.getElementById('search_form').submit();" class="listing-bottom border-radius-10 background-second-color box-shadow" href="#">Search Now</a>
                        </div>
                    </form>

                </div>

                    <div class="widget widget_categories">
                        <div class="margin-bottom-30px">
                            <h4 class="padding-lr-30px padding-tb-20px background-white box-shadow border-radius-10"><i class="far fa-folder-open margin-right-10px text-main-color"></i> Categories</h4>
                            <div class="padding-30px padding-bottom-30px background-white border-radius-10">
                                <ul>
                                    @foreach(App\Category::all() as $cat)
                                    <li><a href="{{url('/recipes/cat',['id'=>$cat->id])}}">{{$cat->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>



@endsection