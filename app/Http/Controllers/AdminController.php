<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Message;
use App\Admin;
use App\Institue;
use DB;
use App\Contact;
use Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
class AdminController extends Controller
{


    public function forget_password(){
        return view('admin.forget');

    }

    public function add_institue(){
        return view('admin.add_institue');

    }

    public function reset($token){
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            return view('admin.reset_password',['data'=>$check]);
        }
        else{
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
            Mail::to($user->email)->send(new AdminResetPassword(['data'=>$user,'token'=>$token]));
            return back()->with(['success'=>'Reset password email sent successfully']);
        }
        return back()->with(['error'=>'This email does not exist']);
        
    }

    public function messages(){
        $messages=Message::latest('created_at', 'admin_id')->where('admin_id',auth()->guard('admin')->user()->id)->where('to_status',1)->get();
        
        return view('admin.messages',compact(['messages']));

    }

    public function sent(){
        $messages=Message::latest('created_at', 'admin_id')->where('admin_id',auth()->guard('admin')->user()->id)->where('from_status',1)->get();
        return view('admin.sent',compact(['messages']));

    }

    public function reply_sub(Request $request){

        $data=$this->validate(request(),[
            'subject'=>'required',
            'body'=>'required',
            ],[
                'body'=>'Body',
                'subject'=>'Subject',
        ]);
        $msg=new Message();
        $msg->sub_id=$request->sub_id;
        $msg->body=$request->body;
        $msg->admin_id=auth()->guard('admin')->user()->id;
        $msg->from_status=1;
        $msg->to_status=2;
        $msg->subject=$request->subject;
        $msg->save();
        return back()->with(['success'=>'your Message sent successfully....']);
    }


    public function reply_parent(Request $request){

        $data=$this->validate(request(),[
            'subject'=>'required',
            'body'=>'required',
            ],[
                'body'=>'Body',
                'subject'=>'Subject',
        ]);
        $msg=new Message();
        $msg->parent_id=$request->parent_id;
        $msg->body=$request->body;
        $msg->admin_id=auth()->guard('admin')->user()->id;
        $msg->from_status=1;
        $msg->to_status=3;
        $msg->subject=$request->subject;
        $msg->save();
        return back()->with(['success'=>'your Message sent successfully....']);
    }



	public function edit_profile(Request $request){
        $admin= Admin::find($request->admin_id);
        $admin->name=$request->name;
        $admin->Address=$request->address;
        $admin->email=$request->email;
        $admin->summary=$request->summary;
        $admin->country=$request->country;
        $admin->phone=$request->phone;
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

    public function save_institue(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
             'address'=>'required',
            'country'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'name'=>'name',
            

        ]);
        $institue=new Institue();
        $institue->name=$request->name;
        $institue->country=$request->country;
        $institue->address=$request->address;
        $institue->sub_id=$request->sub_id;
        $institue->summary=$request->summary;
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $institue->img=$filename;
        $institue->save();
       
        	return back()->with('success','Institue Saved successfully ');
        
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

    


    public function contact(){

    	$messages=Contact::all();
        return view('admin.contact',compact(['messages']));
    }

 

    public function do_register(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
            'password'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'country'=>'required',
            'email'=>'required',
            'phone'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo  ',
                'name'=>' name',
                'address'=>'address',
                'email'=>' email ',
                'password'=>'password ',
                'phone'=>'phone ',
                'country'=>'country',
            

        ]);

        $admin=new Admin();
        $admin->summary=$request->summary;
        $admin->name=$request->name;
        $admin->address=$request->address;
        $admin->phone=$request->phone;
        $admin->country=$request->country;
        $admin->gender=$request->gender;
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



    public function profile(){
        $profile=Admin::find(auth()->guard('admin')->user()->id);
        return view('admin.profile',compact(['profile']));
    }
}
