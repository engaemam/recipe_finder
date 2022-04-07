
@extends('layouts.master')

@section('content')
@include('layouts.carousel')

  


    <div class="background-light-grey">
        <div class="container padding-top-100px">
            @if (session()->has('error'))
                    <div class=" alert alert-warning">
                        
                           
                                 <i class="fa fa-exclamation-triangle"></i> {{session()->get('error')}}
                            
                    </div>
              @endif
              @if (session()->has('success'))
            
                    <div class="alert alert-success">
                      
                        <i class="fa fa-check-circle-o"></i> {{session()->get('success')}}
                      
                  </div>
            @endif
            <div class="row">

                @foreach(App\Category::all() as $cat)
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 sm-mb-25px margin-left-20px">
                    <a href="{{url('/recipes/cat',['id'=>$cat->id])}}" class="d-block box-shadow background-main-color text-white hvr-float">
                        <div class="thum"><img src="/assets/img/{{$cat->img}}" alt=""></div>
                        <h4 class="text-center padding-15px">{{$cat->name}}</h4>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>


    <section class="padding-tb-25px background-light-grey">
        <div class="container">
            <div class="title text-center">
                <h2 class="font-weight-700 text-main-color">Latest Recipes</h2>
                <div class="row justify-content-center margin-bottom-45px">
                    <div class="col-md-7">

                        <p class="text-grey-2">Checkout our wesite to know more recipes and subsripe to get new updates and adding your new recipes .</p>
                    </div>
                </div>
            </div>

            <div class="recipes-masonry">

                @foreach(App\Recipe::where('admin_status',1)->get() as $recipe)
                <div class="col-xl-4 col-lg-4 col-md-6 recipe-item margin-bottom-40px">
                    <div class="card border-0 box-shadow">
                        <div class="card-img-top"><a href="{{url('/recipe/details',['id'=>$recipe->id])}}"><img src="/assets/img/{{$recipe->img}}" style="height: 250px; width:350px;" alt=""></a></div>
                        <div class="padding-lr-30px padding-tb-20px">
                            <h5 class="margin-bottom-20px margin-top-10px"><a class="text-dark" href="#">{{$recipe->name}} </a></h5>
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
                            <hr>
                            <div class="row no-gutters">
                                @if(!auth()->guard('admin')->user()&&auth()->guard('user')->user()&&App\Recipe::where('user_id',auth()->guard('user')->user()->id)->where('id','=',$recipe->id)->get()->isEmpty())
                                <div class="col-4 text-left"><a href="{{url('/wishlist/add',['id'=>$recipe->id])}}" class="text-red"><i class="far fa-heart"></i> Save</a></div>
                                @endif
                                @if(!auth()->guard('admin')->user()&&!auth()->guard('user')->user())
                                <div class="col-4 text-left"><a href="{{url('/wishlist/add',['id'=>$recipe->id])}}" class="text-red"><i class="far fa-heart"></i> Save</a></div>
                                @endif
                                
                                <div class="col-8 text-right"><a href="{{url('/recipe/details',['id'=>$recipe->id])}}" class="text-grey-2"><i class="fas fa-users"></i> {{App\Wishlist::where('recipe_id',$recipe->id)->count()}} favourites</a></div>
                            </div>
                        </div>
                        <div class="background-light-grey border-top-1 border-grey padding-lr-30px padding-tb-20px">
                            <a href="{{url('/user/profile',['id'=>$recipe->user_id])}}" class="d-inline-block text-grey-3 h6 margin-bottom-0px margin-right-15px"><img src="/assets/img/{{App\User::find($recipe->user_id)->img}}" class="height-30px border-radius-30 margin-right-15px" alt=""> {{App\User::find($recipe->user_id)->name}}</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- // Recipe Item -->



            </div>
            <div class="text-center">
                <a href="{{url('/user/recipes')}}" class="btn box-shadow margin-top-10px padding-tb-10px btn-sm border-2 border-radius-30 btn-inline-block width-210px background-second-color text-white">Show All Recipes</a>
            </div>
        </div>
        <!-- // container -->
    </section>


@endsection