<footer class="padding-top-20px padding-bottom-20px background-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 sm-mb-30px">
                    <div class="logo margin-bottom-10px" style="color: white; font-size: 14px; font-weight: bold;"><img src="/assets/img/logo-small.png" alt="">Online-Recipes</div>
                    <div class="text-grey-2  font-weight-300">Checkout our wesite to know more recipes and subsripe to get new updates and adding your new recipes .</div>
                    <ul class="list-inline text-left margin-tb-20px margin-lr-0px text-white">
                        <li class="list-inline-item"><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
                        <li class="list-inline-item"><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li class="list-inline-item"><a class="google" href="#"><i class="fab fa-google-plus"></i></a></li>
                        <li class="list-inline-item"><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                    </ul>
                    <!-- // Social -->
                </div>



                <div class="col-lg-4  col-md-4 sm-mb-30px">
                    <ul class="footer-menu-2 row margin-0px padding-0px list-unstyled">
                        <li class="col-6  padding-tb-5px"><a href="{{url('/')}}" class="text-grey-2">Home</a></li>
                        <li class="col-6  padding-tb-5px"><a href="" class="text-grey-2">Categories</a></li>
                        <li class="col-6  padding-tb-5px"><a href="{{url('/user/recipes')}}" class="text-grey-2">Recipes</a></li>
                        @if(!auth()->guard('admin')->user())
                        <li class="col-6  padding-tb-5px"><a href="{{url('/recipe/add')}}" class="text-grey-2">Add Recipe</a></li>
                        @endif
                        <li class="col-6  padding-tb-5px"><a href="{{url('/about')}}" class="text-grey-2">About</a></li>
                        <li class="col-6  padding-tb-5px"><a href="{{url('/contact')}}" class="text-grey-2">Contact Us</a></li>
                        @if(!auth()->guard('admin')->user()&&!auth()->guard('user')->user())
                        <li class="col-6  padding-tb-5px"><a href="{{url('/about')}}" class="text-grey-2">Login</a></li>
                        <li class="col-6  padding-tb-5px"><a href="{{url('/contact')}}" class="text-grey-2"> Register</a></li>
                        @endif
                    </ul>
                </div>

                <div class="col-lg-4  col-md-4 sm-mb-30px">
                        

                        <div class="margin-bottom-30px background-main-color box-shadow border-radius-10">
                        <div class="padding-30px">
                            <form method="post" action="{{url('/user/subscribe')}}" id="subcribe_form">
                                {{csrf_field()}}
                            <div class="input-group mb-3 border-radius-10 overflow-hidden">
                                <input type="email" placeholder="Your email" name="email" required="" class="form-control border-radius-0 border-0">
                                <div class="input-group-append">
                                    <button onclick="document.getElementById('subcribe_form').submit();" class="btn btn-outline-secondary text-white background-dark border-0 border-radius-0" type="button">Subscribe</button>
                                </div>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>


    <div class="padding-tb-5px background-main-color">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="text-white margin-tb-15px text-center text-lg-left">
                        Recipes-Online | @2019 All copy rights reserved
                    </div>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline text-lg-right text-center margin-lr-0px margin-tb-15px text-white">
                        <li class="list-inline-item margin-lr-8px"><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item margin-lr-8px"><a class="facebook" href="#"><i class="fab fa-youtube"></i></a></li>
                        <li class="list-inline-item margin-lr-8px"><a class="facebook" href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li class="list-inline-item margin-lr-8px"><a class="facebook" href="#"><i class="fab fa-google-plus"></i></a></li>
                        <li class="list-inline-item margin-lr-8px"><a class="facebook" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item margin-lr-8px"><a class="rss" href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/jquery-3.2.1.min.js"></script>
    <script src="/assets/js/sticky-sidebar.js"></script>
    <script src="/assets/js/YouTubePopUp.jquery.js"></script>
    <script src="/assets/js/owl.carousel.min.js"></script>
    <script src="/assets/js/imagesloaded.min.js"></script>
    <script src="/assets/js/masonry.min.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/custom.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents p').length + 1;
        
        $('#addScnt').on('click', function() {
                $('<p><label><i class="far fa-list-alt margin-right-10px"></i> Recipe Ingredient ' + i +'</label><input type="text" id="p_scnt" size="20" name="p_scnt_' + i +'" value="" class="form-control form-control-sm" placeholder="Listing Title"></p>').appendTo(scntDiv);
                document.getElementById('p_scnt_no').value=i;
                i++;
                
                
                return false;
        });
        
});
    </script>
</body>

</html>
