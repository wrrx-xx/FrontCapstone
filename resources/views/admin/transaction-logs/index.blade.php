@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Transaction Logs</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.transaction-logs.export') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-file-export"></i> Export Logs
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <form action="{{ route('admin.transaction-logs.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">All Users</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">All Statuses</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="action_type">Action Type</label>
                                    <select name="action_type" id="action_type" class="form-control">
                                        <option value="">All Actions</option>
                                        <option value="payment_created" {{ request('action_type') == 'payment_created' ? 'selected' : '' }}>Payment Created</option>
                                        <option value="payment_approved" {{ request('action_type') == 'payment_approved' ? 'selected' : '' }}>Payment Approved</option>
                                        <option value="payment_declined" {{ request('action_type') == 'payment_declined' ? 'selected' : '' }}>Payment Declined</option>
                                        <option value="billing_created" {{ request('action_type') == 'billing_created' ? 'selected' : '' }}>Billing Created</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="date_from">Date From</label>
                                    <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="date_to">Date To</label>
                                    <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Transaction Logs Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Processor</th>
                                    <th>Amount</th>
                                    <th>Cash Advance</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Action Type</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactionLogs as $log)
                                    <tr>
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->user->name }}</td>
                                        <td>{{ $log->processor ? $log->processor->name : 'N/A' }}</td>
                                        <td>₱{{ number_format($log->amount, 2) }}</td>
                                        <td>
                                            @if($log->cash_advance_amount)
                                                ₱{{ number_format($log->cash_advance_amount, 2) }}
                                                @if($log->cash_advance_used)
                                                    (Used: ₱{{ number_format($log->cash_advance_used, 2) }})
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($log->payment_method) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $log->status == 'completed' ? 'success' : ($log->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($log->status) }}
                                            </span>
                                        </td>
                                        <td>{{ str_replace('_', ' ', ucfirst($log->action_type)) }}</td>
                                        <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin.transaction-logs.show', $log->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No transaction logs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $transactionLogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 