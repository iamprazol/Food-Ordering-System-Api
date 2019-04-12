<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responser($item,$data,$name)
    {

        $num = count($item);

        if($num > 0){
            return response()->json([
                'data' => $data,
                'status' => 200,
                'message' => $num.' '.$name.' found'
            ]);
        } else {
            return response()->json([
                'data' => $data,
                'status' => 404,
                'message' => $name.' not found'
            ]);
        }


    }
}
