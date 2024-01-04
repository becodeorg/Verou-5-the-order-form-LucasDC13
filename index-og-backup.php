<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
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

// TODO: provide some products (you may overwrite the example)
$products = [
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
    ['category' => 'Accessories', 'name' => 'Leather pouch - small', 'price' => 8.99],
    ['category' => 'Accessories', 'name' => 'Leather pouch - medium', 'price' => 12.99],
    ['category' => 'Accessories', 'name' => 'Leather pouch - large', 'price' => 18.99],
    ['category' => 'Accessories', 'name' => 'Leather pouch - king', 'price' => 24.99],
    ['category' => 'Accessories', 'name' => 'Velvet pouch - small', 'price' => 8.99],
    ['category' => 'Accessories', 'name' => 'Velvet pouch - medium', 'price' => 12.99],
    ['category' => 'Accessories', 'name' => 'Velvet pouch - large', 'price' => 18.99],
    ['category' => 'Accessories', 'name' => 'Velvet pouch - king', 'price' => 24.99],
];

$totalValue = 0;

function validate()
{
    $required = ['email', 'street', 'streetnumber', 'zipcode', 'city', 'products'];
    $invalidFields = [];
    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
            $invalidFields[] = $field;
        }
    }
    if ($error) {
        echo "All fields are required.";
    } else {
        echo "Proceed";
    }
    // TODO: This function will send a list of invalid fields back
    return $invalidFields;
}

function handleForm()
{
    $invalidFields = validate(); // Assign the returned value of validate() to $invalidFields
    if (empty($invalidFields)) {
        global $products, $totalValue;
        if (isset($_POST['products'])) {
            // Loop through the posted data to identify selected products
            foreach ($_POST['products'] as $index => $value) {
                if ($value === '1') {
                    // If the checkbox value is '1', it's selected; add the corresponding product to the selected products array
                    $selectedProducts[] = $products[$index];
                    $totalValue += $products[$index]['price']; // Accumulate total value
                }
            }
    
            // Display the order confirmation (email, address, order)
            echo "<p><strong>Order confirmation</strong> sent to <strong>{$_POST['email']}</strong>.</p>";
            echo "<h3>Delivery Address:</h3>";
            echo "<p>{$_POST['street']} {$_POST['streetnumber']}</p>";
            echo "<p>{$_POST['zipcode']} {$_POST['city']}</p>";
            echo "<h3>Selected Products:</h3>";
            foreach ($selectedProducts as $selectedProduct) {
                echo "<p>{$selectedProduct['name']}</p>";
            }
        } else {
            echo "<p>No products selected.</p>";
        }
    
        // Display total value or perform further processing
        echo "<p>Total cost: &euro; $totalValue</p>";
        // TODO: form related tasks (step 1)
    
        // Validation (step 2) - You've already checked for invalid fields above, no need to call validate() again.
        if (!empty($invalidFields)) {
            // TODO: handle errors
        } else {
            // TODO: handle successful submission
        }
    }
}
    

// TODO: replace this by an actual check for the form to be submitted
$formSubmitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    handleForm();
}

require 'form-view.php';

// if()