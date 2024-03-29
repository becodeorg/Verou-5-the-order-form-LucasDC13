<?php // This file is mostly containing things for your view / html ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link href="./style.css" type="text/css" rel="stylesheet">
    <title>The Money Shop</title>
</head>
<body>
    <div class="parallax"></div>
    <header>
        <h1>Ye Money Shoppe</h1>
    </header>
    <div class="container">
        <h2>Place your order</h2>
        <?php // Navigation for when you need it ?>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="?cat=0">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?cat=1">Tokens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?cat=2">Accessories</a>
                </li>
            </ul>
        </nav>

        <form method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; } ?>">
                </div>
                <div></div>
            </div>

            <fieldset>
                <legend>Address</legend>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="street">Street:</label>
                        <input type="text" name="street" id="street" class="form-control" value="<?php if(isset($_SESSION['street'])) { echo $_SESSION['street']; } ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="streetnumber">Street number:</label>
                        <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?php if(isset($_SESSION['streetnumber'])) { echo $_SESSION['streetnumber']; } ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" class="form-control" value="<?php if(isset($_SESSION['city'])) { echo $_SESSION['city']; } ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php if(isset($_SESSION['zipcode'])) { echo $_SESSION['zipcode']; } ?>">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Products</legend>
                <?php foreach ($products as $i => $product): ?>
                    <div class="productWrap">
                    <label>
                    <input type="checkbox" value="1" name="products[<?= $i ?>]" class='productCheck'>
                    <?= $product['category'] ?> - <?= $product['name'] ?> - &euro; <?= number_format($product['price'], 2) ?>
                    </label><br>
                    <input class="quantField" type="number" value="1" min="1" name="quantities[<?= $i ?>]">
                    </div>  
                <?php endforeach; ?>
            </fieldset>

            <button type="submit" class="btn btn-primary">Order!</button>
        </form>

        <footer>You already ordered <strong>&euro;<?= $totalValue ?></strong> in items.</footer>
    </div>
</body>
</html>