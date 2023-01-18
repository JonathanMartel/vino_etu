<?php

    namespace App\Http\Controllers;
    use App\Models\Employee;
    use Illuminate\Http\Request;
    class EmployeeController extends Controller
    {
       public function index()
       {
          return view('Employee.index');
       }
       public function showEmployee(Request $request)
       {
         // $employees = Employee::all();
          if($request->keyword != ''){
          $employees = Employee::where('name','LIKE','%'.$request->keyword.'%')->get();
          }
          return response()->json([
             'employees' => $employees
          ]);
        }
    }

