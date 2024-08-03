-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 11:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(50) NOT NULL,
  `post_name` varchar(255) NOT NULL,
  `post_username` varchar(255) NOT NULL,
  `post_content` varchar(500) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_views` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_name`, `post_username`, `post_content`, `post_image`, `post_views`) VALUES
(1, '5 Ways to Stay Motivated During a Long Workday', 'Bob', 'Staying motivated during a long workday can be challenging, but it\'s important to maintain focus and productivity in order to succeed in your career. Here are five strategies you can try to stay motivated and get through your day:\n\nSet small, achievable goals for yourself. Rather than trying to tackle a huge project all at once, break it down into smaller tasks and focus on completing one at a time. This will help you feel a sense of accomplishment and keep you motivated to keep going.\n\nTake', '', 2),
(2, 'The Benefits of Meditation for Stress Management', 'Alice', 'Meditation is a powerful tool for managing stress and improving overall well-being. Many people find that regular meditation helps them feel calmer, more focused, and better able to cope with the demands of daily life. Here are a few benefits of meditation for stress management:\r\n\r\nReduces stress and anxiety. Meditation helps to quiet the mind and bring a sense of peace and calm. This can help reduce feelings of stress and anxiety, and improve overall well-being.\r\n\r\nImproves focus and concentrat', '', 1),
(3, 'The Science of Sleep: How to Get Better Quality Rest and Wake Up Refreshed', 'user1', 'Sleep is crucial for our physical and mental health, yet many of us struggle to get enough rest. In this post, we dive into the science of sleep and provide practical tips for improving sleep quality, including setting a consistent bedtime, creating a relaxing sleep environment, and avoiding screens before bed.', 'image1.jpg', 100),
(4, '5 Ways to Boost Your Creativity and Unleash Your Inner Artist', 'user2', 'Creativity is essential for problem-solving, innovation, and self-expression. In this post, we explore different strategies for boosting creativity, including practicing mindfulness, trying new things, and collaborating with others.', 'image2.jpg', 200),
(5, 'The Ultimate Guide to Meal Prep: How to Plan, Shop, and Cook for the Week Ahead', 'user3', 'Meal prep is a fantastic way to save time, eat healthier, and reduce stress during the week. This post provides a step-by-step guide to meal prep, including tips for planning your meals, shopping efficiently, and cooking in bulk.', '', 150),
(6, 'The Power of Positive Thinking: How to Train Your Brain to Be More Optimistic', 'user4', 'Optimism can have a significant impact on our mental and physical health. In this post, we explore the benefits of positive thinking and provide practical tips for training your brain to think more optimistically.', 'image4.jpg', 50),
(7, '10 Healthy Habits to Improve Your Life Today', 'user5', 'Maintaining healthy habits is crucial for a happy and fulfilling life. Here are 10 habits you can start implementing today to improve your overall well-being, including eating a nutritious diet, getting regular exercise, and practicing mindfulness.', '', 75),
(8, 'Post 1', 'user1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi id vestibulum magna, et hendrerit enim. Nullam faucibus sapien eu lectus eleifend, ut euismod est ultrices. Proin aliquam metus sit amet felis lacinia, ac pulvinar ipsum fringilla. Vestibulum lacinia tincidunt ipsum, at tristique dolor venenatis in. Aenean euismod consequat orci, quis luctus libero finibus non. Fusce pulvinar, lectus in feugiat ultrices, quam lacus auctor magna, sit amet facilisis velit est ac arcu. Pellentesque tinc', 'image1.jpg', 100),
(9, 'Post 2', 'user2', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi temp', 'image2.jpg', 200),
(10, 'Post 3', 'user3', 'Nunc sodales, mauris in laoreet fringilla, lectus libero blandit mi, quis egestas tortor felis sit amet ante. Curabitur semper lacinia velit, sit amet pharetra nisl varius nec. Praesent ut metus non nulla varius bibendum. Integer tincidunt nisi in neque tincidunt rhoncus. Ut a aliquam augue. Fusce commodo lacus vitae sapien cursus congue. Donec id ornare nisi, sit amet porttitor urna. Nulla at eros velit. Sed posuere lorem eu nunc bibendum scelerisque. Pellentesque interdum posuere tellus, a dig', '', 150),
(11, 'Post 4', 'user4', 'Aliquam pulvinar, odio in bibendum lacinia, dolor nulla commodo neque, at volutpat turpis libero vel nisl. Praesent ultrices in nibh vel\r\ndiam. Donec eget risus ut odio gravida ultrices eget a purus. Vivamus tincidunt urna non blandit convallis. Donec bibendum erat a velit faucibus sollicitudin. Integer malesuada justo eget diam eleifend consectetur. Integer tincidunt lacus et quam accumsan, in faucibus dolor maximus. Fusce luctus hendrerit dolor, quis sollicitudin velit tincidunt ut. Nam portti', 'image4.jpg', 50),
(12, 'Post 5', 'user5', 'Phasellus suscipit ipsum ante, vel facilisis libero dignissim a. Maecenas gravida faucibus nisi, vel blandit mi malesuada ut. Integer sagittis nulla vel quam iaculis, quis pharetra enim lacinia. Suspendisse suscipit ultrices risus, vel volutpat leo lacinia vel. Fusce non orci non velit malesuada bibendum. Duis malesuada dapibus libero, sed hendrerit risus feugiat sed. Vestibulum id malesuada massa. Aliquam fringilla feugiat tortor, in hendrerit elit elementum ac. Sed et ante euismod, vulputate t', '', 75);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `user_description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `profile_image`, `user_description`) VALUES
(1, 'Bob', 'Aa123456', '', 'my name is Bob and i am a Contractor'),
(2, 'Alice', 'ww', '', 'aa'),
(3, 'Niv', 'Niv963', '', 'Niv dosent have a description yet...'),
(4, 'Or', 'Or123!', '', 'Hi my name is Or.'),
(5, 'Shahaf', 'Shahaf963', '', 'Hi, my name is Shahaf.'),
(15, 'NivRoda', 'gg', 'uploads/exp.jpeg', 'aa'),
(16, 'a', 'a', 'uploads/exp.jpeg', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
