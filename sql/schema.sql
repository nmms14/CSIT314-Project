CREATE DATABASE IF NOT EXISTS csit314;
USE csit314;

CREATE TABLE IF NOT EXISTS users (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    username     VARCHAR(50) NOT NULL UNIQUE,
    email        VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20) NOT NULL,
    password     VARCHAR(255) NOT NULL,
    profile      ENUM('platform_manager','donee','fund_raiser','user_admin') NOT NULL,
    status       ENUM('Active','Suspended') NOT NULL DEFAULT 'Active',
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, username, email, phone_number, password, profile, status) VALUES
('Platform Manager', 'manager', 'manager@example.com', '91234567', 'manager123', 'platform_manager', 'Active'),
('Fund Raiser', 'fundraiser', 'fundraiser@example.com', '92345678', 'fundraiser123', 'fund_raiser', 'Active'),
('Donee', 'donee', 'donee@example.com', '93456789', 'donee123', 'donee', 'Active'),
('User Admin', 'useradmin', 'useradmin@example.com', '94567890', 'useradmin123', 'user_admin', 'Active');

CREATE TABLE IF NOT EXISTS user_profiles (
    profile_id   INT AUTO_INCREMENT PRIMARY KEY,
    profile_name VARCHAR(50) NOT NULL UNIQUE,
    description  TEXT NOT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO user_profiles (profile_name, description) VALUES
('Platform Manager', 'Manages the platform and oversees system operations.'),
('User Admin', 'Creates and manages user accounts and user profiles.'),
('Fundraiser', 'Creates and manages fundraising activities.'),
('Donee', 'Receives funds and searches for fundraising activities.');

CREATE TABLE IF NOT EXISTS fundraising_activity (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    campaign_title  VARCHAR(255) NOT NULL,
    category        VARCHAR(100) NOT NULL,
    description     TEXT NOT NULL,
    end_date        DATE NOT NULL,
    goal_amount     DECIMAL(12,2) NOT NULL,
    donee_name      VARCHAR(255),
    phone           VARCHAR(20),
    fundraiser_name VARCHAR(255) NOT NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO fundraising_activity
(campaign_title, category, description, end_date, goal_amount, donee_name, phone, fundraiser_name)
VALUES
('Food Drive', 'Social', 'Providing food supplies to low-income families', '2026-12-31', 3000.00, 'Stella', '91234567', 'fundraiser'),
('School Supplier', 'Education', 'Supplying school materials to student', '2026-11-30', 4000.00, 'John Tan', '98765432', 'fundraiser');
