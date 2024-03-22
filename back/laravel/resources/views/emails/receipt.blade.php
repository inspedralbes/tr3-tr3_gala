<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .receipt {
            width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }
        .receipt h1 {
            color: #333;
        }
        .receipt p {
            color: #666;
        }
        .receipt ul {
            list-style-type: none;
        }
        .receipt li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Receipt for Your Purchase</h1>

        <p>Thank you for your purchase. Here are the details:</p>

        <p>Session ID: {{ $data['session'] }}</p>

        <h2>Seats:</h2>
        <ul>
        @foreach ($data['seats'] as $seat)
            <li>Seat ID: {{ $seat['id'] }}, Price: {{ $seat['price'] }}</li>
        @endforeach
        </ul>

        <p>Total Price: {{ $data['totalPrice'] }}</p>

        <p>Thanks,<br>
        {{ config('app.name') }}</p>
    </div>
</body>
</html>