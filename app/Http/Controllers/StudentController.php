<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();
        
        // Chart 1: Prodi (Bar)
        $prodiData = Student::select('prodi', DB::raw('count(*) as total'))->groupBy('prodi')->get();
        
        // Chart 2: Angkatan (Line)
        $angkatanData = Student::select('angkatan', DB::raw('count(*) as total'))->groupBy('angkatan')->orderBy('angkatan')->get();
        
        // Chart 3: Lulus per Angkatan (Bar/Line)
        $lulusData = Student::where('status', 'lulus')->select('angkatan', DB::raw('count(*) as total'))->groupBy('angkatan')->get();
        
        // Chart 4: Gender (Pie)
        $genderData = Student::select('gender', DB::raw('count(*) as total'))->groupBy('gender')->get();

        return view('student.index', compact('students', 'prodiData', 'angkatanData', 'lulusData', 'genderData'));
    }

    public function create()
    {
        return view('student.create');
    }

    public function store(Request $request) {
        $request->validate([
            'npm' => 'required|unique:students',
            'name' => 'required',
            'prodi' => 'required',
            'angkatan' => 'required|numeric',
            'status' => 'required',
            'gender' => 'required'
        ]);
        Student::create($request->all());
        return redirect()->route('student.index');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('student.edit', compact('student'));
    }

    public function update(Request $request, $id) {
        $student = Student::findOrFail($id);
        $request->validate([
            'npm' => 'required|unique:students,npm,'.$student->id,
            'name' => 'required',
            'prodi' => 'required',
            'angkatan' => 'required|numeric',
            'status' => 'required',
            'gender' => 'required'
        ]);
        $student->update($request->all());
        return redirect()->route('student.index');
    }

    public function destroy($id)
    {
        Student::destroy($id);
        return redirect()->route('student.index');
    }

}