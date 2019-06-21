-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 04 2019 г., 22:55
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gbphp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `adres` varchar(200) NOT NULL,
  `msg` varchar(200) NOT NULL,
  `items` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `booking`
--

INSERT INTO `booking` (`id`, `name`, `adres`, `msg`, `items`) VALUES
(1, '111', '22', '333', '{\"1\":{\"price\":\"200\",\"name\":\"Товар 1\",\"count\":3},\"2\":{\"price\":\"300\",\"name\":\"Товар 2\",\"count\":5}}'),
(2, '111', '22', '333', '{\"1\":{\"price\":\"200\",\"name\":\"Товар 1\",\"count\":3},\"2\":{\"price\":\"300\",\"name\":\"Товар 2\",\"count\":5}}');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `info` varchar(250) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `info`, `price`) VALUES
(1, 'Товар 1', 'Тут информация о товаре 1', 200),
(2, 'Товар 2', 'Тут информация о товаре 2', 300),
(3, 'Товар 3', 'Описание', 230),
(4, 'Товар 4', 'Описание этого товара', 4560);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `fio` varchar(50) NOT NULL DEFAULT 'anonimus',
  `login` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время создания записи',
  `count` int(11) DEFAULT '0',
  `is_admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fio`, `login`, `password`, `date`, `count`, `is_admin`) VALUES
(1, 'Amin', 'admin', '87bd8892e3b714543d8bb6ca71470fa9', '2019-03-12 18:42:08', 0, 1),
(2, 'user', 'user', '87bd8892e3b714543d8bb6ca71470fa9', '2019-03-12 18:42:44', 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
