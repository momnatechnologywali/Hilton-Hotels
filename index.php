<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilton Hotels - Homepage</title>
    <style>
        body { background-color: #000000; color: #39FF14; font-family: 'Arial', sans-serif; margin: 0; padding: 0; }
        .neon-glow { text-shadow: 0 0 10px #39FF14, 0 0 20px #39FF14; }
        header { background: linear-gradient(to bottom, #000000, #111111); padding: 20px; text-align: center; }
        h1 { font-size: 3em; margin: 0; }
        .search-bar { max-width: 800px; margin: 20px auto; padding: 20px; border: 2px solid #39FF14; border-radius: 10px; box-shadow: 0 0 15px #39FF14; }
        input, button { background: #111111; color: #39FF14; border: 1px solid #39FF14; padding: 10px; margin: 5px; border-radius: 5px; }
        button { cursor: pointer; transition: box-shadow 0.3s; }
        button:hover { box-shadow: 0 0 10px #39FF14; }
        .featured { display: flex; flex-wrap: wrap; justify-content: center; }
        .hotel-card { width: 300px; margin: 10px; padding: 10px; border: 1px solid #39FF14; border-radius: 10px; box-shadow: 0 0 10px #39FF14; text-align: center; }
        img { max-width: 100%; border-radius: 5px; }
        @media (max-width: 768px) { .search-bar { padding: 10px; } h1 { font-size: 2em; } }
    </style>
</head>
<body>
    <header class="neon-glow">
        <h1 class="neon-glow">Hilton Hotels</h1>
        <p>Find your perfect stay</p>
    </header>
    <section class="search-bar">
        <form id="searchForm">
            <input type="text" id="location" placeholder="Destination (e.g., New York)" required>
            <input type="date" id="check_in" required>
            <input type="date" id="check_out" required>
            <button type="submit">Search</button>
        </form>
    </section>
    <section class="featured">
        <h2 class="neon-glow">Featured Hotels</h2>
        <?php
        include 'db.php';
        $stmt = $pdo->query("SELECT * FROM hotels LIMIT 3");
        while ($hotel = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="hotel-card neon-glow">';
            echo '<img src="' . $hotel['image'] . '" alt="' . $hotel['name'] . '">';
            echo '<h3>' . $hotel['name'] . '</h3>';
            echo '<p>' . $hotel['location'] . ' - Rating: ' . $hotel['rating'] . '</p>';
            echo '</div>';
        }
        ?>
    </section>
    <script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const location = document.getElementById('location').value;
            const check_in = document.getElementById('check_in').value;
            const check_out = document.getElementById('check_out').value;
            window.location.href = `listing.php?location=${encodeURIComponent(location)}&check_in=${check_in}&check_out=${check_out}`;
        });
    </script>
</body>
</html>
