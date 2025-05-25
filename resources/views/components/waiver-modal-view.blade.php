@props(['waiverFile', 'listingId'])

<!-- Waiver Modal -->
<div class="modal fade" id="waiverModal{{ $listingId }}" tabindex="-1" aria-labelledby="waiverModalLabel{{ $listingId }}" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="waiverModalLabel{{ $listingId }}">Terms and Conditions (Waiver)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height:80vh;">
                @if($waiverFile)
                    <iframe src="{{ asset($waiverFile) }}" width="100%" height="100%" style="border:none;"></iframe>
                @else
                    <p>No waiver file uploaded for this listing.</p>
                @endif
            </div>

        </div>
    </div>
</div>

@once
@push('scripts')
<script>
    window.addEventListener('DOMContentLoaded', function() {
        // Initialize waiver modal
        var waiverModalElement = document.getElementById('waiverModalView');
        if (waiverModalElement) {
            var waiverModal = new bootstrap.Modal(waiverModalElement, {
                backdrop: 'static',
                keyboard: true,
                focus: true
            });

            // Open modal handler
            document.getElementById('openWaiverModal')?.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                waiverModal.show();
            });

            // Close button handler
            waiverModalElement.querySelectorAll('[data-bs-dismiss="modal"]').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    waiverModal.hide();
                });
            });

            // Backdrop click handler
            waiverModalElement.addEventListener('click', function(e) {
                if (e.target === waiverModalElement) {
                    waiverModal.hide();
                }
            });

            // Handle ESC key
            waiverModalElement.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    waiverModal.hide();
                }
            });

            // Clean up when modal is hidden
            waiverModalElement.addEventListener('hidden.bs.modal', function() {
                // Any cleanup needed
            });
        }
    });
</script>
@endpush
@endonce
