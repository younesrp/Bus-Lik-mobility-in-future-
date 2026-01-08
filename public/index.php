<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBus - Réservez votre voyage</title>
    
    <!-- Tailwind CSS (via CDN pour la démonstration) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts (Poppins pour un look moderne) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Configuration Tailwind personnalisée -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            dark: '#0f172a',  // Bleu très profond
                            primary: '#1e3a8a', // Bleu moyen
                            accent: '#3b82f6',  // Bleu vif
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Ajustements mineurs */
        body {
            font-family: 'Poppins', sans-serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .hero-bg {
            background-color: #0f172a; /* Fallback */
            background-image: linear-gradient(to right, #0f172a 0%, #1e293b 100%);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Navigation -->
    <nav class="bg-brand-dark text-white py-4 px-6 lg:px-12 sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="text-3xl font-bold text-blue-400 flex items-center gap-2">
                <img src="../assets/images/image1.png" alt="BusLik Logo" style="height: 40px; width: auto; max-width: 150px;">
                <span>BusLik</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="font-medium hover:text-blue-400 transition-colors">Accueil</a>
                <a href="#" class="font-medium hover:text-blue-400 transition-colors">Horaires</a>
                <a href="#" class="font-medium hover:text-blue-400 transition-colors">Destinations</a>
                <a href="#" class="font-medium hover:text-blue-400 transition-colors">Services</a>
            </div>

            <!-- Auth Buttons -->
            <div class="hidden md:flex items-center space-x-4">
                <button class="px-5 py-2 text-blue-300 font-medium hover:text-white transition-colors">Login</button>
                <button class="px-5 py-2 bg-blue-600 text-white rounded-full font-medium hover:bg-blue-500 transition-colors shadow-lg shadow-blue-900/50">Sign Up</button>
            </div>

            <!-- Mobile Menu Button (Hamburger) -->
            <button class="md:hidden text-2xl text-blue-300">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-bg text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-12 lg:py-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            
            <!-- Left Content -->
            <div class="space-y-6">
                <div class="inline-block px-4 py-1 bg-blue-900/50 border border-blue-700/50 rounded-full text-sm text-blue-300 mb-2">
                    <i class="fa-solid fa-star mr-2"></i>Le meilleur choix pour voyager
                </div>
                <h1 class="text-4xl lg:text-6xl font-bold leading-tight">
                    Take Your Bus <br>
                    <span class="text-blue-400">Now</span>
                </h1>
                <p class="text-slate-300 text-lg max-w-md">
                    Réservez facilement vos billets de bus en ligne. Profitez de nos horaires flexibles et de nos destinations exceptionnelles.
                </p>

                <!-- Search Box -->
                <div class="glass-card text-slate-800 p-4 lg:p-6 rounded-2xl shadow-2xl transform transition-transform hover:-translate-y-1 duration-300 mt-8">
                    <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        
                        <!-- From -->
                        <div class="relative group">
                            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1 ml-1">De</label>
                            <div class="flex items-center border-b-2 border-slate-200 focus-within:border-blue-500 py-2">
                                <i class="fa-solid fa-location-dot text-blue-500 mr-3"></i>
                                <input type="text" placeholder="Paris" class="w-full outline-none bg-transparent font-medium placeholder-slate-400">
                            </div>
                        </div>

                        <!-- To -->
                        <div class="relative group">
                            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1 ml-1">À</label>
                            <div class="flex items-center border-b-2 border-slate-200 focus-within:border-blue-500 py-2">
                                <i class="fa-solid fa-location-arrow text-blue-500 mr-3"></i>
                                <input type="text" placeholder="Lyon" class="w-full outline-none bg-transparent font-medium placeholder-slate-400">
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="relative group">
                            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1 ml-1">Date</label>
                            <div class="flex items-center border-b-2 border-slate-200 focus-within:border-blue-500 py-2">
                                <i class="fa-regular fa-calendar text-blue-500 mr-3"></i>
                                <input type="date" class="w-full outline-none bg-transparent font-medium text-slate-700">
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="flex items-end pt-6">
                            <button type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-600/30 transition-all flex items-center justify-center gap-2">
                                <i class="fa-solid fa-magnifying-glass"></i> Rechercher
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Right Content (Image) -->
            <div class="relative hidden lg:block">
                <!-- Decorative blob behind image -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[100px] opacity-20"></div>
                
                <!-- Image Card -->
                <div class="relative z-10 rounded-3xl overflow-hidden shadow-2xl border border-slate-700/50 rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=1000&auto=format&fit=crop" 
                         alt="Bus de nuit moderne" 
                         class="w-full h-[500px] object-cover">
                    
                    <!-- Floating Badge on Image -->
                    <div class="absolute bottom-6 left-6 bg-white/90 backdrop-blur text-brand-dark px-4 py-3 rounded-xl shadow-lg max-w-xs">
                        <div class="flex items-center gap-3">
                            <div class="bg-green-100 text-green-600 w-10 h-10 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 uppercase font-bold">Statut</p>
                                <p class="font-bold text-sm">En service ce soir</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-brand-dark mb-4">Pourquoi choisir MyBus ?</h2>
                <div class="h-1 w-20 bg-blue-600 mx-auto rounded"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Horaires Flexibles</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Des départs tout au long de la journée et de la nuit. Adaptez votre voyage à votre emploi du temps sans stress.
                    </p>
                    <a href="#" class="inline-block mt-4 text-blue-600 font-medium hover:underline">Voir les horaires <i class="fa-solid fa-arrow-right ml-1 text-sm"></i></a>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Meilleures Destinations</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Accédez aux plus belles villes de France et d'Europe. Des itinéraires optimisés pour un confort maximal.
                    </p>
                    <a href="#" class="inline-block mt-4 text-blue-600 font-medium hover:underline">Explorer <i class="fa-solid fa-arrow-right ml-1 text-sm"></i></a>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-shadow border border-slate-100 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-brand-dark mb-3">Réservation Rapide</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Obtenez votre billet électronique en quelques clics. Pas de files d'attente, montez directement dans le bus.
                    </p>
                    <a href="#" class="inline-block mt-4 text-blue-600 font-medium hover:underline">Réserver <i class="fa-solid fa-arrow-right ml-1 text-sm"></i></a>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-brand-dark text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <span class="text-2xl font-bold text-white tracking-tight">MyBus</span>
                <p class="text-sm mt-1">© 2023 MyBus Inc. Tous droits réservés.</p>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition-colors"><i class="fa-brands fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-white transition-colors"><i class="fa-brands fa-twitter text-xl"></i></a>
                <a href="#" class="hover:text-white transition-colors"><i class="fa-brands fa-instagram text-xl"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>