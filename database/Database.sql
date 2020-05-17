
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 08:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.30

--
-- Database: `Final-Year-Project`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_address` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `contact_message` varchar(255) NOT NULL,
  `contact_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_email`, `contact_address`, `contact_number`, `contact_message`, `contact_date`) VALUES
(1, 'YASSIR IBARARH', 'Yassiribararh@gmail.com', 'Dunton Street', '+447763431236', 'This is a test.', '2020-05-15'),
(8, 'YASSIR IBARARH', 'Yassiribararh@gmail.com', 'Dunton Street', '+447763431236', 'This is a test.', '2020-05-15'),
(9, 'YASSIR IBARARH', 'Yassiribararh@gmail.com', 'Dunton Street', '+447763431236', 'This is a test.', '2020-05-15'),
(11, 'YASSIR IBARARH', 'Yassiribararh@gmail.com', 'Dunton Street', '+447763431236', 'This is a test.', '2020-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_total` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `payement_method` varchar(255) NOT NULL,
  `product_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_total`, `product_id`, `order_date`, `payement_method`, `product_img`) VALUES
(37, '10.17', 'Muscletech, Multi Vitamin, 90 Tablets', '2020-05-17', 'Paypal_Payment', 'multiv.png'),
(38, '38.16', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(39, '68.15', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(40, '29.99', 'Optimum Nutrition Micronised Creatine Powder', '2020-05-17', 'Paypal_Payment', 'creatine.jpg'),
(41, '41.99', 'Maximuscle Protein Chockolate Milk x6', '2020-05-17', 'Paypal_Payment', 'chockolatemilkshake.jpg'),
(42, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(43, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(44, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(45, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(46, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(47, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(48, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(49, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(50, '27.99', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg'),
(51, '46.98', 'PhD Diet Whey Powder Vanilla', '2020-05-17', 'Paypal_Payment', 'dietwhey.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `productsfyp`
--

CREATE TABLE `productsfyp` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `desc` text NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `img` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productsfyp`
--

INSERT INTO `productsfyp` (`id`, `name`, `desc`, `price`, `rrp`, `quantity`, `img`, `date_added`) VALUES
(6, 'WheyProtein', 'Optimum Nutrition’s Gold Standard Whey has been the world’s no 1 choice in whey protein powder for over 20 years. Having constantly refined their formula, the current incarnation of ON’s Gold Standard Whey is the most efficient and fast-absorbing yet, using whey protein isolates as the key ingredient, which help your muscles build and repair. Low quantities of sugar and fat keep things on the healthy side. Gold Standard Whey’s instantised ready-to-mix formula means you can enjoy it any time of day, whether shaken up in a bottle or as an addition to your favourite meals and drinks.', '35.00', '0.00', 20, 'wheyprotein.jpg', '2020-02-08 14:59:02'),
(7, 'BCAA', 'L-Leucine, L-Isoleucine, and L-Valine are commonly grouped together and referred to as Branched Amino Acids, or BCAAs, because of their unique branched chemical structure. BCAAs are essential, meaning they must be consumed through the diet, since the human body cannot make them from other compounds. BCAAs provide active adults with versatile support for training endurance and recovery. Used with protein powders and/or protein-rich foods, these 1000 mg capsules help support muscle recovery and protein synthesis.', '11.76', '0.00', 20, 'bcaa.jpg', '2020-02-08 15:01:31'),
(8, 'Omega 3 Vegan', 'Cytoplan\'s Vegan Omega 3 is derived from the plant marine algae ‘Schizochytrium sp microalgae’ - this is the first supplement to offer good sources of vegan DHA and EPA for vegetarians and vegans. Algal Omega-3 oil has been commercially available for a while but it did not contain meaningful amounts of EPA. A plant algae source of the important Vegan Omega 3 fatty acid - rich in both DHA and EPA Derived from a completely vegetarian source (Schizochytrium sp microalgae) From microalgae that is grown in a controlled environment, eliminating the risk of oceanic contamination From start to finish, it is produced in an FDA-inspected facility, under current Good Manufacturing Practice (cGMP) regulations', '24.80', '0.00', 20, 'omega_3_vegan.jpg', '2020-02-08 15:02:14'),
(9, 'Optimum Nutrition Micronised Creatine Powder', 'Each serving of Optimum Nutrition Creatine Powder supplies a full 3 grams (3000 mg) of Creatine Monohydrate. The production method used to produce this Creatine yields a tasteless, odourless powder that mixes easily into water or juice, and does not readily settle to the bottom - meaning no gritty taste or texture. Not intended for use by persons under the age of 18.', '29.99', '0.00', 20, 'creatine.jpg', '2020-02-08 15:03:11'),
(10, 'Muscletech, Multi Vitamin, 90 Tablets', 'Scientifically Designed Daily Multivitamin Platinum Multivitamin is a complete advanced multivitamin complex designed for bodybuilders, active individuals and even elite athletes for general health support. High-Potency Vitamins & Minerals Each serving delivers 18 vitamins and minerals, including 100% or more of your daily requirements for vitamins A, C, D, E, B6 and B12! it\'s packed with ingredients including essential vitamins, minerals and even an Amino Support Matrix plus an Herbal Matrix that make this a truly complete formula! ‡MuscleTech is America\'s #1 Selling Bodybuilding Supplement Brand based on cumulative wholesale dollar sales 2001 to present.', '10.17', '0.00', 20, 'multiv.png', '2020-02-08 15:03:44'),
(11, 'Cellucor C4 Sport Pre-Workout', 'From the makers of America\'s #1 pre-workout brand, Cellucor C4 Sport provides a performance and energy boost that helps you in your journey towards becoming the best. C4 Sport includes electrolytes in every serving. C4 Sport is pre-workout energy optimized for exercise. It combines two formulations to support performance and energy into one, so every base of your workout is covered. The performance side includes creatine monohydrate for muscle endurance, Arginine AKG to keep you going, and beta-alanine to help keep fatigue at bay. The energy side contains an explosive blend of caffeine and taurine for unrivaled focus and energy. Not intended for use by persons under the age of 18.', '29.99', '0.00', 20, 'c4.jpg', '2020-02-08 15:04:10'),
(12, 'Maximuscle Protein Chockolate Milk x6', 'Protein Milk Is a convenient, ready-to-drink, great tasting protein shake. Protein milk is a high protein, low fat milk shake. Specifically formulated to deliver 25g of protein, to support muscle maintenance, growth and development. We only use natural ingredients so you will not find any artificial colours, artificial flavours or unnecessary thickeners in our products.', '12.00', '0.00', 20, 'chockolatemilkshake.jpg', '2020-02-08 15:04:44'),
(13, 'Nutramino Lean Protein Shake Strawberry', 'No fat & no added sugars 25g of high quality milk protein Tasty strawberry flavour Nutramino Lean Protein Shake is he tastiest lean shake in the world. It contains 25g of protein, helping support muscle repair. Each shake is made from the highest quality milk protein with the added benefit of a low sugar content and no fat. This shake is perfect for the calorie conscious taken before or after exercise. Simply twist the lid and enjoy the taste. 139kcal per serve.', '2.59', '0.00', 20, 'strawberry.jpg', '2020-02-08 15:05:11'),
(14, 'Grenade Carb Killa High Protein and Low Carb Bar', 'Carb Killa is made using a specially selected baking process for exceptional taste resulting in a softer, crunchier texture. It is high in complete proteins, low in impact carbs and loaded with tons of fibre. Carb Killa is available in a range of flavours, including Caramel Chaos, Cookies and Cream, Fudge Brownie, White Chocolate Cookie, Dark Chocolate Mint, Chocolate Crunch, White Chocolate Mocha, Banana Armour, Jaffa Quake and Birthday Cake each made up from delicious triple layers, filled with crunchy crispies all coated in chocolate. With low sugar and low calories, this bar really is the complete high-protein low-carb snack.', '18.99', '0.00', 20, 'grenade.jpg', '2020-02-08 15:05:44'),
(15, 'Omega 3 Fish Oil 1000mg', 'These capsules are a useful fish oil supplement, containing EPA and DHA which are essential Omega 3 fatty acids. Your body can’t produce essential fatty acids on its own, so the NHS recommends that you consume at least 2 portions of fish per week, including 1 oily fish portion. If your diet does not regularly consist of this, you may wish to consider a supplement. One of the advantages of DHA is its ability to aid in the maintenance of vision and normal brain function. It also helps contribute to normal heart function and you can also be assured that they’re suitable for pescatarians, too. Get all the omega 3 benefits with our Omega 3 Fish Oil 1000mg 100 Softgel Capsules. 1- Contains essential Omega-3 fatty acids EPA & DHA 2- Supports healthy vision, brain function and normal heart function* 3-Suitable for pescatarians. PS. The beneficial effect is obtained with a daily intake of 250 mg.', '13.99', '0.00', 20, 'fishoil.png', '2020-02-08 15:07:02'),
(16, 'PhD Diet Whey Powder Vanilla', 'PhD Diet Whey Protein Powder is one of the industry-leading, high protein, low sugar, diet and slimming formulas for weight control. With a wide range of ingredients used in a variety of weight loss formulas, PhD diet whey is ideal for men and women following a weight management nutritional plan and looking to lose body fat and control calorie intake. Incredibly versatile, mix PhD diet whey powder with yoghurt to make a delicious dessert, or combine with porridge oats or pancake mix for a tasty & filling breakfast. Blend 25g PhD diet whey powder vanilla with 175ml cold water. Use 2-3 servings daily to help support adequate protein intake. Take any time of the day pre- or post-workout.', '27.99', '0.00', 20, 'dietwhey.jpg', '2020-02-08 15:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `review_name` varchar(255) NOT NULL,
  `review_date` date NOT NULL DEFAULT current_timestamp(),
  `review_message` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `review_name`, `review_date`, `review_message`) VALUES
(2, 'Yassir Ibararh', '2020-05-15', 'This is a test.'),
(17, 'Yassir Ibararh', '2020-05-15', 'This is a test.'),
(18, 'Yassir Ibararh', '2020-05-15', 'This is a test.'),
(19, 'Yassir Ibararh', '2020-05-15', 'This is a test.'),
(20, 'Yassir Ibararh', '2020-05-15', 'This is a test.'),
(21, 'Yassir Ibararh', '2020-05-16', 'Very good experience using the website.');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `payment_amount` decimal(7,2) NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `payer_email` varchar(255) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `payer_address` varchar(255) NOT NULL,
  `payer_postcode` varchar(255) NOT NULL,
  `payer_phone` varchar(255) NOT NULL,
  `date-of-order` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `payment_amount`, `payment_status`, `payer_email`, `fullname`, `payer_address`, `payer_postcode`, `payer_phone`, `date-of-order`) VALUES
(1, '32.33', 'Cash-payement', 'yassiribararh@gmail.com', 'Yassir Ibararh', '53 Dunton Street, Leicester,UK.', 'LE35EL', '07763431230', '2020-05-12'),
(2, '40.00', 'Cash-payement', 'yassiribararh@gmail.com', 'Yassir Ibararh', '53 Dunton Street, Leicester,UK.', 'LE35EL', '07763431230', '2020-05-13'),
(3, '120.99', 'Cash-payement', 'yassiribararh@gmail.com', 'Yassir Ibararh', '53 Dunton Street, Leicester,UK.', 'LE35EL', '07763431230', '2020-05-13'),
(4, '0.00', 'Cash-payement', 'yassiribararh@gmail.com', 'Yassir Ibararh', '53 Dunton Street, Leicester,UK.', 'LE35EL', '07763431230', '2020-05-13'),
(5, '0.00', 'Cash-payement', 'Yassiribararh@gmail.com', 'YASSIR IBARARH', 'Dunton Street, 53', 'LE35EL', '07763431236', '2020-05-15'),
(6, '0.00', 'Cash-payement', 'Yassiribararh@gmail.com', 'YASSIR IBARARH', 'Dunton Street, 53', 'LE35EL', '07763431236', '2020-05-15'),
(7, '0.00', 'Cash-payement', 'Yassiribararh@gmail.com', 'YASSIR IBARARH', 'Dunton Street, 53', 'LE35EL', '07763431236', '2020-05-16'),
(8, '0.00', 'Cash-payement', 'Yassiribararh@gmail.com', 'YASSIR IBARARH', 'Dunton Street, 53', 'LE35EL', '07763431236', '2020-05-16'),
(9, '0.00', 'Cash-payement', 'Yassiribararh@gmail.com', 'YASSIR IBARARH', 'Dunton Street, 53', 'LE35EL', '07763431236', '2020-05-16'),
(10, '0.00', 'Cash-payement', 'Yassiribararh@gmail.com', 'YASSIR IBARARH', 'Dunton Street, 53', 'LE35EL', '07763431236', '2020-05-16'),
(11, '18.99', 'Cash-payement', 'Yassiribararh@gmail.com', 'YASSIR IBARARH', 'Dunton Street, 53', 'LE35EL', '07763431236', '2020-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postcode` varchar(100) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `address`, `postcode`, `phonenumber`, `user_type`) VALUES
(1, 'Yassirib', 'd9bf94a01fa20a3b28eb7635b5510ae4', 'yassiribararh@gmail.com', '53 Dunton Street', 'LE35EL', '07763431236', 'admin'),
(2, 'Yassiribararh', 'Yassiruk2020', 'yassiribararh@gmail.com', '53 Dunton Street', 'LE35EL', '07763431236', 'admin'),
(4, 'Yassir2501', 'd9bf94a01fa20a3b28eb7635b5510ae4', 'yassiribararh@gmail.com', '53 Dunton Street', 'LE35EL', '07763431236', 'user'),
(5, 'tiph.ja', 'c4ad0db9698bef2b05058d1a11e6a6e8', 'tjamet23@gmail.com', '53 Dunton Street', 'LE35EL', '07307271001', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `productsfyp`
--
ALTER TABLE `productsfyp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `productsfyp`
--
ALTER TABLE `productsfyp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
