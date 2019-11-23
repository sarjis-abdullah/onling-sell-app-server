@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $row)
                    <tr>
                        <th scope="row">1</th>
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>
                            <a href="{{route('admin.dashboard.show',['dashboard'=>$row->id])}}">
                                <span class="fa fa-edit"></span>
                            </a>
                        </td>

                        <td>
                            <form method="post" action="{{route('admin.dashboard.destroy',['dashboard'=>$row->id])}}">
                                @method('delete')
                                @csrf

                                <input type="submit" class="btn btn-danger" value="delete">
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection