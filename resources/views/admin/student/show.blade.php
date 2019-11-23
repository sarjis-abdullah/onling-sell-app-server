@extends('admin.master')
@section('body')

    <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">student info</h3>
            </div>

            <form action="{{route('student.update' ,['student'=>$student->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Student Full Name</label>
                        <input type="text" required class="form-control" name="name" value="{{$student->name}}">
                        <span class="text-danger">{{$errors->has('name')? $errors->First('name'): ''}}</span>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Student Roll No.</label>
                        <input type="number" required class="form-control" name="roll" value="{{$student->roll}}">
                        <span class="text-danger">{{$errors->has('roll')? $errors->First('roll'): ''}}</span>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Photos of Student</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input  name="image" type="file" class="custom-file-input" id="exampleInputFile" >
                                <label class="custom-file-label" for="exampleInputFile">Choose
                                    file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
                        <img src="{{asset($student->image)}}" width="200" height="200">
                        <span class="text-danger">{{$errors->has('image')? $errors->First('image'): ''}}</span>
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