<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 20px;">

    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #333;">Hello {{ $order->firstname }},</h2>
        <p style="font-size: 16px;">Thank you for your order at <strong>Hamro Pahiran</strong>!</p>

        <div style="margin-top: 20px;">
            <p style="margin: 5px 0;"><strong>Order ID:</strong> #{{ $order->id }}</p>
            <p style="margin: 5px 0;"><strong>Total Amount:</strong> Rs. {{ number_format($order->total_amount, 2) }}</p>
            <p style="margin: 5px 0;"><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
        </div>

        <h3 style="margin-top: 30px; color: #444;">Order Details</h3>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="background-color: #f0f0f0;">
                    <th style="padding: 10px; border: 1px solid #ddd;">Outfit</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Qty</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Price (Rs)</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Total (Rs)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $item->outfit->name }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $item->quantity }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ number_format($item->price, 2) }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top: 30px; font-size: 16px;">We will notify you once your order is packed and ready to ship.</p>

        <p style="margin-top: 40px;">Warm regards,<br><strong>Hamro Pahiran Team</strong></p>
    </div>

</body>
</html>
