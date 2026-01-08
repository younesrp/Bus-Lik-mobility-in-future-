USE buslik;

-- Insert sample stations
INSERT INTO stations (name, latitude, longitude) VALUES
('Gare Centrale', 33.5731, -7.5898),
('Place Mohammed V', 33.5928, -7.6167),
('Avenue Hassan II', 33.5950, -7.6200),
('Hay Riad', 33.5500, -7.5500),
('Maarif', 33.5800, -7.6000),
('Ain Diab', 33.5900, -7.6400),
('Sidi Maarouf', 33.5700, -7.6500),
('Oasis', 33.5600, -7.5800),
('Hay Mohammadi', 33.6000, -7.5800),
('Derb Sultan', 33.6100, -7.6000);

-- Insert sample lines
INSERT INTO lines (name, code) VALUES
('Ligne Centre-Ville', 'LCV'),
('Ligne Côtière', 'LCO'),
('Ligne Express Nord', 'LEN'),
('Ligne Express Sud', 'LES'),
('Ligne Circulaire', 'LCI');

-- Insert line-stations relationships
-- Ligne Centre-Ville (LCV)
INSERT INTO line_stations (line_id, station_id, station_order) VALUES
(1, 1, 1), (1, 2, 2), (1, 3, 3), (1, 5, 4), (1, 8, 5);

-- Ligne Côtière (LCO)
INSERT INTO line_stations (line_id, station_id, station_order) VALUES
(2, 4, 1), (2, 5, 2), (2, 6, 3), (2, 7, 4);

-- Ligne Express Nord (LEN)
INSERT INTO line_stations (line_id, station_id, station_order) VALUES
(3, 1, 1), (3, 9, 2), (3, 10, 3);

-- Ligne Express Sud (LES)
INSERT INTO line_stations (line_id, station_id, station_order) VALUES
(4, 2, 1), (4, 3, 2), (4, 6, 3);

-- Ligne Circulaire (LCI)
INSERT INTO line_stations (line_id, station_id, station_order) VALUES
(5, 1, 1), (5, 2, 2), (5, 5, 3), (5, 8, 4), (5, 1, 5);

-- Create admin user (password: admin123)
INSERT INTO users (fullname, email, password, role) VALUES
('Admin BusLik', 'admin@buslik.ma', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Create wallet for admin
INSERT INTO wallets (user_id, balance) VALUES
(1, 1000.00);

-- Create sample regular user (password: user123)
INSERT INTO users (fullname, email, password, role) VALUES
('Test User', 'user@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Create wallet for test user
INSERT INTO wallets (user_id, balance) VALUES
(2, 50.00);

-- Create sample subscription for test user
INSERT INTO subscriptions (user_id, type, is_active, start_date, end_date) VALUES
(2, 'premium', 1, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY));
