<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Restaurant\Branch as BranchResource;
use App\Branch;
use Illuminate\Support\Facades\Auth;
use Session;
use Image;
use App\Restaurant;

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

    public function show()
    {
        $restaurant = Auth::user()->restaurant;
        if ($restaurant) {
            $branch = Branch::where('restaurant_id', $restaurant->id)->orderBy('branch_name', 'asc')->paginate(15);
            return view('restaurant.branches.show', ['branches' => $branch, 'restaurants' => $restaurant]);
        } else {
            $restaurant = Restaurant::all();
            $branch = Branch::orderBy('restaurant_id', 'asc')->paginate(15);
            return view('restaurant.branches.show', ['branches' => $branch, 'restaurants' => $restaurant]);
        }
    }

    public function search(Request $r)
    {
        $id = $r->restaurant_id;

        $branch = Branch::orderBy('id', 'asc')->where('restaurant_id', $id)->paginate(15);

        $restaurant = Restaurant::all();

        return view('restaurant.branches.show')->with('restaurants', $restaurant)->with('branches', $branch);

    }

    public function create($id){
        $restaurant = Restaurant::find($id);
        return view('restaurant.branches.create')->with('restaurants', $restaurant);
    }

    public function storeBranch(Request $request){

        $this->Validate($request,[
            'branch_name' => 'required|string|min:2',
            'picture' =>'required|max:15360',
        ]);

        $picfilename = time() . '.' . $request->file('picture')->getClientOriginalExtension();
        $picpath = public_path('/images/branch/' . $picfilename);
        Image::make($request->file('picture'))->save($picpath);

        Branch::create([
            'restaurant_id' => $request->restaurant_id,
            'branch_name' => $request->branch_name,
            'address' => $request->address,
            'picture' => $picfilename,
        ]);

        Session::flash('success', 'Branch details added successfully');
        return redirect()->route('branches.show');
    }

    public function edit($id){
        $branch = Branch::find($id);
        return view('restaurant.branches.edit')->with('branches', $branch);
    }

    public function updateBranch(Request $request, $id){

        $this->Validate($request,[
            'branch_name' => 'required|string|min:2',
            'picture' =>'required|max:15360',
        ]);

        $picfilename = time() . '.' . $request->file('picture')->getClientOriginalExtension();
        $picpath = public_path('/images/branch/' . $picfilename);
        Image::make($request->file('picture'))->save($picpath);

        $branch = Branch::find($id);
        $branch->restaurant_id = $request->restaurant_id;
        $branch->branch_name = $request->branch_name;
        $branch->address = $request->address;
        $branch->picture = $picfilename;
        $branch->save();

        Session::flash('success', 'Branch details updated successfully');
        return redirect()->route('branches.show');
    }

    public function destroy($id){
        $branch = Branch::where('id', $id)->first();
        $branch->delete();

        Session::flash('success', 'Branch details deleted successfully');
        return redirect()->route('branches.show');
    }
}
