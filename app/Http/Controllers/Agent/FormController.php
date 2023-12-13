<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Property;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class FormController extends Controller
{
    public function create(){
        return view('auth.register');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $this->validate($request,[
            'fname' => [ 'string', ],
            'lname' => [ 'string', ],
            'email' => ['string', 'email', 'unique:users','max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_type' =>['required'],

        ]);

        // dd($request->all());
        $user = new User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->role_id = $request->role_type;
        $user->password = Hash::make($request['password']);
        $user->save();

        $user_id = $user->id;

        $client = new Client;
        $client->user_id = $user_id;
        $client->save();

        Auth::login($user);
        return redirect('/');

    }
    public function dashboard(){

        $user = Auth::user();
        $prop = Property::where('user_id', $user->id)->count();
        $fav = DB::table('favorite_prop')
                ->join('users', 'users.id', '=', 'favorite_prop.user_id')
                ->join('properties', 'properties.id', '=', 'favorite_prop.property_id')
                ->select('properties.status', 'users.id')->where('properties.status', 1)->where('users.id', $user->id)->count();

        $props = Report::where('client_id', $user->id)->count();

        $favs = DB::table('favorite_prop')->where('user_id', $user->id)->whereDate('created_at', Carbon::today())->count();

        $properties = Property::select('properties.proj_name','properties.stat_view')->where('user_id', $user->id)->get();
        // dd($properties);

        return view('agent.index', compact('prop', 'fav', 'props', 'favs', 'properties'));
    }

    public function contact(){
        return view('agent.contact');
    }
    public function sendMessage(Request $request){

        $request->validate([
            'email'=> 'required', 'email',
            'subject' => 'required',
            'name' => 'required',
            'content' => 'required'

        ]);

        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'content' => $request->content
        ];
        Mail::send('email', $data, function($message) use ($data){
            // $message->from($data['email'])->subject($data['subject']);

            $message->from('jomilendelatorre@gmail.com')->subject('Concern from FindProperty User');
        });
        return back()->with(['message' => 'Email successfully sent!']);

        // Mail::send('email', $data, function($message) use ($data){
        //     $message->to($data['email'])->subject($data['subject']);
        // });
        // return back()->with(['message' => 'Email successfully sent!']);
    }
    public function request(Request $request, $id){

        $user = Auth::find($id);

        $request->validate([
            'message' => 'required',
        ]);

        $data = [
            'email' => $user->email,
            'message' => $request->message,
        ];
    }
}
