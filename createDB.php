


CREATE TABLE Product
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL,
    price FLOAT (5,2) NOT NULL,
    description TEXT NOT NULL,
    quanity INT,
    categoryId INT NOT NULL,
    FOREIGN KEY(categoryId) REFERENCES Category(id)
    
    
);

CREATE TABLE Product_Order
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    productId INT NOT NULL,
    orderId INT NOT NULL,
    price FLOAT (5,2) NOT NULL,
    quantity INT,
    FOREIGN KEY(productId) REFERENCES Product(id),
    FOREIGN KEY(orderId) REFERENCES `Order`(id)
        
);

CREATE TABLE `Order`
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    userId INT NOT NULL,
    statusId INT NOT NULL,
    creatingDate DATETIME,
    FOREIGN KEY(userId) REFERENCES User(id),
    FOREIGN KEY(statusId) REFERENCES Status(id)
        
);



CREATE TABLE User
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    country VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    postalCode VARCHAR(20) NOT NULL,
    street VARCHAR(255) NOT NULL,
    houseNo VARCHAR(20) NOT NULL,
    apartmentNo VARCHAR(20) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    hashedPassword VARCHAR(255) NOT NULL,
    deleteStatus INT NOT NULL
        
);

CREATE TABLE Photos
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    path VARCHAR(200) NOT NULL,
    productId INT NOT NULL,
    FOREIGN KEY(productId) REFERENCES Product(id)
    
);

CREATE TABLE Category
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
        
);

CREATE TABLE Status
(
    id INT PRIMARY KEY,
    description VARCHAR(100) NOT NULL
        
);

//dla tabeli Status-description mamy 4 opcje:
1-pending
2-confirmed
3-paid
4-complited
-----------------------------------------


CREATE TABLE Admin
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    hashedPassword VARCHAR(255) NOT NULL
        
);

CREATE TABLE Messages
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    text VARCHAR(255) NOT NULL,
    creationDate DATETIME,
    userId INT NOT NULL,
    FOREIGN KEY(userId) REFERENCES User(id)
    
);


