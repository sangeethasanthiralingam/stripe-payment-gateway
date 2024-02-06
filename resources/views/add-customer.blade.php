<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customer</title>
</head>
<body>
    <h1>Add New Customer</h1>
    <form action="/add-customer" method="POST">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>
        
        <button type="submit">Add Customer</button>
    </form>
</body>
</html>
