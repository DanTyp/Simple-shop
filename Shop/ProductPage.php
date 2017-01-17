<?php
/*
 * Na tej stronie będzie wczytywany produkt, jego opis, cena i dostępność oraz możliwość dodania produktu 
 * do koszyka przyciskiem i przekierowanie na stronę koszyka
 */
require_once __DIR__ . '/../src/connection.php';
require_once __DIR__ . '/../src/Category.php';
require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ . '/../src/Photos.php';
require_once __DIR__ .'/../src/User.php';
require_once __DIR__ . '/../src/session.php';
?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Product Page</title>
    </head>
    
    
    <body>
        <hr>Strona produktu:<br>
        Miejsce na nagłówek wspolny dla wszystkich stron, gdzie będzie:<br>
        1. Nazwa sklepu i Logo<br><br>
        2. 2. 
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
        
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
               
               
               $product = Product::loadProductById($connection, $_GET['productId']);
              
               echo '<a href="index.php?categoryId='.$product->getCategoryId().'">'.$product->getCategoryName().'</a> > ';
               echo $product->getName().'<br>';
               echo '<table><tr><td><img src="'.$product->getPath().'"  width=600/></td>';
               echo '<td>Price: <b>'.$product->getPrice().' zł</b><br><br>';
               echo 'Availability: <b>'.$product->getQuantity().' pcs.</b><br><br>';
                      
               echo '<form method="post" action="CartPage.php">';
               echo('<input type="hidden" name="productId" value="' . $product->getId() . '">');
               echo '<button type="submit" name="submit" value="cart">Add to Basket</button><br><br>';
               echo '</form></td></tr></table>';
       
               
               $photos = Photos::loadPhotosByProductId($connection, $_GET['productId']);
               foreach ($photos as $photo) {
                   echo '<img src="'.$photo->getPath().'" width=70/>';
               }
               
               echo '<br><br>';
               
               echo $product->getDescription();
               
            }
        ?>
      
    </body>
    
</html>
