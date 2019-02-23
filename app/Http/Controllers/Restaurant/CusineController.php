<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Cusine;
use App\Http\Resources\Restaurant\Cusine as CusineResource;

class CusineController extends Controller
{
    public function index(){

        $cusine = Cusine::orderBy('name', 'asc')->get();

        $data = CusineResource::collection($cusine);

        $num = count($data);

        if($num > 0){
            return $this->responser($data, 200, 'All Cusines are listed');
        } else {
            return $this->responser($data, 404, 'Cusines cannot be found');
        }

    }
}
