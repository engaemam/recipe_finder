<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Message;
use App\Admin;
use App\Category;
use App\Subscribe;
use App\User;
use DB;
use Mail;
use App\Mail\RecipeUpdate;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminsResetPassword;
use Carbon\Carbon;
class AdminController extends Controller
{


    public function forget_password(){
        return view('admin.forget');

    }

    public function reset($token){
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            return view('admin.reset_password',['data'=>$check]);
        }
        else{
           // DB::table('password_resets')->where('email','mostafadeveloper2016@gmail.com')->delete();
           return view('admin.forget');  
        }

    }

    public function reset_final($token){
        $this->validate(request(),[
                'password'=>'required|confirmed'
        ]);
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            $user=Admin::where('email',$check->email)->update(['email'=>$check->email,'password'=>Hash::make(request('password'))]);
            DB::table('password_resets')->where('email',$check->email)->delete();
            if(auth()->guard('admin')->attempt(['email'=>$check->email,'password'=>request('password')],false)){
            return redirect('/');
                }
        }else{
            return back()->with(['error'=>'This email exceeds 2 hours ']);
        }

    }

    public function reset_request(Request $request){
        $user=Admin::where('email',$request->email)->first();
        if(!empty($user)){
            $token=app('auth.password.broker')->createToken($user);
            DB::table('password_resets')->insert(['email'=>$user->email,'token'=>$token,'created_at'=>Carbon::now()]);
            Mail::to($user->email)->send(new AdminsResetPassword(['data'=>$user,'token'=>$token]));
            return back()->with(['success'=>'Reset password email sent successfully']);
        }
        return back()->with(['error'=>'This email does not exist']);
        
    }


	public function edit_profile(Request $request){
        $admin= Admin::find($request->admin_id);
        $admin->name=$request->name;
        $admin->Address=$request->address;
        $admin->email=$request->email;
        $admin->biography=$request->biography;
        $admin->password=Hash::make($request->password);
        $file=$request->file('img');
        if($file){
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $admin->img=$filename;
        }
        
        $admin->update();
        return back()->with('success','Your profile updated successfully');
   
    }

    public function save_category(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo',
                'name'=>'name',
            

        ]);
        $category=new Category();
        $category->name=$request->name;
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $category->img=$filename;
        $category->save();
       
        	return back()->with('success','Category added successfully ');
        
    }
    public function add_category(){
        return view('admin.add_category');
    }
    

    public function login(){
        return view('admin.login');
    }

    public function register(){
        return view('admin.register');
    }


    public function check_login(Request $request)
    {   
        $remmberme = $request->remmberme==1?true:false;
        if(auth()->guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$remmberme)){
            return redirect('/');
        }else{
            return back()->with(['error'=>'please enter a valid email and password to login']);
        }
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/admin/login');

    }

    
    public function requests(){
    	$recipes=Recipe::where('admin_status',0)->get();
        return view('admin.requests',compact(['recipes']));
    }

    public function messages(){

    	$messages=Message::all();
        return view('admin.messages',compact(['messages']));
    }

    public function accept_request($id){
        $recipe=Recipe::find($id);
        $recipe->admin_status=1;
        $recipe->save();
        $valueArray = [
            'method' => $recipe->method,
            'user_name' => User::find($recipe->user_id)->name,
            'name'=>$recipe->name,
            'cat'=>Category::find($recipe->category_id)->name,
            'recipe_id'=>$recipe->id,

        ];
        $subscribers=Subscribe::all();
        foreach ($subscribers as $subscriber) {
        	Mail::to($subscriber->email)->send(new RecipeUpdate($valueArray));
        }
          
   
        return back()->with('success','Accepted successfully and mails sent to subscribers');

    }

    public function do_register(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
            'password'=>'required',
            'address'=>'required',
            'email'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo  ',
                'name'=>' name',
                'address'=>'address',
                'email'=>' email ',
                'password'=>'password ',
            

        ]);

        $admin=new Admin();
        $admin->biography=$request->biography;
        $admin->name=$request->name;
        $admin->address=$request->address;
        $admin->email=$request->email;
        $admin->password=Hash::make($request->password);
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $admin->img=$filename;
        $admin->save();
        return back()->with('success','Admin registered successfully');
   
    }

    public function refuse_request($id){
        $recipe=Recipe::find($id);
        $recipe->admin_status=2;
        $recipe->save();
        return back()->with('success','Refused successfully');

    }

    public function profile($id){
        $profile=Admin::find($id);
        return view('admin.profile',compact(['profile']));
    }
}
