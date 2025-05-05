<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');
        
        :root {
            --primary-color: #2a4365;
            --gold-accent: #d4af37;
            --light-gold: #f0e6cc;
            --dark-text: #2c3e50;
            --light-text: #7f8c8d;
            --white: #ffffff;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f4e9;
            margin: 0;
            padding: 40px 20px;
            color: var(--dark-text);
            line-height: 1.6;
        }
        
        .container {
            max-width: 600px;
            margin: auto;
            background: var(--white);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-top: 6px solid var(--gold-accent);
        }
        
        .header {
            text-align: center;
            padding-bottom: 30px;
            position: relative;
        }
        
        .header h1 {
            color: var(--primary-color);
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .header h1:after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: var(--gold-accent);
            margin: 15px auto;
        }
        
        .hotel-info {
            text-align: center;
            margin: 25px 0;
            font-size: 15px;
            color: var(--light-text);
        }
        
        .hotel-name {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: var(--primary-color);
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .details {
            margin-top: 30px;
        }
        
        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: var(--dark-text);
        }
        
        .confirmation-text {
            background: rgba(212, 175, 55, 0.1);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid var(--gold-accent);
        }
        
        .invoice {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 30px 0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .invoice th {
            background: var(--primary-color);
            color: var(--white);
            padding: 15px;
            text-align: left;
            font-weight: 500;
        }
        
        .invoice td {
            padding: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .invoice tr:last-child td {
            border-bottom: none;
        }
        
        .invoice tr:nth-child(even) {
            background-color: rgba(212, 175, 55, 0.03);
        }
        
        .total {
            text-align: right;
            font-size: 20px;
            font-weight: 600;
            color: var(--primary-color);
            margin: 25px 0;
        }
        
        .total-amount {
            color: var(--gold-accent);
            font-size: 24px;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 15px;
            color: var(--light-text);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding-top: 30px;
        }
        
        .footer strong {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .contact-link {
            color: var(--gold-accent);
            text-decoration: none;
            font-weight: 500;
        }
        
        .contact-link:hover {
            text-decoration: underline;
        }
        
        .highlight {
            color: var(--gold-accent);
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>Booking Confirmation</h1>
        <p>Thank you for choosing</p>
        <div class="hotel-name">The Star Hotel</div>
    </div>

    <!-- Hotel Info -->
    <div class="hotel-info">
        <p>Kathmandu, Nepal</p>
        <p>Phone: +977-1-XXXXXXX | Email: <a href="mailto:support@starhotel.com" class="contact-link">support@starhotel.com</a></p>
    </div>

    <!-- Booking Details -->
    <div class="details">
        <div class="greeting">
            <p><strong>Dear {{ $name }},</strong></p>
        </div>
        
        <div class="confirmation-text">
            <p>Your booking for <span class="highlight">{{ $room_name }}</span> is confirmed.</p>
            <p>We are delighted to welcome you to our hotel and look forward to providing you with an exceptional stay.</p>
        </div>

        <!-- Invoice Table -->
        <table class="invoice">
            <tr>
                <th>Booking Details</th>
                <th></th>
            </tr>
            <tr>
                <td>Room Name</td>
                <td><strong>{{ $room_name }}</strong></td>
            </tr>
            <tr>
                <td>Total Guests</td>
                <td>{{ $total_guest }}</td>
            </tr>
            <tr>
                <td>Check-in Date</td>
                <td>{{ $start_date }}</td>
            </tr>
            <tr>
                <td>Check-out Date</td>
                <td>{{ $end_date }}</td>
            </tr>
            <tr>
                <td>Total Amount</td>
                <td><strong>Rs. {{ number_format($amount, 2) }}</strong></td>
            </tr>
        </table>

        <p class="total">Total Amount: <span class="total-amount">Rs. {{ number_format($amount, 2) }}</span></p>
    </div>

    <div class="footer">
        <p>If you have any questions or special requests, please don't hesitate to contact us.</p>
        <p>We look forward to hosting you at <strong>The Star Hotel!</strong></p>
    </div>
</div>

</body>
</html>