<?php

namespace App\Http\Controllers;
use App\Employee;
use App\Http\Requests;
use Illuminate\Http\Request;

class Employees extends Controller
{
    public function index($id=null) {
        if ($id == null) {
            return Employee::orderBy('id', 'desc')->paginate(10);
        } else {
            return $this->show($id);
        }
    }

    public function store(Request $request) {
        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->contact_number = $request->input('contact_number');
        $employee->position = $request->input('position');
        $employee->save();

        return 'Employee record successfully created with id ' . $employee->id;
    }
    public function show($id) {
        return Employee::find($id);
    }
    public function update(Request $request, $id) {
        $employee = Employee::find($id);

        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->contact_number = $request->input('contact_number');
        $employee->position = $request->input('position');
        $employee->save();

        return "Sucess updating user #" . $employee->id;
    }
    public function destroy(Request $request) {
      /*   dd($request->id); */
        $employee = Employee::find($request->id);

        $employee->delete();

        return "Employee record successfully deleted #" . $request->input('id');
    }

}
