<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Shared\CustomValidation;
use App\Shared\Message;
use Illuminate\Http\Request;

class TaskController extends Controller {

    public function index(Request $request){

        $taskData = Task::findRecords($request);

        if (count($taskData)>0) {
            return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataFound'),'data' => $taskData]);
        }
        return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataNotFound'),'data' => null]);

    }

    public function store(Request $request){

        $validator = new CustomValidation();
        $validator = $validator->validateTask($request);

        if (!empty($validator) && isset($validator['success']) && $validator['success'] == false) {
            return response()->json(['code' => 200, 'success' => false, 'message' => Message::getErrorMessage('responseErrorMessage'), 'messages' => $validator['errors']]);
        }

        $taskData = new Task();
        $taskData->task_name = $request->task_name;
        $taskData->is_completed = 0;
        if($taskData->save()){
            return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataInserted')]);
        }
        return response()->json(['code' => 500, 'success' => false, 'message' => Message::getErrorMessage('dataNotInserted')]);
    }


    public function update(Request $request , $id){

        $validator = new CustomValidation();
        $validator = $validator->validateTask($request);

        if (!empty($validator) && isset($validator['success']) && $validator['success'] == false) {
            return response()->json(['code' => 200, 'success' => false, 'message' => Message::getErrorMessage('responseErrorMessage'), 'messages' => $validator['errors']]);
        }

        $taskData = Task::whereId($id)->first();
        if (!empty($taskData)) {

            $taskData->task_name = $request->task_name;
            $taskData->save();

            return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataUpdated')]);
        }
        return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataNotFound')]);


    }

    public function changeTaskStatus($id){

        $taskData = Task::whereId($id)->first();
        if (!empty($taskData)) {

            $taskData->is_completed = $taskData->is_completed == 0 ? 1 : 0;
            $taskData->save();

            return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataUpdated')]);
        }
        return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataNotFound')]);

    }

    public function destroy($id)
    {
        $taskData = Task::find($id);
        if (!empty($taskData)) {

            $taskData->delete();

            return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataDeleted')]);
        }
        return response()->json(['code' => 200, 'success' => true, 'message' => Message::getErrorMessage('dataNotFound')]);
    }



}
