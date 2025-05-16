@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="container">
        <h1>Manage Caretakers by Owner</h1>

        @foreach($owners as $owner)
            <div class="card mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span>Owner: {{ $owner->fname }} {{ $owner->lname }}</span>
                    <a href="{{ route('admin.caretaker.create', ['owner_id' => $owner->id]) }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Add Caretaker
                    </a>
                </div>
                <div class="card-body">
                    @if($owner->caretakers->isEmpty())
                        <p>No caretakers assigned to this owner.</p>
                    @else
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($owner->caretakers as $caretaker)
                                    <tr>
                                        <td>{{ $caretaker->fname }} {{ $caretaker->lname }}</td>
                                        <td>{{ $caretaker->email }}</td>
                                        <td>{{ $caretaker->phone_number }}</td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.caretaker.edit', $caretaker->id) }}" 
                                                   class="btn btn-sm btn-outline-primary"
                                                   data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.caretaker.destroy', $caretaker->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="tooltip" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this caretaker?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .btn-group .btn {
        margin-right: 5px;
    }
    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    $(function () {
        $('[data-bs-toggle="tooltip"]').tooltip()
    })
</script>
@endpush
