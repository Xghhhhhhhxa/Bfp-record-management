<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .payment-option {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
        }
        .payment-option:hover {
            background-color: #f8f9fa;
        }
        .payment-method-container {
            display: none;
            margin-top: 20px;
        }
        #qr-code {
            width: 100%;
            max-width: 300px;
            display: none;
            margin-top: 20px;
        }
        #cash-message {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Navbar for Home -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Payment System</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dshbrdins.php">Home</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Payment Method Content -->
    <div class="container mt-5">
        <h2 class="text-center">Choose Your Payment Method</h2>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <div class="payment-option" data-method="gcash">
                    <h5>GCash</h5>
                    <p>Select GCash for online payment via your mobile wallet.</p>
                </div>
                <div class="payment-option" data-method="cash">
                    <h5>Cash</h5>
                    <p>Choose Cash if you're paying in-person or upon delivery.</p>
                </div>
            </div>
        </div>

        <!-- Payment Method Container -->
        <div class="payment-method-container" id="payment-method-container">
            <div id="gcash-method" style="display:none;">
                <h4>Scan the GCash QR Code</h4>
                <img src="https://via.placeholder.com/300x300.png?text=GCash+QR+Code" id="qr-code" alt="GCash QR Code">
            </div>
            <div id="cash-method" style="display:none;">
                <h4>Please prepare the cash for payment.</h4>
                <p id="cash-message">Thank you for choosing Cash! Please have the exact amount ready for the payment.</p>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <button class="btn btn-primary w-100" id="continueBtn" disabled>Continue</button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle click on payment options
            $('.payment-option').click(function() {
                const method = $(this).data('method');
                // Hide both method contents initially
                $('#gcash-method').hide();
                $('#cash-method').hide();
                $('#qr-code').hide();
                $('#payment-method-container').show();
                // Enable the continue button
                $('#continueBtn').prop('disabled', false);

                // Show selected payment method
                if (method === 'gcash') {
                    $('#gcash-method').show();
                    $('#qr-code').show(); // Display QR code for GCash
                } else if (method === 'cash') {
                    $('#cash-method').show();
                    $('#cash-message').show(); // Show message for Cash
                }
            });

            // Handle Continue button click
            $('#continueBtn').click(function() {
                const selectedMethod = $('.payment-option.selected').data('method');
                alert('You selected ' + selectedMethod + ' as your payment method.');
            });
        });
    </script>
</body>
</html>
