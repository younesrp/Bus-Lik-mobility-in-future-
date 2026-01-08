<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BusLik - Réservez votre voyage</title>
    
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    
    <style>
        .hero-section {
            min-height: 90vh;
            display: grid;
            grid-template-columns: 2fr 3fr;
            position: relative;
            overflow: hidden;
        }
        
        .hero-left {
            background: transparent;
            display: flex;
            align-items: center;
            padding: 4rem 2rem;
            position: relative;
            z-index: 2;
        }
        
        .hero-right {
            background-image: url('../assets/images/image2.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 1;
            position: relative;
        }
        
        .hero-content {
            max-width: 100%;
            width: 100%;
        }
        
        .hero-text {
            max-width: 100%;
        }
        
        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: #FFFFFF;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        
        .hero-text p {
            font-size: 1.15rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
        }
        
        .search-form {
            background: #FFFFFF;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 2rem;
            align-items: end;
        }
        
        .form-field {
            display: flex;
            flex-direction: column;
        }
        
        .form-field label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        
        .form-field-input {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #E2E8F0;
            padding: 0.875rem 0;
            transition: border-color 0.3s;
        }
        
        .form-field-input:focus-within {
            border-color: #4A6ED1;
        }
        
        .form-field-input i {
            color: #4A6ED1;
            margin-right: 0.875rem;
            font-size: 1.2rem;
        }
        
        .form-field-input input {
            border: none;
            outline: none;
            background: transparent;
            font-size: 1rem;
            font-weight: 500;
            color: #2D3748;
            width: 100%;
            padding: 0;
        }
        
        .form-field-input input::placeholder {
            color: #A0AEC0;
            font-weight: 400;
        }
        
        .search-btn {
            background: #FF7A2A;
            color: #FFFFFF;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
            white-space: nowrap;
            height: fit-content;
        }
        
        .search-btn:hover {
            background: #e66a1f;
        }
        
        
        .features-section {
            padding: 4rem 2rem;
            background: #F7FAFC;
        }
        
        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        
        .feature-card {
            background: #FFFFFF;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.5rem;
        }
        
        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2D3748;
            margin-bottom: 0.75rem;
        }
        
        .feature-card p {
            color: #718096;
            font-size: 0.95rem;
        }
        
        @media (max-width: 968px) {
            .hero-section {
                grid-template-columns: 1fr;
            }
            
            .hero-right {
                min-height: 300px;
            }
            
            .hero-text h1 {
                font-size: 2.5rem;
            }
            
            .search-form {
                grid-template-columns: 1fr;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav style="background: #111632; color: #FFFFFF; padding: 1.25rem 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: flex; justify-content: space-between; align-items: center;">
            <!-- Logo -->
            <a href="index.php" style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none;">
                <img src="../assets/images/image1.png" alt="BusLik Logo" style="height: 35px; width: auto;">
                <span style="color: #FFFFFF; font-size: 1.5rem; font-weight: 600;">BusLik</span>
            </a>

            <!-- Desktop Menu -->
            <div style="display: flex; align-items: center; gap: 2.5rem;">
                <a href="index.php" style="color: #FFFFFF; text-decoration: none; font-weight: 500; position: relative; padding-bottom: 0.5rem;">
                    Accueil
                    <span style="position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: #FF7A2A;"></span>
                </a>
                <a href="horaires.php" style="color: #FFFFFF; text-decoration: none; font-weight: 500;">Horaires</a>
                <a href="lignes.php" style="color: #FFFFFF; text-decoration: none; font-weight: 500;">Nos Destinations</a>
                <a href="#" style="color: #FFFFFF; text-decoration: none; font-weight: 500;">A Propos</a>
            </div>

            <!-- Auth Buttons -->
            <div style="display: flex; align-items: center; gap: 1rem;">
                <a href="login.php" style="background: #FF7A2A; color: #FFFFFF; padding: 0.625rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 500; transition: background 0.3s;">Login</a>
                <a href="register.php" style="background: #4A6ED1; color: #FFFFFF; padding: 0.625rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 500; transition: background 0.3s;">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Left Content (50%) -->
        <div class="hero-left">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Take Your Bus Now</h1>
                    <p>Réservez votre billet en quelques clics.</p>

                    <!-- Search Form -->
                    <form class="search-form" action="#" method="GET">
                        <div class="form-field">
                            <label>VILLE DE DÉPART</label>
                            <div class="form-field-input">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" placeholder="Entrez la ville" required>
                            </div>
                        </div>

                        <div class="form-field">
                            <label>VILLE D'ARRIVÉE</label>
                            <div class="form-field-input">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" placeholder="Entrez la ville" required>
                            </div>
                        </div>

                        <div class="form-field">
                            <label>DATE DE VOYAGE</label>
                            <div class="form-field-input">
                                <i class="fa-regular fa-calendar"></i>
                                <input type="text" placeholder="jj/mm/aaaa" required>
                            </div>
                        </div>

                        <button type="submit" class="search-btn">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Right Content - Image (50%) -->
        <div class="hero-right"></div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="features-grid">
            <!-- Feature 1 -->
            <div class="feature-card">
                <div class="feature-icon" style="background: #4A6ED1; color: #FFFFFF;">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <h3>Horaires Flexibles</h3>
                <p>Trouvez l'horaire qui vous convient.</p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card">
                <div class="feature-icon" style="background: #FF7A2A; color: #FFFFFF;">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <h3>Meilleures Destinations</h3>
                <p>Explorez nos lieux populaires.</p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card">
                <div class="feature-icon" style="background: #B59A90; color: #FFFFFF;">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h3>Réservation Rapide</h3>
                <p>Réservez en toute simplicité.</p>
            </div>
        </div>
    </section>

    <?php require_once '../includes/footer.php'; ?>
</body>
</html>
