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
                            <td scope="col">ID</td>
                            <td scope="col">Name</td>
                            <td scope="col">Email</td>
                            <td scope="col">Action</th>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- You can add page-specific scripts here -->
    <script>
        // Sample page-specific JavaScript
        console.log('Sample page loaded');
    </script>
@endpush
