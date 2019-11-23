@extends('admin.master')
@section('body')

    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">student info</h3>
            </div>

            <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Student Full Name</label>
                        <input type="text" required class="form-control" name="name">
                        <span class="text-danger">{{$errors->has('name')? $errors->First('name'): ''}}</span>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Student Roll No.</label>
                        <input type="number" required class="form-control" name="roll">
                        <span class="text-danger">{{$errors->has('roll')? $errors->First('roll'): ''}}</span>

                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

        <!-- /.card -->

    </div>
@endsection