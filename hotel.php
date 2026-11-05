<?php 
include 'includes/header.php'; 

// Database Configuration
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "srs"; 

$booking_message = "";
$message_type = "";

// Handle Booking Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        $booking_message = "Connection failed: " . $conn->connect_error;
        $message_type = "error";
    } else {
        $hotel_name = htmlspecialchars($_POST['hotel_name']);
        $guest_name = htmlspecialchars($_POST['guest_name']);
        $guest_email = htmlspecialchars($_POST['guest_email']);
        $guest_phone = htmlspecialchars($_POST['guest_phone']);

        $stmt = $conn->prepare("INSERT INTO bookings (hotel_name, guest_name, guest_email, guest_phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $hotel_name, $guest_name, $guest_email, $guest_phone);

        if ($stmt->execute()) {
            $booking_message = "Thank you! Your booking at " . $hotel_name . " has been submitted successfully.";
            $message_type = "success";
        } else {
            $booking_message = "Error: " . $stmt->error;
            $message_type = "error";
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels & Resorts - Visit Jimma</title>
    <link rel="stylesheet" href="assets/css/hotel.css">
</head>
<body>
    <main class="hotel-page">
        <header class="hotel-header">
            <span class="badge">Stay In Comfort</span>
            <h1>Hotels & Resorts in <span>Jimma</span></h1>
            <p class="subtitle">Find luxury resorts, boutique lodgings, and verified stays across Jimma.</p>
            
            <?php if (!empty($booking_message)): ?>
                <div class="alert-box <?php echo $message_type; ?>">
                    <?php echo $booking_message; ?>
                </div>
            <?php endif; ?>
        </header>
        <div class="hotel-container" id="hotel-list"></div>
    </main>

    <script>
        const hotels = [
            { 
                name: "Haile Resort Jimma", 
                image: "assets/images/haile.jpg", 
                tag: "4-Star Resort",
                description: "Nestled in the vibrant heart of Jimma city, this luxurious 4-star retreat offers breathtaking highland views, spacious suites, fine dining, and the renowned hospitality service of Haile Hotels & Resorts Group." 
            },
            { 
                name: "Boni International Hotel", 
                image: "assets/images/boni.jpg", 
                tag: "Stadium Area",
                description: "Conveniently located close to Jimma Stadium, offering spacious modern rooms with en-suite bathrooms, satellite television, workstations, complimentary WiFi, and dedicated business traveler services." 
            },
            { 
                name: "Dololo Hotel", 
                image: "assets/images/dololo.jpg", 
                tag: " Near Museum",
                description: "Located merely 1.3 km from the Jimma Museum, Dololo Hotel features 35 comfortable guest rooms, an on-site restaurant serving local flavors, swimming pool facilities, and secure on-site parking." 
            },
            { 
                name: "Rebeka International Hotel", 
                image: "assets/images/rebeka hotel.jpg", 
                tag: " Agip Area",
                description: "Situated in the accessible Agip district of Jimma, Rebeka International Hotel provides dependable guest comfort, quiet accommodations, and 24/7 front desk hospitality. Contact: 0915850404." 
            },
            { 
                name: "Awetu Grand Hotel", 
                image: "assets/images/Awetu.jpg", 
                tag: " City Center",
                description: "A prominent hotel roughly 1.3 km from the city center, offering 58 well-appointed rooms equipped with soundproofed windows, mini-fridges, tea/coffee makers, and cable television." 
            },
            { 
                name: "Central Jimma Hotel", 
                image: "assets/images/central hotel.jpg", 
                tag: " 3-Star Classic",
                description: "A distinguished 3-star establishment in the downtown core with over two decades of hospitality experience, offering comfortable double and twin rooms with high-speed WiFi and air conditioning." 
            }
        ];

        const hotelList = document.getElementById("hotel-list");

        hotels.forEach((hotel, index) => {
            const hotelCard = document.createElement("article");
            hotelCard.classList.add("hotel-card");
            
            const formId = `form-${index}`;
            
            hotelCard.innerHTML = `
                <div class="img-wrapper">
                    <img src="${hotel.image}" alt="${hotel.name}">
                    <span class="rating-tag">${hotel.tag}</span>
                </div>
                <div class="card-content">
                    <h2>${hotel.name}</h2>
                    <p>${hotel.description}</p>
                    <button type="button" class="btn-toggle" onclick="toggleForm('${formId}')">Book This Hotel</button>
                    
                    <div class="booking-drawer" id="${formId}">
                        <form action="hotel.php" method="POST" class="inner-form">
                            <input type="hidden" name="hotel_name" value="${hotel.name}">
                            
                            <div class="form-group">
                                <label>Your Full Name</label>
                                <input type="text" name="guest_name" required>
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="guest_email" required>
                            </div>

                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="guest_phone" required>
                            </div>

                            <button type="submit" class="btn-submit">Confirm Reservation</button>
                        </form>
                    </div>
                </div>
            `;
            hotelList.appendChild(hotelCard);
        });

        function toggleForm(formId) {
            const target = document.getElementById(formId);
            const isVisible = target.classList.contains('active');
            document.querySelectorAll('.booking-drawer').forEach(drawer => {
                drawer.classList.remove('active');
            });
            
            if (!isVisible) {
                target.classList.add('active');
            }
        }
    </script>
</body>
</html>