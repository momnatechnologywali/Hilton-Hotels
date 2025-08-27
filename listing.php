<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilton Hotels - Listings</title>
    <style>
        body { background-color: #000000; color: #39FF14; font-family: 'Arial', sans-serif; margin: 0; padding: 0; }
        .neon-glow { text-shadow: 0 0 10px #39FF14, 0 0 20px #39FF14; }
        header { background: linear-gradient(to bottom, #000000, #111111); padding: 20px; text-align: center; }
        .filters { max-width: 800px; margin: 20px auto; padding: 10px; }
        select, input, button { background: #111111; color: #39FF14; border: 1px solid #39FF14; padding: 5px; }
        .listings { display: flex; flex-wrap: wrap; justify-content: center; }
        .room-card { width: 300px; margin: 10px; padding: 10px; border: 1px solid #39FF14; border-radius: 10px; box-shadow: 0 0 10px #39FF14; text-align: center; }
        button { cursor: pointer; transition: box-shadow 0.3s; }
        button:hover { box-shadow: 0 0 15px #39FF14; }
        @media (max-width: 768px) { .room-card { width: 100%; } }
    </style>
</head>
<body>
    <header class="neon-glow">
        <h1 class="neon-glow">Available Rooms</h1>
    </header>
    <section class="filters">
        <label>Sort by: </label>
        <select id="sort">
            <option value="price_asc">Price Low to High</option>
            <option value="price_desc">Price High to Low</option>
            <option value="rating_desc">Best Rated</option>
        </select>
        <button onclick="sortRooms()">Apply Sort</button>
    </section>
    <section class="listings" id="roomList">
        <?php
        include 'db.php';
        $location = $_GET['location'] ?? '';
        $check_in = $_GET['check_in'] ?? '';
        $check_out = $_GET['check_out'] ?? '';
 
        // Pro query: Join hotels/rooms, check availability (no overlapping bookings)
        $query = "SELECT r.id, r.room_type, r.price, r.amenities, r.image, h.name, h.rating, h.description
                  FROM rooms r
                  JOIN hotels h ON r.hotel_id = h.id
                  WHERE h.location ILIKE :location
                  AND NOT EXISTS (
                      SELECT 1 FROM bookings b
                      WHERE b.room_id = r.id
                      AND NOT (b.check_out <= :check_in OR b.check_in >= :check_out)
                  )";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['location' => "%$location%", 'check_in' => $check_in, 'check_out' => $check_out]);
        while ($room = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="room-card neon-glow" data-price="' . $room['price'] . '" data-rating="' . $room['rating'] . '">';
            echo '<img src="' . $room['image'] . '" alt="' . $room['room_type'] . '">';
            echo '<h3>' . $room['room_type'] . ' at ' . $room['name'] . '</h3>';
            echo '<p>Price: $' . $room['price'] . ' | Rating: ' . $room['rating'] . '</p>';
            echo '<p>Amenities: ' . $room['amenities'] . '</p>';
            echo '<button onclick="bookRoom(' . $room['id'] . ', \'' . $check_in . '\', \'' . $check_out . '\')">Book Now</button>';
            echo '</div>';
        }
        ?>
    </section>
    <script>
        function bookRoom(roomId, checkIn, checkOut) {
            window.location.href = `booking.php?room_id=${roomId}&check_in=${checkIn}&check_out=${checkOut}`;
        }
        function sortRooms() {
            const sortBy = document.getElementById('sort').value;
            const roomList = document.getElementById('roomList');
            const rooms = Array.from(roomList.children);
            rooms.sort((a, b) => {
                if (sortBy === 'price_asc') return a.dataset.price - b.dataset.price;
                if (sortBy === 'price_desc') return b.dataset.price - a.dataset.price;
                if (sortBy === 'rating_desc') return b.dataset.rating - a.dataset.rating;
                return 0;
            });
            rooms.forEach(room => roomList.appendChild(room));
        }
    </script>
</body>
</html>
