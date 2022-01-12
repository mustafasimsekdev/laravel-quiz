<?php

namespace App\Http\Controllers\Admin\ToDo;

use App\Events\ToDoLogEvent;
use App\Http\Controllers\Controller;
use App\Models\ToDoes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.to-do.list');
    }

    public function add()
    {
        return view('admin.to-do.add');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'headerTemp' => ['required', 'min:3'],
            'contentTemp' => ['required', 'min:3'],
        ]);

        if ($validator->fails()) {
            $array['result'] = 0;
            $array['content_text'] = $validator->errors()->first();
        } else {
            $newToDo = new ToDoes();
            $newToDo->header = $request->headerTemp;
            $newToDo->content = $request->contentTemp;
            $newToDo->recording_id = Auth::user()->id;
            if ($newToDo->save()) {
                event(new ToDoLogEvent($newToDo->content, $newToDo->getUser->fullname, 'Ekledi'));
                $array['result'] = 1;
                $array['content_text'] = "To Do basarili bir sekilde eklendi.";
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $toDo = ToDoes::find($id);
        if (isset($toDo) && $toDo->recording_id == Auth::user()->id) {
            return view('admin.to-do.edit', compact('toDo'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'headerTemp' => ['required', 'min:3'],
            'contentTemp' => ['required', 'min:3'],
        ]);

        if ($validator->fails()) {
            $array['result'] = 0;
            $array['content_text'] = $validator->errors()->first();
        } else {
            $updateToDo = ToDoes::where("id", $request->todo_id)->first();
            $updateToDo->header = $request->headerTemp;
            $updateToDo->content = $request->contentTemp;
            $updateToDo->is_active = $request->is_active == 'on' ? 1 : 0;

            if ($updateToDo->save()) {
                event(new ToDoLogEvent($updateToDo->content, $updateToDo->getUser->fullname, 'Guncelledi'));
                $array['result'] = 1;
                $array['content_text'] = "To Do başarıyla güncellendi";
            } else {
                $array['result'] = 0;
                $array['content_text'] = "Beklenmeyen hatayla karşılaşıldı. Lütfen tekrar deneyin!";
            }
        }
        return response()->json(array('status' => $array['result'], 'message' => $array['content_text']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $toDoId = $request->input('id');
        try {
            $delete = ToDoes::findOrFail($toDoId);
            $delete->is_active = 0;
            $delete->save();
            event(new ToDoLogEvent($delete->content, $delete->getUser->fullname, 'Sildi'));
            $delete->delete();

            echo 'ok';
        } catch (ModelNotFoundException $e) {
            echo 'notok';
        }
    }
}
