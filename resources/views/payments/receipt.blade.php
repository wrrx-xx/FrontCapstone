<!-- resources/views/payments/receipt.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; }
        .header { text-align: center; }
        .details { margin-top: 20px; }
        .footer { margin-top: 30px; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Payment Receipt</h2>
        </div>
        <div class="details">
            <p><strong>Tenant:</strong> {{ $tenant->fname ?? '' }} {{ $tenant->mname ?? '' }} {{ $tenant->lname ?? '' }}</p>
            <p><strong>Processed By:</strong> {{ $processed_by->fname ?? '' }} {{ $processed_by->mname ?? '' }} {{ $processed_by->lname ?? '' }}</p>
            <p><strong>Listing:</strong> {{ $listing->title }}</p>
            <p><strong>Amount Paid:</strong> ₱ {{ number_format($payment->amount, 2) }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($payment->payment_method) }}</p>
            <p><strong>Date:</strong> {{ $payment->created_at->format('F d, Y h:i A') }}</p>
        </div>
        <div class="footer">
            <p>Thank you for your payment!</p>
        </div>
    </div>
</body>
</html>
