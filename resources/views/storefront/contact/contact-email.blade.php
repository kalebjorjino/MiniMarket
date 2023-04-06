<!DOCTYPE html>
<html>

<head>
    <title>Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .signature {
            margin-top: 20px;
            font-size: 18px;
            font-style: italic;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>New Contact Form Submission</h1>

        <p><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $message }}</p>

        <p class="signature">Best regards,<br />SAMJ KMART</p>
    </div>
</body>

</html>
