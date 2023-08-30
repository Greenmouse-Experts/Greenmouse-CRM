<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Client;
use App\Models\CustomerManagement;
use App\Models\Debtor;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\Enquiry;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Property;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Mail;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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

    public function index(Request $request) {
        $employees = Employee::get();
        $incomes = Income::get()->sum('income_amount');
        $expenses = Expense::get()->sum('expense_amount');
        $debtors = Debtor::get()->sum('amount_owned');
        $products = Product::get()->count();
        $suppliers = Supplier::get()->count();

        $selectedIncomeYear = $request->input('income_year', date('Y')); // Default to current year if not specified
        $incomesChart = Income::whereYear('income_date', $selectedIncomeYear)
            ->groupBy('month')
            ->selectRaw('MONTH(income_date) as month, SUM(income_amount) as total_amount')
            ->orderBy('month')
            ->get();
        
        $selectedExpensesYear = $request->input('expense_year', date('Y')); // Default to current year if not specified
        $expensesChart = Expense::whereYear('expense_date', $selectedExpensesYear)
            ->groupBy('month')
            ->selectRaw('MONTH(expense_date) as month, SUM(expense_amount) as total_amount')
            ->orderBy('month')
            ->get();

        $productsByCategory = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('categories.name as category, SUM(products.quantity) as total_quantity')
            ->groupBy('categories.name')
            ->get();

        $debtorsChart = Debtor::orderBy('amount_owned', 'desc')->with('client')->get();

        // return $debtorsChart;

        return view('admin.dashboard', [
            'incomes' => $incomes,
            'employees' => $employees->count(),
            'expenses' => $expenses,
            'incomesChart' => $incomesChart,
            'selectedIncomeYear' => $selectedIncomeYear,
            'expensesChart' => $expensesChart,
            'selectedExpensesYear' => $selectedExpensesYear,
            'productsByCategory' => $productsByCategory,
            'products' => $products,
            'suppliers' => $suppliers,
            'debtors' => $debtors,
            'debtorsChart' => $debtorsChart
        ]);
    }

    // Roles
    public function roles() 
    {
        $roles = Role::latest()->get();

        return view('admin.employee.role', [
            'roles' => $roles
        ]);
    }

    public function add_role(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string']
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Role added successfully.'
        ]);
    }

    public function update_role($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string']
        ]);

        $Finder = Crypt::decrypt($id);

        $category = Role::findorfail($Finder);

        $category->update([
            'name' => $request->name
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Role updated successfully.'
        ]);
    }

    public function delete_role($id) 
    {
        $Finder = Crypt::decrypt($id);

        $role = Role::findorfail($Finder);

        $employee = Employee::where('role', $role->id)->get();

        if($employee)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Role has been attached to the Employee list. You can only Edit',
            ]);
        }

        $role->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Role deleted successfully.',
        ]);
    }

    // Employee
    public function employees() 
    {
        $employees = Employee::latest()->get();

        return view('admin.employee.employee', [
            'employees' => $employees
        ]);
    }

    public function add_employee(Request $request) 
    {
        $messages = [
            'role.required' => 'Please select a role.',
        ];

        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric'],
            'role' => ['required']
        ], $messages);

        if (request()->hasFile('photo')) 
        {
            $this->validate($request, [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->photo->getClientOriginalName();
            request()->photo->storeAs('employee_photos', $filename, 'public');

            $employee = Employee::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'dob' => $request->dob,
                'sex' => $request->sex,
                'address' => $request->address,
                'role' => $request->role,
                'join_date' => $request->join_date,
                'photo' => '/storage/employee_photos/'.$filename
            ]);

            EmployeeSalary::create([
                'employee_id' => $employee->id,
                'salary' => $request->salary
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Employee Registered Successfully'
            ]);
        }
        
        $employee = Employee::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'address' => $request->address,
            'role' => $request->role,
            'join_date' => $request->join_date
        ]);

        EmployeeSalary::create([
            'employee_id' => $employee->id,
            'salary' => $request->salary
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Employee Registered Successfully'
        ]);
    }

    public function update_employee($id, Request $request) 
    {
        $messages = [
            'role.required' => 'Please select a role.',
        ];

        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric'],
            'role' => ['required']
        ], $messages);

        $Finder = Crypt::decrypt($id);

        $employee = Employee::findorfail($Finder);

        if (request()->hasFile('photo')) 
        {
            $this->validate($request, [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->photo->getClientOriginalName();
            if($employee->photo) {
                Storage::delete(str_replace("storage", "public", $employee->photo));
            }
            request()->photo->storeAs('employee_photos', $filename, 'public');

            $employee->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'dob' => $request->dob,
                'sex' => $request->sex,
                'address' => $request->address,
                'role' => $request->role,
                'join_date' => $request->join_date,
                'photo' => '/storage/employee_photos/'.$filename
            ]);

            if($request->salary != null)
            {
                $salary = EmployeeSalary::where('employee_id', $employee->id)->first();

                $salary->update([
                    'salary' => $request->salary
                ]);
            }

            return back()->with([
                'type' => 'success',
                'message' => 'Employee Updated Successfully'
            ]);
        }
        
        $employee->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'dob' => $request->dob,
            'sex' => $request->sex,
            'address' => $request->address,
            'role' => $request->role,
            'join_date' => $request->join_date
        ]);

        if($request->salary != null)
        {
            $salary = EmployeeSalary::where('employee_id', $employee->id)->first();

            $salary->update([
                'salary' => $request->salary
            ]);
        }

        return back()->with([
            'type' => 'success',
            'message' => 'Employee Updated Successfully'
        ]);
    }

    public function delete_employee($id) 
    {
        $Finder = Crypt::decrypt($id);

        $employee = Employee::findorfail($Finder);

        $salary = EmployeeSalary::where('employee_id', $employee->id)->first();

        $product = Product::where('employee_id', $employee->id)->get();

        if($product)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Employee has been attached to the Product list. You can only Edit',
            ]);
        }

        if($employee->photo) {
            Storage::delete(str_replace("storage", "public", $employee->photo));
        }

        if($salary)
        {
            $salary->delete();
        }

        $employee->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Employee Deleted Successfully!'
        ]); 
    }

    // Salary Structure
    public function salary_structure() 
    {
        $salaries = EmployeeSalary::latest()->get();

        return view('admin.employee.salary_structure', [
            'salaries' => $salaries
        ]);
    }

    public function update_salary($id, Request $request) 
    {
        $Finder = Crypt::decrypt($id);

        $salary = EmployeeSalary::findorfail($Finder);

        $salary->update([
            'salary' => $request->salary
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Salary Updated Successfully'
        ]);
    }

    public function account() 
    {
        return view('admin.account');
    }

    public function change_password($id, Request $request) 
    {
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

    public function properties() 
    {
        $properties = Property::latest()->get();

        return view('admin.properties',[
            'properties' => $properties
        ]);
    }

    public function property() 
    {
        return view('admin.add_property');
    }

    public function add_property(Request $request) 
    {
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

    public function view_property($id) 
    {
        $Finder = Crypt::decrypt($id);

        $property = Property::findorfail($Finder);

        return view('admin.view_property',[
            'property' => $property
        ]);
    }

    public function update_property($id, Request $request) 
    {
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

    public function delete_property($id) 
    {
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

    // Client
    public function clients() 
    {
        $clients = Client::latest()->get();

        return view('admin.client.clients',[
            'clients' => $clients
        ]);
    }

    public function client_management() 
    {
        return view('admin.client.add_client');
    }

    public function add_client_management(Request $request) 
    {
        //Validate Request
        // $this->validate($request, [
        //     'title' => ['required', 'string', 'max:255'],
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'address_1' => ['required', 'string'],
        //     'phone_number' => ['required', 'numeric'],
        //     'email' => ['required', 'string'],
        // ]);

        Client::create([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone_number, 
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'occupation' => $request->occupation,
            'section' => $request->section,
            'admin_id' => Auth::user()->id
        ]);

        return redirect()->route('clients')->with([
            'type' => 'success',
            'message' => 'Client Added Successfully!'
        ]);
    }

    public function delete_client_management($id) 
    {
        $Finder = Crypt::decrypt($id);

        $client = Client::findorfail($Finder);

        $debt = Debtor::where('client_id', $client->id)->get();

        if($debt)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Client Details has been attached to the debtor list. You can only Edit',
            ]);
        }
        
        $client->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Client Details Deleted Successfully!',
        ]);
    }

    public function view_client_management($id) 
    {
        $Finder = Crypt::decrypt($id);

        $client = Client::findorfail($Finder);
        
        return view('admin.client.view_client', [
            'client' => $client
        ]);
    }

    public function update_client_management($id, Request $request) 
    {
        //Validate Request
        // $this->validate($request, [
        //     'title' => ['required', 'string', 'max:255'],
        //     'first_name' => ['required', 'string', 'max:255'],
        //     'last_name' => ['required', 'string', 'max:255'],
        //     'address_1' => ['required', 'string'],
        //     'phone_number' => ['required', 'numeric'],
        //     'email' => ['required', 'string'],
        // ]);

        $Finder = Crypt::decrypt($id);

        $client = Client::findorfail($Finder);

        $client->update([
            'title' => $request->title,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone_number, 
            'email' => $request->email,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'occupation' => $request->occupation,
            'section' => $request->section,
        ]);

        return redirect()->route('clients')->with([
            'type' => 'success',
            'message' => 'Client Updated Successfully!'
        ]);
    }

    // Category
    public function categories() 
    {
        $categories = Category::latest()->get();

        return view('admin.category.categories', [
            'categories' => $categories
        ]);
    }

    public function add_category(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string']
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Category added successfully.'
        ]);
    }

    public function update_category($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string']
        ]);

        $Finder = Crypt::decrypt($id);

        $category = Category::findorfail($Finder);

        $category->update([
            'name' => $request->name
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Category updated successfully.'
        ]);
    }

    public function delete_category($id) 
    {
        $Finder = Crypt::decrypt($id);

        $category = Category::findorfail($Finder);

        $products = Product::where('category_id', $category->id)->get();

        if($products)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Category Details has been attached to the Product list. You can only Edit',
            ]);
        }
        
        $category->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Category deleted successfully.',
        ]);
    }

    // Supplier
    public function suppliers() 
    {
        $suppliers = Supplier::latest()->get();

        return view('admin.supplier.suppliers', [
            'suppliers' => $suppliers
        ]);
    }

    public function add_supplier(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string'],
        ]);

        if (request()->hasFile('photo')) 
        {
            $this->validate($request, [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->photo->getClientOriginalName();
            request()->photo->storeAs('inventory_supplier_image', $filename, 'public');

            Supplier::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopName' => $request->shopName,
                'photo' => '/storage/inventory_supplier_image/'.$filename,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Supplier added successfully.'
            ]);
        }

        Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopName' => $request->shopName
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Supplier added successfully.'
        ]);
    }

    public function update_supplier($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
            'shopName' => ['required', 'string'],
        ]);

        $Finder = Crypt::decrypt($id);

        $supplier = Supplier::findorfail($Finder);

        if (request()->hasFile('photo')) 
        {
            $this->validate($request, [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->photo->getClientOriginalName();
            if($supplier->photo) {
                Storage::delete(str_replace("storage", "public", $supplier->photo));
            }
            request()->photo->storeAs('inventory_supplier_image', $filename, 'public');

            $supplier->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopName' => $request->shopName,
                'photo' => '/storage/inventory_supplier_image/'.$filename,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Supplier updated successfully.'
            ]);
        }

        $supplier->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopName' => $request->shopName
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Supplier updated successfully.'
        ]);
    }

    public function delete_supplier($id) 
    {
        $Finder = Crypt::decrypt($id);

        $supplier = Supplier::findorfail($Finder);
        
        $products = Product::where('supplier_id', $supplier->id)->get();

        if($products)
        {
            return back()->with([
                'type' => 'danger',
                'message' => 'Supplier Details has been attached to the Product list. You can only Edit',
            ]);
        }
        
        if($supplier->photo) {
            Storage::delete(str_replace("storage", "public", $supplier->photo));
        }

        $supplier->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Supplier deleted successfully.',
        ]);
    }

    // Products
    public function products() 
    {
        $products = Product::latest()->get();

        return view('admin.product.products', [
            'products' => $products
        ]);
    }

    function product_code($input, $strength = 3) 
    {
        $input = '0123456789';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return $random_string;
    }

    public function add_product(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'category_id' => ['required', 'integer'],
            'supplier_id' => ['required', 'integer'],
            'product_name' => ['required', 'string'],
            'employee_id' => ['nullable', 'integer'],
        ]);

        if (request()->hasFile('photo')) 
        {
            $this->validate($request, [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->photo->getClientOriginalName();
            request()->photo->storeAs('inventory_product_image', $filename, 'public');

            Product::create([
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'product_code' => ucfirst(substr($request->product_name, 0, 1)).$this->product_code(3),
                'quantity' => $request->quantity,
                'price' => $request->price,
                'employee_id' => $request->employee_id,
                'product_image' => '/storage/inventory_product_image/'.$filename,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Supplier added successfully.'
            ]);
        }

        Product::create([
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_code' => ucfirst(substr($request->product_name, 0, 3)).$this->product_code(3),
            'quantity' => $request->quantity,
            'price' => $request->price,
            'employee_id' => $request->employee_id,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Product added successfully.'
        ]);
    }

    public function view_product($id) 
    {
        $Finder = Crypt::decrypt($id);

        $product = Product::find($Finder);

        return view('admin.product.view_product', [
            'product' => $product
        ]);
    }

    public function update_product($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'category_id' => ['required', 'string'],
            'supplier_id' => ['required', 'string'],
            'product_name' => ['required', 'string'],
            'employee_id' => ['required', 'string'],
        ]);

        $Finder = Crypt::decrypt($id);

        $product = Product::findorfail($Finder);

        if (request()->hasFile('photo')) 
        {
            $this->validate($request, [
                'photo' => 'required|mimes:jpeg,png,jpg',
            ]);
            $filename = request()->photo->getClientOriginalName();
            if($product->product_image) {
                Storage::delete(str_replace("storage", "public", $product->product_image));
            }
            request()->photo->storeAs('inventory_product_image', $filename, 'public');

            $product->update([
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'employee_id' => $request->employee_id,
                'product_image' => '/storage/inventory_product_image/'.$filename,
            ]);

            return back()->with([
                'type' => 'success',
                'message' => 'Supplier updated successfully.'
            ]);
        }

        $product->update([
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'employee_id' => $request->employee_id,
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Product updated successfully.'
        ]);
    }

    public function delete_product($id) 
    {
        $Finder = Crypt::decrypt($id);

        $product = Product::findorfail($Finder);
        
        if($product->product_image) {
            Storage::delete(str_replace("storage", "public", $product->product_image));
        }

        $product->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Product deleted successfully.',
        ]);
    }

    // Todo
    public function todo_list() 
    {
        $todoLists = Task::latest()->get();

        return view('admin.todo.todo_list', [
            'todoLists' => $todoLists
        ]);
    }

    public function add_todo_list(Request $request) 
    {
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

    public function completed_todo_list($id) 
    {
        $Finder = Crypt::decrypt($id);

        $task = Task::findorfail($Finder);

        $task->update([
            'status' => 'Completed'
        ]);

        return back();
    }

    public function pending_todo_list($id) 
    {
        $Finder = Crypt::decrypt($id);

        $task = Task::findorfail($Finder);

        $task->update([
            'status' => 'Pending'
        ]);

        return back();
    }

    public function edit_todo_list($id, Request $request) 
    {
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

    public function delete_todo_list($id) 
    {
        $Finder = Crypt::decrypt($id);

        Task::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Task Deleted Successfully!',
        ]);
    }

    // Expenses
    public function expenses() 
    {
        $expenses = Expense::latest()->get();

        return view('admin.financial.expenses', [
            'expenses' => $expenses
        ]);
    }

    public function add_expense(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        Expense::create([
            'expense_title' => $request->title,
            'expense_description' => $request->description,
            'expense_amount' => $request->amount,
            'expense_date' => $request->date
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Expense added successfully.'
        ]);
    }

    public function update_expense($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        $Finder = Crypt::decrypt($id);

        $expense = Expense::findorfail($Finder);

        $expense->update([
            'expense_title' => $request->title,
            'expense_description' => $request->description,
            'expense_amount' => $request->amount,
            'expense_date' => $request->date
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Expense updated successfully.'
        ]);
    }

    public function delete_expense($id) 
    {
        $Finder = Crypt::decrypt($id);

        Expense::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Expense deleted successfully.',
        ]);
    }

    // Incomes
    public function incomes() 
    {
        $incomes = Income::latest()->get();

        return view('admin.financial.incomes', [
            'incomes' => $incomes
        ]);
    }

    public function add_income(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        Income::create([
            'income_title' => $request->title,
            'income_description' => $request->description,
            'income_amount' => $request->amount,
            'income_date' => $request->date
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Income added successfully.'
        ]);
    }

    public function update_income($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ]);

        $Finder = Crypt::decrypt($id);

        $expense = Income::findorfail($Finder);

        $expense->update([
            'income_title' => $request->title,
            'income_description' => $request->description,
            'income_amount' => $request->amount,
            'income_date' => $request->date
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Income updated successfully.'
        ]);
    }

    public function delete_income($id) 
    {
        $Finder = Crypt::decrypt($id);

        Income::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Income deleted successfully.',
        ]);
    }

    // Debtors
    public function debtors() 
    {
        $debtors = Debtor::latest()->get();

        return view('admin.financial.debtors', [
            'debtors' => $debtors
        ]);
    }

    public function add_debtor(Request $request) 
    {
        $messages = [
            'client_id.required' => 'Please select a client detail.',
        ];

        //Validate Request
        $this->validate($request, [
            'client_id' => ['required', 'string'],
            'type' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
        ], $messages);

        Debtor::create([
            'client_id' => $request->client_id,
            'debt_type' => $request->type,
            'debt_description' => $request->description,
            'amount_owned' => $request->amount
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Debtor added successfully.'
        ]);
    }

    public function process_debtor($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'amount' => ['required', 'numeric'],
        ]);

        $Finder = Crypt::decrypt($id);

        $debtor = Debtor::findorfail($Finder);

        if($request->amount == $debtor->amount_owned)
        {
            Income::create([
                'income_title' => $debtor->debt_type,
                'income_description' => $debtor->debt_description,
                'income_amount' => $debtor->amount_owned,
                'income_date' => now()
            ]);

            $debtor->delete();

            return back()->with([
                'type' => 'success',
                'message' => 'Debt processed successfully.'
            ]);
        }

        Income::create([
            'income_title' => $debtor->debt_type,
            'income_description' => $debtor->debt_description,
            'income_amount' => $request->amount,
            'income_date' => now()
        ]);

        $debtor->update([
            'amount_owned' => $debtor->amount_owned - $request->amount
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Debtor updated successfully.'
        ]);
    }

    public function update_debtor($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'client_id' => ['required', 'string'],
            'type' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
        ]);

        $Finder = Crypt::decrypt($id);

        $debtor = Debtor::findorfail($Finder);

        $debtor->update([
            'client_id' => $request->client_id,
            'debt_type' => $request->type,
            'debt_description' => $request->description,
            'amount_owned' => $request->amount
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Debtor updated successfully.'
        ]);
    }

    public function delete_debtor($id) 
    {
        $Finder = Crypt::decrypt($id);

        Debtor::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Debtor deleted successfully.',
        ]);
    }

    // Sales
    public function findPrice(Request $request){
        $data = DB::table('products')->select('price')->where('id', $request->id)->first();
        return response()->json($data);
    }

    public function sales() 
    {
        $products = Product::all();
        $sales = Sale::latest()->get();

        return view('admin.financial.sales', [
            'products' => $products,
            'sales' => $sales
        ]);
    }

    public function add_sale(Request $request) 
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
            'email' => 'nullable|email',
            'product_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'amount' => 'required',
        ]);

        $invoice = Invoice::create([
            'invoice_id' => Str::random(8),
            'name' => $request->name,
            'email' => $request->email,
            'total' => array_sum($request->amount)
        ]);

        foreach ( $request->product_id as $key => $product_id){
            $sale = Sale::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id[$key],
                'invoice_id' => $invoice->id,
                'name' => $request->name,
                'email' => $request->email,
                'quantity' => $request->qty[$key],
                'price' => $request->price[$key],
                'amount' => $request->amount[$key],
                'date_of_payment' => $request->date
            ]);

            $product = Product::find($sale->product_id);

            $product->update([
                'quantity' => $product->quantity - $sale->quantity
            ]);
        }

        return redirect()->route('sales')->with([
            'type' => 'success',
            'message' => 'Sales added successfully.'
        ]);
    }

    public function delete_sale($id) 
    {
        $Finder = Crypt::decrypt($id);

        $sale = Sale::find($Finder);
        $invoice = Invoice::find($sale->invoice_id);

        if($invoice)
        {
            $invoice->update([
                'total' => $sale->amount
            ]);
        }
        
        $sale->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Sale deleted successfully.',
        ]);
    }

    public function invoices()
    {
        $invoices = Invoice::latest()->get();

        return view('admin.financial.invoices', [
            'invoices' => $invoices
        ]);
    }

    public function preview_invoice($id)
    {
        $Finder = Crypt::decrypt($id);

        $invoice = Invoice::find($Finder);

        return view('admin.financial.preview', [
            'invoice' => $invoice
        ]);
    }

    public function edit_invoice($id)
    {
        $Finder = Crypt::decrypt($id);

        $sales = Sale::where('invoice_id', $Finder)->get();
        $products = Product::orderBy('id', 'DESC')->get();
        $invoice = Invoice::find($Finder);

        return view('admin.financial.edit', [
            'sales' => $sales,
            'products' => $products,
            'invoice' => $invoice
        ]);
    }

    public function update_invoice($id, Request $request) 
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[a-zA-Z ]+$/',
            'email' => 'nullable|email',
            'product_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'amount' => 'required',
        ]);

        $Finder = Crypt::decrypt($id);

        $invoice = Invoice::find($Finder);

        $invoice->update([
            'invoice_id' => Str::random(8),
            'name' => $request->name,
            'email' => $request->email,
            'total' => array_sum($request->amount)
        ]);

        Sale::where('invoice_id', $invoice->id)->delete();

        foreach ( $request->product_id as $key => $product_id){
            $sale = Sale::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id[$key],
                'invoice_id' => $invoice->id,
                'name' => $request->name,
                'email' => $request->email,
                'quantity' => $request->qty[$key],
                'price' => $request->price[$key],
                'amount' => $request->amount[$key],
                'date_of_payment' => $request->date ?? Carbon::now()->format('Y-m-d')
            ]);

            $product = Product::find($sale->product_id);

            $product->update([
                'quantity' => $product->quantity - $sale->quantity
            ]);
        }

        return redirect()->route('sales')->with([
            'type' => 'success',
            'message' => 'Sales updated successfully.'
        ]);
    }

    public function delete_invoice($id)
    {
        $Finder = Crypt::decrypt($id);

        Invoice::find($Finder)->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Invoice deleted successfully.',
        ]);
    }

    // Equiries
    public function enquiries() 
    {
        $enquiries = Enquiry::latest()->get();

        return view('admin.enquiry.call_bookings',[
            'enquiries' => $enquiries
        ]);
    }

    public function add_enquiry(Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        Enquiry::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'location' => $request->location,
            'how_do_you_know_about_us' => $request->how_do_you_know_about_us,
            'enquiry_details' => $request->details, 
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Enquiry added successfully.'
        ]);

    }

    public function update_enquiry($id, Request $request) 
    {
        //Validate Request
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        
        $Finder = Crypt::decrypt($id);

        $enquiry = Enquiry::findorfail($Finder);

        $enquiry->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'location' => $request->location,
            'how_do_you_know_about_us' => $request->how_do_you_know_about_us,
            'enquiry_details' => $request->details, 
        ]);

        return back()->with([
            'type' => 'success',
            'message' => 'Enquiry updated successfully.'
        ]);

    }

    public function delete_enquiry($id) 
    {
        $Finder = Crypt::decrypt($id);

        Enquiry::findorfail($Finder)->delete();
        
        return back()->with([
            'type' => 'success',
            'message' => 'Enquiry deleted successfully.'
        ]); 
    }

    public function pdf_invoice($id)
    {
        $Finder = Crypt::decrypt($id);

        $invoice = Invoice::find($Finder);
        $logoUrl = public_path('assets/img/greenmouse-logo.png'); 
        $sign = "₦";

        // return view('admin.financial.receiptPDF', [
        //     'invoice' => $invoice
        // ]);

        $pdf = PDF::loadView('admin.financial.receiptPDF', [
            'invoice' => $invoice,
            'logoUrl' => $logoUrl,
            'sign' => $sign 
        ]);
    
        return $pdf->download('receipt.pdf');
    }
}