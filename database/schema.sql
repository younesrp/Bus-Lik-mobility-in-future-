CREATE DATABASE buslik;
USE buslik;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin', 'controller') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Wallets table
CREATE TABLE wallets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE NOT NULL,
    balance DECIMAL(10,2) DEFAULT 0.00,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Subscriptions table
CREATE TABLE subscriptions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('basic', 'premium', 'student') DEFAULT 'basic',
    is_active BOOLEAN DEFAULT 0,
    start_date DATE,
    end_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
-- Stations table
CREATE TABLE stations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    latitude DECIMAL(10,8) NOT NULL,
    longitude DECIMAL(11,8) NOT NULL
);

-- Lines table
CREATE TABLE lines (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(10) UNIQUE NOT NULL
);

-- Line-Stations junction table
CREATE TABLE line_stations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    line_id INT NOT NULL,
    station_id INT NOT NULL,
    station_order INT NOT NULL,
    FOREIGN KEY (line_id) REFERENCES lines(id) ON DELETE CASCADE,
    FOREIGN KEY (station_id) REFERENCES stations(id) ON DELETE CASCADE,
    UNIQUE KEY unique_line_station (line_id, station_id)
);

-- Trips table
CREATE TABLE trips (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    line_id INT NOT NULL,
    start_station_id INT,
    end_station_id INT,
    price DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (line_id) REFERENCES lines(id),
    FOREIGN KEY (start_station_id) REFERENCES stations(id),
    FOREIGN KEY (end_station_id) REFERENCES stations(id)
);

-- QR Tokens table
CREATE TABLE qr_tokens (
    id INT PRIMARY KEY AUTO_INCREMENT,
    trip_id INT NOT NULL,
    token VARCHAR(255) UNIQUE NOT NULL,
    expires_at TIMESTAMP NOT NULL,
    used_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trip_id) REFERENCES trips(id) ON DELETE CASCADE
);