CREATE DATABASE IF NOT EXISTS csit314;
USE csit314;

CREATE TABLE IF NOT EXISTS user_profiles (
    profile_id   INT AUTO_INCREMENT PRIMARY KEY,
    profile_name VARCHAR(50) NOT NULL UNIQUE,
    description  TEXT NOT NULL,
    status       ENUM('Active','Suspended') NOT NULL DEFAULT 'Active',
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS user_accounts (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    username     VARCHAR(50) NOT NULL UNIQUE,
    email        VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20) NOT NULL,
    password     VARCHAR(255) NOT NULL,
    profile      VARCHAR(50) NOT NULL,
    status       ENUM('Active','Suspended') NOT NULL DEFAULT 'Active',
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (profile) REFERENCES user_profiles(profile_name)
);

CREATE TABLE IF NOT EXISTS fundraising_activity (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    campaign_title  VARCHAR(255) NOT NULL,
    category        INT NOT NULL,
    description     TEXT NOT NULL,
    end_date        DATE NOT NULL,
    goal_amount     DECIMAL(12,2) NOT NULL,
    donee_name      VARCHAR(255),
    phone           VARCHAR(20),
    fundraiser_name VARCHAR(255) NOT NULL,
    view_count      INT NOT NULL DEFAULT 0,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP

    FOREIGN KEY (category) REFERENCES fra_categories(name)
);

CREATE TABLE IF NOT EXISTS favourite_fundraising_activity (
    id 			INT AUTO_INCREMENT PRIMARY KEY,
    username 	VARCHAR(50) NOT NULL,
    activity_id INT NOT NULL,
    created_at 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (username) REFERENCES user_accounts(username) ON DELETE CASCADE,

    FOREIGN KEY (activity_id) REFERENCES fundraising_activity(id) ON DELETE CASCADE,

    UNIQUE (username, activity_id)
);

CREATE TABLE IF NOT EXISTS fra_categories (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(100) NOT NULL UNIQUE,
    description    TEXT NOT NULL,
    created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE donation (
    donation_id INT AUTO_INCREMENT PRIMARY KEY,
    fra_id INT NOT NULL,
    donee_name VARCHAR(100),
    amount DECIMAL(10,2) NOT NULL,
    donation_date DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (fra_id)
    REFERENCES fundraising_activity(id)
);

CREATE TABLE completed_fra (
    completed_id INT AUTO_INCREMENT PRIMARY KEY,
    fra_id INT NOT NULL,
    completed_date DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (fra_id)
    REFERENCES fundraising_activity(id)
);