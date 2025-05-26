@props(['listings'])

<div class="card shadow-sm border-0 rounded-3 bg-white">
    <div class="card-header bg-transparent border-0 py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="fas fa-exclamation-triangle me-2"></i>Unpaid Billings
            </h5>
            <div class="d-flex gap-2">
                <form action="{{ route('payment.unpaid.download') }}" method="GET" class="d-inline">
                    <input type="hidden" name="month" value="{{ request('month', now()->format('Y-m')) }}">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-download me-1"></i> Download Report
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Month Filter -->
        <div class="row mb-4">
            <div class="col-md-4">
                <form action="{{ request()->url() }}" method="GET" class="d-flex gap-2">
                    <input type="month" 
                           name="month" 
                           class="form-control" 
                           value="{{ request('month', now()->format('Y-m')) }}"
                           onchange="this.form.submit()">
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Property</th>
                        <th>Tenant</th>
                        <th>Due Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $selectedMonth = request('month', now()->format('Y-m'));
                        $totalUnpaid = 0;
                    @endphp
                    @foreach($listings as $listing)
                        @foreach($listing->getUnpaidBillings($selectedMonth) as $billing)
                            @php
                                $totalUnpaid += $billing->getTotalAmount();
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-2">
                                            <i class="fas fa-home text-secondary"></i>
                                        </div>
                                        <div>
                                            {{ $listing->title }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($billing->user)
                                        {{ $billing->user->fname }} {{ $billing->user->lname }}
                                    @else
                                        <span class="text-muted">No tenant assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $billing->isOverdue() ? 'bg-danger' : 'bg-warning' }}">
                                        {{ $billing->due_date->format('M d, Y') }}
                                        @if($billing->isOverdue())
                                            <br>
                                            <small>{{ $billing->getDaysOverdue() }} days overdue</small>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold">₱{{ number_format($billing->getTotalAmount(), 2) }}</div>
                                    <small class="text-muted">
                                        Rent: ₱{{ number_format($billing->amount, 2) }}
                                        @if($billing->utility->sum('amount') > 0)
                                            <br>Utilities: ₱{{ number_format($billing->utility->sum('amount'), 2) }}
                                        @endif
                                    </small>
                                </td>
                                <td>
                                    <span class="badge {{ $billing->isOverdue() ? 'bg-danger' : 'bg-warning' }}">
                                        {{ $billing->isOverdue() ? 'Overdue' : 'Pending' }}
                                    </span>
                                </td>
                                
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total Unpaid Amount:</td>
                        <td colspan="3" class="fw-bold">₱{{ number_format($totalUnpaid, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div> 