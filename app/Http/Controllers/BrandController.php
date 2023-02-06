<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\tbl_brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->search)){
            $last_id = tbl_brand::max('BrandID')+1;
            $brands = tbl_brand::query()
            ->where('BrandName','like','%'.$request->search.'%')
            ->orwhere('BrandID','like','%'.$request->search.'%')->get();
            return view('brands.index', compact('last_id','brands'));
        }else{
            $last_id = tbl_brand::max('BrandID')+1;
            $brands = tbl_brand::all();
            return view('brands.index', compact('last_id','brands'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!empty($request->search)){
            $last_id = tbl_brand::max('BrandID')+1;
            $brands = tbl_brand::query()
            ->where('BrandName','like','%'.$request->search.'%')
            ->orwhere('BrandID','like','%'.$request->search.'%')->get();
            return view('brands.index', compact('last_id', 'brands'));
        }else{
            $last_id = tbl_brand::max('BrandID')+1;
            $brands = tbl_brand::orderBy('BrandID', 'asc')->paginate(5);
            return view('brands.index', compact('last_id', 'brands'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'BrandName' => 'required|unique:tbl_brands',
            'IsActive' => 'required',
        ],
        [
            'required' => 'All fields are required. Please ensure all fields are
            completed.',
            'unique' => 'Brand name already exists in the database.',
        ]);

        tbl_brand::insert([
            'BrandName' => $request->BrandName,
            'IsActive' => $request->IsActive,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success','New brand name has been added.');

    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = tbl_brand::where('BrandID',$id)->first();
        $last_id = tbl_brand::max('BrandID')+1;
        return view('brands.edit', compact('brands', 'last_id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            tbl_brand::where('BrandID', $id)->forceDelete();
            return redirect()->route('brands.create')->with('delete','Brand has been deleted.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', 'Brand cannot be deleted. This item is referred to by another object.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'BrandName' => 'required|unique:tbl_brands,BrandID,'.$id.',BrandID',
            'IsActive' => 'required',
        ],
        [
            'required' => 'All fields are required. Please ensure all fields are
            completed.',
            'unique' => 'Brand name already exists in the database.',
        ]);

        tbl_brand::where('BrandID',$id)->update([
            'BrandName' => $request->BrandName,
            'IsActive' => $request->IsActive,
        ]);

        
        return redirect()->route('brands.create')->with('success','Brand has been updated.');
    }


}
