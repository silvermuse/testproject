{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Bill - Pizza Order System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .bill-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }

        .bill-header {
            text-align: center;
            border-bottom: 3px dashed #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .bill-header h1 {
            color: #ff6b6b;
            font-size: 32px;
            margin-bottom: 5px;
        }

        .bill-header p {
            color: #666;
            font-size: 14px;
        }

        .order-items {
            margin-bottom: 30px;
        }

        .order-item {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 5px;
        }

        .item-name {
            color: #333;
            font-size: 18px;
            font-weight: 600;
            flex: 1;
        }

        .item-line-total {
            color: #ff6b6b;
            font-size: 18px;
            font-weight: 700;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        .item-quantity {
            font-weight: 500;
        }

        .item-unit-price {
            font-style: italic;
        }

        .total-section {
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            color: white;
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .total-amount {
            color: white;
            font-size: 36px;
            font-weight: 900;
        }

        .summary-box {
            background: #fff9e6;
            border-left: 4px solid #ffa500;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .summary-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .summary-detail {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .thank-you {
            text-align: center;
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .btn-new-order {
            width: 100%;
            padding: 15px;
            background: #333;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-new-order:hover {
            background: #555;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .emoji {
            font-size: 48px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="bill-container">
        <div class="bill-header">
            <h1>🍕 Order Bill</h1>
            <p>Thank you for your order!</p>
        </div>

        <div class="emoji">🎉</div>

        <div class="summary-box">
            <div class="summary-title">Order Summary:</div>
            <div class="summary-detail">
                <strong>Total Items:</strong> {{ count($orderItems) }}
            </div>
            <div class="summary-detail">
                <strong>Total Pizzas:</strong> {{ array_sum(array_column($orderItems, 'quantity')) }}
            </div>
        </div>

        <div class="order-items">
            @foreach($orderItems as $item)
                <div class="order-item">
                    <div class="item-header">
                        <span class="item-name">{{ $item['description'] }}</span>
                        <span class="item-line-total">RM {{ number_format($item['line_total'], 2) }}</span>
                    </div>
                    <div class="item-details">
                        <span class="item-quantity">Qty: {{ $item['quantity'] }}</span>
                        <span class="item-unit-price">@ RM {{ number_format($item['unit_price'], 2) }} each</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="total-section">
            <div class="total-row">
                <span class="total-label">Grand Total:</span>
                <span class="total-amount">RM {{ number_format($total, 2) }}</span>
            </div>
        </div>

        <div class="thank-you">
            Your pizzas will be ready soon! 🍕✨
        </div>

        <a href="{{ route('pizza.order') }}" class="btn-new-order">
            Place New Order
        </a>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Bill - Pizza Order System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .bill-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }

        .bill-header {
            text-align: center;
            border-bottom: 3px dashed #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .bill-header h1 {
            color: #ff6b6b;
            font-size: 32px;
            margin-bottom: 5px;
        }

        .bill-header p {
            color: #666;
            font-size: 14px;
        }

        .order-items {
            margin-bottom: 30px;
        }

        .order-item {
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 5px;
        }

        .item-name {
            color: #333;
            font-size: 18px;
            font-weight: 600;
            flex: 1;
        }

        .item-line-total {
            color: #ff6b6b;
            font-size: 18px;
            font-weight: 700;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }

        .item-quantity {
            font-weight: 500;
        }

        .item-unit-price {
            font-style: italic;
        }

        .total-section {
            background: linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%);
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            color: white;
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .total-amount {
            color: white;
            font-size: 36px;
            font-weight: 900;
        }

        .summary-box {
            background: #fff9e6;
            border-left: 4px solid #ffa500;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .summary-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .summary-detail {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .thank-you {
            text-align: center;
            color: #666;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-home {
            padding: 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-home:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-new-order {
            padding: 15px;
            background: #333;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .btn-new-order:hover {
            background: #555;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .button-group {
                grid-template-columns: 1fr;
            }
        }

        .emoji {
            font-size: 48px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="bill-container">
        <div class="bill-header">
            <h1>🍕 Order Bill</h1>
            <p>Thank you for your order!</p>
        </div>

        <div class="emoji">🎉</div>

        <div class="summary-box">
            <div class="summary-title">Order Summary:</div>
            <div class="summary-detail">
                <strong>Total Items:</strong> {{ count($orderItems) }}
            </div>
            <div class="summary-detail">
                <strong>Total Pizzas:</strong> {{ array_sum(array_column($orderItems, 'quantity')) }}
            </div>
        </div>

        <div class="order-items">
            @foreach($orderItems as $item)
                <div class="order-item">
                    <div class="item-header">
                        <span class="item-name">{{ $item['description'] }}</span>
                        <span class="item-line-total">RM {{ number_format($item['line_total'], 2) }}</span>
                    </div>
                    <div class="item-details">
                        <span class="item-quantity">Qty: {{ $item['quantity'] }}</span>
                        <span class="item-unit-price">@ RM {{ number_format($item['unit_price'], 2) }} each</span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="total-section">
            <div class="total-row">
                <span class="total-label">Grand Total:</span>
                <span class="total-amount">RM {{ number_format($total, 2) }}</span>
            </div>
        </div>

        <div class="thank-you">
            Your pizzas will be ready soon! 🍕✨
        </div>

        <div class="button-group">
            <a href="/" class="btn-home">
                🏠 Home
            </a>
            <a href="{{ route('pizza.order') }}" class="btn-new-order">
                🔄 New Order
            </a>
        </div>
    </div>
</body>
</html>