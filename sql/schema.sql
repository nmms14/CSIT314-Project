CREATE DATABASE IF NOT EXISTS csit314;
USE csit314;

CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    role       ENUM('platform_manager','donee','fund_raiser','user_admin') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password, role) VALUES
('manager', 'manager123', 'platform_manager'), 
('fundraiser', 'fundraiser123', 'fund_raiser');
