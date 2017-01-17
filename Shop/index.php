<?php
require_once __DIR__ . '/../src/connection.php';
require_once __DIR__ . '/../src/Category.php';
require_once __DIR__ . '/../src/Product.php';
require_once __DIR__ .'/../src/User.php';
require_once __DIR__ . '/../src/session.php';
?>
<!DOCTYPE HTML>
<html lang="pl">
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>Simple shop</title>
    </head>

    <body>
        
        <hr>
        "Wellcome to the Simple Shop!"<br>
        Miejsce na nagłówek wspolny dla wszystkich stron, gdzie będzie<br>
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
        </table><hr>
        <br>       
        
        <form method="POST" action="index.php">
            Search:
            <input type="text" name="productSearch">
            <select name="categoryId">
                <option value="">All</option>
                <?php
                    $allCategories = Category::loadAllCategory($connection);  //!!!zmienic ta metode aby sortowala po ID lub innej sensownej wartosci odwzorowujacej oczekiwana kolejnosc
                    foreach ($allCategories as $category) {
                        echo '<option value="'.$category->getId().'">'.$category->getCategoryName().'</option>';
                    }
                ?>
            </select>
            <input type="submit" value="search">
        </form>
        <br>

    <?php
    
    $categoryId = null;
    $productSearch = null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['categoryId'])) { $productSearch = trim($_POST['productSearch']); }
        echo 'Results for search <b>"'.$productSearch.'"</b> ';
        if(isset($_POST['categoryId']) && $_POST['categoryId'] != null) {
            $categoryId = $_POST['categoryId'];
            $category=  Category::loadCategoryById($connection, $categoryId);
            echo 'in Category <b>'.$category->getCategoryName().'</b>';
        }
        echo '<br><br>';
    } else {       
        if(isset($_GET['categoryId']) && $_GET['categoryId'] != null) {
            $categoryId = $_GET['categoryId'];
            $category=  Category::loadCategoryById($connection, $categoryId);
            echo 'Category <b>'.$category->getCategoryName().'</b><br><br>';
        }
    }

    
    $searchedProducts = Product::searchProducts($connection, $categoryId, $productSearch, 1, null, null);
        
    echo '<table border=1><tr><th>Category</th><th>Product</th><th>Description</th><th>Price</th><tr>';
    foreach ($searchedProducts as $product) {
        echo '<tr><td>'.$product->getCategoryName().'</td>';
        echo '<td><a href="ProductPage.php?productId='.$product->getId().'">'.$product->getName().'</a><br><img src="'.$product->getPath().'" height=100 width=auto/></td>';

        $exploded_name = explode('<br>', $product->getDescription());
        $exploded_trimmed = array_slice($exploded_name, 0, 10);
        $imploded_name = implode('<br>', $exploded_trimmed);
//        echo '<td>'.substr($product->getDescription(), 0, 300).'</td>';

        echo '<td>'.$imploded_name.'</td>';
        echo '<td>'.$product->getPrice().'</td></tr>';
    }
    echo '</table>';

?>


    </body>
</html>

