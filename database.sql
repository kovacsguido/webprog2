-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: web2hf_db
-- Létrehozás ideje: 2020. Dec 03. 13:19
-- Kiszolgáló verziója: 5.7.30
-- PHP verzió: 7.4.6

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `web2hf`
--
CREATE DATABASE IF NOT EXISTS `web2hf` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `web2hf`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `url` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_hungarian_ci NOT NULL,
  `permission` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `url`, `name`, `permission`, `position`) VALUES
(1, 0, 'kezdolap', 'Kezdőlap', 1, 10),
(2, 0, 'hirbekuldes', 'Hír beküldés', 2, 20),
(3, 0, '', 'Információ', 1, 30),
(4, 0, '', 'Belépés/Regisztráció', 1, 40),
(5, 0, '', 'Adminisztráció', 3, 50),
(6, 3, 'rolunk', 'Rólunk', 1, 31),
(7, 3, 'elerhetoseg', 'Elérhetőség', 1, 32),
(8, 4, 'regisztracio', 'Regisztráció', 1, 41),
(9, 4, 'belepes', 'Belépés', 1, 42),
(10, 4, 'kilepes', 'Kilépés', 2, 43),
(11, 5, 'felhasznalok', 'Felhasználók', 3, 51);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(62) COLLATE utf8_hungarian_ci NOT NULL,
  `body` varchar(4096) COLLATE utf8_hungarian_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `news`
--

INSERT INTO `news` (`id`, `title`, `body`, `created`, `creator`) VALUES
(1, 'dsad', 'dsad dsadas', '2020-12-03 10:35:50', 2),
(2, 'rewq', 'rewq rewq rewq', '2020-12-03 11:16:30', 2),
(3, 'fdsa fdsa fdsa', 'fds fdsa fdsa fdsa fdsa fdsa fdsa fdsa fdsa fdsa fdsa', '2020-12-03 11:22:29', 2),
(4, 'hír 4', 'dsa dsa asda', '2020-12-03 12:17:10', 2),
(5, 'Teszt hír - 2020.12.03. 12:22:32', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec massa risus, consectetur ac magna nec, faucibus sagittis turpis. Sed accumsan dictum est, eu aliquam dui suscipit ac. Donec sagittis velit in ex lacinia gravida. Proin id quam eget justo tincidunt tincidunt sit amet quis ligula. Ut id egestas dui, eu aliquet tellus. Suspendisse aliquam justo neque, id semper turpis aliquam eget. Nam purus nunc, sagittis in mi at, aliquet sodales lectus. Nullam orci lorem, ullamcorper condimentum aliquet non, consectetur sed dui. Maecenas ac massa at quam lacinia convallis. Nullam elementum enim nec lobortis facilisis. Nullam auctor lobortis diam non lacinia. Vivamus et efficitur ligula. Donec velit nulla, ornare et massa nec, feugiat vehicula urna.', '2020-12-03 12:22:32', 1),
(6, 'Teszt hír - 2020.12.03. 12:42:23', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec massa risus, consectetur ac magna nec, faucibus sagittis turpis. Sed accumsan dictum est, eu aliquam dui suscipit ac. Donec sagittis velit in ex lacinia gravida. Proin id quam eget justo tincidunt tincidunt sit amet quis ligula. Ut id egestas dui, eu aliquet tellus. Suspendisse aliquam justo neque, id semper turpis aliquam eget. Nam purus nunc, sagittis in mi at, aliquet sodales lectus. Nullam orci lorem, ullamcorper condimentum aliquet non, consectetur sed dui. Maecenas ac massa at quam lacinia convallis. Nullam elementum enim nec lobortis facilisis. Nullam auctor lobortis diam non lacinia. Vivamus et efficitur ligula. Donec velit nulla, ornare et massa nec, feugiat vehicula urna.', '2020-12-03 12:42:23', 1),
(7, 'Hír 7', 'dfsasfd fdsfasdf fdsafsad fdsfasd fdsa fdsa fdsa fdsa', '2020-12-03 12:42:42', 2),
(8, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis metus metus, blandit quis placerat in, consequat ac ex. Proin tristique diam quis eros sollicitudin vulputate. Cras auctor ipsum sapien, a ullamcorper nulla dictum at. Cras lacus augue, dapibus ultrices vehicula ac, feugiat vel arcu. Sed eu mi vel massa ullamcorper finibus at non ante. Proin vitae velit ullamcorper, consequat diam egestas, vestibulum nisl. Vivamus eu cursus nulla. Pellentesque vel libero quis justo ullamcorper pulvinar.<br />\r\n<br />\r\nAenean ut ante non tellus rhoncus porttitor. Proin at sodales ligula, egestas tristique purus. In velit dui, convallis quis maximus vitae, viverra at eros. Pellentesque tempus porttitor turpis at tincidunt. Nunc dictum felis justo, id tincidunt mauris vulputate a. In in dolor ultrices, pretium risus ac, aliquam enim. Ut porta massa gravida velit venenatis, at venenatis enim efficitur. Vestibulum venenatis dignissim quam, non sodales mauris mollis sit amet. Suspendisse sodales sem sit amet metus sagittis dictum. Integer ultricies laoreet lorem rutrum varius. Nulla facilisi. Nam vitae sem at justo luctus sagittis at sed risus.<br />\r\n<br />\r\nUt iaculis ut magna at sodales. Sed non nisi in dui commodo volutpat. Donec quis sem ut lorem tempor tincidunt. Vivamus pretium eleifend facilisis. Etiam posuere diam nisl, a rutrum tortor molestie quis. Curabitur elit neque, laoreet faucibus tincidunt in, blandit quis ipsum. Cras gravida lectus erat, eu aliquet metus bibendum consectetur. Donec tincidunt interdum orci vel suscipit. Suspendisse arcu nisi, eleifend quis lectus eget, fermentum sodales velit. Suspendisse in leo quis dolor fringilla auctor et a ex. Maecenas quis lectus dui.', '2020-12-03 14:12:37', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `firstname` varchar(32) COLLATE utf8_hungarian_ci NOT NULL,
  `lastname` varchar(32) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `password`, `permission`) VALUES
(1, 'admin', 'Admin', 'Admin', '8C6976E5B5410415BDE908BD4DEE15DFB167A9C873FC4BB8A81F6F2AB448A918', 3),
(2, 'guido', 'Guido', 'Kovács', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 2),
(16, 'tesztelek', 'Elek', 'Teszt', '25f654d6d0801dab80abee61003800d8864034b7287afada9e988703c0c33326', 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `name`) VALUES
(1, 'Látogató'),
(2, 'Regisztrált felhasználó'),
(3, 'Adminisztrátor');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator` (`creator`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission` (`permission`);

--
-- A tábla indexei `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT a táblához `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT a táblához `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`permission`) REFERENCES `user_permissions` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
