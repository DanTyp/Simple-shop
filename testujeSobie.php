<?php

require_once 'src/connection.php';
require_once 'src/User.php';

//$user = new User();
//
//$user->setName('Daniel')->setSurname('Typiak')->setCountry('Poland')->setPostalCode('87-800')->setCity('Wloclawek');
//$user->setApartmentNo(23)->setHouseNo('11A')->setDeleteStatus(0);
//$user->setEmail('dantyp@gmail.com')->setStreet('Zwiazkow Zawodowych')->setHashedPassword('hashedPassword');
//
//$user->saveUserToDB($connection);
//
//echo '<br>';
//echo '<h1>Wyniki setterow:</h1>';
//echo '<br>';
//echo $user->getId();
//echo '<br>';
//echo $user->getName();
//echo '<br>';
//echo $user->getSurname();
//echo '<br>';
//echo $user->getCountry();
//echo '<br>';
//echo $user->getCity();
//echo '<br>';
//echo $user->getPostalCode();
//echo '<br>';
//echo $user->getStreet();
//echo '<br>';
//echo $user->getHouseNo();
//echo '<br>';
//echo $user->getApartmentNo();
//echo '<br>';
//echo $user->getEmail();
//echo '<br>';
//echo $user->getHashedPassword();
//echo '<br>';
//echo $user->getDeleteStatus();


//$user2 = new User();
//$user2->setId(3)->setName('Robert')->setSurname('Malinowski')->setCountry('Poland')->setPostalCode('02-025')->setCity('Warszawa');
//$user2->setApartmentNo(3)->setHouseNo('1A')->setDeleteStatus(0);
//$user2->setEmail('roberto@gmail.com')->setStreet('Tarczynska')->setHashedPassword('hashedPassword34');
//$user2->saveUserToDB($connection);

//$user3 = new User();
//$user3->setId(4)->setName('Ewa')->setSurname('Mazurek')->setCountry('Poland')->setPostalCode('81-100')->setCity('Torun');
//$user3->setApartmentNo(10)->setHouseNo('')->setDeleteStatus(0);
//$user3->setEmail('ewaSok@gmail.com')->setStreet('Wloclawska')->setHashedPassword('hasheddsfdPassword34');
//$user3->saveUserToDB($connection);

//$user = User::loadUserById($connection, 1);
//echo '<br>';
//echo '<h1>Wyniki setterow:</h1>';
//echo '<br>';
//echo $user->getId();
//echo '<br>';
//echo $user->getName();
//echo '<br>';
//echo $user->getSurname();
//echo '<br>';
//echo $user->getCountry();
//echo '<br>';
//echo $user->getCity();
//echo '<br>';
//echo $user->getPostalCode();
//echo '<br>';
//echo $user->getStreet();
//echo '<br>';
//echo $user->getHouseNo();
//echo '<br>';
//echo $user->getApartmentNo();
//echo '<br>';
//echo $user->getEmail();
//echo '<br>';
//echo $user->getHashedPassword();
//echo '<br>';
//echo $user->getDeleteStatus();

//$user = User::loadAllUsers($connection);
//var_dump($user);
//
//$user = User::loadUserByEmail($connection, 'ewaSok@gmail.com');
//var_dump($user);

//$user5 = User::loadUserById($connection, 5);
//var_dump($user5);
//$user5->deleteUser($connection);

//if($result = User::verifyEmailAndPassword($connection, 'dantyp@gmail.com', 'hashedPassworfhd')){
//    echo "poprawny email i hasło";
//} else {
//    echo 'Bledny email lub haslo';
//};
//var_dump($result);

//$email = User::verifyEmailsAvailability($connection, 'dantyp@gmail.com');
//var_dump($email);

if($id = User::verifyEmailAndPassword($connection, 'jan.kowalski@gmail.com', 'jankowalski')){
    $_SESSION['id'] = $id;
}

var_dump($_SESSION['id']);
