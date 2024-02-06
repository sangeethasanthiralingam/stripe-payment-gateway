<!-- resources/views/payment.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Payment</title>
</head>
<body>
    <h1>Process Payment</h1>
    <form action="{{ route('process.payment') }}" method="POST">
        @csrf
        <label for="card_number">Card Number:</label><br>
        <input type="text" id="card_number" name="card_number"><br>
        
        <label for="exp_month">Expiration Month:</label><br>
        <input type="text" id="exp_month" name="exp_month"><br>
        
        <label for="exp_year">Expiration Year:</label><br>
        <input type="text" id="exp_year" name="exp_year"><br>
        
        <label for="cvc">CVC:</label><br>
        <input type="text" id="cvc" name="cvc"><br>
        
        <label for="amount">Amount (in cents):</label><br>
        <input type="text" id="amount" name="amount"><br>
        
        <button type="submit">Submit Payment</button>
    </form>
</body>
</html>
