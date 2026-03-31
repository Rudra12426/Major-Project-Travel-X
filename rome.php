<?php
session_start();

$bookings = [];
if (file_exists('rome_bookings.json')) {
    $bookings = json_decode(file_get_contents('rome_bookings.json'), true);
}

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
    file_put_contents('rome_bookings.json', json_encode($bookings, JSON_PRETTY_PRINT));
    
    $_SESSION['booking_success'] = true;
    $_SESSION['booking_message'] = 'La tua prenotazione è stata confermata!';
}

$blogPosts = [
    [
        'id' => 1,
        'title' => 'The Colosseum: A Monument to History',
        'excerpt' => 'Explore the most iconic symbol of Rome and the Roman Empire.',
        'content' => 'The Colosseum stands as the greatest architectural achievement of ancient Rome. Built between 72-80 AD, this massive amphitheater could hold up to 50,000 spectators. Walking through its ancient corridors and arena, you can almost hear the roar of crowds from nearly 2,000 years ago. It\'s a testament to Roman engineering and power.',
        'author' => 'Marco Rossi',
        'date' => '2024-03-15',
        'image' => 'colosseum'
    ],
    [
        'id' => 2,
        'title' => 'The Vatican: Spiritual and Artistic Wonder',
        'excerpt' => 'Discover the heart of Catholicism and Renaissance art.',
        'content' => 'The Vatican City is the smallest independent state in the world, yet it houses some of the greatest artistic treasures. St. Peter\'s Basilica, with its magnificent dome, and the Sistine Chapel, with Michelangelo\'s breathtaking ceiling, draw millions of pilgrims and art lovers annually. Every corner reveals masterpieces.',
        'author' => 'Giulia Bianchi',
        'date' => '2024-03-10',
        'image' => 'vatican'
    ],
    [
        'id' => 3,
        'title' => 'Roman Cuisine: Flavors of Tradition',
        'excerpt' => 'Savor the authentic tastes of Rome passed down through generations.',
        'content' => 'Roman food is simple yet exquisite, emphasizing fresh ingredients and time-honored recipes. Try cacio e pepe, carbonara, or amatriciana in local trattorias. Visit the Campo de\' Fiori market, the heart of Roman culinary culture. The food scene reflects Rome\'s history and character in every bite.',
        'author' => 'Angela Moretti',
        'date' => '2024-03-05',
        'image' => 'food'
    ],
    [
        'id' => 4,
        'title' => 'The Pantheon: Ancient Marvel',
        'excerpt' => 'Experience one of the best-preserved Roman buildings.',
        'content' => 'The Pantheon, dedicated to all gods, is an architectural masterpiece from the 2nd century. Its perfectly proportioned dome with the oculus at the top creates a breathtaking space. The building\'s harmony and balance embody the ideals of Roman architecture and continue to inspire architects today.',
        'author' => 'Roberto Ferrari',
        'date' => '2024-02-28',
        'image' => 'pantheon'
    ]
];

$landmarks = [
    [
        'name' => 'Colosseum',
        'description' => 'Ancient amphitheater and Roman icon',
        'image' => 'colosseum'
    ],
    [
        'name' => 'Vatican',
        'description' => 'Heart of the Catholic Church',
        'image' => 'vatican'
    ],
    [
        'name' => 'Pantheon',
        'description' => 'Ancient Roman temple of gods',
        'image' => 'pantheon'
    ],
    [
        'name' => 'Roman Forum',
        'description' => 'Center of ancient Roman life',
        'image' => 'forum'
    ],
    [
        'name' => 'Trevi Fountain',
        'description' => 'Stunning baroque fountain',
        'image' => 'fountain'
    ],
    [
        'name' => 'Spanish Steps',
        'description' => 'Famous staircase and gathering place',
        'image' => 'steps'
    ]
];

$hotels = [
    'Luxury Rome Suites' => '€380+',
    'Trastevere Elegance' => '€280+',
    'Colosseum View Hotel' => '€320+',
    'Spanish Steps Boutique' => '€350+',
    'Vatican Charm Inn' => '€240+'
];

$restaurants = [
    'La Pergola' => 'Michelin 3-star Fine Dining',
    'Flavio al Velavevodetto' => 'Traditional Roman',
    'Armando al Pantheon' => 'Family-run Classic',
    'Checchino dal 1887' => 'Roman Traditional',
    'Nino' => 'Contemporary Italian'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rome Tourism - The Eternal City</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #d4502d;
            --dark: #1a1410;
            --light: #fdf8f4;
            --accent: #c67c5d;
            --text: #2c2420;
            --border: #e5d9ce;
            --success: #8b6e3a;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Cambria', 'Georgia', serif;
            color: var(--text);
            background: linear-gradient(135deg, var(--light) 0%, #fff9f2 100%);
            line-height: 1.8;
            letter-spacing: 0.5px;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--primary);
            padding: 1.2rem 0;
            box-shadow: 0 4px 12px rgba(212, 80, 45, 0.12);
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
            margin-left: 2.5rem;
            text-decoration: none;
            color: var(--text);
            font-size: 0.95rem;
            font-weight: 500;
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

        .hero {
            height: 600px;
            background: linear-gradient(135deg, rgba(212, 80, 45, 0.1) 0%, rgba(198, 124, 93, 0.1) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            animation: heroGlow 8s ease-in-out infinite;
        }

        @keyframes heroGlow {
            0%, 100% { box-shadow: inset 0 0 30px rgba(212, 80, 45, 0.1); }
            50% { box-shadow: inset 0 0 50px rgba(212, 80, 45, 0.2); }
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
            color: white;
            text-decoration: none;
            border-radius: 3px;
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
            box-shadow: 0 10px 30px rgba(212, 80, 45, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        section {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--text);
            font-weight: 700;
            width: 100%;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--primary);
            margin: 1rem auto 0;
        }

        .section-subtitle {
            text-align: center;
            color: var(--accent);
            margin-bottom: 3rem;
            font-size: 1.1rem;
            font-style: italic;
        }

        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }

        .blog-card {
            background: white;
            border-radius: 3px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border-left: 5px solid var(--primary);
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
            box-shadow: 0 15px 40px rgba(212, 80, 45, 0.15);
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
            color: #666;
            margin-bottom: 1.5rem;
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

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .gallery-item {
            position: relative;
            border-radius: 3px;
            overflow: hidden;
            aspect-ratio: 1;
            cursor: pointer;
        }

        .gallery-item-image {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #d4502d, #c67c5d);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.3);
            transition: all 0.4s ease;
        }

        .gallery-item:hover .gallery-item-image {
            transform: scale(1.1);
            box-shadow: 0 20px 40px rgba(212, 80, 45, 0.3);
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
        }

        .booking-section {
            background: white;
            border-radius: 3px;
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
        }

        .form-group input,
        .form-group select {
            padding: 0.8rem 1rem;
            border: 2px solid var(--border);
            border-radius: 3px;
            font-family: inherit;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(212, 80, 45, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 3px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            background: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .success-message {
            background: linear-gradient(135deg, var(--success), #a0854f);
            color: white;
            padding: 1.5rem;
            border-radius: 3px;
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
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            nav a {
                margin-left: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .blog-grid, .gallery {
                grid-template-columns: 1fr;
            }

            .booking-section {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="#home" class="logo">🏛️ Rome</a>
            <nav>
                <a href="#blog">Blog</a>
                <a href="#gallery">Gallery</a>
                <a href="#booking">Book Now</a>
            </nav>
        </div>
    </header>

    <section class="hero" id="home">
        <div class="hero-content">
            <h1>Rome</h1>
            <p>The Eternal City - Where History Lives</p>
            <a href="#booking" class="cta-button">Plan Your Visit</a>
        </div>
    </section>

    <section id="blog">
        <div class="container">
            <h2 class="section-title">Rome Stories</h2>
            <p class="section-subtitle">Discover the timeless beauty of the ancient world</p>
            
            <div class="blog-grid">
                <?php foreach ($blogPosts as $post): ?>
                <article class="blog-card">
                    <div class="blog-card-image">
                        <?php
                            $emojis = [
                                'colosseum' => '🏛️',
                                'vatican' => '⛪',
                                'food' => '🍝',
                                'pantheon' => '🛕'
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

    <section id="gallery">
        <div class="container">
            <h2 class="section-title">Famous Landmarks</h2>
            <p class="section-subtitle">Explore Rome's most iconic attractions</p>
            
            <div class="gallery">
                <?php foreach ($landmarks as $landmark): ?>
                <div class="gallery-item">
                    <div class="gallery-item-image">
                        <?php
                            $landmarkEmojis = [
                                'colosseum' => '🏛️',
                                'vatican' => '⛪',
                                'pantheon' => '🛕',
                                'forum' => '🏺',
                                'fountain' => '💧',
                                'steps' => '🪜'
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

    <section id="booking">
        <div class="container">
            <h2 class="section-title">Book Your Rome Experience</h2>
            <p class="section-subtitle">Reserve your hotel or restaurant with ease</p>
            
            <div class="booking-section">
                <?php if (isset($_SESSION['booking_success'])): ?>
                <div class="success-message show">
                    <strong>✓ Success!</strong> <?php echo $_SESSION['booking_message']; ?>
                </div>
                <?php unset($_SESSION['booking_success']); endif; ?>

                <div class="booking-tabs">
                    <button class="booking-tab-btn active" onclick="switchTab('hotel')">
                        🏨 Hotels
                    </button>
                    <button class="booking-tab-btn" onclick="switchTab('restaurant')">
                        🍽️ Restaurants
                    </button>
                </div>

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

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>About Rome</h3>
                    <p>Experience the eternal city where ancient history breathes in every corner. Rome is a living museum where every street tells a story of empires, art, and civilization.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <a href="#blog">Blog</a><br>
                    <a href="#gallery">Gallery</a><br>
                    <a href="#booking">Booking</a>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>Email: info@rometourism.it<br>
                    Phone: +39 06-XXXX-XXXX<br>
                    Address: Rome, Italy</p>
                </div>
                <div class="footer-section">
                    <h3>Opening Hours</h3>
                    <p>Monday - Friday: 9:00 AM - 6:00 PM<br>
                    Saturday: 10:00 AM - 5:00 PM<br>
                    Sunday: Closed</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Rome Tourism. All rights reserved. | Designed with passion</p>
            </div>
        </div>
    </footer>

    <script>
        function switchTab(tab) {
            document.getElementById('hotel-form').classList.remove('active');
            document.getElementById('restaurant-form').classList.remove('active');
            
            document.querySelectorAll('.booking-tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            if (tab === 'hotel') {
                document.getElementById('hotel-form').classList.add('active');
                document.querySelectorAll('.booking-tab-btn')[0].classList.add('active');
            } else {
                document.getElementById('restaurant-form').classList.add('active');
                document.querySelectorAll('.booking-tab-btn')[1].classList.add('active');
            }
        }

        document.getElementById('hotel-form').addEventListener('submit', function(e) {
            const date = new Date(document.getElementById('hotel-date').value);
            if (date < new Date()) {
                e.preventDefault();
                alert('Please select a future date');
            }
        });

        document.getElementById('restaurant-form').addEventListener('submit', function(e) {
            const date = new Date(document.getElementById('rest-date').value);
            if (date < new Date()) {
                e.preventDefault();
                alert('Please select a future date');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({behavior: 'smooth'});
                }
            });
        });

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

        setTimeout(() => {
            const successMsg = document.querySelector('.success-message');
            if (successMsg) {
                successMsg.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>
