<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CallBooking;
use App\Models\CustomerManagement;
use App\Models\Property;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Mail;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
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

    public function index() {
        $staffs = User::latest()->where('user_type', 'Staff')->get();
        $agents = User::latest()->where('user_type', 'Agent')->get();
        $users = User::latest()->take(10)->where('user_type', '!=', 'Administrator')->get();

        return view('admin.dashboard', [
            'agents' => $agents,
            'staffs' => $staffs,
            'users' => $users
        ]);
    }

    public function agents() {
        $agents = User::latest()->where('user_type', 'Agent')->get();

        return view('admin.agents', [
            'agents' => $agents
        ]);
    }

    public function staffs() {
        $staffs = User::latest()->where('user_type', 'Staff')->get();

        return view('admin.staffs', [
            'staffs' => $staffs
        ]);
    }

    public function add_user(Request $request) {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric'],
        ]);

        if ($request->user_type == 'Agent') {
            $user = User::create([
                'referrer_code' => 'RHA-'.$this->referrer_id(5),
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type, 
            ]);

            /** Store information to include in mail in $data as an array */
            $data = array(
                'referral_link' => $user->referral_link,
                'referrer_code' => $user->referrer_code,
                'name' => request()->name,
                'email' => request()->email,
                'phone_number' => request()->phone_number,
                'password' => request()->password,
                'user' => request()->email,
            );
            /** Send message to the admin */
            Mail::send('emails.welcome', $data, function ($m) use ($data) {
                $m->to($data['user'])->subject('Welcome To Reftop Homes');
            });

            return back()->with([
                'type' => 'success',
                'message' => 'Agent Registered Successfully'
            ]);
        } elseif($request->user_type == 'Staff') {
            $user = User::create([
                'referrer_code' => 'RHS-'.$this->referrer_id(5),
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'user_type' => $request->user_type, 
            ]);

            /** Store information to include in mail in $data as an array */
            $data = array(
                'referral_link' => $user->referral_link,
                'referrer_code' => $user->referrer_code,
                'name' => request()->name,
                'email' => request()->email,
                'phone_number' => request()->phone_number,
                'password' => request()->password,
                'user' => request()->email,
            );
            /** Send message to the admin */
            Mail::send('emails.welcome', $data, function ($m) use ($data) {
                $m->to($data['user'])->subject('Welcome To Reftop Homes');
            });

            return back()->with([
                'type' => 'success',
                'message' => 'Staff Registered Successfully'
            ]);
        } else {
            return back()->with([
                'type' => 'danger',
                'message' => 'Unauthorized User Registration'
            ]);
        }
        
    }

    function referrer_id($input, $strength = 5) {
        $input = '0123456789';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return $random_string;
    }

    public function edit_user($id, Request $request) {
        $this->validate($request, [
            'name' => ['string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric'],
        ]);

        $userFinder = Crypt::decrypt($id);

        $user = User::findorfail($userFinder);

        $user->name = $request->name;
        // $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => 'User Updated Successfully'
        ]);
    }

    public function delete_user($id) {
        $userFinder = Crypt::decrypt($id);

        User::findorfail($userFinder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Account Deleted Successfully!'
        ]); 
    }

    public function downlines_user($id) {
        $userFinder = Crypt::decrypt($id);

        $user = User::findorfail($userFinder);

        $downlines = User::latest()->where('referral_code', $user->referrer_code)->get();

        return view('admin.downlines',[
            'downlines' => $downlines
        ]);
    }

    public function account() {
        return view('admin.account');
    }

    public function change_password($id, Request $request) {
        $this->validate($request, [
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userFinder = Crypt::decrypt($id);

        $user = User::findorfail($userFinder);
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Password Updated Successfully!'
        ]); 
    }

    public function call_bookings() {
        $call_bookings = CallBooking::latest()->get();

        return view('admin.call_bookings',[
            'call_bookings' => $call_bookings
        ]);
    }

    public function add_call_bookings(Request $request) {
        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'how_do_you_know_about_us' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string'],
        ]);

        CallBooking::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'how_do_you_know_about_us' => $request->how_do_you_know_about_us,
            'comment' => $request->comment, 
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Call Booking Added Successfully'
        ]);

    }

    public function delete_call_bookings($id) {
        $Finder = Crypt::decrypt($id);

        CallBooking::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Call Booking Deleted Successfully!'
        ]); 
    }

    public function edit_call_bookings($id, Request $request) {
        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'how_do_you_know_about_us' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string'],
        ]);
        
        $Finder = Crypt::decrypt($id);

        $callBooking = CallBooking::findorfail($Finder);

        $callBooking->first_name = $request->first_name;
        $callBooking->last_name = $request->last_name;
        $callBooking->phone_number = $request->phone_number;
        $callBooking->email = $request->email;
        $callBooking->how_do_you_know_about_us = $request->how_do_you_know_about_us;
        $callBooking->comment = $request->comment; 
        $callBooking->save();

        return back()->with([
            'type' => 'success',
            'message' => 'Call Booking Updated Successfully'
        ]);

    }

    public function properties() {
        $properties = Property::latest()->get();

        return view('admin.properties',[
            'properties' => $properties
        ]);
    }

    public function property() {
        return view('admin.add_property');
    }

    public function add_property(Request $request) {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'per_sqm' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'payment_plans' => ['required', 'string'],
            'features' => ['required', 'string'],
            'features' => ['required', 'string'],
            'images.*' => 'required|mimes:jpeg,png,jpg',
        ]);

        // Making counting of uploaded images
        $file_count = count($request->images);


        // start count how many uploaded
        if ($file_count > 6) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upload should not be more than 5!'
            ]); 
        }

        if (request()->hasFile('images')) {
            foreach ($request->images as $image) {
                $filename = $image->getClientOriginalName();
                $image->storeAs('property_images', $filename, 'public');
                $propertyimages[]=$filename;
            }

            Property::create([
                'user_id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone_number' => Auth::user()->phone_number,
                'title' => $request->title,
                'location' => $request->location, 
                'description' => $request->description,
                'per_sqm' => $request->per_sqm,
                'price' => $request->price,
                'payment_plans' => $request->payment_plans,
                'features' => $request->features,
                'images' => implode(",",$propertyimages)
            ]);

            return redirect()->route('properties')->with([
                'type' => 'success',
                'message' => 'Property Added Successfully!'
            ]);
        }
    }

    public function view_property($id) {
        $Finder = Crypt::decrypt($id);

        $property = Property::findorfail($Finder);

        return view('admin.view_property',[
            'property' => $property
        ]);
    }

    public function update_property($id, Request $request) {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'per_sqm' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'payment_plans' => ['required', 'string'],
            'features' => ['required', 'string'],
            'features' => ['required', 'string'],
            'images.*' => 'required|mimes:jpeg,png,jpg',
        ]);

        $Finder = Crypt::decrypt($id);

        $property = Property::findorfail($Finder);

        // Making counting of uploaded images
        $file_count = count($request->images);


        // start count how many uploaded
        if ($file_count > 6) {
            return back()->with([
                'type' => 'danger',
                'message' => 'Upload should not be more than 5!'
            ]); 
        }

        if (request()->hasFile('images')) {
            foreach ($request->images as $propertyimage) {
                $filename = $propertyimage->getClientOriginalName();

                $images = explode(",", $property->images);

                if(!$images == null) {
                    foreach ($images as $image) {
                        Storage::delete('/public/property_images/'.$image);
                    }
                }

                $propertyimage->storeAs('property_images', $filename, 'public');
                $propertyimages[]=$filename;
            }

            $property->update([
                'user_id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone_number' => Auth::user()->phone_number,
                'title' => $request->title,
                'location' => $request->location, 
                'description' => $request->description,
                'per_sqm' => $request->per_sqm,
                'price' => $request->price,
                'payment_plans' => $request->payment_plans,
                'features' => $request->features,
                'images' => implode(",",$propertyimages)
            ]);

            return redirect()->route('properties')->with([
                'type' => 'success',
                'message' => 'Property Updated Successfully!'
            ]);
        }
    }


    public function delete_property($id) {
        $Finder = Crypt::decrypt($id);

        $property = Property::findorfail($Finder);

        $images = explode(",", $property->images);

        foreach ($images as $image) {
            Storage::delete('/public/property_images/'.$image);
        }
        
        Property::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Property Deleted Successfully!',
        ]);
    }

    public function customers() {
        $customers = CustomerManagement::latest()->get();

        return view('admin.customers',[
            'customers' => $customers
        ]);
    }

    public function customer_management() {
        return view('admin.add_customer');
    }

    public function add_customer_management(Request $request) {
        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'string'],
            'occupation' => ['required', 'string'],
            'property_of_interest' => ['required', 'string'],
            'offer' => ['required', 'string'],
            'when_do_you_want_to_move_in' => ['required', 'string']
        ]);


        CustomerManagement::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'phone_number' => $request->phone_number, 
            'email' => $request->email,
            'occupation' => $request->occupation,
            'property_of_interest' => $request->property_of_interest,
            'offer' => $request->offer,
            'when_do_you_want_to_move_in' => $request->when_do_you_want_to_move_in,
        ]);

        return redirect()->route('customers')->with([
            'type' => 'success',
            'message' => 'Customer Added Successfully!'
        ]);
    }

    public function delete_customer_management($id) {
        $Finder = Crypt::decrypt($id);

        CustomerManagement::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Customer Details Deleted Successfully!',
        ]);
    }

    public function view_customer_management($id) {
        $Finder = Crypt::decrypt($id);

        $customer = CustomerManagement::findorfail($Finder);
        
        return view('admin.view_customer', [
            'customer' => $customer
        ]);
    }

    public function update_customer_management($id, Request $request) {
        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'string'],
            'occupation' => ['required', 'string'],
            'property_of_interest' => ['required', 'string'],
            'offer' => ['required', 'string'],
            'when_do_you_want_to_move_in' => ['required', 'string']
        ]);

        $Finder = Crypt::decrypt($id);

        $customer = CustomerManagement::findorfail($Finder);

        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'address_2' => $request->address_2,
            'phone_number' => $request->phone_number, 
            'email' => $request->email,
            'occupation' => $request->occupation,
            'property_of_interest' => $request->property_of_interest,
            'offer' => $request->offer,
            'when_do_you_want_to_move_in' => $request->when_do_you_want_to_move_in,
        ]);

        return redirect()->route('customers')->with([
            'type' => 'success',
            'message' => 'Customer Updated Successfully!'
        ]);
    }

    public function todo_list() {
        $todoLists = Task::latest()->get();

        return view('admin.todo_list', [
            'todoLists' => $todoLists
        ]);
    }

    public function add_todo_list(Request $request) {
        //Validate Request
        $this->validate($request, [
            'task' => ['required', 'string']
        ]);

        Task::create([
            'task' => $request->task
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Task Added Successfully'
        ]);
    }

    public function completed_todo_list($id) {
        $Finder = Crypt::decrypt($id);

        $task = Task::findorfail($Finder);

        $task->update([
            'status' => 'Completed'
        ]);

        return back();
    }

    public function pending_todo_list($id) {
        $Finder = Crypt::decrypt($id);

        $task = Task::findorfail($Finder);

        $task->update([
            'status' => 'Pending'
        ]);

        return back();
    }

    public function edit_todo_list($id, Request $request) {
        //Validate Request
        $this->validate($request, [
            'task' => ['required', 'string']
        ]);

        $Finder = Crypt::decrypt($id);

        $task = Task::findorfail($Finder);

        $task->update([
            'task' => $request->task
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Task Updated Successfully'
        ]);
    }

    public function delete_todo_list($id) {
        $Finder = Crypt::decrypt($id);

        Task::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Task Deleted Successfully!',
        ]);
    }
}
