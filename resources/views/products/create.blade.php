@extends('layouts.app')

@section('title', 'Sample Page - Modernize Free')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Sample Page</h5>

            <form id="general-form" method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <div class="invalid-feedback" id="nameError"></div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    <div class="invalid-feedback" id="descriptionError"></div>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" >
                    <div class="invalid-feedback" id="priceError"></div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <!-- You can add page-specific scripts here -->
    <script src="{{ asset('assets/js/ajax/ajax-general.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/errors.css') }}" />
    <script>
        // Sample page-specific JavaScript
        console.log('Sample page loaded');
    </script>
@endpush
