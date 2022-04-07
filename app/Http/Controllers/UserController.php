<?php

namespace App\Http\Controllers;
use App\Recipe;
use App\Ingredient;
use App\User;
use Illuminate\Http\Request;
use App\Admin;
use App\Wishlist;
use App\Review;
use App\Message;
use App\Subscribe;
use App\Mail\AdminResetPassword;
use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //

    public function login(){
        return view('customers.login');
    }

    public function add_recipe(){
    	return view('customers.add_recipe');
    }

    public function register(){
        return view('customers.register');

    }

    public function forget_password(){
        return view('customers.forget');

    }

    public function reset($token){
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            return view('customers.reset_password',['data'=>$check]);
        }
        else{
        	DB::table('password_resets')->where('email','mostafadeveloper2016@gmail.com')->delete();
           return view('customers.forget');  
        }

    }

    public function reset_final($token){
        $this->validate(request(),[
                'password'=>'required|confirmed'
        ]);
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            $user=User::where('email',$check->email)->update(['email'=>$check->email,'password'=>Hash::make(request('password'))]);
            DB::table('password_resets')->where('email',$check->email)->delete();
            if(auth()->guard('user')->attempt(['email'=>$check->email,'password'=>request('password')],false)){
            return redirect('/');
                }
        }else{
        	return back()->with(['error'=>'This email exceeds 2 hours ']);
        }

    }

    public function reset_request(Request $request){
        $user=User::where('email',$request->email)->first();
        if(!empty($user)){
            $token=app('auth.password.broker')->createToken($user);
            DB::table('password_resets')->insert(['email'=>$user->email,'token'=>$token,'created_at'=>Carbon::now()]);
            Mail::to($user->email)->send(new AdminResetPassword(['data'=>$user,'token'=>$token]));
            return back()->with(['success'=>'Reset password email sent successfully']);
        }
        return back()->with(['error'=>'This email does not exist']);
        
    }


    public function my_wishlist(){
        $wishlist=Wishlist::where('user_id',auth()->guard('user')->user()->id)->get();
        return view('customers.wishlist',compact(['wishlist']));
    }

    public function search(Request $request){
    	$key_words=$request->keyword;
    	$cat_id=$request->cat_id;
    	$sts=1;
    	if($request->cat_id==0){
            $recipes= DB::table('recipes')->where('admin_status',$sts)
     ->join('ingredients', 'ingredients.recipe_id', '=', 'recipes.id')
     ->select('recipes.*')
     ->where('content', 'like','%' . $key_words . '%')
     ->orWhere('method', 'like','%' . $key_words . '%')->distinct()
     
     ->get();

    		
    	}else{
    		
            $recipes= DB::table('recipes')->where('admin_status',$sts)
     ->join('ingredients', 'ingredients.recipe_id', '=', 'recipes.id')
     ->select('recipes.*')
     ->where('content', 'like','%' . $key_words . '%')
     ->orWhere('method', 'like','%' . $key_words . '%')->where('category_id',$cat_id)->distinct()
     
     ->get();

    	}
    	//dd($recipes->toSql(),$recipes->getBindings());
        
        return view('search',compact(['recipes']));
    }


   /* public function search(Request $request){
        $key_words=$request->keyword;
        $cat_id=$request->cat_id;
        $sts=1;
        if($request->cat_id==0){
            $recipes=Recipe::where('admin_status',$sts)->Where('method','like','%' . $key_words . '%')->Where('name','like','%' . $key_words. '%')->get();
        }else{
            $recipes=Recipe::where('category_id',$cat_id)->where('method','like','%' . $key_words. '%')->where('name','like','%' . $key_words. '%')->where('admin_status',$sts)->get();
        }
        //dd($recipes->toSql(),$recipes->getBindings());
        
        return view('search',compact(['recipes']));
    }*/

    public function by_category($id){

    		$recipes=Recipe::where('category_id',$id)->get();
    	 
        return view('search',compact(['recipes']));
    }


    public function history_recipes(){

    		$recipes=Recipe::where('user_id',auth()->guard('user')->user()->id)->get();
    	 
        return view('customers.history',compact(['recipes']));
    }
    

    public function recipes(){

    		$recipes=Recipe::where('admin_status',1)->paginate(3);
    	 
        return view('recipes',compact(['recipes']));
    }

    public function request_recipe(Request $request){
        $data=$this->validate(request(),[
            'method'=>'required',
            'name'=>'required',
            'v_url'=>'required',
            'key_words'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo',
                'name'=>'name',
            

        ]);
        $recipe=new Recipe();
        $recipe->name=$request->name;
        $recipe->method=$request->method;
        $recipe->category_id=$request->category_id;
        $recipe->key_words=$request->key_words;
        $recipe->v_url=$request->v_url;
        $recipe->user_id=auth()->guard('user')->user()->id;
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $recipe->img=$filename;
        if($recipe->save()){
        	for ($i=1; $i <=$request->p_scnt_no ; $i++) { 
        		$x=("p_scnt_$i");
        		$ingrdient=new Ingredient();
        		$ingrdient->content=$request->$x;
        		$ingrdient->recipe_id=$recipe->id;
        		$ingrdient->save();
        	}
        	return back()->with('success','Added successfully waiting admin approval');
        }
    }

        public function do_register(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
            'password'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo  ',
                'phone'=>'phone ',
                'name'=>' name',
                'address'=>'address',
                'email'=>' email ',
                'password'=>'password ',
            

        ]);

        $user=new User();
        $user->biography=$request->biography;
        $user->name=$request->name;
        $user->address=$request->address;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->password=Hash::make($request->password);
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $user->img=$filename;
        $user->save();
        return back()->with('success','Account registered successfully');
   
    }

    public function save_message(Request $request){

        $data=$this->validate(request(),[
            'name'=>'required',
            'subject'=>'required',
            'body'=>'required',
            'email'=>'required'],[
            ],[
                'name'=>'Name',
                'body'=>'Body',
                'email'=>'Email',
                'subject'=>'Subject',
        ]);
        $msg=new Message();
        $msg->name=$request->name;
        $msg->body=$request->body;
        $msg->email=$request->email;
        $msg->subject=$request->subject;
        $msg->save();
        return back()->with(['success'=>'Message sent successfully....']);
    }

    public function subscribe(Request $request){

        $data=$this->validate(request(),[
            'email'=>'required'],[
            ],[

                'email'=>'Email',
        ]);
        $subscribe=new Subscribe();
        $subscribe->email=$request->email;
        $subscribe->save();
        return back()->with(['success'=>'You subscribed our website successfully....']);
    }

    public function add_wishlist($id)
    {   
        $user_id=auth()->guard('user')->user()->id;
        $wish=Wishlist::where('user_id','=',$user_id)->where('recipe_id','=',$id)->get();
        if($wish->isNotEmpty()){
           return back()->with('error',' This recipe already in your wishlist');
        }else{
            $wishlist=new Wishlist();
            $wishlist->user_id=$user_id;
            $wishlist->recipe_id=$id;
            
            $wishlist->save();
             return back()->with('success',' Added to your wishlist successfully');

        }

    }

    public function add_review(Request $request){


    	$data=$this->validate(request(),[
            'name'=>'required',
            'recipe_id'=>'required',
            'email'=>'required',
            'rate'=>'required',
            'comment'=>'required'],[
            ],[
                'name'=>'Name',
                'rate'=>'Rate',
                'email'=>'Email',
                'comment'=>'Comment',
        ]);
       $img='user-img.jpg';
        if(auth()->guard('user')->user()){
        	$img=auth()->guard('user')->user()->img;
        }
        if(auth()->guard('admin')->user()){
        	$img=auth()->guard('admin')->user()->img;
        }
        $review=new Review();
        $review->img=$img;
        $review->name=$request->name;
        $review->comment=$request->comment;
        $review->email=$request->email;
        $review->rate=$request->rate;
        $review->recipe_id=$request->recipe_id;
        $review->save();
        return back()->with('success',' Your review added successfully');;
        
    }

    public function recipe($id){
        $recipe=Recipe::find($id);
        return view('recipe',compact(['recipe']));
    }

    public function user_profile($id){
        $profile=User::find($id);
        return view('customers.profile',compact(['profile']));
    }


    public function check_login(Request $request)
    {   
        $remmberme = $request->remmberme==1?true:false;
        if(auth()->guard('user')->attempt(['email'=>$request->email,'password'=>$request->password],$remmberme)){
            return redirect('/');
        }else{
            return back()->with(['error'=>'Please enter a valid email and password to login']);
        }
    }

    public function logout()
    {
        auth()->guard('user')->logout();
        return redirect('/user/login');

    }

    public function edit_profile(Request $request){
        $user= User::find($request->user_id);
        $user->name=$request->name;
        $user->Address=$request->address;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->biography=$request->biography;
        $user->password=Hash::make($request->password);
        $file=$request->file('img');
        if($file){
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $user->img=$filename;
        }
        
        $user->update();
        return back()->with('success','Your profile updated successfully');
   
    }
        
    

}
