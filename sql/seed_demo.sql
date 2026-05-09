-- Demo seed data for daily/weekly/monthly reports.
-- Run AFTER schema.sql:   mysql -u root csit314 < sql/seed_demo.sql
-- Today's reference date: 2026-05-07.

USE csit314;

-- =========================================================
-- Extra user accounts spread across recent dates
-- =========================================================
INSERT INTO user_accounts (name, username, email, phone_number, password, profile, status, created_at) VALUES
('Donee Two',     'donee2',     'donee2@example.com',     '93000001', 'donee123',     'Donee',      'Active', '2026-05-07 09:15:00'),
('Donee Three',   'donee3',     'donee3@example.com',     '93000002', 'donee123',     'Donee',      'Active', '2026-05-06 14:40:00'),
('Donee Four',    'donee4',     'donee4@example.com',     '93000003', 'donee123',     'Donee',      'Active', '2026-05-04 11:05:00'),
('Donee Five',    'donee5',     'donee5@example.com',     '93000004', 'donee123',     'Donee',      'Active', '2026-05-02 16:20:00'),
('Fund Raiser 2', 'fundraiser2','fundraiser2@example.com','92000001', 'fundraiser123','Fundraiser', 'Active', '2026-04-28 10:00:00'),
('Fund Raiser 3', 'fundraiser3','fundraiser3@example.com','92000002', 'fundraiser123','Fundraiser', 'Active', '2026-04-15 08:30:00'),
('Donee Six',     'donee6',     'donee6@example.com',     '93000005', 'donee123',     'Donee',      'Active', '2026-03-22 13:00:00');

-- =========================================================
-- Extra fundraising activities spread across recent dates.
-- IDs continue from the schema seed (existing rows: 1-6).
-- =========================================================
INSERT INTO fundraising_activity
(campaign_title, category, description, end_date, goal_amount, donee_name, phone, fundraiser_name, created_at)
VALUES
('Hospital Fund',         'Medical',         'Support a local hospital wing renovation.',     '2026-12-31', 8000.00, 'Anna',    '91111111', 'fundraiser',  '2026-05-07 10:00:00'),
('College Scholarship',   'Education',       'Scholarships for low-income college students.', '2026-11-30', 6000.00, 'Brian',   '91111112', 'fundraiser',  '2026-05-06 11:30:00'),
('Book Drive',            'Education',       'Donate books to rural schools.',                '2026-10-31', 2000.00, 'Cara',    '91111113', 'fundraiser2', '2026-05-05 09:00:00'),
('Flood Relief',          'Disaster Relief', 'Emergency relief for flood-affected areas.',    '2026-09-30', 7000.00, 'David',   '91111114', 'fundraiser',  '2026-05-04 15:00:00'),
('Senior Care Project',   'Social',          'Care packages for the elderly.',                '2026-08-31', 3500.00, 'Eva',     '91111115', 'fundraiser2', '2026-05-02 12:45:00'),
('Animal Shelter Fund',   'Animal Welfare',  'New shelter facilities for rescued animals.',   '2026-07-31', 4500.00, 'Felix',   '91111116', 'fundraiser',  '2026-04-28 14:30:00'),
('Community Garden',      'Community',       'Build a shared garden for the neighbourhood.',  '2026-07-31', 2500.00, 'Grace',   '91111117', 'fundraiser3', '2026-04-15 10:00:00'),
('Cancer Research',       'Medical',         'Support ongoing cancer research projects.',     '2026-12-31', 9000.00, 'Henry',   '91111118', 'fundraiser',  '2026-04-10 09:30:00'),
('Stray Dog Rescue',      'Animal Welfare',  'Rescue and rehome stray dogs.',                 '2026-09-30', 3000.00, 'Iris',    '91111119', 'fundraiser2', '2026-03-25 16:00:00'),
('Earthquake Relief 2',   'Disaster Relief', 'Continued relief for earthquake survivors.',    '2026-08-31', 5500.00, 'Jacob',   '91111120', 'fundraiser',  '2026-03-10 11:00:00');

-- =========================================================
-- Favourites across donees and dates.
-- Note: we do NOT hardcode activity IDs; we look them up by title
-- so this seed survives differing AUTO_INCREMENT values.
-- =========================================================
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee',  id, '2026-05-07 10:30:00' FROM fundraising_activity WHERE campaign_title = 'Hospital Fund';
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee',  id, '2026-05-07 14:00:00' FROM fundraising_activity WHERE campaign_title = 'Food Drive';
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee2', id, '2026-05-07 16:20:00' FROM fundraising_activity WHERE campaign_title = 'Pet Aid';

INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee',  id, '2026-05-06 09:50:00' FROM fundraising_activity WHERE campaign_title = 'College Scholarship';
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee3', id, '2026-05-06 17:10:00' FROM fundraising_activity WHERE campaign_title = 'School Supplier';

INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee2', id, '2026-05-05 11:00:00' FROM fundraising_activity WHERE campaign_title = 'Book Drive';
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee4', id, '2026-05-05 13:30:00' FROM fundraising_activity WHERE campaign_title = 'Flood Relief';

INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee',  id, '2026-05-03 10:15:00' FROM fundraising_activity WHERE campaign_title = 'Stray Cat Rescue';
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee5', id, '2026-05-02 18:00:00' FROM fundraising_activity WHERE campaign_title = 'Senior Care Project';

INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee',  id, '2026-04-28 15:45:00' FROM fundraising_activity WHERE campaign_title = 'Animal Shelter Fund';
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee2', id, '2026-04-20 12:00:00' FROM fundraising_activity WHERE campaign_title = 'Earthquake Relief';
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee3', id, '2026-04-15 16:30:00' FROM fundraising_activity WHERE campaign_title = 'Community Garden';

INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee6', id, '2026-03-22 14:00:00' FROM fundraising_activity WHERE campaign_title = 'Cancer Research';
INSERT INTO favourite_fundraising_activity (username, activity_id, created_at)
SELECT 'donee',  id, '2026-03-10 11:45:00' FROM fundraising_activity WHERE campaign_title = 'Earthquake Relief 2';


-- =========================================================
-- Completed FRA
-- =========================================================

INSERT INTO completed_fra (fra_id, completed_date)
SELECT id, '2026-05-07'
FROM fundraising_activity
WHERE campaign_title = 'Hospital Fund';

INSERT INTO completed_fra(fra_id, completed_date)
SELECT id, '2026-05-06'
FROM fundraising_activity
WHERE campaign_title = 'College Scholarship';

INSERT INTO completed_fra(fra_id, completed_date)
SELECT id, '2026-05-05'
FROM fundraising_activity
WHERE campaign_title = 'Flood Relief';

INSERT INTO completed_fra(fra_id, completed_date)
SELECT id, '2026-05-03'
FROM fundraising_activity
WHERE campaign_title = 'Animal Shelter Fund';