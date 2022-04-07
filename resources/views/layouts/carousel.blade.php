    <div class="banner padding-tb-20px" style="height: 450px;">
        <div class="container">

            <div class=" z-index-2 position-relative">
                <div class="text-center">
                    <h1 class="text-white pull-l icon-large font-weight-500 margin-bottom-40px">+20,000</h1>
                    <h3 class="text-white icon-large font-weight-100">Cooking Recipes</h3>
                </div>
                <div class="margin-top-45px">
                    <div class="row justify-content-center margin-tb-60px">
                        <div class="col-lg-8">
                            <div class="listing-search">
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
                </div>
            </div>
        </div>
        <!-- //container  -->
        <video autoplay loop id="video-background" muted plays-inline>
        <source src="assets/img/video.qt" type="video/mp4">
    </video>

    </div>