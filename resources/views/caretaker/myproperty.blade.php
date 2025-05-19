@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">My Properties (Caretaker)</h2>
                </div>
                <div class="card-body">
                    @if($listings->isEmpty())
                        <div class="alert alert-info">You have no properties assigned yet.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>City</th>
                                        <th>Barangay</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listings as $listing)
                                        <tr>
                                            <td>{{ $listing->title }}</td>
                                            <td>{{ $listing->type }}</td>
                                            <td>₱{{ number_format($listing->price, 2) }}</td>
                                            <td>{{ $listing->city }}</td>
                                            <td>{{ $listing->baranggay }}</td>
                                            <td>
                                                <span class="badge bg-{{ $listing->availability === 'open' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($listing->availability) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('listing.show', $listing->id) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('listing.edit', $listing->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
