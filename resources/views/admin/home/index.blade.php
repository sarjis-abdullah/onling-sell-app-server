@extends('admin.master')
@section('body')

    <h1 class="text text-primary"> {{Session::get('message')}}</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#SL</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>


        <tbody>

        @php($i=1)
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>

                <td>
                    <a class="btn btn-secondary" href="{{route('user.show',['user'=>$user->id])}}">Edit</a>

                    <form method="post" action="{{route('user.destroy',['user'=>$user->id])}}">

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