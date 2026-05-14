<?php

$file = fopen("test_data.sql", "w");

// =========================================
// USER PROFILES
// =========================================

fwrite($file, "-- USER PROFILES\n");
fwrite($file, "INSERT INTO user_profiles (profile_name, description) VALUES\n");
fwrite($file, "('Platform Manager', 'Manages the platform and oversees system operations.'),\n");
fwrite($file, "('User Admin', 'Creates and manages user accounts and user profiles.'),\n");
fwrite($file, "('Fundraiser', 'Creates and manages fundraising activities.'),\n");
fwrite($file, "('Donee', 'Receives funds and searches for fundraising activities.');\n\n");

// =========================================
// USER ACCOUNTS
// =========================================

fwrite($file, "-- USER ACCOUNTS\n");
fwrite($file, "INSERT INTO user_accounts\n");
fwrite($file, "(name, username, email, phone_number, password, profile, status)\n");
fwrite($file, "VALUES\n");

$data = [];

// DONEE
for ($i = 1; $i <= 99; $i++) {
    $data[] = "('Donee $i', 'donee$i', 'donee$i@gmail.com', '9000" . str_pad($i, 4, '0', STR_PAD_LEFT) . "', '1234', 'Donee', 'Active')";
}

// FUNDRAISER
for ($i = 1; $i <= 99; $i++) {
    $data[] = "('Fundraiser $i', 'fundraiser$i', 'fundraiser$i@gmail.com', '9100" . str_pad($i, 4, '0', STR_PAD_LEFT) . "', '1234', 'Fundraiser', 'Active')";
}

// USER ADMIN
for ($i = 1; $i <= 99; $i++) {
    $data[] = "('User Admin $i', 'useradmin$i', 'useradmin$i@gmail.com', '9200" . str_pad($i, 4, '0', STR_PAD_LEFT) . "', '1234', 'User Admin', 'Active')";
}

// PLATFORM MANAGER
for ($i = 1; $i <= 99; $i++) {
    $data[] = "('Platform Manager $i', 'pm$i', 'pm$i@gmail.com', '9300" . str_pad($i, 4, '0', STR_PAD_LEFT) . "', '1234', 'Platform Manager', 'Active')";
}

fwrite($file, implode(",\n", $data));
fwrite($file, ";");

// =========================================
// FRA CATEGORIES
// =========================================

$categories = [
    ['Medical', 'Medical support and healthcare funding.'],
    ['Education', 'Educational assistance and school funding.'],
    ['Social', 'Social welfare and community support.'],
    ['Disaster Relief', 'Emergency disaster aid and recovery.'],
    ['Animal Welfare', 'Animal rescue and welfare projects.'],
    ['Community', 'Community development initiatives.'],
    ['Others', 'Miscellaneous fundraising activities.'],
    ['Healthcare', 'Healthcare support projects.'],
    ['Mental Health', 'Mental health awareness and support.'],
    ['Children', 'Support for children and youth.'],
    ['Disability Aid', 'Aid for disabled individuals.'],
    ['Homeless Support', 'Support for homeless individuals.'],
    ['Arts & Culture', 'Arts and cultural activities.'],
    ['Sports', 'Sports and athletic support.'],
    ['Environment', 'Environmental sustainability projects.'],
    ['Orphan Support', 'Support for orphanages and children.'],
    ['Women Support', 'Women empowerment initiatives.'],
    ['Senior Care', 'Support for elderly care services.'],
    ['Emergency Aid', 'Emergency assistance projects.'],
    ['Technology', 'Technology and innovation support.']
];

fwrite($file, "-- FRA CATEGORIES\n");
fwrite($file, "INSERT INTO fra_categories (name, description) VALUES\n");

$catData = [];
foreach ($categories as $cat) {
    $catData[] = "('{$cat[0]}', '{$cat[1]}')";
}

fwrite($file, implode(",\n", $catData));
fwrite($file, ";\n\n");

// =========================================
// FRA
// =========================================

$fraCategories = array_column($categories, 0);

fwrite($file, "-- FRA\n");
fwrite($file, "INSERT INTO fundraising_activity\n");
fwrite($file, "(campaign_title, category, description, end_date, goal_amount, donee_name, phone, fundraiser_name)\n");
fwrite($file, "VALUES\n");

$fraData = [];

for ($i = 1; $i <= 100; $i++) {

    $category = $fraCategories[array_rand($fraCategories)];
    $goal = rand(1000, 10000);

    $fraData[] = "('Campaign $i', '$category', 'Description for campaign $i', '2026-12-31', '$goal', 'Donee $i', '95" . str_pad($i, 6, '0', STR_PAD_LEFT) . "', 'fundraiser" . rand(1,99) . "')";
}

fwrite($file, implode(",\n", $fraData));
fwrite($file, ";\n\n");

// =========================================
// FAVOURITE FUNDRAISING ACTIVITIES
// =========================================

fwrite($file, "-- FAVOURITE FUNDRAISING ACTIVITIES\n");
fwrite($file, "INSERT INTO favourite_fundraising_activity\n");
fwrite($file, "(username, activity_id)\n");
fwrite($file, "VALUES\n");

$favData = [];

for ($i = 1; $i <= 100; $i++) {

    $favData[] = "('donee" . rand(1,99) . "', '" . rand(1,100) . "')";
}

fwrite($file, implode(",\n", $favData));
fwrite($file, ";\n\n");

// =========================================
// DONATIONS
// =========================================

fwrite($file, "-- DONATIONS\n");
fwrite($file, "INSERT INTO donation\n");
fwrite($file, "(fra_id, donee_name, amount)\n");
fwrite($file, "VALUES\n");

$donationData = [];

for ($i = 1; $i <= 150; $i++) {

    $amount = rand(10, 500);

    $donationData[] = "('" . rand(1,100) . "', 'donee" . rand(1,99) . "', '$amount')";
}

fwrite($file, implode(",\n", $donationData));
fwrite($file, ";\n\n");

// =========================================
// COMPLETED FRA
// =========================================

fwrite($file, "-- COMPLETED FRA\n");
fwrite($file, "INSERT INTO completed_fra\n");
fwrite($file, "(fra_id)\n");
fwrite($file, "VALUES\n");

$completedData = [];

for ($i = 1; $i <= 50; $i++) {
    $completedData[] = "('$i')";
}

fwrite($file, implode(",\n", $completedData));
fwrite($file, ";\n\n");

fclose($file);


echo "SQL file generated successfully!";
?>