<?php

namespace App\Http\Controllers;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
    	return view('home');
    }

    public function about(){
    	return view('about');
    }

    public function contact(){
    	return view('contact');
    }

    public function make_user(){

        $user=new User();
        $user->name='Hussin Abd-alh';
        $user->address='ryadh, Saudi Arabia';
        $user->email='hussin2018@gmail.com';
        $user->phone='0102456854';
        $user->biography='I’m a translator in PXL, CA with a passion for arts, sw engineering and embedded systems technology.';
        $user->password=Hash::make(111111);
        $user->img='user.png';
        $user->save();
   
    }

    public function make_admin(){

        $user=new Admin();
        $user->name='Hassan Mohamed';
        $user->address='Cairo, Egypt';
        $user->email='mostafamohmed59@gmail.com';
        $user->biography='I’m a driver in PXL, CA with a passion for transportation.';
        $user->password=Hash::make(111111);
        $user->img='user.png';
        $user->save();
   
    }
}
