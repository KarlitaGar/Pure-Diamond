<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\tbl_item;
use App\Models\tbl_brand;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->search)){
            $last_id = tbl_item::max('BrandID')+1;
            $items = tbl_item::query()
            ->where('ItemID','like','%'.$request->search.'%')
            ->orwhere('ItemName','like','%'.$request->search.'%')->get();
            return view('items.index', compact('last_id','items'));
        }else{
            $items = tbl_item::all();
            return view('items.index', compact('last_id','items'));
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!empty($request->search)){
            $last_id = tbl_item::max('ItemID')+1;
            $items = tbl_item::query()
            ->where('ItemName','like','%'.$request->search.'%')
            ->orwhere('ItemID','like','%'.$request->search.'%')->paginate(5);
            return view('items.index', compact('last_id', 'items'));
        }else{
            $last_id = tbl_item::max('ItemID')+1;
            $brands = tbl_brand::all();
            $items = tbl_item::orderBy('ItemID', 'asc')->paginate(5);
            return view('items.index', compact('last_id', 'brands', 'items'));
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
            'ItemName' => 'required|unique:tbl_items',
            'ItemPrice' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'ItemUOM' => 'required',
            'BrandID' => 'required',
            'MinStock' => 'required|numeric|min:1|integer',
            'ReorderQty' => 'required|numeric|min:1|integer',
            'IsActive' => 'required',
        ],
        [
            'required' => 'All fields are required. Please ensure all fields are completed.',
            'unique' => 'Inventory item name already exists in the database.',
            'MinStock.integer' => 'Minimum stock must be a whole number.',
            'ReorderQty.integer' => 'Reorder quantity must be a whole number.',
            'MinStock.min' => 'Minimum stock must be at least 1.',
            'ReorderQty.min' => 'Reorder quantity must be at least 1.',
        ]);

        tbl_item::insert([
            'ItemName' => $request->ItemName,
            'ItemPrice' => $request->ItemPrice,
            'ItemUOM' => $request->ItemUOM,
            'BrandID' => $request->BrandID,
            'MinStock' => $request->MinStock,
            'ReorderQty' => $request->ReorderQty,
            'IsActive' => $request->IsActive,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success','New inventory item has been added.');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $items = tbl_item::where('ItemID',$id)->first();
        $brands = tbl_brand::all();
        return view('items.edit', compact('items', 'brands'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tbl_item::where('ItemID',$id)->delete();
        return redirect()->route('items.create')->with('delete','Inventory has been deleted.');
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
        // $validate = $request->validate([
        //     'ItemName' => 'required|unique:tbl_items',
        //     'ItemPrice' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        //     'ItemUOM' => 'required',
        //     'BrandID' => 'required',
        //     'MinStock' => 'required|numeric|min:1|integer',
        //     'ReorderQty' => 'required|numeric|min:1|integer',
        //     'IsActive' => 'required',
        // ],
        // [
        //     'required' => 'All fields are required. Please ensure all fields are
        //     completed.',
        //     'unique' => 'Inventory item name already exists in the database.',
        //     'integer' => 'This field must be a whole number.',
        //     'min' => 'This field must be at least 1.'
        // ]);

        tbl_item::where('ItemID',$id)->update([
            'ItemName' => $request->ItemName,
            'ItemPrice' => $request->ItemPrice,
            'ItemUOM' => $request->ItemUOM,
            'BrandID' => $request->BrandID,
            'MinStock' => $request->MinStock,
            'ReorderQty' => $request->ReorderQty,
            'IsActive' => $request->IsActive,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        request()->session()->flash('flash.banner', 'Inventory item has been updated.');

        return redirect('items');
    }
}
