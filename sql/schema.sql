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
    status       ENUM('Active','Suspended') NOT NULL DEFAULT 'Active',
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, username, email, phone_number, password, profile, status) VALUES
('Platform Manager', 'manager',    'manager@example.com',    '91234567', 'manager123',    'platform_manager', 'Active'),
('Fund Raiser',      'fundraiser', 'fundraiser@example.com', '92345678', 'fundraiser123', 'fund_raiser', 'Active'),
('Donee',            'donee',      'donee@example.com',      '93456789', 'donee123',      'donee', 'Active'),
('User Admin',       'useradmin',  'useradmin@example.com',  '94567890', 'useradmin123',  'user_admin', 'Active');

CREATE TABLE IF NOT EXISTS fundraising_activity (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    fra_name       VARCHAR(150) NOT NULL,
    category       VARCHAR(50)  NOT NULL,
    description    TEXT         NOT NULL,
    donee_info     TEXT         NOT NULL,
    end_date       DATE         NOT NULL,
    goal_amount    DECIMAL(12,2) NOT NULL,
    raised_amount  DECIMAL(12,2) NOT NULL DEFAULT 0,
    status         ENUM('Ongoing','Completed','Cancelled') NOT NULL DEFAULT 'Ongoing',
    created_at     TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);
