@extends('layout.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm" >
            <div class="card">
                <div class="card-header text-center">
                    <h4>Brands</h4>
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                    <a href="{{ route('items.index') }}">
                        {{ __('Items') }}
                    </a>
                </h2>
        
        </div>
    </div>
@endsection
