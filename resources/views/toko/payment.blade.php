<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CIME | Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('dashboard2/assets/img/icons/logocime.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/order.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- Stepper -->
    <div class="stepper-wrapper">
        <div class="stepper-item completed" id="step-1">
            <div class="step-counter">1</div>
            <div class="step-name">Cart</div>
        </div>
        <div class="stepper-item completed" id="step-2">
            <div class="step-counter">2</div>
            <div class="step-name">Details</div>
        </div>
        <div class="stepper-item completed" id="step-3">
            <div class="step-counter">3</div>
            <div class="step-name">Shipping</div>
        </div>
        <div class="stepper-item active" id="step-4">
            <div class="step-counter">4</div>
            <div class="step-name">Payment</div>
        </div>
        <div class="stepper-item" id="step-5">
            <div class="step-counter">5</div>
            <div class="step-name">Review</div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="mb-4">Payment Method</h4>
                        
                        <div class="payment-options">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="midtrans" value="midtrans" checked>
                                    <label class="form-check-label" for="midtrans">
                                        <i class="bi bi-credit-card me-2"></i> Online Payment (Midtrans)
                                    </label>
                                </div>
                                <small class="text-muted d-block ms-4">Pay securely using credit card, bank transfer, or e-wallet</small>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod">
                                    <label class="form-check-label" for="cod">
                                        <i class="bi bi-cash me-2"></i> Cash on Delivery
                                    </label>
                                </div>
                                <small class="text-muted d-block ms-4">Pay when your order arrives</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('shipping') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-2"></i> Back
                            </a>
                            <button type="button" id="pay-button" class="btn btn-danger">
                                Continue to Review <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
    document.getElementById('pay-button').addEventListener('click', function() {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const button = this;
        
        if (paymentMethod === 'midtrans') {
            // Disable button and show loading state
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Processing...';

            // Get snap token from server
            fetch('{{ route("payment.create-snap-token") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            // Mark as paid in session
                            fetch('/set-payment-method', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ method: 'midtrans', paid: true })
                            }).then(() => {
                                window.location.href = '{{ route("review") }}';
                            });
                        },
                        onPending: function(result) {
                            // Only redirect for certain payment types (e.g., bank_transfer)
                            if (result.payment_type === 'bank_transfer') {
                                window.location.href = '{{ route("review") }}';
                            } else {
                                // For QRIS/GoPay, show a message and let user refresh manually
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Payment Pending',
                                    text: 'Please complete your payment in your e-wallet app. This page will update automatically once payment is confirmed.',
                                    confirmButtonText: 'OK'
                                });
                                button.disabled = false;
                                button.innerHTML = 'Continue to Review <i class="bi bi-arrow-right ms-2"></i>';
                            }
                        },
                        onError: function(result) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Payment Failed',
                                text: 'Please try again or choose a different payment method.',
                                confirmButtonText: 'Try Again'
                            });
                            button.disabled = false;
                            button.innerHTML = 'Continue to Review <i class="bi bi-arrow-right ms-2"></i>';
                        },
                        onClose: function() {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Payment Cancelled',
                                text: 'You closed the payment window. Please complete your payment to proceed.',
                                confirmButtonText: 'OK'
                            });
                            button.disabled = false;
                            button.innerHTML = 'Continue to Review <i class="bi bi-arrow-right ms-2"></i>';
                        }
                    });
                } else {
                    throw new Error(data.error || 'Failed to initialize payment');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Payment Error',
                    text: error.message || 'Failed to initialize payment. Please try again.',
                    confirmButtonText: 'Try Again'
                });
                button.disabled = false;
                button.innerHTML = 'Continue to Review <i class="bi bi-arrow-right ms-2"></i>';
            });
        } else {
            // For COD, just proceed to review
            fetch('/set-payment-method', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ method: 'cod', paid: false })
            }).then(() => {
                window.location.href = '{{ route("review") }}';
            });
        }
    });
    </script>
</body>
</html>
