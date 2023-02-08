@extends('layout.app')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="card w-50" style="margin: auto;">
            <div class="row">
                    
                 </div>
                @if ($errors->any())
                    <div class="alert alert-danger fade show">
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="width: 5px; height: 5px; float: right;"></button>
                    </div>
                @endif
                
                <div class="card-body">
                    <form method="POST" action="{{ route('brands.update', $brands->BrandID) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="BrandID" class="form-label">Brand ID</label>
                            <input class="form-control" type="text" name="BrandID" value="{{ $brands->BrandID }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="BrandName" class="form-label">Brand Name</label>
                            <input class="form-control" type="text" name="BrandName" value="{{ $brands->BrandName }}">
                        </div>

                        <div class="mb-3">
                            <label for="IsActive" class="form-label">Active</label>
                            <select name="IsActive" class="form-control" id="IsActive">
                                <option value="{{ $brands->IsActive == 'Yes' ? 'Yes' : 'No' }}" >{{ $brands->IsActive }}</option>
                                <option value="{{ $brands->IsActive == 'Yes' ? 'No' : 'Yes' }}" >{{ $brands->IsActive == 'Yes'?'No':'Yes' }}</option>
                            </select>
                        </div>

                        <div class="mb-3 row" style="margin-top: 5%;">
                            <div class="col-sm">
                                <a class="btn btn-outline-primary" href="{{ route('brands.create') }}" style="width: 100%;"> Back </a>
                            </div>
                            <div class="col-sm" style="margin-left: 70%; width: 100%;">
                                <button type="submit" class="btn btn-primary" > {{ __('Update') }} </button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
