<?php
session_start();

if (!isset($_SESSION['userUid'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style-shop.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <title></title>
</head>
<body>

<main>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-3 login-form-1">
                <h2>SHOP</h2>
                <hr>
                <nav class="nav flex-column nav">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                    <a class="nav-link active" href="">Zum Shop</a>
                </nav>
            </div>
            <div class="col-md-9 login-form-2">
                <h1>Produktauswahl</h1>
                <h6>Bitte wähle ein Produkt aus</h6>

                <div class="product">
                    <div class="product__price-tag">
                        <label class="product__price-tag-price"><i class="fab fa-cuttlefish"></i> <s>1.200</s>
                            1.000</label>
                    </div>
                    <div class="product__price-tag2">
                        <label class="product__price-tag-price2"><i class="fas fa-dollar-sign"></i> SALE</label>
                    </div>
                    <i class="far fa-star"></i>
                    <h1>30 Tage Premium</h1>
                    <p>Du erhältst für <b>30 Tage</b> den Premium-Rang.</p>
                    <a href="purchase1.php"><img
                                src="/img/onemonth.jpg"></a>
                </div>
                <div class="product">
                    <div class="product__price-tag">
                        <label class="product__price-tag-price"><i class="fab fa-cuttlefish"></i> 3.500</label>
                    </div>
                    <i class="fas fa-star"></i>
                    <h1>Lebenslang Premium</h1>
                    <p>Du erhältst <b>dauerhaft</b> den Premium-Rang.</p>
                    <a href="purchase2.php"><img
                                src="/img/lifetime.jpg"></a>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>

</footer>
</body>
</html>
