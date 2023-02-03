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
