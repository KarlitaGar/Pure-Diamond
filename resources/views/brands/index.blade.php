@extends('layout.app')
@section('content')

<div class="container">
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
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('delete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-outline-primary" href="{{ route('home') }}" style="margin: 2rem;"> Home </a>
                </div>
                <div class="col-md-6">
                    <a class="btn btn-outline-primary" href="{{ route('items.create') }}" style="margin: 2rem; float: right;"> Inventory Items </a>
                </div>
            </div>
        </div>

        <div class="col-sm" >
            <div class="card">
                <div class="card-header text-center">
                    <h4>Brands</h4>
                </div>
                <div class="container" style="width: 100%; padding: 10px;">
                    <div class="text-right">
                        <form action="{{ route('brands.create') }}" method="GET">
                            <button type="submit" class='btn btn-primary' style="float: right;">Search</button>
                            <input type="text" name="search" class="form-control" style="float: right; width: 13rem; margin-right: 7px;"/>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Brand ID</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Active</th>
                                <th scope="col" class="text-center">Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <th scope="row"> {{ $brand->BrandID }} </th>
                                    <td>{{ $brand->BrandName }}</td>
                                    <td>{{ $brand->IsActive }}</td>
                                    <td class="text-center">
                                            <a href="{{ route('brands.edit', $brand->BrandID) }}" class='btn btn-warning' style="margin-right: 10px;">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('brands.destroy',$brand->BrandID) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type=submit class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
                <div class="card">
                        <div class="card-header text-center">
                            Add Brand
                        </div>
                        <!-- @if ($errors->any())
                            <div class="alert alert-danger fade show">
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width: 5px; height: 5px; float: right;"></button>
                            </div>
                        @endif -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('brands.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="brand_id" class="form-label">Brand ID</label>
                                    <input class="form-control" type="text" name="brand_id" value="{{ $last_id }}" readonly>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="BrandName" class="form-label">Brand Name</label>
                                    <input class="form-control" type="text" name="BrandName" value="{{ old('brand-name') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="IsActive" class="form-label">Active</label>
                                    <select name="IsActive" class="form-control" id="IsActive">
                                        <option value="Yes" >Yes</option>
                                        <option value="No" >No</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">
                                    {{ __('Add') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
        <!-- <div class="col-sm">
            <div class="card">
                <div class="card-header text-center">
                    Add Brand
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3">
                        <label for="fordescription" class="form-label">Description</label>
                        <textarea class="form-control" id="description" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="forstatus" class="form-label">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value=""></option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>

                        <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Assignee</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1">
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        </div>
    </div>
@endsection
