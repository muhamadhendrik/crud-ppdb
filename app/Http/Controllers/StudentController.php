<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

use PDF;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {
           $this->validate($request,[
            'nis' => 'required|integer',
            'nama' => 'required|string',
            'jns_kelamin' => 'required|string',
            'temp_lahir' => 'required|string',
            'tgl_lahir' => 'required|string',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
        ]);

        $attr = $request->all();

        Student::create($attr);
        return redirect()->route('student.index')->with('success', 'Data Siswa Baru berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
         $this->validate($request,[
            'nis' => 'required|string',
            'nama' => 'required|string',
            'jns_kelamin' => 'required|string',
            'temp_lahir' => 'required|string',
            'tgl_lahir' => 'required|string',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
        ]);
        $attr=$request->all();
        $student->update($attr);
        return redirect()->route('student.index')->with('success', 'berhasil mengupdate data siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Data Berhasil dihapus');
    }

    public function cetakPdf()
    {
        $students = Student::all();

        $pdf = PDF::loadview('pdf', compact('students'));
        return $pdf->stream();
    }
}
