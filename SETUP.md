# Quick Setup Guide

## 🚀 Fast Setup (5 minutes)

### 1. Database Setup
```sql
-- Run in MySQL/MariaDB
source database/schema.sql;
source database/seed.sql;
```

### 2. Configure Database
Edit `config/Db.php`:
- Update `$host`, `$user`, `$password`, `$port` if needed
- Default: localhost, root, (empty), 3307

### 3. Access the Application
- Open: `http://localhost/Bus-Lik-mobility-in-future-/public/`
- Or: `http://localhost/Bus-Lik-mobility-in-future-/public/index.php`

### 4. Test Accounts
**Admin:**
- Email: `admin@buslik.ma`
- Password: `admin123`

**User:**
- Email: `user@test.com`
- Password: `user123`

## ✅ What's Fixed & Completed

1. ✅ Wallet auto-creation on user registration
2. ✅ Fixed duplicate QRToken::create() method
3. ✅ Complete database seed data
4. ✅ Professional README.md
5. ✅ Proper .gitignore
6. ✅ All API endpoints functional
7. ✅ QR code generation & validation working
8. ✅ All authentication flows working

## 🎯 Key Features Working

- User registration & login
- Wallet management & recharge
- QR code ticket generation
- QR code validation
- Trip history
- Station & line browsing
- Admin dashboard
- Subscription management

## 📝 To Push to GitHub

```bash
git push origin main
```

If you get conflicts:
```bash
git pull origin main --rebase
git push origin main
```

## 🎉 You're Ready!

Your project is complete and ready for the hackathon! 🚀
