<?php

namespace App\Shared;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    public static function getErrorMessage($argError)
    {

        $arrErrorMessage = [

            'taskNameRequired' => 'Task name is required',
            'taskNameMinimumCharcters' => 'Task name can not be less than 5 charcters',
            'taskNameMaximumCharcters' => 'Task name can not be more than 150 charcters',

            'responseErrorMessage' => 'Error(s) Found!',
            'dataFound' => 'Record(s) has been found successfully.',
            'dataNotFound' => 'There is no record found.',
            'dataInserted' => 'Data Added successfully.',
            'dataNotInserted' => 'There was some error while uploading data , please try again!.',
            'dataUpdated' => 'Data Updated successfully.',
            'dataDeleted' => 'Data Deleted successfully.',
        ];

        return isset($arrErrorMessage[$argError]) && !empty($arrErrorMessage[$argError]) ? $arrErrorMessage[$argError] : 'N/A';
    }

}
