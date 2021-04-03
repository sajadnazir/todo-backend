<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_name' ,'is_completed'
     ];

     private static function setCondition($request) {

        $arrWhereCondition = [];

        if (!empty($request['id'])) {
            $arrWhereCondition[] = ['id', '=', $request['id']];
        }
        if (!empty(request('created_at'))) {
            $arrWhereCondition[] = ['created_at', 'LIKE', '%' .request('created_at').'%'];
        }

        return $arrWhereCondition;
    }

    protected static function findRecords($request) {


        $varPageNo = !empty(request('pageno')) ? request('pageno') : '1';
        $varTotalRecordPerPage = !empty(request('records-per-page')) ? request('records-per-page') : '10';
        $varSortBy = !empty(request('sortby')) ? request('sortby') : 'id';
        $varOrder = !empty(request('order')) ? request('order') : 'desc';

        $varStartingRecords = ($varPageNo - 1) * $varTotalRecordPerPage;

        $arrWhereCondition = self::setCondition($request);
        $varTotalRecords = self::where($arrWhereCondition)->count();

        $arrData = self::skip($varStartingRecords)->take($varTotalRecordPerPage)->where($arrWhereCondition)->orderBy($varSortBy, $varOrder)->get()->toArray();


        return ['totalRecords' => $varTotalRecords, "records" => $arrData];

    }

}
