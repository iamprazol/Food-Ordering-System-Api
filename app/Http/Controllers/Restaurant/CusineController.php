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

        return $this->responser($cusine, $data, 'Cusines');

    }
}
