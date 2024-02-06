<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charge Payment</title>
</head>
<body>
    <h1>Charge Payment</h1>
    <form id="payment-form" action="{{ route('process.charge') }}" method="POST">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        
        <label for="amount">Amount (in cents):</label><br>
        <input type="text" id="amount" name="amount"><br>
        
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
        
        <button type="submit">Submit Payment</button>
    </form>

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('sk_test_51OgmYFJtZ5BpZMH17e6QxCiMAGDiwJ6IJdK85tSaT2f8jbWsTh73r9jMUtBaSQ8Umx2UVDDkClrZvZZlT8ZNCFeG00F7nb6LGM');
        var elements = stripe.elements();

        // Create an instance of the card Element.
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div.
        card.mount('#card-element');

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Insert the token ID into the form so it gets submitted to the server.
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form.
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
