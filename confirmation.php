<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilton Hotels - Confirmation</title>
    <style>
        body { background-color: #000000; color: #39FF14; font-family: 'Arial', sans-serif; margin: 0; padding: 0; text-align: center; }
        .neon-glow { text-shadow: 0 0 10px #39FF14, 0 0 20px #39FF14; font-size: 2em; padding: 50px; }
        button { background: #39FF14; color: #000000; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; }
        button:hover { box-shadow: 0 0 15px #39FF14; }
        @media (max-width: 768px) { .neon-glow { font-size: 1.5em; } }
    </style>
</head>
<body>
    <div class="neon-glow">
        <h1>Booking Confirmed!</h1>
        <p>Thank you for choosing Hilton Hotels. Enjoy your stay!</p>
        <button onclick="window.location.href = 'index.php'">Back to Home</button>
    </div>
</body>
</html>
