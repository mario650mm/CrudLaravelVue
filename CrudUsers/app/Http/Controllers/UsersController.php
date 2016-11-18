<?php

namespace App\Http\Controllers;

use App\User;
use App\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $success = null, $user = null)
    {
        $users = User::filterAndPaginate($request->get('name'), $request->get('email'), $request->get('type'));
        if ($success == "create") {
            return redirect("/users/list")->with('success', 'El usuario  '.$user.'   ¡ha sido registrado existosamente!');
        } else if ($success == "update") {
            return redirect("/users/list")->with('success', 'El usuario  ' .$user. '   ¡ha sido actualizado existosamente!');
        }else{
            return view("users.index", ["users" => $users]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userTypes = UserType::get();
        return view("users.create", ["userTypes" => $userTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            "name" => "required|max:60",
            "email" => "required|max:50",
            "password" => "required|min:6",
            "type" => "required"
        ]);
        if($validation == null){
            \DB::beginTransaction();
            $directory = "../storage/app/public/images/";
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $image = $request->image;
            if ($image) {
                $userDB = User::all(['id'])->last();
                $userId = $userDB->id + 1;
                $imageName = 'user_' . $userId . '.png';
                Image::make($image->getRealPath())->resize(300, 200)->save($directory . $imageName);
                $user->image = $imageName;
            }
            $user->user_type_id = $request->type;
            $user->save();
            \DB::commit();
            return response()->json('ok');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $userTypes = UserType::get();
        return view("users.edit", ["user" => $user, "userTypes" => $userTypes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $this->validate($request, [
            "name" => "required|max:60",
            "email" => "required|max:50",
            "type" => "required"
        ]);

        if($validation == null){
            \DB::beginTransaction();
            $directory = "../storage/app/public/images/";
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $password = $request->password;
            $image = $request->image;
            if ($password) {
                $user->password = bcrypt($password);
            }
            if ($image) {
                $userId = $user->id;
                $imageName = 'user_' . $userId . '.png';
                Image::make($image->getRealPath())->resize(300, 200)->save($directory . $imageName);
                $user->image = $imageName;
            }
            $user->user_type_id = $request->type;
            $user->save();
            \DB::commit();
            return response()->json('ok');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        $user = User::find($id);
        $user->delete();
        \DB::commit();
        return redirect('/users/list')->with('warning','El usuario  '.$user->name.' ¡ha sido eliminado sastifactoriamente!');
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }
}
