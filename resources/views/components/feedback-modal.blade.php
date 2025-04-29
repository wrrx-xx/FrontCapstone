<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white">
                <h5 class="modal-title">{{ session('success') ? 'Success!' : 'Oops!' }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                @if (session('success'))
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                    <p class="mt-3">{{ session('success') }}</p>
                @endif

                @if ($errors->any())
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                    <ul class="mt-3 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
