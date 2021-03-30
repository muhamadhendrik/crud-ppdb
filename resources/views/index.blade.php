@extends('layouts.app')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <span>{{ session('success') }}</span>
            <button class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    <div class="header mb-3">
        <a type="button" href="{{ route('student.create') }}" class="btn btn-sm btn-primary">Create</a>
        <form action="{{ route('student.pdf') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-sm btn-success shadow">cetak pdf</button>
        </form>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Jk</th>
                <th>Tempat Lahir</th>
                <th>Tanggal lahir</th>
                <th>Alamat</th>
                <th>Asal Sekolah</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->jns_kelamin }}</td>
                    <td>{{ $student->temp_lahir }}</td>
                    <td>{{ $student->tgl_lahir }}</td>
                    <td>{{ $student->alamat }}</td>
                    <td>{{ $student->asal_sekolah }}</td>
                    <td>{{ $student->kelas }}</td>
                    <td>{{ $student->jurusan }}</td>
                    <td>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-sm btn-success">Edit</a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('yakin mau di hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
