-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` int DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `final` tinyint(1) DEFAULT '0',
  `publishedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,5,'The Future of Web Development','<p>The landscape of web development is constantly evolving, with new technologies and methodologies emerging at a rapid pace. As we look towards the future, several key trends are shaping the way we build and interact with web applications.</p><h2>1. Serverless Architectures</h2><p>Serverless computing is gaining traction, allowing developers to focus on writing code without the need to manage server infrastructure. This approach offers benefits such as reduced operational costs, improved scalability, and faster time-to-market for new features.</p><h2>2. AI-Driven Interfaces</h2><p>Artificial Intelligence is making its way into web interfaces, enabling more personalized and intuitive user experiences. From chatbots to predictive analytics, AI is enhancing the way users interact with web applications.</p><h2>3. Progressive Web Apps (PWAs)</h2><p>PWAs continue to bridge the gap between web and native applications, offering offline capabilities, push notifications, and app-like experiences within the browser. This technology is becoming increasingly important for businesses looking to engage users across multiple platforms.</p><p>As we embrace these new technologies, it&#39;s clear that the future of web development is geared towards creating more efficient, intelligent, and user-centric experiences. Developers who stay ahead of these trends will be well-positioned to create innovative solutions in the ever-evolving digital landscape.</p>','web, web dev',1,'2024-10-01 12:54:25'),(3,1,'Testing all styles','<h1>heading 1</h1><h2>heading 2</h2><h3>heading 3</h3><p><strong>bold</strong></p><p><em>italic</em></p><p><u>underlined</u></p><p><a href=\"https://youtube.com\" rel=\"noopener noreferrer\" target=\"_blank\">link</a></p>','all styles, test',1,'2024-10-01 12:58:16');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'yash','y@gmail.com','$2y$10$qEBskdmEGYrpu8E6sFELPO7UPzdebemdFrnnECKxlU49eQRho/krK'),(2,'test','t@gmail.com','$2y$10$EG2/1jOKspOP29rBsk7ETOQFT2YK7qU7LHwO/4sNZO3N0sFs/YH.W'),(5,'John Doe','john@gmail.com','$2y$10$3mbvU/m4zmltAY9nkD5rMexJReXo9sTbhcw/qAXzsWDCYkIBaAfF.');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-01 18:31:39
