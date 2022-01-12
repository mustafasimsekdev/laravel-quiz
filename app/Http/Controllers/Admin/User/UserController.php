<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.list');
    }

    public function add(){
        return view('admin.user.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'min:3'],
            'email' => 'required|email|unique:users,email,',
        ]);

        if ($validator->fails()) {
            $array['result'] = 0;
            $array['content_text'] = $validator->errors()->first();
        } else {
            $newUser = new User();
            $newUser->fullname = $request->fullname;
            $newUser->email = $request->email;
            $newUser->password = Hash::make($request->new_password);
            if ($request->hasFile('user_image')) {
                $file = $request->file('user_image');
                // if size less than 5MB
                if ($file->getSize() < 5000000) {
                    if (in_array($file->getClientOriginalExtension(), array('png', 'jpg', 'jpeg', 'gif'))) {
                        // upload
                        $avatar = Str::uuid() . "." . $file->getClientOriginalExtension();
                        $newUser->photo = $avatar;
                        $file->storeAs("public/images/user-profile/", $avatar);
                    }
                }
            }

            if ($newUser->save()) {
                $array['result'] = 1;
                $array['content_text'] = "Kullanici basarili bir sekilde eklendi.";
            } else {
                $array['result'] = 0;
                $array['content_text'] = "Beklenmeyen hatayla karşılaşıldı. Lütfen tekrar deneyin!";
            }
        }
        return response()->json(array('status' => $array['result'], 'message' => $array['content_text']));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (isset($user)) {
            return view('admin.user.edit', compact('user'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateGeneral(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'min:3'],
            'email' => 'required|email|unique:users,email,' . $request->profile_id,
        ]);

        if ($validator->fails()) {
            $array['result'] = 0;
            $array['content_text'] = $validator->errors()->first();

        } else {
            $updateProfile = User::where("id", $request->profile_id)->first();
            $updateProfile->fullname = $request->fullname;
            $updateProfile->email = $request->email;
            $updateProfile->is_active = $request->is_active == 'on' ? 1 : 0;

            if ($request->hasFile('user_image')) {
                $file = $request->file('user_image');
                // if size less than 5MB
                if ($file->getSize() < 5000000) {
                    if (in_array($file->getClientOriginalExtension(), array('png', 'jpg', 'jpeg', 'gif'))) {
                        // upload
                        $avatar = Str::uuid() . "." . $file->getClientOriginalExtension();
                        $updateProfile->photo = $avatar;
                        $file->storeAs("public/images/user-profile/", $avatar);
                    }
                }
            }
            if ($updateProfile->save()) {
                $array['result'] = 1;
                $array['content_text'] = "Profiliniz başarıyla güncellendi";
            } else {
                $array['result'] = 0;
                $array['content_text'] = "Beklenmeyen hatayla karşılaşıldı. Lütfen tekrar deneyin!";
            }
        }

        return response()->json(array('status' => $array['result'], 'message' => $array['content_text']));

    }

    public function removeImage(Request $request)
    {
        $updateProfile = User::where("id", $request->id)->first();
        if (is_file(storage_path('app/public/images/user-profile/' . $updateProfile->photo))) {
            unlink(storage_path('app/public/images/user-profile/' . $updateProfile->photo));

            if ($updateProfile->save()) {
                $array['result'] = 1;
                $array['content_text'] = "Profiliniz başarıyla güncellendi";
            } else {
                $array['result'] = 0;
                $array['content_text'] = "Beklenmeyen hatayla karşılaşıldı. Lütfen tekrar deneyin!";
            }
        } else {
            $array['result'] = 0;
            $array['content_text'] = "Beklenmeyen hatayla karşılaşıldı. Lütfen tekrar deneyin!";
        }

        return response()->json(array('status' => $array['result'], 'message' => $array['content_text']));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = $request->input('id');
        try {
            $delete = User::findOrFail($user);
            $delete->is_active = 0;
            $delete->save();
            $delete->delete();

            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }
}
