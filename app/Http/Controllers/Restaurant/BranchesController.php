<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\Branch as BranchResource;
use App\Branch;

class BranchesController extends Controller
{
    public function branchById($id){

        $branch = Branch::where('id', $id)->get();

        $data = BranchResource::collection($branch);

        $num = count($branch);

        if($num > 0){
            return $this->responser($data, 200, 'Branch with specific id is listed');
        } else {
            return $this->responser($data, 404, 'Branch with specific id cannot be found');
        }

    }

    public function branchOfRestaurant($id){

        $branch = Branch::where('restaurant_id', $id)->orderBy('branch_name', 'asc')->get();

        $data = BranchResource::collection($branch);

        $num = count($branch);

        if($num > 0){
            return $this->responser($data, 200, 'Branch with specific restaurant id is listed');
        } else {
            return $this->responser($data, 404, 'Branch with specific restaurant id cannot be found');
        }

    }
}
