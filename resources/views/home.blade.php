@extends('layout.app')
@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="container">
    <div class="row">
        <div class="col-sm" >
            <div class="card">
                <div class="card-header text-center">
                    <div style="">Brands</div>
                    <div class="container" style="width: 47.5%; float: right; ">
                        <div class="text-right">
                            <form action="" method="GET">
                                <button type="submit" class='btn btn-dark'>Item List</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <table class="table table-striped table-hover">
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('brands.destroy',$brand->BrandID) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type=submit class="btn btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: #f00ff">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
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
                        @if ($errors->any())
                            <div class="alert alert-danger fade show">
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width: 5px; height: 5px; float: right;"></button>
                            </div>
                        @endif
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
