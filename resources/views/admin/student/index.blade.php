@extends('admin.master')
@section('body')

    <h1 class="text text-primary"> {{Session::get('message')}}</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#SL</th>
            <th scope="col">Student Name</th>
            <th scope="col">Roll Number</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
        </tr>
        </thead>


        <tbody>

        @php($i=1)
        @foreach($students as $student)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$student->name}}</td>
                <td>{{$student->roll}}</td>
                <td>
                    <img src="{{asset($student->image)}}" height="100" width="100">
                </td>
                <td>
                    <a class="btn btn-secondary" href="{{route('student.show',['student'=>$student->id])}}">Edit</a>

                    <form method="post" action="{{route('student.destroy',['student'=>$student->id])}}">

                        @csrf
                        @method('delete')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>

            </tr>
        @endforeach


        </tbody>
    </table>

@endsection