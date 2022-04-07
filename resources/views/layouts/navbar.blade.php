
    <header class="background-main-color">
        <div class="container">
            <div class="header-output">
                <div class="header-in">

                    <div class="row">
                        <div class="col-lg-2 col-md-12">
                            <a id="logo" href="{{url('/')}}" class="d-inline-block margin-tb-5px" style="color: white; font-size: 14px; font-weight: bold;"><img src="/assets/img/logo-small.png" alt="">Online-Recipes</a>
                            <a class="mobile-toggle padding-13px background-main-color" href="{{url('/')}}"><i class="fas fa-bars"></i></a>
                        </div>
                        <div class="col-lg-8 col-md-12 position-inherit">
                            <ul id="menu-main" class="white-link dropdown-dark text-lg-center nav-menu link-padding-tb-17px">
                                <li><a href="{{url('/')}}">Home</a></li>
                                <li><a href="{{url('/user/recipes')}}">Recipes</a> </li>
                                @if(!auth()->guard('admin')->user())
                                <li class="has-dropdown"><a href="">Categories</a>
                                 
                                
                                    <ul class="sub-menu text-left">
                                        @foreach(App\Category::all() as $cat)
                                        <li><a href="{{url('/recipes/cat',['id'=>$cat->id])}}">{{$cat->name}} </a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                            @if(auth()->guard('admin')->user())
                            <li><a href="{{url('/admin/requests')}}"> Requests  </a></li>
                            <li><a href="{{url('/category/add')}}"> Add category  </a></li>
                            <li><a href="{{url('/admin/messages')}}"> Messages  </a></li>
                            @endif
                                

                            @if(!auth()->guard('admin')->user())
                            <li><a href="{{url('/contact')}}"> Contact Us </a></li>
                            @endif
                                <li><a href="{{url('/about')}}">About</a></li>
                                @if(auth()->guard('user')->user())
                                <li class="has-dropdown"><a href="#"> <img src="/assets/img/{{auth()->guard('user')->user()->img}}" class="height-30px border-radius-30 margin-right-15px" alt="">{{auth()->guard('user')->user()->name}}<span class="caret"></span></a>
                                    <ul class="sub-menu text-left">
                                          <li><a href="{{url('/user/wishlist')}}"> My Wishlist </a></li>
                                          <li><a href="{{url('/history/recipes')}}"> My Recipes </a></li>
                                          <li><a href="{{url('/user/profile',['id'=>auth()->guard('user')->user()->id])}}"> My Profile  </a></li>
                                          <li><a href="{{url('/user/logout')}}"> Logout  </a></li>
                                    </ul>
                                </li>
                               @endif 
                               @if(auth()->guard('admin')->user())
                                <li class="has-dropdown"><a href="#"> <img src="/assets/img/{{auth()->guard('admin')->user()->img}}" class="height-30px border-radius-30 margin-right-15px" alt="">
                               {{auth()->guard('admin')->user()->name}} </a><span class="caret"></span>
                                    <ul class="sub-menu text-left">
                                          <li><a href="{{url('/admin/profile',['id'=>auth()->guard('admin')->user()->id])}}"> My Profile  </a></li>
                                          <li><a href="{{url('/admin/logout')}}"> Logout  </a></li>
                                    </ul>
                                </li>
                               @endif
                                 
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-12">
                            <hr class="margin-bottom-0px d-block d-sm-none">
                            @if(!auth()->guard('admin')->user())
                            <a href="{{url('/recipe/add')}}" class="text-white ba-2 box-shadow float-right padding-lr-23px padding-tb-15px text-extra-large"><i class="fas fa-plus"></i></a>
                            @endif
                            @if(!auth()->guard('admin')->user()&&!auth()->guard('user')->user())
                            <a href="{{url('/user/login')}}" class="text-white ba-1 box-shadow float-right padding-lr-23px padding-tb-15px text-extra-large"><i class="far fa-user"></i></a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- // Header  -->