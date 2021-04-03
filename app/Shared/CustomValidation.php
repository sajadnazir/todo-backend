<?php

namespace App\Shared;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomValidation extends Model{

    protected $response = ['success' => true, 'errors' => []];

    public function validateTask(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'task_name' => 'required | min:5 | max:150',

        ], [

            'task_name.required' => Message::getErrorMessage('taskNameRequired'),
            'task_name.min' => Message::getErrorMessage('taskNameMinimumCharcters'),
            'task_name.max' => Message::getErrorMessage('taskNameMaximumCharcters'),

        ]

        );

        if ($validator->fails()) {
            $this->response['success'] = false;
            $this->response['errors'] = $validator->errors();
        }

        return $this->response;

    }
}
