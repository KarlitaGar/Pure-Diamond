@extends('layout.app')
@section('content')

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="card w-50" style="margin: auto;">
                @if ($errors->any())
                    <div class="alert alert-danger  fade show">
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width: 5px; height: 5px; float: right;"></button>
                    </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('items.update', $items->ItemID) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <div class="col-sm">
                                <label for="ItemID" class="form-label">Item ID</label>
                                <input class="form-control" type="text" name="ItemID" value="{{ $items->ItemID }}" readonly>
                            </div>
                            
                            <div class="col-sm">
                                <label for="ItemName" class="form-label">Item Name</label>
                                <input class="form-control" type="text" name="ItemName" value="{{ $items->ItemName }}">
                            </div>
                        </div>
                            
                        <div class="mb-3 row">
                            <div class="col-sm">
                                <label for="ItemPrice" class="form-label">Item Price</label>
                                <input class="form-control" type="text" name="ItemPrice" value="{{ $items->ItemPrice }}">
                            </div>
                            
                            <div class="col-sm">
                                <label for="ItemUOM" class="form-label">Item UOM</label>
                                <select name="ItemUOM" class="form-control" id="ItemUOM">
                                    <option value="Pc" {{ old('ItemUOM', $items->ItemUOM) == 'Pc' ? 'selected' : '' }}>Pc</option>
                                    <option value="Pack/2s" {{ old('ItemUOM', $items->ItemUOM) == 'Pack/2s' ? 'selected' : '' }}>Pack/2s</option>
                                    <option value="Pack/24s" {{ old('ItemUOM', $items->ItemUOM) == 'Pack/24s' ? 'selected' : '' }}>Pack/24s</option>
                                    <option value="Box/10s" {{ old('ItemUOM', $items->ItemUOM) == 'Box/10s' ? 'selected' : '' }}>Box/10s</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm">
                                <label for="BrandID" class="form-label">Brand ID</label>
                                <select name="BrandID" class="form-control" id="BrandID">
                                    @foreach($brands as $row)
                                    <option value="{{ $row->BrandID }}" {{ old('BrandID', $items->ItemID) == $row->BrandID ? 'selected' : '' }}>
                                        {{ $row->BrandID }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm">
                                <label for="MinStock" class="form-label">Minimum Stock</label>
                                <input class="form-control" type="number" name="MinStock" value="{{ $items->MinStock }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm">
                                <label for="ReorderQty" class="form-label">Reorder Quantity</label>
                                <input class="form-control" type="number" name="ReorderQty" value="{{ $items->ReorderQty }}">
                            </div>

                            <div class="col-sm">
                                <label for="IsActive" class="form-label">Active</label>
                                <select name="IsActive" class="form-control" id="IsActive">
                                    <option value="{{ $items->IsActive == 'Yes' ? 'Yes' : 'No' }}" >{{ $items->IsActive }}</option>
                                    <option value="{{ $items->IsActive == 'Yes' ? 'No' : 'Yes'  }}" >{{ $items->IsActive == 'Yes'?'No':'Yes' }}</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
