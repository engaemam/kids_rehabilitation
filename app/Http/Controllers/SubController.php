<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\program;
use App\Sub;
use App\Admin;
use App\Book;
use App\Institue;
use App\Message;
use App\Mail\SubResetPassword;
use DB;
use Mail;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class SubController extends Controller
{
    
    public function save_program(Request $request){
        $data=$this->validate(request(),[
            'title'=>'required',
            'price'=>'required',
            'description'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo',
                'title'=>'Title',
                'description'=>'Description'
            

        ]);
        $program=new Program();
        $program->title=$request->title;
        $program->description=$request->description;
        $program->category_id=$request->category_id;
        $program->price=$request->price;
        $program->admin_status=1;
        $program->sub_id=auth()->guard('sub')->user()->id;
        $file = $request->file('img');
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $program->img=$filename;
        $program->save();
            
            return back()->with('success','Added successfully waiting admin approval');
        
    }

    public function programs(){

            $programs=Program::where('sub_id',auth()->guard('sub')->user()->id)->get();
         
        return view('sub.programs',compact(['programs']));
    }

    public function bookings(){

            $bookings=Book::where('admin_status',0)->get();
         
        return view('sub.requests',compact(['bookings']));
    }

    public function login(){
        return view('sub.login');
    }

    public function add_program(){
        return view('sub.add_program');
    }

    public function register(){
        return view('sub.register');

    }

    public function forget_password(){
        return view('sub.forget');

    }

    public function reset($token){
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            return view('sub.reset_password',['data'=>$check]);
        }
        else{
            DB::table('password_resets')->where('email','mostafadeveloper2016@gmail.com')->delete();
           return view('sub.forget');  
        }

    }

    public function reset_final($token){
        $this->validate(request(),[
                'password'=>'required|confirmed'
        ]);
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            $user=Sub::where('email',$check->email)->update(['email'=>$check->email,'password'=>Hash::make(request('password'))]);
            DB::table('password_resets')->where('email',$check->email)->delete();
            if(auth()->guard('sub')->attempt(['email'=>$check->email,'password'=>request('password')],false)){
            return redirect('/');
                }
        }else{
            return back()->with(['error'=>'This email exceeds 2 hours ']);
        }

    }

    public function reset_request(Request $request){
        $user=Sub::where('email',$request->email)->first();
        if(!empty($user)){
            $token=app('auth.password.broker')->createToken($user);
            DB::table('password_resets')->insert(['email'=>$user->email,'token'=>$token,'created_at'=>Carbon::now()]);
            Mail::to($user->email)->send(new SubResetPassword(['data'=>$user,'token'=>$token]));
            return back()->with(['success'=>'Reset password email sent successfully']);
        }
        return back()->with(['error'=>'This email does not exist']);
        
    }

    
        public function do_register(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
            'password'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'country'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo  ',
                'phone'=>'phone ',
                'name'=>' name',
                'address'=>'address',
                'email'=>' email ',
                'password'=>'password ',
                'country'=>'country ',
            

        ]);

        $user=new Sub();
        $user->summary=$request->summary;
        $user->name=$request->name;
        $user->address=$request->address;
        $user->country=$request->country;
        $user->gender=$request->gender;
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

    
    
    public function profile(){
        $profile=Sub::find(auth()->guard('sub')->user()->id);
        return view('sub.profile',compact(['profile']));
    }

    

    public function sub_profile($id){
        $profile=Sub::find($id);
        return view('sub.profile',compact(['profile']));
    }

    public function institue(){
        $institue=Institue::find(auth()->guard('sub')->user()->id);
        return view('sub.institue',compact(['institue']));
    }


    public function check_login(Request $request)
    {   
        $remmberme = $request->remmberme==1?true:false;
        if(auth()->guard('sub')->attempt(['email'=>$request->email,'password'=>$request->password],$remmberme)){
            return redirect('/');
        }else{
            return back()->with(['error'=>'Please enter a valid email and password to login']);
        }
    }

    public function logout()
    {
        auth()->guard('sub')->logout();
        return redirect('/sub/login');

    }

    public function edit_profile(Request $request){
        $user= Sub::find($request->sub_id);
        $user->name=$request->name;
        $user->address=$request->address;
        $user->country=$request->country;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->summary=$request->summary;
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

    public function edit_institue(Request $request){
        $institue= Institue::find($request->institue_id);
        $institue->name=$request->name;
        $institue->address=$request->address;
        $institue->country=$request->country;
        $institue->summary=$request->summary;
        $file=$request->file('img');
        if($file){
        $filename = time() . '.' . $file->getClientOriginalName();
        $path = 'assets/img';
        $file->move($path, $filename);
        $institue->img=$filename;
        }
        
        $institue->update();
        return back()->with('success','Your Institue information updated successfully');
   
    }

    public function messages(){
        $messages=Message::latest('created_at', 'sub_id')->where('sub_id',auth()->guard('sub')->user()->id)->where('to_status',2)->get();
        
        return view('sub.messages',compact(['messages']));

    }

    public function sent(){
        $messages=Message::latest('created_at', 'sub_id')->where('sub_id',auth()->guard('sub')->user()->id)->where('from_status',2)->get();
        return view('sub.sent',compact(['messages']));

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
        $msg->sub_id=auth()->guard('sub')->user()->id;
        $msg->from_status=2;
        $msg->to_status=3;
        $msg->subject=$request->subject;
        $msg->save();
        return back()->with(['success'=>'your Message sent successfully....']);
    }


    public function reply_admin(Request $request){

        $data=$this->validate(request(),[
            'subject'=>'required',
            'body'=>'required',
            ],[
                'body'=>'Body',
                'subject'=>'Subject',
        ]);
        $msg=new Message();
        $msg->admin_id=$request->admin_id;
        $msg->body=$request->body;
        $msg->sub_id=auth()->guard('sub')->user()->id;
        $msg->from_status=2;
        $msg->to_status=1;
        $msg->subject=$request->subject;
        $msg->save();
        return back()->with(['success'=>'your Message sent successfully....']);
    }


     public function accept_request($id){
        $book=Book::find($id);
        $book->admin_status=1;
        $book->save();

        return back()->with('success','Book Request Accepted successfully');

    }

    public function refuse_request($id){
        $book=Book::find($id);
        $book->admin_status=2;
        $book->save();
        return back()->with('success','Refused successfully');

    }

}
