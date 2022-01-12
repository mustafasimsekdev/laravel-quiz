<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $myProfile = User::findOrFail(Auth::user()->id);
        return view('admin.profile.index', compact('myProfile'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateGeneral(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'min:3'],
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        if ($validator->fails()) {
            $array['result'] = 0;
            $array['content_text'] = $validator->errors()->first();

            return response()->json(array('status' => $array['result'], 'message' => $array['content_text']));
        } else {
            $updateProfile = User::where("id", Auth::user()->id)->first();
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

    public function updatePassword(Request $request)
    {
        $update = User::where("id", Auth::user()->id)->first();

        if (Hash::check($request->old_password, $update->password)) {
            $update->password = Hash::make($request->new_password);
            $update->save();
            if ($update->save()) {
                $success = 1;
                $message = "Şifreniz başarıyla güncellendi";
            } else {
                $success = 0;
                $message = "Beklenmeyen hatayla karşılaşıldı. Lütfen tekrar deneyin!";
            }
        } else {
            $success = 0;
            $message = "Eski şifre uyuşmuyor!";
        }
        return response()->json(array('status' => $success, 'message' => $message));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
