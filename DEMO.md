# 🚀 Live Demo Guide - BusLik

## Quick Start Demo

### Step 1: Start XAMPP
1. Open **XAMPP Control Panel**
2. Start **Apache** and **MySQL** services
3. Wait for both to show green "Running" status

### Step 2: Import Database
1. Open **phpMyAdmin**: `http://localhost/phpmyadmin`
2. Click **"New"** to create a database
3. Name it: `buslik`
4. Click **"Import"** tab
5. Choose file: `database/schema.sql` → Click **Go**
6. Choose file: `database/seed.sql` → Click **Go**

### Step 3: Access the Application

**Main URL:**
```
http://localhost/Bus-Lik-mobility-in-future-/public/
```

**Or directly:**
```
http://localhost/Bus-Lik-mobility-in-future-/public/index.php
```

## 🎯 Demo Flow

### 1. Homepage
- Visit: `http://localhost/Bus-Lik-mobility-in-future-/public/`
- See the beautiful landing page with search functionality

### 2. User Registration
- Click **"Sign Up"**
- Register a new account
- Wallet is automatically created with 0.00 DH

### 3. Login
**Test Accounts Available:**
- **Admin**: `admin@buslik.ma` / `admin123`
- **User**: `user@test.com` / `user123`

### 4. Dashboard
- After login, see your dashboard
- View balance, subscriptions, and trip stats
- Quick access to all features

### 5. Recharge Wallet
- Click **"Recharger"** button
- Add funds (e.g., 100 DH)
- See updated balance

### 6. Generate QR Code Ticket
1. Go to **"QR Code"** from dashboard
2. Select a **Line** (e.g., "Ligne Centre-Ville")
3. Select **Start Station** (e.g., "Gare Centrale")
4. Select **End Station** (e.g., "Place Mohammed V")
5. Click **"Générer le QR Code"**
6. QR code appears with token
7. Wallet is automatically debited (2.00 DH per trip)

### 7. View Trip History
- Click **"Historique"** from dashboard
- See all your past trips with details

### 8. Browse Stations & Lines
- **Stations**: See all available bus stations
- **Lignes**: See all bus lines and routes
- **Horaires**: View bus schedules

### 9. Admin Panel
- Login as admin: `admin@buslik.ma` / `admin123`
- Access admin dashboard
- Manage lines, stations, users, and view statistics

## 📱 Demo Features to Showcase

### ✅ Core Features
- [x] User Registration & Authentication
- [x] Digital Wallet System
- [x] QR Code Generation
- [x] QR Code Validation (for controllers)
- [x] Trip Management
- [x] Station & Line Browsing
- [x] Admin Dashboard
- [x] Subscription Management

### 🎨 UI/UX Highlights
- Modern, responsive design
- Dark theme with orange accents
- Smooth user experience
- Mobile-friendly interface

## 🔗 Important URLs

| Page | URL |
|------|-----|
| Homepage | `http://localhost/Bus-Lik-mobility-in-future-/public/` |
| Login | `http://localhost/Bus-Lik-mobility-in-future-/public/login.php` |
| Register | `http://localhost/Bus-Lik-mobility-in-future-/public/register.php` |
| Dashboard | `http://localhost/Bus-Lik-mobility-in-future-/public/dashboard.php` |
| QR Code | `http://localhost/Bus-Lik-mobility-in-future-/public/qr-code.php` |
| Stations | `http://localhost/Bus-Lik-mobility-in-future-/public/stations.php` |
| Admin | `http://localhost/Bus-Lik-mobility-in-future-/admin/` |

## 🐛 Troubleshooting

### Database Connection Error
- Check MySQL is running in XAMPP
- Verify database name is `buslik`
- Check `config/Db.php` port (default: 3307)

### Page Not Found
- Ensure Apache is running
- Check URL path is correct
- Verify files are in `htdocs` folder

### QR Code Not Generating
- Ensure wallet has sufficient balance
- Check all form fields are filled
- Verify database has lines and stations

## 🎬 Presentation Tips

1. **Start with Homepage** - Show the beautiful landing page
2. **Register New User** - Demonstrate the registration flow
3. **Recharge Wallet** - Show digital wallet functionality
4. **Generate QR Code** - The main feature! Show QR generation
5. **View History** - Show trip tracking
6. **Admin Panel** - Show management capabilities

## 🚀 Ready to Demo!

Your application is fully functional and ready to impress the judges! 🎉
