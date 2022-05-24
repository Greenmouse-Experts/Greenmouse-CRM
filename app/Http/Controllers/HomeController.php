<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Property;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $downlines = User::latest()->where('referral_code', Auth::user()->referrer_code)->get();
        $totalDownlines = User::latest()->where('referral_code', Auth::user()->referrer_code)->take(5)->get();
        
        return view('dashboard.home',[
            'downlines' => $downlines,
            'totalDownlines' => $totalDownlines
        ]);
    }

    public function downlines() {
        $downlines = User::latest()->where('referral_code', Auth::user()->referrer_code)->get();
        

        return view('dashboard.downlines',[
            'downlines' => $downlines
        ]);
    }

    public function referral() {
        return view('dashboard.referral');
    }


    public function properties() {
        $properties = Property::latest()->get();

        return view('dashboard.properties',[
            'properties' => $properties
        ]);
    }

    public function view_property($id) {
        $Finder = Crypt::decrypt($id);

        $property = Property::findorfail($Finder);

        return view('dashboard.view_property',[
            'property' => $property
        ]);
    }

    public function account() {
        return view('dashboard.account');
    }

    public function update_user($id, Request $request) {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
        ]);

        $userFinder = Crypt::decrypt($id);

        $user = User::findorfail($userFinder);
        
        $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
        ]); 

        return back()->with([
            'type' => 'success',
            'message' => 'Updated Successfully!'
        ]); 
    }

    public function change_password_user($id, Request $request) {
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userFinder = Crypt::decrypt($id);

        $user = User::findorfail($userFinder);
        
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Password Updated Successfully!'
        ]); 
    }
}