# 🚌 BusLik - Future Mobility Platform

**BusLik** is a modern, innovative bus transportation management system designed for the future of urban mobility. This platform enables users to book bus tickets, manage subscriptions, and use QR codes for seamless travel experiences.

## ✨ Features

### For Users
- 🔐 **User Authentication** - Secure registration and login system
- 💰 **Digital Wallet** - Manage your balance and recharge easily
- 🎫 **QR Code Tickets** - Generate and validate QR codes for bus trips
- 📍 **Station & Line Management** - Browse available stations and bus lines
- 📊 **Trip History** - Track all your past and current trips
- 🎟️ **Subscription Plans** - Choose from Basic, Premium, or Student plans
- 📱 **Real-time Validation** - QR code validation system for controllers

### For Administrators
- 📈 **Dashboard Analytics** - Comprehensive statistics and insights
- 🛣️ **Line Management** - Add, edit, and manage bus lines
- 🚏 **Station Management** - Manage bus stations and their locations
- ⏰ **Schedule Management** - Set and manage bus schedules
- 👥 **User Management** - Monitor and manage user accounts
- 📊 **Statistics** - View detailed analytics and reports

## 🛠️ Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Architecture**: MVC Pattern
- **Security**: Password hashing, Session management, SQL injection prevention

## 📋 Prerequisites

- PHP 7.4 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Apache/Nginx web server
- XAMPP/WAMP/MAMP (for local development)

## 🚀 Installation

### Step 1: Clone the Repository
```bash
git clone https://github.com/yourusername/Bus-Lik-mobility-in-future-.git
cd Bus-Lik-mobility-in-future-
```

### Step 2: Database Setup

1. Create a MySQL database:
```sql
CREATE DATABASE buslik;
```

2. Import the database schema:
```bash
mysql -u root -p buslik < database/schema.sql
```

3. (Optional) Import seed data for testing:
```bash
mysql -u root -p buslik < database/seed.sql
```

### Step 3: Configure Database Connection

Edit `config/Db.php` and update the database credentials:
```php
private static $host = "localhost";
private static $db_name = "buslik";
private static $user = "root";
private static $password = "";
private static $port = 3307; // Adjust if needed
```

### Step 4: Web Server Configuration

#### For XAMPP:
1. Copy the project folder to `C:\xampp\htdocs\` (Windows) or `/opt/lampp/htdocs/` (Linux)
2. Access via: `http://localhost/Bus-Lik-mobility-in-future-/public/`

#### For Apache:
1. Configure virtual host pointing to the `public/` directory
2. Ensure mod_rewrite is enabled

### Step 5: Set Permissions (Linux/Mac)
```bash
chmod -R 755 .
chmod -R 777 storage/ # if you have a storage directory
```

## 📖 Default Credentials

After importing seed data, you can use these test accounts:

**Admin Account:**
- Email: `admin@buslik.ma`
- Password: `admin123`

**Test User Account:**
- Email: `user@test.com`
- Password: `user123`

## 🎯 Usage

### User Flow
1. **Register/Login** - Create an account or login
2. **Recharge Wallet** - Add funds to your digital wallet
3. **Select Trip** - Choose your departure and arrival stations
4. **Generate QR Code** - Create a QR code ticket
5. **Validate** - Show QR code to controller for validation

### Admin Flow
1. Login with admin credentials
2. Access admin dashboard
3. Manage lines, stations, schedules, and users
4. View statistics and analytics

## 📁 Project Structure

```
Bus-Lik-mobility-in-future-/
├── admin/              # Admin panel pages
├── api/                # API endpoints
├── app/
│   ├── controllers/    # MVC Controllers
│   └── models/         # Data models
├── assets/             # CSS, JS, Images
├── auth/               # Authentication handlers
├── config/             # Configuration files
├── database/           # SQL schema and seeds
├── includes/           # Reusable PHP includes
├── public/             # Public-facing pages
└── vendor/             # Composer dependencies
```

## 🔒 Security Features

- Password hashing using `password_hash()` with bcrypt
- Prepared statements to prevent SQL injection
- Session-based authentication
- CSRF protection (recommended to add)
- Input validation and sanitization

## 🧪 Testing

1. Register a new user account
2. Recharge wallet with test amount
3. Generate a QR code for a trip
4. Validate the QR code
5. Check trip history

## 🚧 API Endpoints

### Authentication
- `POST /api/register.php` - User registration
- `POST /api/login.php` - User login

### Trips & QR Codes
- `POST /api/qr-generate.php` - Generate QR code for trip
- `POST /api/qr-validate.php` - Validate QR code token
- `GET /api/historique_trajets.php` - Get trip history

### Data
- `GET /api/lignes.php` - Get all bus lines
- `GET /api/stations.php` - Get all stations
- `GET /api/lignes_stations.php?line_id=X` - Get stations for a line
- `GET /api/horaires.php` - Get schedules

### Wallet
- `POST /api/recharge.php` - Recharge wallet

### Admin
- `GET /api/admin/stats.php` - Get admin statistics

## 🎨 Features Highlights

### QR Code System
- Secure token generation using cryptographically secure random bytes
- Time-based expiration (2 hours default)
- One-time use validation
- Automatic wallet deduction

### Wallet System
- Automatic wallet creation on user registration
- Secure balance management
- Transaction history tracking

### Subscription System
- Multiple subscription types (Basic, Premium, Student)
- Active/inactive status tracking
- Date-based expiration

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is created for hackathon purposes. All rights reserved.

## 👥 Team

Developed for the Future Mobility Hackathon.

## 🎯 Future Enhancements

- [ ] Mobile app (React Native/Flutter)
- [ ] Real-time GPS tracking
- [ ] Push notifications
- [ ] Payment gateway integration
- [ ] Multi-language support
- [ ] Advanced analytics dashboard
- [ ] Machine learning for route optimization

## 📞 Support

For issues, questions, or contributions, please open an issue on GitHub.

---

**Made with ❤️ for the Future of Mobility**
