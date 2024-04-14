# Web development 2 final project


## Authors

- [Wojciech Kolasa IT2B 695344](https://github.com/WKolasaa/WebDevelopmentFinalProject)

## Overview
This project is a web application built using Vue.js for the frontend and PHP for the backend. It is a e-commerce website project as a web development 2 final project.

## Features
- **Vue.js Frontend:** Utilizes Vue.js for building dynamic and interactive user interfaces. 
- **PHP Backend:** Employs PHP for server-side logic and database interactions.
- **Database Integration:** Demonstrates integration with a MySQL database.
- **User Authentication:** Provides user authentication functionality.
- **Responsive Design:** Ensures the application is responsive and works well on different devices and screen sizes.

## Installation
### Fronend:
#### Project setup
```bash
npm install
```
#### Project run
```bash
npm run dev
```

### Backend:
#### Project setup and run
```bash
docker compose up
```

## Access to application
- Frontend: [http://localhost:5173](http://localhost:5173)

## Login

#### Admin account

login: admin \
password: admin

#### User account

login: customer \
password: customer

## SQL script

```bash
CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) 

CREATE TABLE `products` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` text DEFAULT NULL,
  `productPrice` float NOT NULL,
  `productImage` varchar(255) DEFAULT NULL,
  `productQuantity` int(11) NOT NULL
) 

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) 
```

## SQL insert script

```bash
# Users
INSERT INTO `users` (`userID`, `userName`, `firstName`, `lastName`, `email`, `password`, `phone`, `address`, `address2`, `country`, `zip`, `dateOfBirth`, `role`) VALUES
(1, 'username', 'user', 'user', 'user@user.user', 'username', '1234567890', '123 Main St', 'Apt 456', 'The Netherlands', '12345', '1990-01-01', 'user'),
(3, 'Test', 'Test', 'Test', 'Test', '$2y$10$3FirB3nPKDb5.jReMHHVIuMLGYXW8BjTa1JPw68fFIy5jr0CmGNxG', '123123', 'Test', '', 'Test', 'Test', '1111-11-11', 'user'),
(4, 'customer', 'customer', 'customer', 'customer@customer.customer', '$2y$10$TFzm5RcC4tdCY0IavmTss.c9GKfpsoKQ90VnQo5TSq7TOTwaGURTq', '123123', 'customer', '123', 'The Netherlands', '2122AS', '1111-11-11', 'user'),
(5, 'admin', 'admin', 'admin', 'Admin@Admin.Admin', '$2y$10$KH8rxAGVxljIzBKS5Gk6TOw3TajBCojr.vZwi2KVwh9CXbvuVFtOS', '123123', 'admin', 'admin', 'The Netherlands', '3123SA', '1111-11-11', 'admin');;

# Products

INSERT INTO `products` (`productID`, `productName`, `productDescription`, `productPrice`, `productImage`, `productQuantity`) VALUES
(1, 'Widget ', 'A high-quality widget', 19.99, 'images/image.jpeg', 100),
(2, 'Gadget', 'An innovative gadget', 29.99, 'images/R.jpeg', 50);

# Orders

INSERT INTO `orders` (`id`, `user_id`, `total`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 169.94, 'PayPal', '2024-04-14 16:39:13', '2024-04-14 16:39:13'),
(2, 1, 169.94, 'PayPal', '2024-04-14 16:39:44', '2024-04-14 16:39:44'),
(3, 1, 169.94, 'PayPal', '2024-04-14 16:40:12', '2024-04-14 16:40:12'),
(4, 1, 169.94, 'PayPal', '2024-04-14 16:43:43', '2024-04-14 16:43:43'),
(5, 1, 169.94, 'PayPal', '2024-04-14 16:44:19', '2024-04-14 16:44:19'),
(6, 1, 169.94, 'PayPal', '2024-04-14 16:44:44', '2024-04-14 16:44:44'),
(7, 1, 169.94, 'PayPal', '2024-04-14 16:45:04', '2024-04-14 16:45:04');

```



