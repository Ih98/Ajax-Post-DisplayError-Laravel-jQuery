<?php

namespace App\Http\Controllers;

use App\Models\data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class AjaxController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ], [
            'name.required' => 'Name must be provided.',
            'email.required' => 'Email must be provided.',
            'email.email' => 'Invalid email format.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()]);
        }

        return response()->json(['success' => 'Employee created successfully.']);
    }
}


// return redirect()->back()->withErrors($validator)->withInput($request->all());;
// data::create([
//     'name' => $request->name,
//     'email' => $request->email,
// ]);
// return response()->json($validator);

// Your logic for storing the employee data goes here

// return response()->json(['success' => 'Employee created successfully.']);




// $validator = Validator::make($request->all(), [
//     'name' => 'required',
//     'email' => 'required|email',
// ], [
//     'name.required' => 'Name must be provided.',
//     'email.required' => 'Email must be provided.',
//     'email.email' => 'Invalid email format.',
// ]);

// if ($validator->fails()) {
//     return response()->json(['data' => 0, 'error' => $validator->errors()->all()]);
// }

// return response()->json(['success' => 'Employee created successfully.']);

// $request->validate([
//     'name' => 'required',
//     'email' => 'required|email',
// ]);
