<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function list()
    {
        return Student::all();
    }

    public function addStudent(Request $req)
    {
        try {
            // Validate the request data
            $validator = Validator::make($req->all(), [
                'student_name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'dob' => 'required|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            // Create and save the student
            $student = new Student();
            $student->student_name = $req->student_name;
            $student->city = $req->city;
            $student->dob = $req->dob;

            if ($student->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Student added successfully',
                    'data' => $student,
                ], 201);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to save student',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateStudent(Request $req){
        $student = Student::find($req->id);
        $student->student_name = $req->student_name;
        $student->city = $req->city;
        $student->dob = $req->dob;
        if($student->save()){
            return ["result"=>" student updated"];
        }else{
            return ["result"=>" student not updated"];
        }
    }

    public function deleteStudent($id){
        // return $id;
        $student = Student::destroy($id);
        if($student){
            return ["result"=>"Successfully deleted"];
        }else{
            return ["result"=>"error id not found"];
        }
    }

    function searchStudent($name){
        $student = Student::where('student_name','like',"%$name%")->get();
        return response()->json($student);
    }
}