<?php
/*
 * Na stronie koszyka będzie możliwość edycji koszyka, zwiększenia ilości produktów w koszyku, usunięcia 
 * produktu z koszyka, powrót do zakupów oraz zatwierdzenie zakupów(zmiana statusu zamówienia)
 */
require_once __DIR__ . '/../src/connection.php';
require_once __DIR__ . '/../src/Category.php';
require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/Photos.php';
require_once __DIR__ .'/../src/User.php';
require_once __DIR__ . '/../src/Order.php';
require_once __DIR__ . '/../src/session.php';
?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Cart Page</title>
    </head>
    
    
    <body>
        <hr>Strona koszyka:<br>
        Miejsce na nagłówek wspolny dla wszystkich stron, gdzie będzie:<br>
        1. Nazwa sklepu i Logo<br><br>
        2. 
<?php
    if (isset($_SESSION['loggedUserId'])) {
            
        $loggedUserId = User::loadUserById($connection, $_SESSION['loggedUserId']);
        echo "Zalogowany użytkownik to: ";
        echo $loggedUserId->getName(). ' o id'. $_SESSION['loggedUserId'] .'<br><br>';
    } else {
            header('Location: UserLoginPage.php');
    }
?>
        3. Koszyk z liczbą produktów i wartością<br><br>
        
        <table>
            <tr>
<?php
     $allCategories = Category::loadAllCategory($connection);  //!!!zmienic ta metode aby sortowala po ID lub innej sensownej wartosci odwzorowujacej oczekiwana kolejnosc
     foreach ($allCategories as $category) {
         echo '<td><a href="index.php?categoryId='.$category->getId().'">'.$category->getCategoryName().'</a></td>';
     }
 ?> 
            </tr>
        </table>
        <hr>
        
<?php 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['productId'])) {
            echo $_POST['productId'];
            $cart = Order::getCartByUserId($connection, $loggedUserId->getId());
            
            echo('<table border=1><tr><th>Product</th><th>Price</th><th>Quantity</th><th>Sum</th></tr>');
            foreach ($cart->getProductOrder() as $value) {
                echo('<tr><td>'.$value['name'].'</td>');
                echo('<td>'.$value['price'].'</td>');
                echo('<td>'.$value['quantity'].'</td>');
                echo('<td>'.number_format($value['price']*$value['quantity'],2).'</td></tr>');
            }
            echo('</table>');
        }
    }
?>