@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.dashboard.update',['dashboard'=>$normal_user->id]) }}">
                            @csrf
                            @method('put')

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input  id="name" type="text" class="form-control " name="name" value="{{$normal_user->name}}"  required autocomplete="name" autofocus>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input value="{{$normal_user->email}}" id="email" type="email" class="form-control " name="email" required autocomplete="email">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Make Him Admin') }}</label>

                                <div class="col-md-6">
                                    <select  id="email"  class="form-control "
                                             name="role_id" required >
                                        <option disabled="" value="">Select</option>

                                        <option value="{{$normal_user->role_id}}">No</option>
                                        <option value="1">Ok</option>
                                    </select>

                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Update User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
