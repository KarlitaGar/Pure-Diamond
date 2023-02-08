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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!empty($request->search)){
            $items = tbl_item::query()
            ->where('ItemID','like','%'.$request->search.'%')
            ->orwhere('ItemPrice','like','%'.$request->search.'%')
            ->orwhere('ItemName','like','%'.$request->search.'%')
            ->orwhere('IsActive','like','%'.$request->search.'%')->get();
            return view('items.index', compact('items'));
        }else{
            $items = tbl_item::all();
            return view('items.index', compact('items'));
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!empty($request->search)){
            $last_id = tbl_item::max('ItemID')+1;
            $brands = tbl_brand::all();
            $items = tbl_item::query()
            ->where('ItemName','like','%'.$request->search.'%')
            ->orwhere('ItemPrice','like','%'.$request->search.'%')
            ->orwhere('IsActive','like','%'.$request->search.'%')
            ->orwhere('ItemID','like','%'.$request->search.'%')->get();
            return view('items.index', compact('last_id','brands', 'items'));
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
        $last_id = tbl_brand::max('BrandID')+1;
        $brands = tbl_brand::all();
        return view('items.edit', compact('last_id', 'items', 'brands'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tbl_item::where('ItemID',$id)->forceDelete();
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
        $validate = $request->validate([
            'ItemName' => 'required|unique:tbl_items,ItemName,'.$id.',ItemID',
            'ItemPrice' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'ItemUOM' => 'required',
            'BrandID' => 'required',
            'MinStock' => 'required|numeric|min:1|integer',
            'ReorderQty' => 'required|numeric|min:1|integer',
            'IsActive' => 'required',
        ],
        [
            'required' => 'All fields are required. Please ensure all fields are
            completed.',
            'unique' => 'Inventory item already exists in the database.',
            'integer' => 'This field must be a whole number.',
            'min' => 'This field must be at least 1.',
        ]);

        $old_name = tbl_item::where('ItemID', $id)->first()->toArray();

        tbl_item::where('ItemID',$id)->update([
            'ItemName' => $request->ItemName,
            'ItemPrice' => $request->ItemPrice,
            'ItemUOM' => $request->ItemUOM,
            'BrandID' => $request->BrandID,
            'MinStock' => $request->MinStock,
            'ReorderQty' => $request->ReorderQty,
            'IsActive' => $request->IsActive,
        ]);

        $new_name = tbl_item::where('ItemID', $id)->first()->toArray();

        $diff = array_diff($old_name, $new_name);

        if ((isset($diff['ItemName']) ||
            isset($diff['ItemPrice']) ||
            isset($diff['ItemUOM']) ||
            isset($diff['BrandID']) ||
            isset($diff['MinStock']) ||
            isset($diff['ReorderQty']) ||
            isset($diff['IsActive']))) {
            return redirect()->route('items.create')->with('update','Inventory has been updated.');
        }else{
            return back();
        }
        return redirect()->route('items.create')->with('update','Inventory has been updated.');

        // $old_name = tbl_item::where('ItemID', $id)->pluck('ItemName')[0];
        // $old_price = tbl_item::where('ItemID', $id)->pluck('ItemPrice')[0];
        // $old_itemuom = tbl_item::where('ItemID', $id)->pluck('ItemUOM')[0];
        // $old_brandid = tbl_item::where('ItemID', $id)->pluck('BrandID')[0];
        // $old_stock = tbl_item::where('ItemID', $id)->pluck('MinStock')[0];
        // $old_qty = tbl_item::where('ItemID', $id)->pluck('ReorderQty')[0];
        // $old_status = tbl_item::where('ItemID', $id)->pluck('IsActive')[0];
        

        // tbl_item::where('ItemID',$id)->update([
        //     'ItemName' => $request->ItemName,
        //     'ItemPrice' => $request->ItemPrice,
        //     'ItemUOM' => $request->ItemUOM,
        //     'BrandID' => $request->BrandID,
        //     'MinStock' => $request->MinStock,
        //     'ReorderQty' => $request->ReorderQty,
        //     'IsActive' => $request->IsActive,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        // // $new_name = tbl_item::where('ItemID', $id)->first()->toArray();

        // $update = $old_name !== $request->BrandName || 
        //         $old_price !== $request->ItemPrice|| 
        //         $old_itemuom !== $request->ItemUOM || 
        //         $old_brandid !== $request->BrandID || 
        //         $old_stock !== $request->MinStock || 
        //         $old_qty !== $request->ReorderQty || 
        //         $old_status !== $request->IsActive;

        // if($update == true){
        //     return redirect()->route('items.create')->with('success','Brand has been updated.');
        // }else{
        //     return back();
        // }      
        
    }
    
}
