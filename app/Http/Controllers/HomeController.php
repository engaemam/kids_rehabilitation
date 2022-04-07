<?php

namespace App\Http\Controllers;
use App\Uparent;
use App\Sub;
use App\Admin;
use App\Institue;
use App\Program;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
    	$programs=Program::where('admin_status',1)->get()->take(3);
    	$institues=Institue::all()->take(3);
    	return view('home',compact(['programs','institues']));
    }

    public function about(){
    	return view('about');
    }

    public function program($id){
        $program=Program::find($id);
        return view('program',compact(['program']));
    }

    public function institue($id){
        $institue=Institue::find($id);
        return view('institue',compact(['institue']));
    }


    public function search(Request $request){
        $country=$request->country;
        $cat_id=$request->cat_id;
        $title=$request->title;
        $sts=1;
        if($request->cat_id==0){
            $programs=Program::where('admin_status',$sts)->Where('country','like','%' . $country . '%')->Where('title','like','%' . $title. '%')->get();
        }else{
            $programs=Program::where('category_id',$cat_id)->where('country','like','%' . $country. '%')->where('title','like','%' . $title. '%')->where('admin_status',$sts)->get();
        }
        
        return view('search',compact(['programs']));
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
        $msg->content=$request->body;
        $msg->email=$request->email;
        $msg->subject=$request->subject;
        $msg->save();
        return back()->with(['success'=>'Message sent successfully....']);
    }



    public function contact(){
    	return view('contact');
    }

    public function programs(){

            $programs=Program::where('admin_status',1)->paginate(6);
         
        return view('programs',compact(['programs']));
    }

    public function institues(){

        $institues=Institue::paginate(3);
         
        return view('institues',compact(['institues']));
    }

    public function by_category($id){

    		$programs=Program::where('category_id',$id)->get();
    	 
        return view('search',compact(['programs']));
    }

    public function make_user(){

        $user=new Sub();
        $user->name='Hossan Ibrahim';
        $user->address='Jaddah, Saudi Arabia';
        $user->email='hossam2019@gmail.com';
        $user->phone='0125555544';
        $user->gender='1';
        $user->country='KSA';
        $user->summary='I’m a 42 years old , my hobbies is playing clever games, reading more novels and swimming sport wih my friends in the club .';
        $user->password=Hash::make(111111);
        $user->save();
   
    }

    public function make_institue(){

        $user=new Institue();
        $user->name='Hetin institue';
        $user->address='Hetin, Saudi Arabia';
        $user->img='r3.jpg';
        $user->sub_id='3';
        $user->country='KSA';
        $user->summary='Our physical, occupational and speech therapy programs work closely with doctors, families and caregivers to ensure your child reaches their full potential.';
        $user->save();
   
    }

    
}
