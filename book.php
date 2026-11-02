<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Gallery</title>
    <link rel="stylesheet" href="book.css">
</head>
<body>
    <div class="container" id="hotel-list">
    
    <script>
        const hotels = [
            { name: "Haile Resort", image: "images/haile.jpg", description: "Haile Resort Jimma, a luxurious four-star retreat nestled in the vibrant heart of Jimma city, Ethiopia.Haile Resort Jimma, a luxurious four-star retreat nestled in the vibrant heart of Jimma city, Ethiopia. Located just 350 km from Addis Ababa, this stunning resort boasts breathtaking views and spacious accommodations, providing guests with the renowned personalized service that Haile Hotels & Resorts Group is celebrated for. Experience the rich culture of Ethiopia’s coffee-producing capital while indulging in the perfect blend of luxury and history at Haile Resort Jimma. We look forward to welcoming our esteemed guests and the vibrant community of Jimma to this exceptional new destination." },
            { name: "Boni International Hotel", image: "images/boni.jpg", description: "Boni International Hotel is located close to Jimma Stadium, offering spacious rooms with essential amenities.Boni International Hotel is located close to Jimma Stadium. WiFi internet access is available.Each spacious room is beautifully designed with an en-suite bathroom and fitted with a TV with satellite reception, a work table, an intercom telephone, a refrigerator, a wardrobe, private safe and separate sitting area with sofas." },
            { name: "Dololo Hotel", image: "images/dololo.jpg", description: "The Dololo is a conveniently located hotel in Jimma, Ethiopia.The Dololo, is a conveniently located Hotel in Jimma, Ethiopia. Guests can be entertained by the presence of a pool. Parking amenities includes an on-site car park. Food is provided by a restaurant. There is no cost Wireless Internet access within the hotel in both public and in-room hotel areas.Hotel Dololo Jima has 35 rooms and is located merely 1.3 km from Jimma Museum.Guests will make use of towels and slippers in bathrooms equipped with a separate toilet and a shower." },
            { name: "Rebeka International Hotel", image: "images/rebeka hotel.jpg", description: "Rebeka International Hotel offers guests a comfortable stay with essential amenities.Rebeka International Hotel, located in the Agip area of Jimma, Ethiopia, offers guests a comfortable stay with essential amenities. While specific details about the hotel's facilities are limited, it is situated in a convenient location within the city. For more information or inquiries, you can contact the hotel directly at 0915850404" },
            { name: "Awetu Grand Hotel", image: "images/Awetu.jpg", description: "Awetu Grand Hotel is a prominent accommodation in Jimma, Ethiopia.Awetu Grand Hotel is a prominent accommodation in Jimma, Ethiopia, situated approximately 1.3 kilometers from the city center. The hotel offers 58 well-appointed rooms, each equipped with amenities such as a mini fridge bar, coffee and tea making facilities, and cable satellite TV. The rooms are designed with soundproofed windows and furnished with comfortable seating areas, ensuring a restful stay for guests" },
            { name: "Central Hotel", image: "images/central hotel.jpg", description: "Central Jimma Hotel is a distinguished 3-star establishment located in the heart of Jimma, Ethiopia.Central Jimma Hotel is a distinguished 3-star establishment located in the heart of Jimma, Ethiopia. With over two decades of unwavering commitment to hospitality, the hotel offers guests a blend of comfort and convenience. The hotel features a variety of spacious rooms, including Double Rooms, Standard Rooms, and Twin Rooms. Each room is equipped with amenities such as Wi-Fi, air conditioning" }
        ];

        const hotelList = document.getElementById("hotel-list");

        hotels.forEach(hotel => {
            const hotelCard = document.createElement("div");
            hotelCard.classList.add("hotel-card");
            
            hotelCard.innerHTML = `
                <img src="${hotel.image}" alt="${hotel.name}">
                <div class="hotel-info">
                    <h2>${hotel.name}</h2>
                    <p>${hotel.description}</p>
                    <button class="btn" onclick="toggleForm('${hotel.name}', '${hotel.description}')">Book Now</button>
                    <div class="booking-form" id="${hotel.name.replace(/\s+/g, '')}-form">
                        <form action="book.php" method="POST">
                            <input type="hidden" name="hotel_name" value="${hotel.name}">
                            <input type="hidden" name="hotel_description" value="${hotel.description}">
                            <label for="guest_name">Your Name:</label>
                            <input type="text" id="guest_name" name="guest_name" required>
                            <label for="guest_email">Your Email:</label>
                            <input type="email" id="guest_email" name="guest_email" required>
                            <label for="guest_phone">Your Phone:</label>
                            <input type="tel" id="guest_phone" name="guest_phone" required>
                            <button type="submit" class="btn">Submit Booking</button>
                        </form>
                    </div>
                </div>
            `;
            hotelList.appendChild(hotelCard);
        });

        function toggleForm(hotelName) {
            const allForms = document.querySelectorAll('.booking-form');
    allForms.forEach(form => {
        form.style.display = 'none';
    });
           
            const formId = hotelName.replace(/\s+/g, '') + '-form';
            const form = document.getElementById(formId);
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }
    </script>
    </div>

    <?php
    
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "srs"; 
    
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $hotel_name = htmlspecialchars($_POST['hotel_name']);
        $guest_name = htmlspecialchars($_POST['guest_name']);
        $guest_email = htmlspecialchars($_POST['guest_email']);
        $guest_phone = htmlspecialchars($_POST['guest_phone']);
    
        
        $stmt = $conn->prepare("INSERT INTO bookings (hotel_name, guest_name, guest_email, guest_phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $hotel_name, $guest_name, $guest_email, $guest_phone);
    
        
        if ($stmt->execute()) {
            echo "Thank you for booking at " . $hotel_name . ". We will contact you shortly!";
        } else {
            echo "Error: " . $stmt->error;
        }
    
        
        $stmt->close();
    }
    
    
    $conn->close();
    ?>
    
</body>
</html>