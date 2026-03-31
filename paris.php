<?php
session_start();

// Simulated database for bookings (in production, use real database)
$bookings = [];
if (file_exists('bookings.json')) {
    $bookings = json_decode(file_get_contents('bookings.json'), true);
}

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_type'])) {
    $booking = [
        'id' => uniqid(),
        'type' => htmlspecialchars($_POST['booking_type']),
        'name' => htmlspecialchars($_POST['name']),
        'email' => htmlspecialchars($_POST['email']),
        'phone' => htmlspecialchars($_POST['phone']),
        'date' => htmlspecialchars($_POST['date']),
        'guests' => isset($_POST['guests']) ? htmlspecialchars($_POST['guests']) : '1',
        'hotel' => isset($_POST['hotel']) ? htmlspecialchars($_POST['hotel']) : '',
        'restaurant' => isset($_POST['restaurant']) ? htmlspecialchars($_POST['restaurant']) : '',
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    $bookings[] = $booking;
    file_put_contents('bookings.json', json_encode($bookings, JSON_PRETTY_PRINT));
    
    $_SESSION['booking_success'] = true;
    $_SESSION['booking_message'] = 'Votre réservation a été confirmée!';
}

// Blog posts data
$blogPosts = [
    [
        'id' => 1,
        'title' => 'The Magic of the Eiffel Tower',
        'excerpt' => 'Discover why this iconic iron lattice tower has captivated millions of visitors.',
        'content' => 'The Eiffel Tower, completed in 1889, stands as a testament to human ingenuity and architectural brilliance. Originally intended to be temporary, it has become the most recognizable symbol of Paris. The tower offers breathtaking views from three levels, each providing a unique perspective of the sprawling city. Whether you visit during the day or witness the magical nighttime illuminations, the experience is unforgettable.',
        'author' => 'Marie Dubois',
        'date' => '2024-03-15',
        'image' => 'eiffel-tower'
    ],
    [
        'id' => 2,
        'title' => 'Seine River: Paris\'s Liquid Soul',
        'excerpt' => 'Explore the romantic Seine and the charming experiences along its banks.',
        'content' => 'The Seine River flows through the heart of Paris like an artery of culture and romance. A cruise along its waters reveals centuries of architecture, from medieval bridges to Renaissance palaces. The river has inspired countless poets, artists, and lovers who have found solace in its gentle currents. From the Île de la Cité to the Pont des Arts, every bridge tells a story.',
        'author' => 'Jean-Pierre Laurent',
        'date' => '2024-03-10',
        'image' => 'seine-river'
    ],
    [
        'id' => 3,
        'title' => 'Culinary Delights of Paris',
        'excerpt' => 'Indulge in the world-renowned French cuisine in the City of Light.',
        'content' => 'Paris is a gastronomic paradise where every meal is a celebration of flavor and artistry. From Michelin-starred restaurants to cozy bistros tucked away on side streets, the culinary scene offers something for every palate. Experience the delicate layers of croissants, the richness of coq au vin, and the elegance of French wines. Paris doesn\'t just feed you; it awakens your senses.',
        'author' => 'Sophie Mercier',
        'date' => '2024-03-05',
        'image' => 'french-cuisine'
    ],
    [
        'id' => 4,
        'title' => 'Art and Culture: The Louvre Experience',
        'excerpt' => 'Journey through one of the world\'s greatest art museums.',
        'content' => 'The Louvre is more than a museum; it\'s a monument to human creativity. Housing over 38,000 artworks, including the Mona Lisa and Venus de Milo, it offers an incomparable collection spanning centuries. Walking through its magnificent halls, you\'re not just viewing art; you\'re experiencing the evolution of human expression and imagination.',
        'author' => 'Claude Bernard',
        'date' => '2024-02-28',
        'image' => 'louvre-museum'
    ]
];

// Famous landmarks data
$landmarks = [
    [
        'name' => 'Eiffel Tower',
        'description' => 'The iconic iron lattice monument',
        'image' => 'tokyo.jpeg'
        
    ],
    [
        'name' => 'Arc de Triomphe',
        'description' => 'Monumental arch honoring those fallen in war',
        'image' => 'arc-triomphe'
    ],
    [
        'name' => 'Notre-Dame Cathedral',
        'description' => 'Gothic masterpiece of medieval architecture',
        'image' => 'notre-dame'
    ],
    [
        'name' => 'Sacré-Cœur Basilica',
        'description' => 'White-domed basilica in Montmartre',
        'image' => 'sacre-coeur'
    ],
    [
        'name' => 'The Louvre',
        'description' => 'World\'s largest art museum',
        'image' => 'louvre-museum'
    ],
    [
        'name' => 'Versailles Palace',
        'description' => 'Opulent royal residence and gardens',
        'image' => 'versailles'
    ]
];

// Hotels data
$hotels = [
    'Luxury Paris Suites' => '€450+',
    'Boutique Seine Hotel' => '€320+',
    'Le Marais Elegance' => '€280+',
    'Champs-Élysées Palace' => '€380+',
    'Latin Quarter Charm' => '€220+'
];

// Restaurants data
$restaurants = [
    'L\'Astrance' => 'Michelin 3-star Fine Dining',
    'Café de Flore' => 'Historic Café & Bistro',
    'Le Jules Verne' => 'Eiffel Tower Fine Dining',
    'Benoit' => 'Classic French Cuisine',
    'L\'Ami Jean' => 'Traditional Bistro'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paris Tourism - Discover the City of Light</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #d4af37;
            --dark: #1a1a1a;
            --light: #f5f1e8;
            --accent: #8b7355;
            --text: #2c2c2c;
            --border: #e0dcd4;
            --success: #7cb342;
            --error: #d32f2f;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Georgia', 'Garamond', serif;
            color: var(--text);
            background: linear-gradient(135deg, var(--light) 0%, #fffbf7 100%);
            line-height: 1.7;
            letter-spacing: 0.5px;
        }

        /* Header & Navigation */
        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            padding: 1.2rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: var(--primary);
            text-transform: uppercase;
            text-decoration: none;
        }

        nav a {
            margin-left: 2rem;
            text-decoration: none;
            color: var(--text);
            font-size: 0.95rem;
            transition: color 0.3s ease;
            position: relative;
        }

        nav a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: var(--primary);
            transition: width 0.3s ease;
        }

        nav a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            height: 600px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.1) 0%, rgba(139, 115, 85, 0.1) 100%),
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23f5f1e8" width="1200" height="600"/><path fill="%23d4af37" opacity="0.05" d="M600 50L700 250L900 300L700 350L600 550L500 350L300 300L500 250Z"/></svg>');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            animation: heroGlow 8s ease-in-out infinite;
        }

        @keyframes heroGlow {
            0%, 100% { box-shadow: inset 0 0 30px rgba(212, 175, 55, 0.1); }
            50% { box-shadow: inset 0 0 50px rgba(212, 175, 55, 0.2); }
        }

        .hero-content {
            text-align: center;
            color: var(--text);
            z-index: 10;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.5rem;
            color: var(--accent);
            margin-bottom: 2rem;
            font-style: italic;
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: var(--primary);
            color: var(--dark);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border: 2px solid var(--primary);
            cursor: pointer;
            font-size: 1rem;
        }

        .cta-button:hover {
            background: transparent;
            color: var(--primary);
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Section Styles */
        section {
            padding: 5rem 0;
            position: relative;
        }

        .section-title {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--text);
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--primary);
            margin: 1rem auto 0;
            border-radius: 2px;
        }

        .section-subtitle {
            text-align: center;
            color: var(--accent);
            margin-bottom: 3rem;
            font-size: 1.1rem;
            font-style: italic;
        }

        /* Blog Section */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }

        .blog-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border-top: 4px solid var(--primary);
            animation: cardSlideIn 0.6s ease-out backwards;
        }

        .blog-card:nth-child(1) { animation-delay: 0.1s; }
        .blog-card:nth-child(2) { animation-delay: 0.2s; }
        .blog-card:nth-child(3) { animation-delay: 0.3s; }
        .blog-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes cardSlideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(212, 175, 55, 0.15);
        }

        .blog-card-image {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
            overflow: hidden;
        }

        .blog-card-image::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50%, 50%); }
        }

        .blog-card-content {
            padding: 2rem;
        }

        .blog-card-title {
            font-size: 1.4rem;
            margin-bottom: 0.8rem;
            color: var(--text);
            line-height: 1.4;
        }

        .blog-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: var(--accent);
        }

        .blog-card-excerpt {
            color: #555;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .read-more {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .read-more::after {
            content: '→';
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }

        .read-more:hover::after {
            transform: translateX(5px);
        }

        /* Gallery Section */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            aspect-ratio: 1;
            cursor: pointer;
            group: "gallery-image";
        }

        .gallery-item-image {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #d4af37, #8b7355);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.3);
            transition: all 0.4s ease;
            position: relative;
        }

        .gallery-item:hover .gallery-item-image {
            transform: scale(1.1);
            box-shadow: 0 20px 40px rgba(212, 175, 55, 0.3);
        }

        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
            color: white;
            padding: 2rem 1rem 1rem;
            transform: translateY(100%);
            transition: transform 0.4s ease;
        }

        .gallery-item:hover .gallery-caption {
            transform: translateY(0);
        }

        .gallery-caption-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .gallery-caption-desc {
            font-size: 0.9rem;
            color: #ddd;
        }

        /* Booking Section */
        .booking-section {
            background: white;
            border-radius: 12px;
            padding: 3rem;
            margin-top: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .booking-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 2px solid var(--border);
        }

        .booking-tab-btn {
            padding: 1rem 2rem;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            color: var(--text);
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .booking-tab-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .booking-tab-btn:hover {
            color: var(--primary);
        }

        .booking-form {
            display: none;
        }

        .booking-form.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select {
            padding: 0.8rem 1rem;
            border: 2px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: var(--dark);
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .submit-btn:hover {
            background: var(--accent);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Success Message */
        .success-message {
            background: linear-gradient(135deg, var(--success), #558b2f);
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: none;
            animation: slideDown 0.4s ease;
        }

        .success-message.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 5rem;
            border-top: 2px solid var(--primary);
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            color: var(--primary);
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .footer-section p, .footer-section a {
            color: #ccc;
            text-decoration: none;
            font-size: 0.95rem;
            line-height: 1.8;
        }

        .footer-section a:hover {
            color: var(--primary);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #999;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            nav a {
                margin-left: 1rem;
                font-size: 0.85rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .blog-grid {
                grid-template-columns: 1fr;
            }

            .booking-tabs {
                flex-wrap: wrap;
            }

            .booking-tab-btn {
                padding: 0.8rem 1.5rem;
                font-size: 0.9rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .booking-section {
                padding: 2rem;
            }
        }

        /* Utility */
        .text-center {
            text-align: center;
        }

        .mt-3 {
            margin-top: 3rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <a href="#home" class="logo">✦ Paris</a>
            <nav>
                <a href="#blog">Blog</a>
                <a href="#gallery">Gallery</a>
                <a href="#booking">Book Now</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Paris</h1>
            <p>City of Light, Love & Elegance</p>
            <a href="#booking" class="cta-button">Plan Your Visit</a>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog">
        <div class="container">
            <h2 class="section-title">Paris Stories</h2>
            <p class="section-subtitle">Discover the magic of the City of Light through captivating tales</p>
            
            <div class="blog-grid">
                <?php foreach ($blogPosts as $post): ?>
                <article class="blog-card">
                    <div class="blog-card-image">
                        <?php
                            $emojis = [
                                'eiffel-tower' => '🗼',
                                'seine-river' => '🌊',
                                'french-cuisine' => '🍷',
                                'louvre-museum' => '🎨'
                            ];
                            echo isset($emojis[$post['image']]) ? $emojis[$post['image']] : '✨';
                        ?>
                    </div>
                    <div class="blog-card-content">
                        <h3 class="blog-card-title"><?php echo $post['title']; ?></h3>
                        <div class="blog-card-meta">
                            <span><?php echo date('M d, Y', strtotime($post['date'])); ?></span>
                            <span><?php echo $post['author']; ?></span>
                        </div>
                        <p class="blog-card-excerpt"><?php echo $post['excerpt']; ?></p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery">
        <div class="container">
            <h2 class="section-title">Famous Landmarks</h2>
            <p class="section-subtitle">Explore the iconic attractions that define Paris</p>
            
            <div class="gallery">
                <?php foreach ($landmarks as $landmark): ?>
                <div class="gallery-item">
                    <div class="gallery-item-image">
                        <?php
                            $landmarkEmojis = [
                                'eiffel-tower' => '🗼',
                                'arc-triomphe' => '🏛️',
                                'notre-dame' => '⛪',
                                'sacre-coeur' => '⛩️',
                                'louvre-museum' => '🎨',
                                'versailles' => '👑'
                            ];
                            echo isset($landmarkEmojis[$landmark['image']]) ? $landmarkEmojis[$landmark['image']] : '✨';
                        ?>
                    </div>
                    <div class="gallery-caption">
                        <div class="gallery-caption-title"><?php echo $landmark['name']; ?></div>
                        <div class="gallery-caption-desc"><?php echo $landmark['description']; ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section id="booking">
        <div class="container">
            <h2 class="section-title">Book Your Paris Experience</h2>
            <p class="section-subtitle">Reserve your hotel or restaurant with ease</p>
            
            <div class="booking-section">
                <?php if (isset($_SESSION['booking_success'])): ?>
                <div class="success-message show">
                    <strong>✓ Success!</strong> <?php echo $_SESSION['booking_message']; ?>
                </div>
                <?php unset($_SESSION['booking_success']); endif; ?>

                <!-- Booking Tabs -->
                <div class="booking-tabs">
                    <button class="booking-tab-btn active" onclick="switchTab('hotel')">
                        🏨 Hotels
                    </button>
                    <button class="booking-tab-btn" onclick="switchTab('restaurant')">
                        🍽️ Restaurants
                    </button>
                </div>

                <!-- Hotel Booking Form -->
                <form id="hotel-form" class="booking-form active" method="POST">
                    <input type="hidden" name="booking_type" value="hotel">
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="hotel-name">Full Name *</label>
                            <input type="text" id="hotel-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="hotel-email">Email *</label>
                            <input type="email" id="hotel-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="hotel-phone">Phone Number *</label>
                            <input type="tel" id="hotel-phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="hotel-date">Check-in Date *</label>
                            <input type="date" id="hotel-date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="hotel-guests">Number of Guests *</label>
                            <input type="number" id="hotel-guests" name="guests" min="1" max="6" value="1" required>
                        </div>
                        <div class="form-group">
                            <label for="hotel-select">Select Hotel *</label>
                            <select id="hotel-select" name="hotel" required>
                                <option value="">Choose a hotel...</option>
                                <?php foreach ($hotels as $name => $price): ?>
                                <option value="<?php echo $name; ?>"><?php echo "$name - $price"; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">Book Hotel</button>
                </form>

                <!-- Restaurant Booking Form -->
                <form id="restaurant-form" class="booking-form" method="POST">
                    <input type="hidden" name="booking_type" value="restaurant">
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="rest-name">Full Name *</label>
                            <input type="text" id="rest-name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="rest-email">Email *</label>
                            <input type="email" id="rest-email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="rest-phone">Phone Number *</label>
                            <input type="tel" id="rest-phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="rest-date">Reservation Date *</label>
                            <input type="date" id="rest-date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="rest-guests">Number of Guests *</label>
                            <input type="number" id="rest-guests" name="guests" min="1" max="12" value="2" required>
                        </div>
                        <div class="form-group">
                            <label for="rest-select">Select Restaurant *</label>
                            <select id="rest-select" name="restaurant" required>
                                <option value="">Choose a restaurant...</option>
                                <?php foreach ($restaurants as $name => $cuisine): ?>
                                <option value="<?php echo $name; ?>"><?php echo "$name - $cuisine"; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">Reserve Table</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About Paris</h3>
                    <p>Discover the magic of Paris, where centuries of history meet modern elegance. Experience culture, cuisine, and romance in every corner of this magnificent city.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <a href="#blog">Blog</a><br>
                    <a href="#gallery">Gallery</a><br>
                    <a href="#booking">Booking</a>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>Email: info@pariscity.fr<br>
                    Phone: +33 1 23 45 67 89<br>
                    Address: Paris, France</p>
                </div>
                <div class="footer-section">
                    <h3>Opening Hours</h3>
                    <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                    Saturday: 10:00 AM - 5:00 PM<br>
                    Sunday: Closed</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Paris Tourism. All rights reserved. | Designed with elegance</p>
            </div>
        </div>
    </footer>

    <script>
        // Tab switching for booking forms
        function switchTab(tab) {
            // Hide all forms
            document.getElementById('hotel-form').classList.remove('active');
            document.getElementById('restaurant-form').classList.remove('active');
            
            // Remove active class from all buttons
            document.querySelectorAll('.booking-tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected form
            if (tab === 'hotel') {
                document.getElementById('hotel-form').classList.add('active');
                document.querySelectorAll('.booking-tab-btn')[0].classList.add('active');
            } else {
                document.getElementById('restaurant-form').classList.add('active');
                document.querySelectorAll('.booking-tab-btn')[1].classList.add('active');
            }
        }

        // Handle form submission with validation
        document.getElementById('hotel-form').addEventListener('submit', function(e) {
            const date = new Date(document.getElementById('hotel-date').value);
            if (date < new Date()) {
                e.preventDefault();
                alert('Please select a future date');
                return;
            }
        });

        document.getElementById('restaurant-form').addEventListener('submit', function(e) {
            const date = new Date(document.getElementById('rest-date').value);
            if (date < new Date()) {
                e.preventDefault();
                alert('Please select a future date');
                return;
            }
        });

        // Smooth scroll for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({behavior: 'smooth'});
                }
            });
        });

        // Add scroll animation to elements
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.blog-card, .gallery-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Auto-hide success message
        setTimeout(() => {
            const successMsg = document.querySelector('.success-message');
            if (successMsg) {
                successMsg.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>
