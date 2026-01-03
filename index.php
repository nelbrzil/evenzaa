<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENZA - Premium Event Reservation & Ticketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        .chat-fab-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            z-index: 1100;
        }

        .chat-fab {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            border: none;
            background-color: gray;
            color: #ffffff;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.05em;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 12px 25px rgba(163, 0, 0, 0.45), 0 0 12px rgba(163, 0, 0, 0.5);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .chat-fab:hover,
        .chat-fab:focus-visible {
            transform: scale(1.08);
            box-shadow: 0 18px 35px rgba(163, 0, 0, 0.55), 0 0 18px rgba(163, 0, 0, 0.6);
            outline: none;
        }

        .chat-fab-label {
            background: #ffffff;
            color: black;
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .chat-fab-container {
                bottom: 16px;
                right: 16px;
            }

            .chat-fab-label {
                display: none;
            }
        }

        /* Chat Window Styles */
        .chat-window {
            position: fixed;
            bottom: 100px;
            right: 24px;
            width: 400px;
            height: 600px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            display: none;
            flex-direction: column;
            z-index: 1200;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        .chat-window.active {
            display: flex;
        }

        .chat-header {
            background-color: gray;
            color: #ffffff;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 16px 16px 0 0;
        }

        .chat-header h3 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            flex: 1;
            text-align: center;
        }

        .chat-header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .chat-header-btn {
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-header-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .chat-body {
            flex: 1;
            background-color: #F5F5F0;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background: gray;
            border-radius: 3px;
        }

        .chat-message {
            max-width: 75%;
            padding: 12px 16px;
            border-radius: 18px;
            word-wrap: break-word;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .chat-message.user {
            background-color: #E0E0E0;
            color: #333;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }

        .chat-message.bot {
            background-color: gray;
            color: #ffffff;
            align-self: flex-start;
            border-bottom-left-radius: 4px;
        }

        .chat-placeholder {
            text-align: center;
            color: #666;
            font-size: 0.9rem;
            padding: 20px;
            margin: auto;
        }

        .typing-indicator {
            display: none;
            align-self: flex-start;
            background-color: #E8E8E3;
            color: #666;
            padding: 12px 16px;
            border-radius: 18px;
            border-bottom-left-radius: 4px;
            font-size: 0.9rem;
            font-style: italic;
        }

        .typing-indicator.active {
            display: block;
        }

        .chat-input-container {
            padding: 16px;
            background-color: #ffffff;
            border-top: 1px solid #E0E0E0;
            display: flex;
            gap: 8px;
        }

        .chat-input {
            flex: 1;
            width: 80%;
            padding: 12px 16px;
            border: 1px solid #E0E0E0;
            border-radius: 24px;
            font-size: 0.95rem;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .chat-input:focus {
            border-color: gray;
        }

        .chat-send-btn {
            width: 20%;
            padding: 12px;
            background-color: black;
            color: #ffffff;
            border: none;
            border-radius: 24px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .chat-send-btn:hover {
            background-color: #8B0000;
        }

        .chat-send-btn:active {
            transform: scale(0.98);
        }

        @media (max-width: 576px) {
            .chat-window {
                width: calc(100vw - 32px);
                height: calc(100vh - 100px);
                bottom: 100px;
                right: 16px;
                left: 16px;
                border-radius: 16px 16px 0 0;
            }
        }
    </style>
</head>

<body>
    <div class="navbar navbar-expand-lg navbar-light fixed-top luxury-nav">
        <div class="container">
            <a class="navbar-brand luxury-logo" href="index.php"><img src="assets/images/evenzaLogo.png" alt="EVENZA" class="evenza-logo-img"><span class="visually-hidden">EVENZA</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="events.php">Events</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item ms-3">
                            <a class="nav-link" href="profile.php">My Profile</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link btn-register" href="logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-3">
                            <a class="nav-link btn-login" href="login.php">Login</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link btn-register" href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-8 col-xl-7">
                    <div class="hero-content">
                        <div class="hero-logo-wrap mb-3">
                            <img src="assets/images/evenzaLogo.png" alt="EVENZA" class="hero-logo img-fluid">
                        </div>
                        <h1 class="visually-hidden">EVENZA</h1>
                        <p class="hero-subtitle">Reserve Hotel-Hosted Events with Ease</p>
                        <div class="hero-buttons mt-4">
                            <a href="events.php" class="btn btn-primary-luxury btn-lg">Explore Events</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="featured-events py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title">Featured Events</h2>
                <p class="section-subtitle">Curated selections for the discerning attendee</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="luxury-card event-card">
                        <div class="event-image position-relative">
                            <img src="assets/images/event_images/galaEvening.jpg" class="card-img-top featured-event-image" alt="Gala Evening">
                            <span class="event-badge">Premium</span>
                        </div>
                        <div class="event-content p-4">
                            <h3 class="event-title">Gala Evening</h3>

                            <p class="event-description">An elegant evening of fine dining and entertainment in an exclusive setting.</p>
                            <?php $link = isset($_SESSION['user_id']) ? 'reservation.php?eventId=1' : 'login.php?redirect=' . urlencode('reservation.php?eventId=1'); ?>
                            <a href="<?php echo $link; ?>" class="btn btn-sm btn-primary-luxury mt-3">Reserve Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="luxury-card event-card">
                        <div class="event-image position-relative">
                            <img src="assets/images/event_images/wineCellar.jpg" class="card-img-top featured-event-image" alt="Wine Tasting">
                            <span class="event-badge">Premium</span>
                        </div>
                        <div class="event-content p-4">
                            <h3 class="event-title">Wine Tasting</h3>

                            <p class="event-description">Discover rare vintages in an intimate tasting experience.</p>
                            <?php $link = isset($_SESSION['user_id']) ? 'reservation.php?eventId=2' : 'login.php?redirect=' . urlencode('reservation.php?eventId=2'); ?>
                            <a href="<?php echo $link; ?>" class="btn btn-sm btn-primary-luxury mt-3">Reserve Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="luxury-card event-card">
                        <div class="event-image position-relative">
                            <img src="assets/images/event_images/artExhibition.jpg" class="card-img-top featured-event-image" alt="Art Exhibition">
                            <span class="event-badge">Premium</span>
                        </div>
                        <div class="event-content p-4">
                            <h3 class="event-title">Art Exhibition</h3>

                            <p class="event-description">Private viewing of contemporary masterpieces.</p>
                            <?php $link = isset($_SESSION['user_id']) ? 'reservation.php?eventId=3' : 'login.php?redirect=' . urlencode('reservation.php?eventId=3'); ?>
                            <a href="<?php echo $link; ?>" class="btn btn-sm btn-primary-luxury mt-3">Reserve Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action / Hotel Partners Section -->
    <?php if (!isset($_SESSION['user_id'])): ?>
        <!-- Logged Out: Show CTA to Create Account -->
        <div class="cta-section py-5">
            <div class="container">
                <div class="luxury-card cta-card text-center p-5">
                    <h2 class="cta-title mb-3">Ready to Reserve Your Experience?</h2>
                    <p class="cta-subtitle mb-4">Join our exclusive community and gain access to premium events worldwide.</p>
                    <a href="register.php" class="btn btn-primary-luxury btn-lg">Create Account</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Logged In: Show Hotel Partners Section -->
        <div class="hotel-partners-section py-5">
            <div class="container">
                <div class="partners-header text-center mb-5">
                    <h2 class="partners-title">Our Featured Hotel Partners</h2>
                    <p class="partners-subtitle">Experience elegance at our premium partner locations</p>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="hotel-image-container">
                            <div class="hotel-image-placeholder">
                                <div class="hotel-image-icon">🏨</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="luxury-card hotel-card p-5">
                            <h3 class="hotel-name mb-3">Grand Luxe Hotels</h3>
                            <p class="hotel-description mb-4">
                                Experience the epitome of luxury and sophistication at Grand Luxe Hotels. Our premium facilities provide the perfect backdrop for unforgettable events, from intimate gatherings to grand celebrations. With world-class service, exquisite dining, and elegantly appointed venues, we are committed to creating exceptional experiences for every occasion.
                            </p>
                            <div class="hotel-highlights mb-4">
                                <span class="highlight-badge">5-Star Luxury</span>
                                <span class="highlight-badge">Premium Venues</span>
                                <span class="highlight-badge">Expert Service</span>
                            </div>
                            <a href="#" class="btn btn-primary-luxury btn-lg">View Partnership</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="luxury-footer py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="footer-logo mb-3">EVENZA</h5>
                    <p class="footer-text">Premium event reservation and ticketing platform. Experience elegance, reserve with confidence.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="footer-heading mb-3">Contact Info</h6>
                    <p class="footer-text">
                        Email: info@evenza.com<br>
                        Phone: +1 (555) 123-4567<br>
                        Address: 123 Luxury Avenue, Suite 100<br>
                        City, State 12345
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h6 class="footer-heading mb-3">Hotel Partner</h6>
                    <p class="footer-text">
                        <strong>Grand Luxe Hotels</strong><br>
                        Your trusted partner for premium event hosting
                    </p>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="footer-copyright">&copy; <?php echo date('Y'); ?> EVENZA. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="chat-fab-container">
        <button class="chat-fab" type="button" aria-label="Ask Batangas AI" id="chatFab">
            AI
        </button>
        <span class="chat-fab-label">Ask Evenza AI</span>
    </div>

    <!-- Chat Window -->
    <div class="chat-window" id="chatWindow">
        <div class="chat-header">
            <h3>Evenza AI Assistant</h3>
            <div class="chat-header-actions">
                <button class="chat-header-btn" id="clearChatBtn" aria-label="Clear Chat" title="Clear Chat">🔄</button>
                <button class="chat-header-btn" id="closeChatBtn" aria-label="Close Chat" title="Close">×</button>
            </div>
        </div>
        <div class="chat-body" id="chatBody">
            <div class="chat-placeholder">
                Hello! Ask Evenza about events, tickets, and reservations—easy and quick!.
            </div>
            <div class="typing-indicator" id="typingIndicator">••• Evenza AI is responding…</div>
        </div>
        <div class="chat-input-container">
            <input type="text" class="chat-input" id="chatInput" placeholder="Type your message..." />
            <button class="chat-send-btn" id="chatSendBtn">Send</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/chatbot.js"></script>

    
</body>
</html>