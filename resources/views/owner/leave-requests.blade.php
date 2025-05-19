@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <h1 class="h3 mb-4">Leave Requests</h1>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($leaveRequests->isEmpty())
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No pending leave requests</h5>
                            </div>
                        </div>
                    @else
                        <div class="row g-4">
                            @foreach ($leaveRequests as $request)
                                <div class="col-12">
                                    <x-leave-request-card :request="$request" />
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
