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

        return $this->responser($branch, $data, 'Branches');

    }

    public function branchOfRestaurant($id){

        $branch = Branch::where('restaurant_id', $id)->orderBy('branch_name', 'asc')->get();

        $data = BranchResource::collection($branch);

        return $this->responser($branch, $data, 'Branches');

    }
}
