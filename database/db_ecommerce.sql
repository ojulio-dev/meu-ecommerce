/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `db_ecommerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_ecommerce`;

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) default NULL,
  `age` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `customer` (`customer_id`, `name`, `image`, `age`, `email`, `password`, `status`, `admin`, `created_at`, `updated_at`) VALUES
	(1, 'Julio', 'customer/1.jpg', 16, 'ojuliocesar@gmail.com', 'ecd1c172f1b762928ee66753b2edd5d9', 1, 1, '2022-07-25 23:33:26', '2022-07-25 23:33:26');

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `banner` varchar(255),
  `amount` int(11) NOT NULL,
  `description` text NOT NULL,
  `special_price` double NOT NULL,
  `price` double NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_id`),
  KEY `FK_product_product_category` (`category_id`),
  CONSTRAINT `FK_product_product_category` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `product` (`product_id`, `category_id`, `name`, `banner`, `amount`, `description`, `special_price`, `price`, `slug`, `status`, `updated_at`, `created_at`) VALUES
	(1, 1, 'Teclado Razer Huntsman Mini', 'products/1.jpg', 99, 'Conheça o Razer Huntsman Mini Entre em uma nova dimensão com o Razer Huntsman Mini - um teclado para jogos com fator de forma de 60% e Switches ópticos Razer de última geração.', 585.89, 689.99, 'teclado-razer-huntsman-mini', 1, '2022-07-25 20:27:50', '2022-07-25 20:27:50'),
	(2, 1, 'Mouse Gamer Logitech G403 HERO', 'products/2.png', 80, 'O G403 entra no ringue com a nova geração do sensor HERO 25K. Prepare-se para um mouse com rastreamento 1:1 no próximo nível, suavização, filtragem ou aceleração zero.', 263.85, 293.17, 'mouse-gamer-logitech-g403-hero', 1, '2022-07-25 20:29:37', '2022-07-25 20:29:37'),
	(3, 1, 'Monitor Gamer Curvo HQ 24', 'products/3.png', 19, 'Monitor Gamer Curvo HQ 24 LED Full HD, 165 Hz, 1ms, HDMI, DisplayPort, FreeSync, Som Integrado, Preto  ', 1359.9, 1950, 'monitor-gamer-curvo-hq-24', 1, '2022-07-25 20:32:06', '2022-07-25 20:32:06'),
	(4, 1, 'Cadeira Gamer Ninja Hiryu', 'products/4.jpg', 298, 'Conheça a cadeira Ninja Hiryu, desenvolvida especialmente para gamers. Com espuma de alta densidade revestida por um couro PU de ótima qualidade, a Hiryu te proporcionará várias horas de jogo repletas de conforto!', 579, 965.38, 'cadeira-gamer-ninja-hiryu', 1, '2022-07-25 20:33:43', '2022-07-25 20:33:43'),
	(5, 1, 'Headset HyperX Cloud Stinger Core', 'products/5.png', 35, 'O HyperX Cloud Stinger Core é o headset perfeito, de nível de entrada, para o jogador de console que está procurando um ótimo som a um ótimo preço.', 179.9, 452.94, 'headset-hyperx-cloud-stinger-core', 1, '2022-07-25 20:36:01', '2022-07-25 20:36:01'),
	(6, 1, 'Microfone Gamer HyperX QuadCast', 'products/6.png', 87, 'Você é streamer, criador de conteúdo ou player. Deseja se comunicar com som impecável para os seus seguidores? Conheça agora mesmo o Microfone Gamer HyperX QuadCast. Este microfone gamer oferece de forma independente todos os recursos necessários para uma ótima gravação. A qualidade sonora é desempenhada por diversas tecnologias embutidas, capazes de reduzir os ruídos e oferecer uma alta estabilidade sonora. ', 799.9, 1411.65, 'microfone-gamer-hyperx-quadcast', 1, '2022-07-25 20:37:33', '2022-07-25 20:37:33'),
	(7, 1, 'Pc Gamer T-GAMER Thor', 'products/7webp', 10, 'Intel i7 10700F / NVIDIA GeForce RTX 3060 / DDR4 8GB / HD 1TB', 6115.31, 7578.38, 'pc-gamer-t-gamer-thor', 1, '2022-07-25 20:40:19', '2022-07-25 20:40:19'),
	(9, 2, 'One Piece - 99', 'products/9.png', 100, 'Depois de seus companheiros conseguirem impedir a perseguição implacável dos Oficiais dos Piratas Bestiais, Luffy finalmente chega ao topo da fortaleza e está diante de Kaido!! Todos os atores reúnem-se neste palco grandioso onde um combate mais do que intenso está prestes a começar...! É o início do clímax da batalha final em Onigashima!!', 43.99, 58.99, 'one-piece-99', 1, '2022-07-25 20:47:09', '2022-07-25 20:47:09'),
	(10, 2, 'One Piece - 100', 'products/10.png', 40, 'Com todas as estrelas reunidas no topo da fortaleza, Luffy e os Piratas da Nova Geração desafiam Kaido e Big Mom! Será que há alguma chance de vitória contra essa aliança formada entre os dois mais poderosos piratas dos mares?! O que o futuro reserva para essa batalha extrema que está fazendo toda Onigashima tremer?!', 40.99, 59.99, 'one-piece-100', 1, '2022-07-25 21:54:47', '2022-07-25 21:54:47'),
	(12, 2, 'Harry Potter e a Pedra Filosofal', 'products/12.png', 29, 'Harry Potter é um garoto cujos pais, feiticeiros, foram assassinados por um poderosíssimo bruxo quando ele ainda era um bebê. Ele foi levado, então, para a casa dos tios que nada tinham a ver com o sobrenatural. Pelo contrário. ', 23.5, 30.99, 'harry-potter-e-a-pedra-filosofal', 1, '2022-07-25 21:58:37', '2022-07-25 21:58:37'),
	(13, 2, 'Traveler: O Viajante (World of Warcraft Livro 1)', 'products/13jfif', 36, 'Já faz anos desde a última vez que Aramar Thorne viu o pai. Então, quando o capitão Greydon Thorne retorna do mar e convida o filho a acompanhá-lo em suas viagens, é como se o mundo de Aram tivesse sido redesenhado. A bordo do Andarilho das Ondas e sempre carregando seu caderno de desenho, Aram se esforça para se dar bem com a tripulação – especialmente com Makasa, a segunda oficial do navio que (relutantemente) foi encarregada de ficar de olho nele.', 21.1, 35.16, 'traveler-o-viajante-world-of-warcraft-livro-1', 1, '2022-07-25 22:11:13', '2022-07-25 22:11:13'),
	(14, 3, 'Caixa de Som Portátil JBL Flip 5', 'products/14.png', 23, 'Som imbatível Sinta a sua música. Tenha mais potência com o mais novo driver em forma de pista de corrida da Flip 5. Sinta graves explosivos em uma caixa de formato compacto.', 120.89, 187.99, 'caixa-de-som-portatil-jbl-flip-5', 1, '2022-07-25 22:13:45', '2022-07-25 22:13:45'),
	(16, 3, 'Smart Tv Full Hd 40 Led Samsung Wi-Fi 2 HDMI J5290', 'products/16.png', 45, 'Se você está procurando Qualidade e ao mesmo tempo um ótimo custo benefício, pode ficar por aqui mesmo, pois você encontrou! Te apresentamos a Smart Tv Full Hd 40 Led Samsung', 678.99, 900.88, 'smart-tv-full-hd-40-led-samsung-wi-fi-2-hdmi-j5290', 1, '2022-07-25 22:21:21', '2022-07-25 22:21:21'),
	(17, 3, 'Smartphone Samsung Galaxy A03 Core', 'products/17.png', 45, '32GB, Câmera Traseira 8 MP, Tela Infinita de 6.5", Octa Core, 2GB RAM, e Android', 668.67, 765.88, 'smartphone-samsung-galaxy-a03-core', 1, '2022-07-25 22:24:47', '2022-07-25 22:24:47'),
	(20, 4, 'Camiseta Efeito Cogumelo', 'products/20.png', 12, 'Camiseta para você doar para seu amigo duvidoso!', 129, 71.99, 'camiseta-efeito-cogumelo', 1, '2022-07-25 22:35:59', '2022-07-25 22:35:59'),
	(21, 4, 'Camiseta Manga Longa Compton', 'products/21.png', 65, 'Camiseta perfeita pra curtir o friozinho', 106.6, 149.9, 'camiseta-manga-longa-compton', 1, '2022-07-25 22:39:05', '2022-07-25 22:39:05'),
	(24, 4, 'Chapéu de Palha Flamingo', 'products/24.png', 44, 'Seu estilo agora pode servir como proteção! Além das estampas iradas, o Chapéu de Palha da Project possui a combinação ideal para proteger sua pele e garantir que você nunca mais perca nada na praia, e agora ela vem com sua própria bolsa, para guardar seu chapéu, e de quebra te ajuda a carregar tudo que precisa!', 179, 259, 'chapeu-de-palha-flamingo', 1, '2022-07-25 23:11:55', '2022-07-25 23:11:55'),
	(25, 5, 'Poltrona Decorativa - Cadeira Escritório', 'products/25.jpg', 56, 'Cadeira Escritório - Azul-turquesa', 369.9, 456.88, 'poltrona-decorativa-cadeira-escritorio', 1, '2022-07-25 23:22:37', '2022-07-25 23:22:37'),
	(26, 5, 'Poltrona Decorativa Cadeira Moderna', 'products/26.jpg', 52, 'Luma Luxo Para Recepção Sala Tv Estar E Espera - Linho Cinza', 599, 649.99, 'poltrona-decorativa-cadeira-moderna', 1, '2022-07-25 23:24:27', '2022-07-25 23:24:27'),
	(27, 1, 'Headset Gamer Razer Kraken', 'products/27.png', 76, 'O seu estilo gamer nunca mais será o mesmo depois deste Headset Gamer Razer Kraken Tournament. Com seu design inconfundível, sua cor exuberante e toda a sua tecnologia, este headset Razer vai te conquistar.', 829.9, 987.99, 'headset-gamer-razer-kraken', 1, '2022-07-26 15:29:47', '2022-07-26 15:29:47'),
	(28, 4, 'Camiseta Nike Brasil', 'products/28.png', 77, 'Camiseta para curtir a Copa do Mundo em 2022', 114.97, 129.99, 'camiseta-nike-brasil', 1, '2022-07-26 17:27:28', '2022-07-26 17:27:28'),
	(29, 3, 'Fone De Ouvido i12 Bluetooth', 'products/29.png', 54, 'O Fone De Ouvido Sem Fio Bluetooth 5.0 I12s Touch Android/IOS é de alta qualidade e traz conforto e liberdade para o dia a dia e até mesmo para prática de esportes.', 59, 66.99, 'fone-de-ouvido-i12-bluetooth', 1, '2022-07-26 17:30:41', '2022-07-26 17:30:41'),
	(30, 5, 'Mesa de Cabeceira', 'products/30.png', 6, 'Mesa de Cabeceira Retrô com 2 Gavetas 1 Nicho e Pés Palito Decor - ViaNossa', 40, 200, 'mesa-de-cabeceira', 1, '2022-07-26 17:34:45', '2022-07-26 17:34:45'),
	(31, 5, 'Mesa Retangular Helena Pequena', 'products/31.png', 33, 'Produto produzido com textura alto relevo, acabamento em Impressão ultra violeta, tampo verniz alto brilho e base verniz fosco.', 255.99, 345.88, 'mesa-retangular-helena-pequena', 1, '2022-07-26 17:37:03', '2022-07-26 17:37:03');

CREATE TABLE IF NOT EXISTS `product_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `product_category` (`category_id`, `name`, `slug`, `status`, `updated_at`, `created_at`) VALUES
	(1, 'Games', 'games', 1, '2022-07-22 14:29:40', '2022-07-22 14:29:40'),
	(2, 'Livros', 'livros', 1, '2022-07-22 14:30:00', '2022-07-22 14:30:00'),
	(3, 'Eletrônicos', 'eletronicos', 1, '2022-07-22 14:30:11', '2022-07-22 14:30:11'),
	(4, 'Moda', 'moda', 1, '2022-07-22 14:30:25', '2022-07-22 14:30:25'),
	(5, 'Móveis', 'moveis', 1, '2022-07-22 14:30:34', '2022-07-22 14:30:34');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
