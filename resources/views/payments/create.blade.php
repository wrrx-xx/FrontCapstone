@extends('layouts.app')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <h1>Payment for Reservation</h1>
                <form id="paymentForm" action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                    <input type="hidden" name="listing_id" value="{{ $reservation->listing_id }}">
                    <input type="hidden" name="amount" value="{{ $reservation->listing->price }}">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price" id="price"
                                    value="{{ $reservation->listing->price }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="reservation_amount" class="form-label">Reservation Amount</label>
                                <input type="text" class="form-control" name="reservation_amount" id="reservation_amount"
                                    value="{{ $reservation->listing->reservation_amount }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="total_amount" class="form-label">Total Amount</label>
                        <input type="text" class="form-control" name="total_amount" id="total_amount"
                            value="{{ $reservation->listing->price + $reservation->listing->reservation_amount }}" readonly>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="cash_advance" name="cash_advance"
                            value="1">
                        <label class="form-check-label" for="cash_advance">Apply Cash Advance</label>
                    </div>

                    <div id="cash-advance-popup" style="display: none;">
                        <h3>Cash Advance Form</h3>
                        <div class="mb-3">
                            <label for="cash_advance_amount" class="form-label">Cash Advance Amount</label>
                            <input type="text" class="form-control" name="cash_advance_amount" id="cash_advance_amount">
                        </div>
                    </div>

                    <div id="gcash-fields" style="display: none;">
                        <h3>Gcash</h3>
                        <div class="mb-3">
                            <label for="reference_number" class="form-label">Reference Number</label>
                            <input type="text" class="form-control" name="reference_number" id="reference_number">
                        </div>

                        <div class="mb-3">
                            <label for="screenshot" class="form-label">Upload Payment Screenshot</label>
                            <input type="file" class="form-control" name="screenshot" id="screenshot" accept="image/*">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" name="payment_method" id="payment_method" required>
                            <option value="cash" selected>Cash</option>
                            <option value="gcash">GCash</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="successModalLabel">Payment Successful</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-body">
                    <div class="container mb-5 mt-3">
                    
                
                      <div class="container">
                        <div class="col-md-12">
                          <img src="{{ asset('assets/images/logo.svg') }}" >
                
                        </div>
                
                
                        <div class="row">
                          <div class="col-xl-8">
                            <ul class="list-unstyled">
                              <li class="text-muted">To: <span style="color:#5d9fc5 ;">{{ $prospect->fname }} {{ $prospect->mname }} {{ $prospect->lname }}</span></li>
                              <li class="text-muted">Email Address: <span style="color:#5d9fc5 ;">{{ $prospect->email}}</span></li>
                              <li class="text-muted">Phone Number: <i class="fas fa-phone"></i> {{ $prospect->phone_number }}</li>
                            </ul>
                          </div>
                          <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="fw-bold">ID:</span>#<span id="paymentId"></span></li>

                                  <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                    class="fw-bold">Processed by:</span>{{ $user->fname }} {{ $user->mname }} {{ $user->lname }}</li>
                              <span class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                  class="fw-bold">Creation Date: </span>{{ $reservation->created_at->format('M d, Y') }}</span></li>
              
                            </ul>
                          </div>
                        </div>
                
                        <div class="row my-2 mx-1 justify-content-center">
                          <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Description</th>
                                
                                <th scope="col">Unit Price</th>
                                <th scope="col">Reservation</th>
                                <th scope="col">Total</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row">1</th>
                                <td>{{ $listing->title }}</td>
                              
                                <td>${{ $listing->price }}</td>
                                <td>${{ $listing->reservation_amount }}</td>
                                <td>${{ $listing->price  + $listing->reservation_amount }}</td>
                              </tr>
                             
                            </tbody>
                
                          </table>
                        </div>
                        <div class="row">
                          <div class="col-xl-8">
                            <p class="ms-3">Add additional notes and payment information</p>
                
                          </div>
                         
                        </div>

                        <hr>
                        <div class="row">
                          <div class="col-xl-10">
                            <p>Thank you for your purchase</p>
                          </div>
                      
                        </div>
                
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('booking.owner') }}" class="btn btn-primary">Return to Home</a>
                <a href="#" id="downloadReceipt" class="btn btn-success">Download Receipt</a>
              </div>
          </div>
      </div>  
      
  </div>

    <script>
        document.getElementById('cash_advance').addEventListener('change', function() {
            var cashAdvancePopup = document.getElementById('cash-advance-popup');
            cashAdvancePopup.style.display = this.checked ? 'block' : 'none';
        });

        document.getElementById('payment_method').addEventListener('change', function() {
            var gcashFields = document.getElementById('gcash-fields');
            gcashFields.style.display = this.value === 'gcash' ? 'block' : 'none';
        });

        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            if (!confirm("Are you sure you want to proceed with the payment?")) {
                return; // Stop submission if the user cancels
            }

            var formData = new FormData(this); // Create a FormData object
            var cashAdvanceAmount = document.getElementById('cash_advance_amount').value || 0; // Get cash advance amount
            formData.append('cash_advance_amount', cashAdvanceAmount); // Append cash advance amount to form data

            fetch('{{ route('payment.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show the success modal
                    var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                    // Set the payment ID in the modal
                    document.getElementById('paymentId').innerText = data.payment_id;
                    // Set the download link for the receipt
                    document.getElementById('downloadReceipt').href = "{{ url('receipt/download') }}/" + data.payment_id;
                } else {
                    // Handle error response
                    alert('Payment failed: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while processing your payment. Please try again.');
            });
        });
</script>
</div>

@endsection
