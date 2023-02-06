@extends('layout.app')
@section('content')

<div class="container-fluid" >
    <div class="row">
    <div class="mb-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger fade show">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width: 5px; height: 5px; float: right;"></button>
            </div>
         @endif
         @if(session('delete'))
            <div class="alert alert-danger fade show" role="alert">
                {{ session('delete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('update') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-outline-primary" href="{{ route('brands.create') }}" style="margin: 2rem;"> Brands </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-outline-primary" href="{{ url('/') }}" style="margin: 2rem; float: right;"> Home </a>
                </div>
            </div>
    </div>
    <div class="col-sm-8">
        <div class="max-w-7xl mx-auto sm:px-8 lg:px-8">
            <div class="card w-100" style="margin: auto;">
                <div class="card-header text-center">
                    <h4>Inventory Items</h4>
                </div>
                <div class="container" style="width: 100%; padding: 10px;">
                    <div class="text-right">
                        <form action="{{ route('items.create') }}" method="GET">
                            <button type="submit" class='btn btn-primary' style="float: right;">Search</button>
                            <input type="text" name="search" class="form-control" style="float: right; width: 13rem; margin-right: 7px;"/>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Item ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Item Price</th>
                                <th scope="col">Item UOM</th>
                                <th scope="col">Brand ID</th>
                                <th scope="col">Min Stock</th>
                                <th scope="col">Reorder Qty</th>
                                <th scope="col">Active</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <th scope="row"> {{ $item->ItemID }} </th>
                                <td>{{ $item->ItemName }}</td>
                                <td>{{ $item->ItemPrice }}</td>
                                <td>{{ $item->ItemUOM }}</td>
                                <td>{{ $item->BrandID }}</td>
                                <td>{{ $item->MinStock }}</td>
                                <td>{{ $item->ReorderQty }}</td>
                                <td>{{ $item->IsActive }}</td>
                                <td class="text-center" style="white-space: nowrap;">
                                    <a href="{{ route('items.edit', $item->ItemID) }}" class='btn btn-warning' style="margin-right: 10px;">Edit</a>
                                    <form method="POST" action="{{ route('items.destroy',$item->ItemID) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type=submit class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4" style="margin-bottom: 2rem;">
        <div class="card">
                <div class="card-header text-center">
                    Add Item
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('items.store') }}">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-sm">
                                <label for="ItemID" class="form-label">Item ID</label>
                                <input class="form-control" type="text" name="ItemID" value="{{ $last_id }}" readonly>
                            </div>
                                    
                            <div class="col-sm">
                                <label for="ItemName" class="form-label">Item Name</label>
                                <input class="form-control" type="text" name="ItemName" value="{{ old('ItemName') }}">
                            </div>
                        </div>
                                    
                        <div class="mb-3 row">
                            <div class="col-sm">
                                <label for="ItemPrice" class="form-label">Item Price</label>
                                <input class="form-control" type="text" name="ItemPrice" value="{{ old('ItemPrice') }}">
                            </div>
                                    
                        <div class="col-sm">
                            <label for="ItemUOM" class="form-label">Item UOM</label>
                                <select name="ItemUOM" class="form-control" id="ItemUOM">
                                    <option value="Pc" {{ old('ItemUOM') == 'Pc' ? 'selected' : '' }}>Pc</option>
                                    <option value="Pack/2s" {{ old('ItemUOM') == 'Pack/2s' ? 'selected' : '' }}>Pack/2s</option>
                                    <option value="Pack/24s" {{ old('ItemUOM') == 'Pack/24s' ? 'selected' : '' }}>Pack/24s</option>
                                    <option value="Box/10s" {{ old('ItemUOM') == 'Box/10s' ? 'selected' : '' }}>Box/10s</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm">
                                <label for="BrandID" class="form-label">Brand ID</label>
                                <select name="BrandID" class="form-control" id="BrandID">
                                    <option value=""></option>
                                         @foreach($brands as $row)
                                        <option value="{{ $row->BrandID }}" {{ old('BrandID') == $row->BrandID ? 'selected' : '' }}>
                                            {{ $row->BrandName }}
                                        </option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="col-sm">
                                <label for="MinStock" class="form-label">Minimum Stock</label>
                                    <input class="form-control" type="number" name="MinStock" value="{{ old('MinStock') }}">
                                    </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-sm">
                                    <label for="ReorderQty" class="form-label">Reorder Quantity</label>
                                    <input class="form-control" type="number" name="ReorderQty" value="{{ old('ReorderQty') }}">
                            </div>

                            <div class="col-sm">
                                <label for="IsActive" class="form-label">Active</label>
                                <select name="IsActive" class="form-control" id="IsActive">
                                    <option value="Yes" {{ old('IsActive') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ old('IsActive') == 'No' ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">
                                    {{ __('Add') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
    </div>
</div>
@endsection
