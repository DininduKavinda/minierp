@extends('layouts.app')

@section('title', 'Sample Page - Modernize Free')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Sample Page</h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->price }}</td>
                            <td>
                                <a href="{{ route('products.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form id="general-form" action="{{ route('products.destroy', $row->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
