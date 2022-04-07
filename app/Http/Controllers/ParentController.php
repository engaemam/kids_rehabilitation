<?php

namespace App\Http\Controllers;
use App\program;
use App\Uparent;
use Illuminate\Http\Request;
use App\Admin;
use App\Comment;
use App\Message;
use App\Contact;
use App\Mail\ParentResetPassword;
use DB;
use Mail;
use URL;
use App\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class ParentController extends Controller
{
    //

    public function login(){
        return view('parents.login');
    }

    public function register(){
        return view('parents.register');

    }

    public function forget_password(){
        return view('parents.forget');

    }

    public function reset($token){
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            return view('parents.reset_password',['data'=>$check]);
        }
        else{
            DB::table('password_resets')->where('email','mostafadeveloper2016@gmail.com')->delete();
           return view('parents.forget');  
        }

    }

    public function reset_final($token){
        $this->validate(request(),[
                'password'=>'required|confirmed'
        ]);
        $check=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
        if(!empty($check)){
            $user=Uparent::where('email',$check->email)->update(['email'=>$check->email,'password'=>Hash::make(request('password'))]);
            DB::table('password_resets')->where('email',$check->email)->delete();
            if(auth()->guard('parent')->attempt(['email'=>$check->email,'password'=>request('password')],false)){
            return redirect('/');
                }
        }else{
            return back()->with(['error'=>'This email exceeds 2 hours ']);
        }

    }

    public function reset_request(Request $request){
        $user=Uparent::where('email',$request->email)->first();
        if(!empty($user)){
            $token=app('auth.password.broker')->createToken($user);
            DB::table('password_resets')->insert(['email'=>$user->email,'token'=>$token,'created_at'=>Carbon::now()]);
            Mail::to($user->email)->send(new UparentResetPassword(['data'=>$user,'token'=>$token]));
            return back()->with(['success'=>'Reset password email sent successfully']);
        }
        return back()->with(['error'=>'This email does not exist']);
        
    }

    public function messages(){
        $messages=Message::latest('created_at', 'parent_id')->where('parent_id',auth()->guard('parent')->user()->id)->where('to_status',3)->get();
        
        return view('parents.messages',compact(['messages']));

    }

    public function sent(){
        $messages=Message::latest('created_at', 'parent_id')->where('parent_id',auth()->guard('parent')->user()->id)->where('from_status',3)->get();
        return view('parents.sent',compact(['messages']));

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
        $msg->parent_id=auth()->guard('parent')->user()->id;
        $msg->from_status=3;
        $msg->to_status=2;
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
        $msg->parent_id=auth()->guard('parent')->user()->id;
        $msg->from_status=3;
        $msg->to_status=1;
        $msg->subject=$request->subject;
        $msg->save();
        return back()->with(['success'=>'your Message sent successfully....']);
    }


    public function bookings(){

            $programs=Book::where('parent_id',auth()->guard('parent')->user()->id)->get();
         
        return view('parents.bookings',compact(['programs']));
    }


    public function book($id)
    {   
        $parent_id=auth()->guard('parent')->user()->id;
        $book=Book::where('parent_id','=',$parent_id)->where('program_id','=',$id)->get();
        if($book->isNotEmpty()){
           return back()->with('error',' You Booked This Program Before');
        }else{
            $b=new Book();
            $b->program_id=$id;
            $b->parent_id=$parent_id;
            $b->save();
             return back()->with('success',' You booked this Course successfully');

        }

    }

    public function profile(){
        $profile=Uparent::find(auth()->guard('parent')->user()->id);
        return view('parents.profile',compact(['profile']));
    }
    

        public function do_register(Request $request){
        $data=$this->validate(request(),[
            'name'=>'required',
            'password'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'country'=>'required',
            'age'=>'required',
             'img'=>'required|image|mimes:jpeg,png,jpg,gif,svg',],[
            ],[
                'img'=>'photo  ',
                'phone'=>'phone ',
                'name'=>' name',
                'address'=>'address',
                'email'=>' email ',
                'password'=>'password ',
                'age'=>'age ',
                'country'=>'country ',
            

        ]);

        $user=new Uparent();
        $user->summary=$request->summary;
        $user->name=$request->name;
        $user->address=$request->address;
        $user->country=$request->country;
        $user->gender=$request->gender;
        $user->age=$request->age;
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

    
    
    

    public function add_comment(Request $request){


        $data=$this->validate(request(),[
            'program_id'=>'required',
            'comment'=>'required'],[
            ],[
                'comment'=>'Comment',
        ]);
       
        $comment=new Comment();
        $comment->parent_id=auth()->guard('parent')->user()->id;
        $comment->program_id=$request->program_id;
        $comment->comment=$request->comment;
        $comment->rate=$request->rate;
        $comment->save();
        return back()->with('success',' Your comment added successfully');;
        
    }



    public function parent_profile($id){
        $profile=Uparent::find($id);
        return view('parents.profile',compact(['profile']));
    }


    public function check_login(Request $request)
    {   
        $remmberme = $request->remmberme==1?true:false;
        if(auth()->guard('parent')->attempt(['email'=>$request->email,'password'=>$request->password],$remmberme)){
            return redirect('/');
        }else{
            return back()->with(['error'=>'Please enter a valid email and password to login']);
        }
    }

    public function logout()
    {
        auth()->guard('parent')->logout();
        return redirect('/parent/login');

    }

    public function send_message(Request $request){

        $data=$this->validate(request(),[
            'name'=>'required',
            'body'=>'required',
            'email'=>'required'],[
            ],[
                'name'=>'Name',
                'body'=>'Body',
                'email'=>'Email',
        ]);
        $msg=new Contact();
        $msg->name=$request->name;
        $msg->body=$request->body;
        $msg->email=$request->email;
        $msg->save();
        return back()->with(['success'=>'Message sent successfully....']);
    }


    public function edit_profile(Request $request){
        $user= Uparent::find($request->parent_id);
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
        
    

}
