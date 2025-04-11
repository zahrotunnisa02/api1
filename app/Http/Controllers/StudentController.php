<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\StudentRsc;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function __construct()
        {
    $this->middleware('auth:api');
        }

    /**
     * Display a listing of the resource.
     *
     * return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return new StudentRsc($students, 'Success', 'List of Students');
    }

    /**
     * Store a newly created resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return new StudentRsc(null, 'Failed', $validator->errors());
        }

        $student = Student::create($request->all());
        return new StudentRsc($student, 'Success', 'Student Created Successfullly');
    }

    /**
     * Display the specified resource.
     *
     * param  int  $id
     * return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        if ($student) {
            return new StudentRsc($student, 'Success', 'Student found');
        } else {
            return new StudentRsc(null, 'Failed', 'Student not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * param  \Illuminate\Http\Request  $request
     * param  int  $id
     * return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {
            
            $validator = Validator::make($request->all(), [
                'nim' => 'required',
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ]);
    
            if ($validator->fails()) {
                return new StudentRsc(null, 'Failed', $validator->errors());
            }

            $student->update($request->all());
            return new StudentRsc($student, 'Success', 'Student data updated succesfully');
        } else {
            return new StudentRsc(null, 'Failed', 'Student not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * param  int  $id
     * return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return new StudentRsc(null, 'Success', 'Student data deleted succesfully');
        } else {
            return new StudentRsc(null, 'Failed', 'Student not found');
        }
    }
}
