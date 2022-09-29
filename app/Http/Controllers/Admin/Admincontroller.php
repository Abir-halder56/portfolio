<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use App\Models\User;

class Admincontroller extends Controller
{
    public function index(){
        return view("admin.dashboard");
    }
   
    public function login(Request $request){
        //echo $password = Hash::make('123456');die;
    	if ($request->isMethod('post')) {
    		$data = $request->all();
            // echo "<pre>"; print_r($data); die;
    		$rulse = [
    			'email' => 'required|email|max:255',
		        'password' => 'required',
    		];

    		$customMessage = [
    			'email.required' =>'Email is required',
    			'email.email' =>'Valid Email is password',
    			'password.required' =>'password is required',
    		];

    		$this->validate($request,$rulse,$customMessage);

            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
    			return redirect('admin/dashboard');
    		}else{
    			Session::flash('error_message','Invalide Email or Password');
    			return redirect()->back();
    		}
    	}
        return view("admin.login");
    }
    public function logout(){
        Auth::logout();
    	return redirect('/admin');
    }



	public function profile(Request $request){
		
        if ($request->isMethod('post')) {
            $data = $request->all();
			echo "<pre>"; print_r($data); die;

			//img
            if ($request->hasFile('img')) {
                $image_temp = $request->file('img');
                if ($image_temp->isValid()) {

                    $extention = $image_temp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extention;
                    $imagePath = 'backend/dist/img/'.$imageName;
                    Image::make($image_temp)->save($imagePath);
                }
            }
			// cv 
			if ($request->hasFile('cv')) {
                $image_temp = $request->file('cv');
                if ($image_temp->isValid()) {

                    $extention = $image_temp->getClientOriginalExtension();
                    $cvName = rand(111,99999).'.'.$extention;
                    $cvPath = 'backend/dist/img/'.$cvName;
                    Image::make($image_temp)->save($cvPath);
                }
            }



            User::where('email',Auth::user()->email)->update(['name'=>$data['name'],'age'=>$data['age'],'gender'=>$data['gender'],'language'=>$data['language'],'address'=>$data['address'],'freelance'=>$data['freelance'],'phone'=>$data['phone'],'cv'=>$cvName,'img'=>$imgName]);
            // Session::flash('success_message','Admin Details has been updated Successfully!');
            
            return redirect()->back();
        }
		return view("admin.profile");
	}
	
}
