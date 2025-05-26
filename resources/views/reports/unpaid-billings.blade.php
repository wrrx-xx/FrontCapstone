<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Unpaid Billings Report - {{ $month }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333;
            margin-bottom: 5px;
        }
        .header p {
            color: #666;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        .total-row {
            font-weight: bold;
            background-color: #f5f5f5;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Unpaid Billings Report</h1>
        <p>For the month of {{ $month }}</p>
        <p>Generated on {{ now()->format('F d, Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Property</th>
                <th>Tenant</th>
                <th>Contact</th>
                <th>Due Date</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unpaidTenants as $tenant)
            <tr>
                <td>{{ $tenant['property'] }}</td>
                <td>{{ $tenant['tenant'] }}</td>
                <td>
                    Phone: {{ $tenant['contact']['phone'] }}<br>
                    Email: {{ $tenant['contact']['email'] }}
                </td>
                <td>{{ $tenant['due_date']->format('M d, Y') }}</td>
                <td>
                    Total: ₱{{ number_format($tenant['amount'], 2) }}<br>
                    Rent: ₱{{ number_format($tenant['rent'], 2) }}<br>
                    Utilities: ₱{{ number_format($tenant['utilities'], 2) }}
                </td>
                <td>
                    @if($tenant['days_overdue'])
                        {{ $tenant['days_overdue'] }} days overdue
                    @else
                        Pending
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" style="text-align: right;">Total Unpaid Amount:</td>
                <td colspan="2">₱{{ number_format($totalUnpaid, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>This report was generated for {{ $owner->fname }} {{ $owner->lname }}</p>
        <p>Property Management System</p>
    </div>
</body>
</html> 