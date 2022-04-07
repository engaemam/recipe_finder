@extends('layouts.master')

@section('content')

    <div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-left">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">wishlist</li>
            </ol>
            <h1 class="font-weight-300">Recipes - wishlist</h1>
        </div>
    </div>


    <div class="container">
        <div class="margin-bottom-60px">
            <div class="listing-search box-shadow">
                <form class="row no-gutters" id="search_form" action="{{url('recipes/search')}}" method="post">
                                    {{csrf_field()}}
                                    <input  type="hidden" id="tcat" name="cat_id" value="0">
                                    <div class="col-md-4">
                                        <div class="keywords">
                                            <input class="listing-form first" name="keyword" type="text" placeholder="Keywords...">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="categories dropdown">
                                            <a class="listing-form d-block text-nowrap" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Categories</a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                 @foreach(App\Category::all() as $cat)
                                                  <button class="dropdown-item text-up-small" onclick="document.getElementById('dropdownMenu2').innerHTML='{{$cat->name}}';
                                                document.getElementById('tcat').value='{{$cat->id}}';" type="button">{{$cat->name}}</button>
                                                @endforeach
                                               
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <a onclick="document.getElementById('search_form').submit();" class="listing-bottom background-second-color box-shadow" href="#">Search Now</a>
                                    </div>
                                </form>
            </div>
        </div>
    </div>



    <div class="container margin-bottom-100px">

        <div class="row">

           


            @foreach($wishlist as $wish)
            <?php $recipe=App\Recipe::where('id',$wish->recipe_id)->first(); ?>
            <div class="col-lg-6 margin-bottom-30px">
                <div class="background-white thum-hover box-shadow hvr-float full-width">
                    <div class="float-md-left margin-right-30px thum-xs">

                        <img class="width-250px" src="/assets/img/{{$recipe->img}}" alt="">
                    </div>
                    <div class="padding-25px">
                         <?php $rate=App\Review::where('recipe_id',$recipe->id)->count()!=0?App\Review::where('recipe_id',$recipe->id)->sum('rate')/App\Review::where('recipe_id',$recipe->id)->count():0;?>
                            <div class="rating">
                                <ul>
                                    <?php for ($i=0; $i < 5; $i++) {
                                        if($i<$rate){ ?> 
                                        <li class="active"></li>
                                    <?php }else{ ?>
                                    <li></li>
                                    <?php } } ?>
                                </ul>
                            </div>
                        <h3><a href="{{url('/recipe/details',['id'=>$recipe->id])}}" class="d-block text-dark text-capitalize text-medium margin-tb-15px">{{$recipe->name}}</a></h3>
                        <hr>
                        <div class="row no-gutters">
                            
                            <div class="col-8 text-right"><a href="{{url('/recipe/details',['id'=>$recipe->id])}}" class="text-grey-2"><i class="fas fa-users"></i> {{App\Wishlist::where('recipe_id',$recipe->id)->count()}} servings</a></div>
                            <div class="background-light-grey border-top-1 border-grey padding-lr-30px padding-tb-20px">
                            <a href="{{url('/user/profile',['id'=>$recipe->user_id])}}" class="d-inline-block text-grey-3 h6 margin-bottom-0px margin-right-5px"><img src="/assets/img/{{App\User::find($recipe->user_id)->img}}" class="height-30px border-radius-30 margin-right-15px" alt=""> {{App\User::find($recipe->user_id)->name}}</a>
                        </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="text-center">
            <a href="{{url('/user/recipes')}}" class="btn box-shadow margin-top-50px padding-tb-10px btn-sm border-2 border-radius-30 btn-inline-block width-210px background-second-color text-white">Show All Recipes</a>
        </div>

    </div>

@endsection