<?php
declare(strict_types=1);
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// CATEGORIZE ITEMS
$tokens = [
    ['category' => 'Harry Potter','name' => '10 Galleons', 'price' => 4.99],
    ['category' => 'Harry Potter','name' => '20 Sickles', 'price' => 4.99],
    ['category' => 'Harry Potter','name' => '30 Knuts', 'price' => 5.99],
    ['category' => 'Harry Potter','name' => 'Mixed package', 'price' => 14.99],
    ['category' => 'Avatar','name' => 'Water Tribe coin set', 'price' => 8.99],
    ['category' => 'Avatar','name' => 'Earth Kingdom coin set', 'price' => 8.99],
    ['category' => 'Avatar','name' => 'Fire Nation coin set', 'price' => 8.99],
    ['category' => 'Avatar','name' => 'Air Nomad coin set', 'price' => 8.99],
    ['category' => 'Avatar','name' => 'Four Nations mixed package', 'price' => 28.99],
    ['category' => 'Game of Thrones','name' => '10 Gold Dragons', 'price' => 4.99],
    ['category' => 'Game of Thrones','name' => '20 Silver Stags', 'price' => 4.99],
    ['category' => 'Game of Thrones','name' => '30 Copper Pennies', 'price' => 5.99],
    ['category' => 'Game of Thrones','name' => 'Mixed package', 'price' => 14.99],
    ['category' => 'Warhammer 40K', 'name' => '25 Gold Thrones', 'price' => 12.99],
    ['category' => 'Warhammer 40K', 'name' => '50 Gold Thrones', 'price' => 21.99],
    ['category' => 'Dungeons & Dragons', 'name' => '10 Platinum Suns', 'price' => 6.99],
    ['category' => 'Dungeons & Dragons', 'name' => '25 Platinum Suns', 'price' => 14.99],
    ['category' => 'Dungeons & Dragons', 'name' => '50 Gold Dragons', 'price' => 24.99],
    ['category' => 'Dungeons & Dragons', 'name' => '150 Gold Dragons', 'price' => 49.99],
    ['category' => 'Dungeons & Dragons', 'name' => '100 Silver Shards', 'price' => 24.99],
    ['category' => 'Dungeons & Dragons', 'name' => '300 Silver Shards', 'price' => 49.99],
    ['category' => 'Dungeons & Dragons', 'name' => '200 Copper Nibs', 'price' => 24.99],
    ['category' => 'Dungeons & Dragons', 'name' => '600 Copper Nibs', 'price' => 49.99],
    ['category' => 'Dungeons & Dragons', 'name' => 'Mixed jewelry bag - small', 'price' => 8.99],
    ['category' => 'Dungeons & Dragons', 'name' => 'Mixed jewelry bag - medium', 'price' => 14.99],
    ['category' => 'Star Wars', 'name' => '5 Credit Chips', 'price' => 5.99],
    ['category' => 'Star Wars', 'name' => '25 Credit Chips', 'price' => 24.99],
    ['category' => 'Star Wars', 'name' => '5 Beskar Chips', 'price' => 6.99],
    ['category' => 'Star Wars', 'name' => '25 Beskar Chips', 'price' => 27.99],
    ['category' => 'Elder Scrolls', 'name' => '15 Gold Septims', 'price' => 11.99],
    ['category' => 'Elder Scrolls', 'name' => '50 Gold Septims', 'price' => 34.99],
];
$accessories = [
    ['category' => 'Accessories', 'name' => 'Leather pouch - small', 'price' => 8.99],
    ['category' => 'Accessories', 'name' => 'Leather pouch - medium', 'price' => 12.99],
    ['category' => 'Accessories', 'name' => 'Leather pouch - large', 'price' => 18.99],
    ['category' => 'Accessories', 'name' => 'Leather pouch - king', 'price' => 24.99],
    ['category' => 'Accessories', 'name' => 'Velvet pouch - small', 'price' => 8.99],
    ['category' => 'Accessories', 'name' => 'Velvet pouch - medium', 'price' => 12.99],
    ['category' => 'Accessories', 'name' => 'Velvet pouch - large', 'price' => 18.99],
    ['category' => 'Accessories', 'name' => 'Velvet pouch - king', 'price' => 24.99],
];
// DEFINE CATEGORIES
if($_GET['cat'] == 0){
    $products = array_merge($tokens, $accessories);
} else if($_GET['cat'] == 1) {
    $products = $tokens;
} else if ($_GET['cat'] == 2) {
    $products = $accessories;
};

//INITIALIZE TOTAL AS ZERO
$totalValue = 0;

//VALIDATE USER INPUT
function validate() {
    $error = false;
    // CHECK FOR EMPTY FIELDS
    $required = ['email', 'street', 'streetnumber', 'zipcode', 'city', 'products'];
    $emptyFields = [];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
            $emptyFields[] = $field;
            // echo "<p class='alert alert-danger'>{$field} is required.</p>";
        } 
    }
    if (!empty($emptyFields)) {
        echo "<p class='alert alert-danger'> All fields must be filled in.</p>";
        $error = true;
    } else {
        // echo "<p class='alert alert-success'>All fields filled in.</p>";
    }
    // CHECK FOR NUMERICAL ZIPCODE
    if(!is_numeric($_POST['zipcode'])){
        echo "<p class='alert alert-warning'>Zipcode can only contain numbers.</p>";
        $error = true;
    } else {
        // echo "<p class='alert alert-success'>Zipcode validated.</p>";
    }
    // CHECK FOR VALID EMAIL
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "<p class='alert alert-warning'>Invalid e-mail address.</p>";
        $error = true;
    } else {
        // echo "<p class='alert alert-success'>E-mail address validated.</p>";
    }
    // CHECK FOR EMPTY SHOPPING CART
    if (empty($_POST['products'])) {
        echo "<p class='alert alert-danger'>Please select products before ordering.</p>";
        $error = true;
    } else {
        // echo "<p class='alert alert-success'>Chosen products found.</p>";
    }
    return $error; 
}

//HANDLE FORM
function handleForm() {
    global $products, $totalValue;
    $error = validate();
    if (!$error) {
        $selectedProducts = [];
        foreach ($_POST['products'] as $index => $value) {
            if ($value === '1') {
                $selectedProducts[] = $products[$index];
                $totalValue += $products[$index]['price'];
            }
        }
        echo "<p><strong>Order confirmation</strong> sent to <strong>{$_POST['email']}</strong>.</p>";
        echo "<h3>Delivery address:</h3>";
        echo "<p>{$_POST['street']} {$_POST['streetnumber']}</p>";
        echo "<p>{$_POST['zipcode']} {$_POST['city']}</p>";
        echo "<h3>Selected products:</h3>";

        foreach ($selectedProducts as $selectedProduct) {
            echo "<p>{$selectedProduct['name']}</p>";
        }

        echo "<p>Total cost: &euro; $totalValue</p>";
        $formSubmitted = true;
    } else {
        // Handle errors if any
    }
}

$formSubmitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$formSubmitted) {
    handleForm();
}

// Check if form submitted and save POST data to session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['email'] = $_POST['email'] ?? '';
    $_SESSION['street'] = $_POST['street'] ?? '';
    $_SESSION['streetnumber'] = $_POST['streetnumber'] ?? '';
    $_SESSION['city'] = $_POST['city'] ?? '';
    $_SESSION['zipcode'] = $_POST['zipcode'] ?? '';
}
//INITIALIZE WITH SAVED VALUES OR BLANK
$email = $_SESSION['email'] ?? '';
$street = $_SESSION['street'] ?? '';
$streetnumber = $_SESSION['streetnumber'] ?? '';
$city = $_SESSION['city'] ?? '';
$zipcode = $_SESSION['zipcode'] ?? '';

require 'form-view.php';