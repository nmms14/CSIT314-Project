CREATE DATABASE IF NOT EXISTS csit314;
USE csit314;

CREATE TABLE IF NOT EXISTS users (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    username     VARCHAR(50)  NOT NULL UNIQUE,
    email        VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20)  NOT NULL,
    password     VARCHAR(255) NOT NULL,
    profile      ENUM('platform_manager','donee','fund_raiser','user_admin') NOT NULL,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, username, email, phone_number, password, profile) VALUES
('Platform Manager', 'manager',    'manager@example.com',    '91234567', 'manager123',    'platform_manager'),
('Fund Raiser',      'fundraiser', 'fundraiser@example.com', '92345678', 'fundraiser123', 'fund_raiser'),
('Donee',            'donee',      'donee@example.com',      '93456789', 'donee123',      'donee'),
('User Admin',       'useradmin',  'useradmin@example.com',  '94567890', 'useradmin123',  'user_admin');
