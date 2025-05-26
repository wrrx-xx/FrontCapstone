<div class="list-group list-group-flush">
    <a class="list-group-item hover-primary-soft" href="{{ route('admin.transaction-logs.index') }}">
        <i class="fas fa-fw fa-history me-2"></i>All Transaction Logs
    </a>
    <a class="list-group-item hover-primary-soft" href="{{ route('admin.transaction-logs.export') }}">
        <i class="fas fa-fw fa-file-export me-2"></i>Export Logs
    </a>
</div>

<!-- Search and Filter Section -->
<div class="mt-3">
    <form action="{{ route('admin.transaction-logs.index') }}" method="GET" class="p-3">
        <div class="mb-3">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Search logs..." 
                   class="form-control">
        </div>

        <div class="mb-3">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        <div class="mb-3">
            <select name="action_type" class="form-select">
                <option value="">All Actions</option>
                <option value="payment" {{ request('action_type') == 'payment' ? 'selected' : '' }}>Payment</option>
                <option value="refund" {{ request('action_type') == 'refund' ? 'selected' : '' }}>Refund</option>
                <option value="adjustment" {{ request('action_type') == 'adjustment' ? 'selected' : '' }}>Adjustment</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-fw fa-search me-2"></i>Filter
        </button>
    </form>
</div> 