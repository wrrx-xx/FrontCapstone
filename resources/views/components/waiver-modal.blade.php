<!-- Waiver Modal -->
<div class="modal fade" id="waiverModalView" tabindex="-1" aria-labelledby="waiverModalViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="waiverModalViewLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 80vh;">
                <iframe src="{{ asset($waiverFile) }}" frameborder="0" style="width: 100%; height: 100%;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var openWaiverModalBtn = document.getElementById('openWaiverModal');
        var waiverModalView = document.getElementById('waiverModalView');
        
        if (openWaiverModalBtn && waiverModalView) {
            var waiverModal = new bootstrap.Modal(waiverModalView, {
                keyboard: true,
                backdrop: true
            });

            openWaiverModalBtn.addEventListener('click', function(e) {
                e.preventDefault();
                waiverModal.show();
            });

            // Close button handler
            var closeButtons = waiverModalView.querySelectorAll('[data-bs-dismiss="modal"]');
            closeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    waiverModal.hide();
                });
            });

            // Handle ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && waiverModalView.classList.contains('show')) {
                    waiverModal.hide();
                }
            });
        }
    });
</script>
