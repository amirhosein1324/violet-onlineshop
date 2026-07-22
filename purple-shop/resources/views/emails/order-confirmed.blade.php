<!DOCTYPE html>
<html>
<head>
    <style>
        body { background-color: #0f172a; color: #f8fafc; font-family: sans-serif; padding: 20px; }
        .card { background-color: #1e293b; border: 1px solid #334155; border-radius: 12px; padding: 24px; max-width: 600px; margin: auto; }
        .title { color: #c084fc; font-size: 24px; font-weight: bold; margin-bottom: 12px; }
        .item { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #334155; }
        .total { font-size: 18px; font-weight: bold; color: #a855f7; margin-top: 16px; text-align: right; }
    </style>
</head>
<body>
    <div class="card">
        <h1 class="title">Thank You for Your Order!</h1>
        <p>Your order <strong>#{{ $this->order->id }}</strong> has been confirmed and is being processed.</p>
        
        <h3>Order Summary</h3>
        <div class="item">
            <span>Customer:</span>
            <span>{{ $this->order->customer_name }}</span>
        </div>
        <div class="item">
            <span>Email:</span>
            <span>{{ $this->order->customer_email }}</span>
        </div>
        <div class="total">
            Total Paid: ${{ number_format($this->order->total, 2) }}
        </div>
    </div>
</body>
</html>