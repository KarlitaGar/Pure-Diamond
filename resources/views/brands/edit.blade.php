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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="card w-50" style="margin: auto;">
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
                                <option value="{{ $brands->IsActive == 'Yes' ? 'No' : 'Yes'  }}" >{{ $brands->IsActive == 'Yes'?'No':'Yes' }}</option>
                            </select>
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
