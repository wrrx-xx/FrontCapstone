@extends('layouts.app')

@section('content')
<div class="main-content">

<div class="container">
    <h2>Payment History</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Month</th>
                <th>Rent</th>
                <th>Water Bill</th>
                <th>Electricity Bill</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>March 2025</td>
                <td>$500</td>
                <td>$30</td>
                <td>$50</td>
                <td><strong>$580</strong></td>
                <td><span class="badge bg-success">Paid</span></td>
            </tr>
            <tr>
                <td>February 2025</td>
                <td>$500</td>
                <td>$28</td>
                <td>$45</td>
                <td><strong>$573</strong></td>
                <td><span class="badge bg-success">Paid</span></td>
            </tr>
            <tr>
                <td>January 2025</td>
                <td>$500</td>
                <td>$25</td>
                <td>$48</td>
                <td><strong>$573</strong></td>
                <td><span class="badge bg-warning">Pending</span></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
@endsection
