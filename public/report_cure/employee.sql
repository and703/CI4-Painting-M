
CREATE TABLE `employee` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `emp_name` varchar(70) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `city` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_of_joining` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `employee` (`id`, `emp_name`, `salary`, `gender`, `city`, `email`, `date_of_joining`) VALUES
(1, 'Yogesh', '30000', 'male', 'Bhopal', 'yssyogesh@makitweb.com', '2019-10-01'),
(2, 'Vishal', '28000', 'male', 'Pune', 'vishal@makitweb.com', '2019-09-16'),
(3, 'Vijay', '35000', 'male', 'Jaipur', 'vijayec@makitweb.com', '2020-02-05'),
(4, 'Rahul', '25000', 'male', 'Kanpur', 'rahul512@makitweb.com', '2020-01-13'),
(5, 'Sonarika', '50000', 'female', 'Mumbai', 'bsonarika@makitweb.com', '2019-10-16'),
(6, 'Jitentendre', '48000', 'male', 'Bhopal', 'jiten94@makitweb.com', '2020-03-02'),
(7, 'Aditya', '36000', 'male', 'Pune', 'aditya@makitweb.com', '2019-08-05'),
(8, 'Anil', '32000', 'male', 'Indore', 'anilsingh@makitweb.com', '2019-11-04'),
(9, 'Sunil', '48000', 'male', 'Nagpur', 'sunil1993@makitweb.com', '2020-01-13'),
(10, 'Akilesh', '52000', 'male', 'Surat', 'akileshsahu@makitweb.com', '2019-12-02'),
(11, 'Raj', '48000', 'male', 'Ahmedabad', 'rajsingh@makitweb.com', '2019-06-24'),
(12, 'Mayank', '54000', 'male', 'Ghaziabad', 'mpatidar@makitweb.com', '2018-10-08'),
(13, 'Shalu', '43000', 'female', 'Bhopal', 'gshalu521@makitweb.com', '2019-07-19'),
(14, 'Ravi', '32000', 'male', 'Ludhiana', 'ravisharma21@makitweb.com', '2018-07-24'),
(15, 'Shruti', '45000', 'female', 'Delhi', 'shruti@makitweb.com', '2020-02-12'),
(16, 'Rishi', '38000', 'male', 'Mumbai', 'rishi121@makitweb.com', '2020-01-14'),
(17, 'Rohan', '47000', 'male', 'Jaipur', 'rohansingh@makitweb.com', '2019-12-18'),
(18, 'Priya', '28000', 'female', 'Indore', 'priya1992@makitweb.com', '2019-10-28'),
(19, 'Rakesh', '34000', 'male', 'bhopal', 'rakesh@makitweb.com', '2019-07-09'),
(20, 'Vinay', '34000', 'male', 'Delhi', 'vinaysingh@makitweb.com', '2019-04-08'),
(21, 'Tanu', '41000', 'female', 'pune', 'Tanu@makitweb.com', '2020-03-09'),
(22, 'Ajay', '28000', 'male', 'bhopal', 'ajay93@makitweb.com', '2018-12-24'),
(23, 'Nikhil', '46000', 'male', 'pune', 'nikhil@makitweb.com', '2019-02-12'),
(24, 'Arav', '28000', 'male', 'Nagpur', 'aravsingh@makitweb.com', '2019-03-13'),
(25, 'Madhu', '32000', 'female', 'Rajkot', 'madhu@makitweb.com', '2019-08-12'),
(26, 'Sagar', '44000', 'male', 'Rajkot', 'sagar@makitweb.com', '2020-02-10'),
(27, 'Anju ', '30000', 'female', 'Ranchi', 'anju@makitweb.com', '2019-11-07'),
(28, 'Rajat', '28000', 'male', 'kota', 'rajat@makitweb.com', '2020-01-21'),
(29, 'Anjali', '32000', 'female', 'Gwalior', 'anjali@makitweb.com', '2019-05-13'),
(30, 'Saloni', '32000', 'female', 'Nashik', 'saloni@makitweb.com', '2019-03-07'),
(31, 'Mayur', '28000', 'male', 'Bhopal', 'mayur@makitweb.com', '2019-09-18'),
(32, 'Pankaj', '32000', 'male', 'Indore', 'pankaj@makitweb.com', '2019-08-08'),
(33, 'Hrithik', '33000', 'male', 'Pune', 'hrithik@makitweb.com', '2020-03-04');

