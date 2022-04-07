@extends('layouts.master')

@section('content')

<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-left">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Recipe</li>
            </ol>
        </div>
    </div>


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
                <div class="margin-bottom-40px card border-0 box-shadow">
                    <div class="card-img-top"><a href="#"><img src="/assets/img/{{$recipe->img}}" style="width: 700px;" alt=""></a></div>
                    <div class="padding-lr-30px padding-tb-20px">
                        <h5 class="margin-bottom-20px margin-top-10px"><a class="text-dark" href="#">{{$recipe->name}}</a></h5>
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
                        <h3>Ingredients</h3>
                        <ul>
                             @foreach(App\Ingredient::where('recipe_id',$recipe->id)->get() as $ingred)
                                        <li>{{$ingred->content}}</li>
                                        @endforeach
                            
                            
                        </ul>
                        <h3>Method</h3>
                        <ol>
                            {{$recipe->method}}
                        </ol>
                        <hr>
                        <div class="row no-gutters">
                                @if(!auth()->guard('admin')->user()&&auth()->guard('user')->user()&&App\Recipe::where('user_id',auth()->guard('user')->user()->id)->where('id','=',$recipe->id)->get()->isEmpty())
                                <div class="col-4 text-left"><a href="{{url('/wishlist/add',['id'=>$recipe->id])}}" class="text-red"><i class="far fa-heart"></i> Save</a></div>
                                @endif
                                @if(!auth()->guard('admin')->user()&&!auth()->guard('user')->user())
                                <div class="col-4 text-left"><a href="{{url('/wishlist/add',['id'=>$recipe->id])}}" class="text-red"><i class="far fa-heart"></i> Save</a></div>
                                @endif
                                
                                <div class="col-8 text-right"><a href="#" class="text-grey-2"><i class="fas fa-users"></i> {{App\Wishlist::where('recipe_id',$recipe->id)->count()}} favourites</a></div>
                            </div>
                    </div>
                    <div class="background-light-grey border-top-1 border-grey padding-lr-30px padding-tb-20px">
                        <a href="{{url('/user/profile',['id'=>$recipe->user_id])}}" class="d-inline-block text-grey-3 h6 margin-bottom-0px margin-right-15px"><img src="/assets/img/{{App\User::find($recipe->user_id)->img}}" class="height-30px border-radius-30 margin-right-15px" alt=""> {{App\User::find($recipe->user_id)->name}}</a>
                    </div>
                </div>


                <div class="margin-bottom-40px box-shadow">
                    <div class="padding-30px background-white">
                        <h3><i class="far fa-star margin-right-10px text-main-color"></i> Review &amp; Rating</h3>
                        <hr>
                        @foreach(App\Review::where('recipe_id',$recipe->id)->get() as $review)
                        <ul class="commentlist padding-0px margin-0px list-unstyled text-grey-3">
                            <li class="border-bottom-1 border-grey-1 margin-bottom-20px">
                                <img src="/assets/img/{{$review->img}}" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="" style="width: 70px;">
                                <div class="margin-left-85px">
                                    <a class="d-inline-block text-dark text-medium margin-right-20px" href="#">{{$review->name}} </a>
                                    <span class="text-extra-small">Date :  <a href="#" class="text-main-color">{{$review->created_at}}</a></span>
                                    <div class="rating">
                                        
                                        <ul>
                                        <?php for ($i=0; $i < 5; $i++) {
                                             if($i<$review->rate){ ?> 
                                            <li class="active"></li>
                                            <?php }else{ ?>
                                            <li></li>
                                            <?php } } ?>
                                       </ul>

                                    </div>
                                    <p class="margin-top-15px text-grey-2">{{$review->comment}}. </p>
                                </div>
                            </li>
                        @endforeach    
                        </ul>

                    </div>
                </div>

                <div class="margin-bottom-80px box-shadow">
                    <div class="padding-30px background-white">
                        <h3><i class="far fa-star margin-right-10px text-main-color"></i> Add Review </h3>
                        <hr>
                        <form id="review_form" method="post" action="{{url('/review/add')}}">
                          {{csrf_field()}}
                          <input type="hidden" name="recipe_id" value="{{$recipe->id}}">
                          @if(!auth()->guard('user')->user()&&!auth()->guard('admin')->user())
                            <div class="form-row">
                                
                                <div class="form-group col-md-6">
                                    <label for="inputName"> Full Name :</label>
                                    <input  required="" class="form-control" name="name" id="inputName"  placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4"> Email :</label>
                                    <input type="email" required="" class="form-control" name="email" id="inputEmail4" placeholder="Email">
                                </div>
                            </div>
                            @endif
                            @if(auth()->guard('user')->user())
                            <input type="hidden" name="name" value="{{auth()->guard('user')->user()->name}}">
                            <input type="hidden" name="email" value="{{auth()->guard('user')->user()->email}}">
                            @endif
                            @if(auth()->guard('admin')->user())
                            <input type="hidden" name="name" value="{{auth()->guard('admin')->user()->name}}">
                            <input type="hidden" name="email" value="{{auth()->guard('admin')->user()->email}}">
                            @endif

                            <div class=" form-group col-md-6">
                                <label for="exampleFormControlTextarea1"> Rate :</label>
                                <select class="form-control form-control-sm" name="rate">
                                    <?php for ($i=5; $i >= 1; $i--) {?>
                                    <option value="{{$i}}">{{$i}}</option>
                                    <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1"> Comment :</label>
                                <textarea class="form-control" required="" name="comment" id="exampleFormControlTextarea1" rows="3" placeholder="Comment"></textarea>
                            </div>
                            <a onclick="document.getElementById('review_form').submit();" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase border-radius-10 padding-10px">Add Now !</a>
                        </form>
                    </div>
                </div>



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
                        <div class="padding-30px background-white border-radius-10">
                            <a href="#" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase border-radius-10 padding-10px" data-toggle="modal"  data-target="#v_recipe">View recipe video</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>




<div class="modal fade" id="v_recipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
          <iframe class="embed-responsive-item" src="{{$recipe->v_url}}" allowfullscreen></iframe>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center flex-column flex-md-row">
       

        </div>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>


      </div>

    </div>
    <!--/.Content-->

  </div>
</div>




@endsection