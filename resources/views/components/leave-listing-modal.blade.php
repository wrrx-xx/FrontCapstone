@props(['listing', 'modalId' => 'leaveListingModal'])

<div class="modal fade" id="{{ $modalId }}" tabindex="-1"
    aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="{{ $modalId }}Form" action="{{ route('tenant.rental.leave', $listing->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $modalId }}Label">Confirm Leave Listing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger fw-bold">
                        Please be aware of the
                       User Agreement
                        and the
                        <button type="button" class="btn btn-link p-0 m-0 align-baseline" data-bs-toggle="modal" data-bs-target="#waiverModal{{ $listing->id }}">
                            Terms and Conditions
                        </button>.
                    </p>
                    <p>Are you sure you want to leave this listing?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes, Leave Listing</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Waiver Modal -->
<div class="modal fade" id="waiverModal{{ $listing->id }}" tabindex="-1" aria-labelledby="waiverModalLabel{{ $listing->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="waiverModalLabel{{ $listing->id }}">Terms and Conditions (Waiver)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height:80vh;">
                @if($listing->waiver_file)
                    <iframe src="{{ asset($listing->waiver_file) }}" width="100%" height="100%" style="border:none;"></iframe>
                @else
                    <p>No waiver file uploaded for this listing.</p>
                @endif
            </div>
        </div>
    </div>
</div>
