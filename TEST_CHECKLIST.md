# ✅ Demo Test Checklist

## 🔐 Authentication Flow

- [ ] **Registration**
  - Go to: `http://localhost/Bus-Lik-mobility-in-future-/public/register.php`
  - Fill form and submit
  - Should redirect to dashboard ✅

- [ ] **Login**
  - Go to: `http://localhost/Bus-Lik-mobility-in-future-/public/login.php`
  - Use: `user@test.com` / `user123`
  - Should redirect to dashboard ✅
  - Should show success message ✅

- [ ] **Dashboard**
  - Should show real balance from database ✅
  - Should show real trip count ✅
  - Should show recent trips ✅

## 💰 Wallet & Recharge

- [ ] **Recharge**
  - Go to dashboard → Click "Recharger"
  - Add amount (e.g., 100 DH)
  - Should update balance ✅
  - Should show in dashboard ✅

## 📱 QR Code Generation

- [ ] **Generate QR**
  - Go to dashboard → Click "QR Code"
  - Select Line (e.g., "Ligne Centre-Ville")
  - Select Start Station
  - Select End Station
  - Click "Générer le QR Code"
  - Should generate QR code ✅
  - Should deduct 2.00 DH from wallet ✅
  - Should show token ✅

## 📜 Trip History

- [ ] **View History**
  - Go to dashboard → Click "Historique"
  - Should show all trips ✅
  - Should show trip details ✅

## 🚏 Browse Features

- [ ] **Stations**
  - Go to dashboard → Click "Stations"
  - Should list all stations ✅

- [ ] **Lines**
  - Go to dashboard → Click "Lignes"
  - Should list all lines ✅

## 👨‍💼 Admin Panel

- [ ] **Admin Login**
  - Login as: `admin@buslik.ma` / `admin123`
  - Should access admin dashboard ✅
  - Should see statistics ✅

## 🎯 Quick Test (2 minutes)

1. **Login**: `user@test.com` / `user123` → Should go to dashboard ✅
2. **Recharge**: Add 50 DH → Balance should update ✅
3. **Generate QR**: Create a trip → QR should appear ✅
4. **Check History**: View trips → Should show new trip ✅

## 🐛 Common Issues & Fixes

### Login not redirecting?
- Check `public/auth/login.php` exists
- Check form action is `auth/login.php`
- Check session is starting

### Dashboard not loading?
- Check database connection in `config/Db.php`
- Check database `buslik` exists
- Check tables are created

### QR Code not generating?
- Check wallet has balance (min 2.00 DH)
- Check lines and stations exist in database
- Check JavaScript console for errors

## ✅ All Systems Ready!

Your demo is ready! 🚀
