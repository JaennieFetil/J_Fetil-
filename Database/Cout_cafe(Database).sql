-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 11:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_category` varchar(100) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_image` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `item_name`, `item_category`, `item_desc`, `item_price`, `item_image`, `status`) VALUES
(1, 'Latte', 'Hot Beverages', 'A milk coffee that boast a silky layer of foam as real highlight to the drink.', 93.00, 'LLatte.jpg', 'Inactive'),
(2, 'French Butter Croissant', 'Snacks & Pastries', 'A beautiful golden color, moist, and buttery meltingly smooth, with a final note of caramel', 99.00, 'FrenchButtercroissant.jpg', 'Active'),
(3, 'Iced Classic Chocolate', 'Cold Beverages', 'Milk and mocha sauce topped with whipped cream and a chocolate-flavoured drizzle. A timeless classic make to sweetened your spirit.', 98.00, 'icedclassicchocolate.jpg', 'Active'),
(4, 'Caramel Macchiato', 'Specialty Drinks', 'A freshly steamed milk with vanilla flavoured syrup, marked with expresso and finished with caramel sauce.', 99.50, 'CaramelMacchiato.jpg', 'Active'),
(5, 'Iced Caffe Mocha', 'Cold Beverages', 'Espresso combined with bitter sweet mocha sauce and milk over ice, topped with sweetened whipped cream.', 105.75, 'IcedCaffeMocha.jpg', 'Active'),
(6, 'Dark Chocolate Macadamia Cookie', 'Snacks & Pastries', 'A decadent combination of belgian chocolate and chunk macadamia nuts in a buttery, chewy cookie', 129.00, 'DarkChocolateMacadamiaCookie.jpg', 'Active'),
(7, 'Bacon Belgian Waffle', 'Snacks & Pastries', 'Yeast-raised dough with sugar pearls and loaded with bacon bits.', 99.00, 'BaconBelgianWaffle.jpg', 'Active'),
(8, 'Classic Lasagna', 'Snacks & Pastries', 'This classic lasagna is the perfect italian comfort food made with ground patty bolognese layered with cheese and al-dente noddles.', 159.00, 'ClassicLasagna.jpg', 'Active'),
(9, 'Cappuccino', 'Hot Beverages', 'A perfect balance of espresso, steamed milk and foam.', 95.00, 'cappuccino.jpg', 'Active'),
(10, 'Matcha Latte', 'Tea & Non-Coffee Drinks', 'Vibrant green tea powder whisked into steamed milk for a creamy, earthy flavor.', 240.00, 'MatchaLatte.jpg', 'Active'),
(11, 'Hot Chocolate', 'Tea & Non-Coffee Drinks', 'A comforting blend of rich cocoa and steamed milk, topped with whipped cream.', 180.00, 'hotchocolate.jpg', 'Active'),
(12, 'Iced Tea (Lemon/Peach)', 'Tea & Non-Coffee Drinks', 'Refreshing iced tea served in lemon or peach flavors.', 150.00, 'PeachIcedTea.jpg', 'Active'),
(13, 'Lemonade', 'Tea & Non-Coffee Drinks', 'Freshly squeezed lemonade, served ice-cold for a zesty, sweet refreshment.', 160.00, 'lemonade.jpg', 'Active'),
(14, 'Banana Fruit Smoothie', 'Tea & Non-Coffee Drinks', 'Blended fresh fruit with yogurt or juice for a creamy, sweet smoothie.', 210.00, 'Banana FruitSmoothie.jpg', 'Active'),
(15, 'Strawberry Milkshake', 'Tea & Non-Coffee Drinks', 'A creamy, sweet milkshake made with rich ice cream and milk.', 250.00, 'StrawberryMilkshake.jpg', 'Active'),
(16, 'Matcha Lemonade', 'Tea & Non-Coffee Drinks', 'A refreshing blend of matcha green tea and lemonade for a tangy, energizing drink.', 230.00, 'matcha lemon.jpg', 'Active'),
(17, 'Blueberry Muffin', 'Snacks & Pastries', 'Soft and moist muffin packed with juicy blueberries.', 150.00, 'BlueberryMuffin.jpg', 'Active'),
(18, 'Chocolate Croissant', 'Snacks & Pastries', 'Flaky pastry with a rich chocolate filling.', 170.00, 'ChocolateCroissant.jpg', 'Active'),
(19, 'Avocado Toast', 'Snacks & Pastries', 'Toasted artisan bread topped with fresh avocado, olive oil, and seasonings.', 280.00, 'avocadotoast.jpg', 'Active'),
(20, 'Banana Bread Slice', 'Snacks & Pastries', 'Sweet, moist banana bread with a hint of cinnamon.', 160.00, 'BananaBread.jpg', 'Active'),
(21, 'Cinnamon Roll', 'Snacks & Pastries', 'Soft and sticky roll filled with cinnamon, sugar, and a creamy glaze.', 180.00, 'CinnamonRoll.jpg', 'Active'),
(22, 'Bagel with Cream Cheese', 'Snacks & Pastries', 'Toasted bagel served with a generous spread of cream cheese.', 170.00, 'Bagelwith CreamCheese.jpg', 'Active'),
(23, 'Crispy Bacon and Egg Sandwich', 'Snacks & Pastries', 'A hearty breakfast sandwich with crispy bacon, a fried egg, and fresh bread.', 220.00, 'BaconBelgianWaffle.jpg', 'Active'),
(24, 'Chai Latte', 'Tea & Non-Coffee Drinks', 'Spiced black tea combined with steamed milk for a sweet and warming treat.\r\n', 200.00, 'ChaiLatte.jpg', 'Active'),
(25, 'Americano', 'Hot Beverages', 'A bold smooth coffee with a full-bodied, mellow flavor and a touch of bitterness', 99.00, 'americano.webp', 'Active'),
(26, ' Hot Chocolate', 'Hot Beverages', 'A warm comforting beverage made from melted chocolate/cocoa powder, mixed with milk or water.', 79.00, '20230327191313-Kettle_HotChoco.webp', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` enum('Cash on Delivery','Credit Card','PayPal') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Confirmed','Delivered') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `name`, `address`, `payment_method`, `created_at`, `status`) VALUES
(1, 18, 93.00, 'Jaennie Cyrell N. Fetil', 'Polangui, Albay', 'Cash on Delivery', '2024-12-16 09:00:15', 'Confirmed'),
(2, 18, 99.00, 'Jaennie Cyrell N. Fetil', 'Polangui, Albay', 'Cash on Delivery', '2024-12-17 08:36:34', 'Pending'),
(3, 20, 250.00, 'Mariz Bata', 'Obaliw-Rinas, Oas, Albay', 'Cash on Delivery', '2024-12-17 08:41:13', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 2, 1, 93.00),
(2, 2, 25, 1, 99.00),
(3, 3, 15, 1, 250.00);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `gender` char(1) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_status` char(1) NOT NULL,
  `user_type` char(1) NOT NULL DEFAULT 'C'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `username`, `password`, `fullname`, `address`, `contact_no`, `gender`, `date_added`, `user_status`, `user_type`) VALUES
(1, 'admin', 'admin', 'Master Admin', 'BUP', '09123456788', 'F', '2024-12-09 15:44:36', 'A', 'A'),
(2, 'intjj', 'bubu19', 'Shanley Resentes', 'Bongoran, Oas, Albay', '09075193156', 'F', '2024-11-20 01:52:54', '', 'A'),
(3, '_mb', 'Mariz123', 'Mariz Bata', 'Obaliw-Rinas, Oas, Albay', '09123456789', 'F', '2024-11-20 01:54:13', '', 'A'),
(4, 'jc', 'jc1234', 'Jaennie Fetil', 'Alomon,Polangui, Albay', '09123456788', 'F', '2024-11-20 01:54:32', '', 'A'),
(5, 'Pen', '12345678', 'Penelope Sablayan', 'Napo, Polangui, Albay', '09213465789', 'F', '2024-11-20 01:54:53', '', 'A'),
(6, 'TC', 'tiny123', 'Tiny coders', 'bu polangui', '09876543211', 'X', '2024-11-20 06:29:51', '', 'C'),
(7, 'xsjuydg', '12gsdjs', 'marss', 'syudgshfbskj', '09987654321', 'M', '2024-11-20 06:48:33', '', 'C'),
(8, 'mars', 'mars', 'marss', 'syudgshfbskj', '09987654321', 'M', '2024-11-20 06:47:45', '', 'C'),
(9, 'mmm', '12345', 'Mb', 'tabi', '09124356987', 'F', '2024-11-20 07:32:07', '', 'C'),
(11, 'Pogito', '********', 'Pogi', 'polanguialbay', '09989989792', 'X', '2024-11-20 08:01:55', '', 'C'),
(12, 'msb', '00000', 'msbata', 'P1-Obaliw,Oas, Albay', '09994719859', 'F', '2024-11-24 06:15:53', '', 'C'),
(13, 'ana', 'ana123', 'Ana Nacion', 'Santicon, Polangui, Albay', '09987654321', 'F', '2024-11-24 08:22:49', '', 'C'),
(14, 'Eun Woo', 'eu123', 'Cha Eun Woo', 'South Korea', '09123654879', 'M', '2024-11-24 08:27:19', '', 'C'),
(15, 'hahahaha', 'hahahaha', 'hahahaha', 'South Korea', '09989989792', 'M', '2024-11-27 05:59:17', '', 'C'),
(16, 'hellopo', 'hel123', 'hello', 'bu polangui albay', '09876543211', 'X', '2024-11-28 05:59:38', '', 'C'),
(17, 'noelroselada', 'noel', 'Noel Roselada', 'Bacolod, Libon, Albay', '09383630942', 'M', '2024-12-09 13:52:50', '', 'C'),
(18, 'jen', 'jen123', 'Jaennie Cyrell Fetil', 'Polangui, Albay', '09100345388', 'F', '2024-12-16 08:56:14', '', 'C'),
(19, 'cy', 'cy123', 'Cyrell Fetil', 'Polangui, Albay', '09100345388', 'F', '2024-12-17 07:55:18', '', 'C'),
(20, 'mb123', 'mb123', 'Mariz Bata', 'Obaliw-Rinas,Oas, Albay', '09614417105', 'F', '2024-12-17 08:08:23', '', 'C'),
(21, 'Cla123', 'cla123', 'Claries Ann Amistoso', 'Ponso, Polangui, Albay', '09126134617', 'F', '2024-12-17 08:10:10', '', 'C'),
(22, 'Shan123', 'shan123', 'Shanley Resentes', 'Bongoran, Oas, Albay', '09075193156', 'F', '2024-12-17 08:11:25', '', 'C'),
(23, 'Pen123', 'pen123', 'Penelope Sablayan', 'Napo, Polangui, Albay', '09164063565', 'F', '2024-12-17 08:12:33', '', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
