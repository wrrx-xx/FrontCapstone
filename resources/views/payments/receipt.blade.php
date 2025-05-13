<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt #{{ $payment->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            margin-bottom: 15px;
         
        }
        .logo img {
            width: 100px;
            height: auto;
        }
        .receipt-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        .receipt-id {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        .info-section {
            margin-bottom: 30px;
        }
        .info-row {
            display: flex;
            margin-bottom: 20px;
        }
        .info-col {
            flex: 1;
        }
        .info-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }
        .info-content {
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background-color: #84B0CA;
            color: white;
            text-align: left;
            padding: 10px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .amount-row {
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
            background-color: #28a745;
        }
        .divider {
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }
        .notes {
            font-style: italic;
            color: #666;
            margin-bottom: 30px;
        }
        .status-badge {
    padding: 0.25em 0.5em;
    border-radius: 0.25rem;
    color: white;
    font-weight: 600;
    text-transform: capitalize;
}

.status-badge.pending {
    background-color: #ffc107; /* Bootstrap warning color */
}

.status-badge.completed {
    background-color: #28a745; /* Bootstrap success color */
}

.status-badge.failed {
    background-color: #dc3545; /* Bootstrap danger color */
}

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <!-- Logo placeholder - you can replace with your actual logo -->
                <img src="assets/images/logo5.png" alt="logo">
            </div>
            <div class="receipt-title">PAYMENT RECEIPT</div>
            <div class="receipt-id">Receipt #{{ $payment->id }}</div>
        </div>

        <div class="info-row">
            <div class="info-col">
                <div class="info-title">BILLED TO:</div>
                <div class="info-content">
                    <strong>{{ $payment->listing->tenant->fname ?? 'N/A' }} {{ $payment->listing->tenant->mname ?? '' }} {{ $payment->listing->tenant->lname ?? 'N/A' }}</strong><br>
                    Email: {{ $payment->listing->tenant->email ?? '' }}<br>
                    Phone: {{ $payment->listing->tenant->phone_number ?? '' }}
                </div>
            </div>
            <div class="info-col">
                <div class="info-title">RECEIPT DETAILS:</div>
                <div class="info-content">
                    <strong>Date:</strong> {{ $payment->created_at->format('M d, Y') }}<br>
                    <strong>processed by:</strong> {{ $payment->processor->fname ?? '' }} {{ $payment->processor->mname ?? '' }} {{ $payment->processor->lname ?? '' }}
                    <br><br>
                    @php
                        $statusClass = strtolower($payment->status);
                    @endphp
                    <strong>Status:</strong> 
                    <span class="status-badge {{ $statusClass }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                    <br>
                </div>
            </div>
        </div>
    
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Unit Price</th>
                    @if(isset($reservation_amount) && $reservation_amount > 0)
                    <th>Reservation Fee</th>
                    @endif
                    <th>Cash Advance</th>
                    @if(isset($payment->billing) && $payment->billing->utility && $payment->billing->utility->count() > 0)
                    <th>Utility Amount</th>
                    @endif
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $payment->listing->title }}</td>
                    <td>{{ number_format($payment->listing->price, 2) }}</td>
                    @if(isset($reservation_amount) && $reservation_amount > 0)
                    <td>{{ number_format($reservation_amount, 2) }}</td>
                    <td>{{ number_format($payment->cash_advance_amount ?? 0, 2) }}</td>
                    @else
                    <td>{{ number_format($payment->cash_advance_amount ?? 0, 2) }}</td>
                    @endif
                    @if(isset($payment->billing) && $payment->billing->utility && $payment->billing->utility->count() > 0)
                    @php
                        $utilityTotal = $payment->billing->utility->sum('amount');
                    @endphp
                    <td>₱{{ number_format($utilityTotal, 2) }}</td>
                    @endif
                    @php
                        $totalAmount = $payment->listing->price + ($reservation_amount ?? 0) + ($payment->cash_advance_amount ?? 0) + ($utilityTotal ?? 0);
                    @endphp
                    <td>{{ number_format($totalAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>
        
        @if(isset($payment->billing) && $payment->billing->utility && $payment->billing->utility->count() > 0)
            <h3>Utility Bills</h3>
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payment->billing->utility as $utility)
                    <tr>
                        <td><i class="fas fa-bolt"></i> <strong>{{ ucfirst($utility->type) }}</strong></td>
                        <td>{{ number_format($utility->amount, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
           
        @endif
    
        <div class="info-row">
            <div class="info-col">
                <div class="info-title">PAYMENT INFORMATION:</div>
                <div class="info-content">
                    <strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}<br>
                    @if($payment->payment_method == 'gcash')
                    <strong>Reference Number:</strong> {{ $payment->reference_number ?? 'N/A' }}<br>
                    @endif
                    <strong>Payment Date:</strong> {{ $payment->created_at->format('M d, Y') }}
                </div>
            </div>
            <div class="info-col">
                <div class="info-title">PROPERTY DETAILS:</div>
                <div class="info-content">
                    <strong>Property:</strong> {{ $payment->listing->title }}<br>
                    <strong>Address:</strong> {{ $payment->listing->address }}, {{ $payment->listing->baranggay }}, {{ $payment->listing->city }}<br>
                    <strong>Type:</strong> {{ $payment->listing->type }}
                </div>
            </div>
        </div>
    
        <div class="divider"></div>
    
        <div class="notes">
            <p>Thank you for your payment. This receipt serves as proof of your payment for the property rental.</p>
            <p>For any inquiries regarding this payment, please contact our support team.</p>
        </div>
    
        <div class="footer">
            <p>This is an electronically generated receipt and does not require a signature.</p>
            <p>© {{ date('Y') }} RoomRental. All rights reserved.</p>
        </div>
    </div>
    
</body>
</html>
