-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 23, 2024 at 04:06 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tastybites`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_fullname` varchar(255) DEFAULT NULL,
  `Admin_email` varchar(255) NOT NULL,
  `Admin_password` varchar(255) NOT NULL,
  `Admin_number` int(11) DEFAULT NULL,
  `Admin_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Admin_ID`, `Admin_fullname`, `Admin_email`, `Admin_password`, `Admin_number`, `Admin_address`) VALUES
(1, 'John Doe', 'john@example.com', 'John123@123@', 1234567890, 'Beirut, Lebanon');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Category_ID` int(11) NOT NULL,
  `Category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Category_ID`, `Category`) VALUES
(1, 'Default'),
(2, 'Vegetarian'),
(3, 'Fast Food'),
(4, 'Appetizer'),
(5, 'Main Course');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `Contact_ID` int(11) NOT NULL,
  `Contact_fullname` varchar(255) DEFAULT NULL,
  `Contact_email` varchar(255) DEFAULT NULL,
  `Contact_number` varchar(20) DEFAULT NULL,
  `Contact_message` text DEFAULT NULL,
  `Contact_subject` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `Customer_ID` int(11) NOT NULL,
  `Customer_email` varchar(255) NOT NULL,
  `Customer_fullname` varchar(255) DEFAULT NULL,
  `Customer_number` varchar(20) DEFAULT NULL,
  `Customer_username` varchar(255) NOT NULL,
  `Customer_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_ID`, `Customer_email`, `Customer_fullname`, `Customer_number`, `Customer_username`, `Customer_password`) VALUES
(1, 'john@example.com', 'John Doe', '1234567890', 'john', 'John123@123');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `Page_ID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`Page_ID`, `Title`, `Active`) VALUES
(1, 'Homes', 1),
(2, 'About Us', 1),
(3, 'Contact Us', 1),
(4, 'Platters', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages_body_sections`
--

CREATE TABLE `pages_body_sections` (
  `Page_ID` int(11) NOT NULL,
  `Body_Section_ID` int(11) NOT NULL,
  `Body_Section` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages_body_sections`
--

INSERT INTO `pages_body_sections` (`Page_ID`, `Body_Section_ID`, `Body_Section`) VALUES
(1, 1, '<h6>Welcome to TastyBites</h6>\n              <h2>BEST RESTAURANT EVER!</h2>\n              <p>\n              At TastyBites, we offer a delightful dining experience that combines \n              the finest ingredients with exceptional culinary artistry. Our menu \n              features a diverse selection of mouthwatering dishes, all crafted to \n              tantalize your taste buds.\n              </p>'),
(2, 1, '<h6>About TastyBites</h6>\n                <h2>Our Staff Expertise</h2>\n            </div>\n            <p>\n                Welcome to TastyBites, where culinary excellence meets a warm, inviting atmosphere. \n                At TastyBites, we are committed to bringing you a diverse menu that combines the \n                freshest ingredients with innovative cooking techniques. Our chefs craft each \n                dish with passion and precision, ensuring a memorable dining experience for every guest.\n            </p>'),
(2, 2, '<p>From our succulent steaks to our delectable seafood and vibrant vegetarian options, we \n                cater to all palates. Our commitment to quality extends beyond our food to our exceptional\n                service. Our friendly and attentive staff are here to make your visit special, whether you’re \n                enjoying a family dinner, a romantic date, or a celebration with friends.We take pride in \n                creating an environment that feels like a second home.</p>'),
(2, 3, '<p>\r\n                Our cozy and elegant dining area is designed to provide comfort and style, making it \r\n                the perfect backdrop for any occasion. At TastyBites, we believe that dining is not \r\n                just about food, but about creating lasting memories.\r\n            </p>'),
(3, 1, '<p>We’d love to hear from you! Whether you have a question, feedback, or want to make a reservation, \r\n              our team at Tasty Bites is here to assist you. Reach out to us via phone, email, or visit us in person. \r\n              Your satisfaction is our priority, and we look forward to making your dining experience exceptional.</p>'),
(3, 2, 'Idaho , Bliss, United States'),
(3, 3, '+961 71 041 955'),
(3, 4, 'abedkansof18@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `platters`
--

CREATE TABLE `platters` (
  `Platter_ID` int(11) NOT NULL,
  `Timing_ID` int(11) NOT NULL,
  `Category_ID` int(11) NOT NULL,
  `Platter` varchar(255) DEFAULT NULL,
  `Platter_price` decimal(10,2) DEFAULT NULL,
  `Platter_small_description` text DEFAULT NULL,
  `Platter_image` varchar(255) DEFAULT NULL,
  `Platter_discount` decimal(5,2) DEFAULT NULL,
  `Platter_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `platters`
--

INSERT INTO `platters` (`Platter_ID`, `Timing_ID`, `Category_ID`, `Platter`, `Platter_price`, `Platter_small_description`, `Platter_image`, `Platter_discount`, `Platter_status`) VALUES
(1, 2, 5, 'Chicken Rice', '10.99', 'Delicious chicken & rice', 'chicken-rice.jpg', '0.50', 1),
(2, 2, 2, 'Veggie Wrap', '7.50', 'Healthy veggie wrap', 'veggie-wrap.jpg', '0.00', 1),
(3, 2, 3, 'BBQ Burger', '8.99', 'Tasty BBQ burger', 'bbq-burger.jpg', '0.50', 1),
(4, 4, 4, 'Seafood Pasta', '15.75', 'Scrumptious seafood dish', 'seafood-pasta.jpg', '2.25', 1),
(5, 4, 4, 'Fruit Salad', '4.99', 'Fresh fruit salad', 'fruit-salad.jpg', '0.75', 1),
(6, 5, 5,'Egg and Bacon','6.50', 'American Bacon with eggs', 'egg_bacon.png','0.5', 1),
(7, 5, 4,'Pancakes with Strawebaries','8.50', 'Tasty old fashioned pancakes with fresh fruites', 'pancake.jpg','0.3', 1),
(8, 5, 5,'Sandwiches Lunch','30.50', 'Large Platter of sandwiches for the whole family', 'sandwiches_lunch.jpg','0.7', 1),
(9, 3, 5,'Breakfast Party Plate','28.50', 'Rich of everything thing for breakfast', 'antipastoplatter.png','0.7', 1),
(10, 3, 5,'Clasic Fish Sandwish','22.50', 'Classic fish Sandwish', 'classic_fish_Sandwish.jpg','0.4', 1);



-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `Customer_ID` int(11) NOT NULL,
  `Reservation_ID` int(11) NOT NULL,
  `Reservation_settings` datetime NOT NULL,
  `People_number` int(11) DEFAULT NULL,
  `Reservation_message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `reservation_settings`
--

CREATE TABLE `reservation_settings` (
  `Reservation_settings` datetime NOT NULL,
  `Max_reservations` int(11) DEFAULT NULL,
  `Current_reservations` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `timings`
--

CREATE TABLE `timings` (
  `Timing_ID` int(11) NOT NULL,
  `Timing` varchar(255) NOT NULL,
  `Timing_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timings`
--

INSERT INTO `timings` (`Timing_ID`, `Timing`, `Timing_status`) VALUES
(1, 'Default', 0),
(2, 'Lunch', 1),
(3, 'Dinner', 1),
(4, 'Snack', 1),
(5, 'Breakfast', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`Admin_ID`),
  ADD UNIQUE KEY `Admin_email` (`Admin_email`),
  ADD UNIQUE KEY `Admin_password` (`Admin_password`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Category_ID`),
  ADD UNIQUE KEY `Category` (`Category`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`Contact_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`Customer_ID`),
  ADD UNIQUE KEY `Customer_email` (`Customer_email`),
  ADD UNIQUE KEY `Customer_username` (`Customer_username`),
  ADD UNIQUE KEY `Customer_password` (`Customer_password`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`Page_ID`);

--
-- Indexes for table `pages_body_sections`
--
ALTER TABLE `pages_body_sections`
  ADD PRIMARY KEY (`Page_ID`,`Body_Section_ID`);

--
-- Indexes for table `platters`
--
ALTER TABLE `platters`
  ADD PRIMARY KEY (`Platter_ID`,`Timing_ID`,`Category_ID`),
  ADD KEY `Timing_ID` (`Timing_ID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`Customer_ID`,`Reservation_ID`,`Reservation_settings`),
  ADD KEY `Reservation_settings` (`Reservation_settings`);

--
-- Indexes for table `reservation_settings`
--
ALTER TABLE `reservation_settings`
  ADD PRIMARY KEY (`Reservation_settings`);

--
-- Indexes for table `timings`
--
ALTER TABLE `timings`
  ADD PRIMARY KEY (`Timing_ID`),
  ADD UNIQUE KEY `Timing` (`Timing`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `Contact_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `Page_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timings`
--
ALTER TABLE `timings`
  MODIFY `Timing_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pages_body_sections`
--
ALTER TABLE `pages_body_sections`
  ADD CONSTRAINT `pages_body_sections_ibfk_1` FOREIGN KEY (`Page_ID`) REFERENCES `pages` (`Page_ID`);

--
-- Constraints for table `platters`
--
ALTER TABLE `platters`
  ADD CONSTRAINT `platters_ibfk_1` FOREIGN KEY (`Timing_ID`) REFERENCES `timings` (`Timing_ID`),
  ADD CONSTRAINT `platters_ibfk_2` FOREIGN KEY (`Category_ID`) REFERENCES `categories` (`Category_ID`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`Customer_ID`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`Reservation_settings`) REFERENCES `reservation_settings` (`Reservation_settings`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
