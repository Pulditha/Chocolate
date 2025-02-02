<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order, {{ $order->name }}!</h1>
    <p>Your order has been placed successfully.</p>
    <p><strong>Order Details:</strong></p>
    <ul>
        <li><strong>Order ID:</strong> {{ $order->id }}</li>
        <li><strong>Email:</strong> {{ $order->email }}</li>
        <li><strong>Phone:</strong> {{ $order->phone }}</li>
        <li><strong>Address:</strong> {{ $order->address }}</li>
        <li><strong>Total Amount:</strong> LKR {{ number_format($order->total_amount, 2) }}</li>
        <li><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</li>
    </ul>
    <p>We appreciate your business and hope you enjoy your chocolates!</p>
</body>
</html>
