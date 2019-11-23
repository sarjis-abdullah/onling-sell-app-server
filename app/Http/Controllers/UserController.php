<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {

        return \App\Http\Resources\User::collection(User::where('role_id',2)->paginate(5));
       // return view('admin.home.index', ['users' => User::all()]);
    }



    public function store(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required',
//            'roll' => 'required',
//        ]);
//        return $request;

    }


    public function show($id)
    {
        //
    }



    public function update(Request $request, $id)
    {
        $row = User::findOrFail($id);
        if (!is_null($row)) {
            $row->name = $request->name;
            $row->email = $request->email;
            if ($request->role_id==1){
                $row->role_id = $request->role_id;
            }


            $row->update();
        }
        return response()->json(
            ['message' => 'Data Editing Problem']
        );
    }


    public function destroy($id)
    {
        $row = User::findOrFail($id);

        if (!is_null($row)) {
            User::destroy($id);
        }
        return response()->json(
            ['message' => 'Data Deletion Problem']
        );
    }
}
