<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilton Hotels - Book Room</title>
    <style>
        body { background-color: #000000; color: #39FF14; font-family: 'Arial', sans-serif; margin: 0; padding: 0; }
        .neon-glow { text-shadow: 0 0 10px #39FF14, 0 0 20px #39FF14; }
        header { background: linear-gradient(to bottom, #000000, #111111); padding: 20px; text-align: center; }
        form { max-width: 400px; margin: 20px auto; padding: 20px; border: 2px solid #39FF14; border-radius: 10px; box-shadow: 0 0 15px #39FF14; }
        input { background: #111111; color: #39FF14; border: 1px solid #39FF14; padding: 10px; margin: 10px 0; width: 100%; border-radius: 5px; }
        button { background: #39FF14; color: #000000; border: none; padding: 10px; width: 100%; cursor: pointer; transition: box-shadow 0.3s; }
        button:hover { box-shadow: 0 0 20px #39FF14; }
        @media (max-width: 768px) { form { padding: 10px; } }
    </style>
</head>
<body>
    <header class="neon-glow">
        <h1 class="neon-glow">Book Your Stay</h1>
    </header>
    <form id="bookingForm">
        <input type="text" id="user_name" placeholder="Your Name" required>
        <input type="email" id="user_email" placeholder="Your Email" required>
        <button type="submit">Confirm Booking</button>
    </form>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const roomId = urlParams.get('room_id');
        const checkIn = urlParams.get('check_in');
        const checkOut = urlParams.get('check_out');
 
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const userName = document.getElementById('user_name').value;
            const userEmail = document.getElementById('user_email').value;
 
            // Post to self for PHP processing
            const formData = new FormData();
            formData.append('room_id', roomId);
            formData.append('user_name', userName);
            formData.append('user_email', userEmail);
            formData.append('check_in', checkIn);
            formData.append('check_out', checkOut);
 
            fetch(window.location.href, {
                method: 'POST',
                body: formData
            }).then(() => {
                alert('Booking confirmed!');
                window.location.href = 'confirmation.php'; // JS redirect
            });
        });
    </script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include 'db.php';
        $room_id = $_POST['room_id'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];
 
        // Insert booking (pro: prepared statement)
        $stmt = $pdo->prepare("INSERT INTO bookings (room_id, user_name, user_email, check_in, check_out) VALUES (:room_id, :user_name, :user_email, :check_in, :check_out)");
        $stmt->execute([
            'room_id' => $room_id,
            'user_name' => $user_name,
            'user_email' => $user_email,
            'check_in' => $check_in,
            'check_out' => $check_out
        ]);
        // No output here, JS handles confirmation and redirect
    }
    ?>
</body>
</html>
