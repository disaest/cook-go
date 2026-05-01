-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 20 2026 г., 21:39
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `busk_baza`
--

-- --------------------------------------------------------

--
-- Структура таблицы `card_recipes`
--

CREATE TABLE `card_recipes` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ingridients` varchar(255) NOT NULL,
  `portions` varchar(20) NOT NULL,
  `time_for_cook` varchar(20) NOT NULL,
  `tutorial` text NOT NULL,
  `images` varchar(255) NOT NULL,
  `likes` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `card_recipes`
--

INSERT INTO `card_recipes` (`id`, `title`, `icon`, `description`, `ingridients`, `portions`, `time_for_cook`, `tutorial`, `images`, `likes`) VALUES
(1, 'Пирог яблочный', 'apple-pie.jpg', 'Пирог с яблоками и корицей', 'Яблоки - 5 шт\nМука - 2 стакана\nСахар - 1 стакан\nЯйца - 2 шт\nМасло сливочное - 100 г\nКорица - 1 ч.л.', '8 порций', '60 минут', '1. Смешайте муку с маслом и яйцами, замесите тесто.\n2. Нарежьте яблоки тонкими дольками.\n3. Раскатайте тесто и выложите в форму.\n4. Выложите яблоки, посыпьте сахаром и корицей.\n5. Выпекайте при 180°C 40 минут.', 'apple-pie-1.jpg,apple-pie-2.jpg,apple-pie-3.jpg', '0'),
(2, 'Пирог мясной', 'meat-pie.jpg', 'Сытный пирог с мясной начинкой', 'Фарш мясной - 500 г\nЛук - 2 шт\nМука - 3 стакана\nЯйца - 2 шт\nМолоко - 200 мл\nДрожжи - 10 г\nСпеции - по вкусу', '6 порций', '90 минут', '1. Замесите дрожжевое тесто из муки, молока, яиц.\n2. Обжарьте фарш с луком и специями.\n3. Раскатайте тесто, выложите начинку.\n4. Сформируйте пирог, смажьте яйцом.\n5. Выпекайте при 180°C 45 минут.', 'meat-pie-1.jpg,meat-pie-2.jpg,meat-pie-3.jpg', '0'),
(3, 'Омлет', 'omelet.jpg', 'Пышный омлет с зеленью', 'Яйца - 3 шт\nМолоко - 50 мл\nСыр - 50 г\nЗелень - пучок\nСоль - по вкусу\nМасло растительное - 1 ст.л.', '2 порции', '15 минут', '1. Взбейте яйца с молоком и солью.\n2. Натрите сыр, нарежьте зелень.\n3. Вылейте смесь на разогретую сковороду.\n4. Посыпьте сыром и зеленью.\n5. Готовьте под крышкой 5-7 минут.', 'omelet-1.jpg,omelet-2.jpg', '0'),
(4, 'Сырники', 'syrniki.jpg', 'Нежные творожные сырники со сметаной', 'Творог - 400 г\nЯйцо - 1 шт\nМука - 3 ст.л.\nСахар - 2 ст.л.\nВанилин - щепотка\nСоль - щепотка', '4 порции', '30 минут', '1. Смешайте творог с яйцом, сахаром, солью.\n2. Добавьте муку и ванилин, перемешайте.\n3. Сформируйте сырники, обваляйте в муке.\n4. Обжарьте на сковороде до золотистой корочки.\n5. Подавайте со сметаной или вареньем.', 'syrniki-1.jpg,syrniki-2.jpg', '0'),
(5, 'Печенье шоколадное', 'choco-cookies.jpg', 'Мягкое печенье с кусочками шоколада', 'Мука - 2 стакана\nМасло сливочное - 150 г\nСахар - 1 стакан\nЯйцо - 1 шт\nШоколад - 100 г\nРазрыхлитель - 1 ч.л.', '12 порций', '40 минут', '1. Взбейте масло с сахаром.\n2. Добавьте яйцо, перемешайте.\n3. Всыпьте муку с разрыхлителем.\n4. Нарежьте шоколад кусочками, добавьте в тесто.\n5. Сформируйте печенье, выпекайте 15 минут при 180°C.', 'choco-cookies-1.jpg,choco-cookies-2.jpg', '0'),
(6, 'Печенье овсяное', 'oat-cookies.jpg', 'Полезное овсяное печенье с изюмом', 'Овсяные хлопья - 2 стакана\nМука - 1 стакан\nМасло - 100 г\nСахар - 0.5 стакана\nЯйцо - 1 шт\nИзюм - 100 г', '10 порций', '35 минут', '1. Смешайте хлопья с мукой.\n2. Взбейте масло с сахаром и яйцом.\n3. Соедините смеси, добавьте изюм.\n4. Сформируйте печенье на противне.\n5. Выпекайте 15-20 минут при 180°C.', 'oat-cookies-1.jpg,oat-cookies-2.jpg', '1'),
(7, 'Суп куриный', 'chicken-soup.jpg', 'Лёгкий куриный суп с вермишелью', 'Курица - 300 г\nКартофель - 3 шт\nМорковь - 1 шт\nЛук - 1 шт\nВермишель - 100 г\nЗелень, соль - по вкусу', '6 порций', '50 минут', '1. Отварите курицу до готовности.\n2. Достаньте курицу, в бульон добавьте нарезанный картофель.\n3. Обжарьте лук с морковью, добавьте в суп.\n4. Добавьте вермишель, варите 5 минут.\n5. Верните курицу, посыпьте зеленью.', 'chicken-soup-1.jpg,chicken-soup-2.jpg,chicken-soup-3.jpg', '0'),
(8, 'Суп грибной', 'mushroom-soup.jpg', 'Суп из лесных грибов', 'Грибы - 300 г\nКартофель - 3 шт\nЛук - 1 шт\nМорковь - 1 шт\nСметана - 100 г\nЗелень, соль - по вкусу', '4 порции', '40 минут', '1. Отварите грибы 15 минут.\n2. Добавьте нарезанный картофель.\n3. Обжарьте лук с морковью, добавьте в суп.\n4. Варите до готовности картофеля.\n5. Подавайте со сметаной и зеленью.', 'mushroom-soup-1.jpg,mushroom-soup-2.jpg', '0'),
(9, 'Салат Цезарь', 'caesar-salad.jpg', 'Классический салат с курицей и соусом', 'Куриное филе - 300 г\nСалат Романо - 1 пучок\nПомидоры черри - 10 шт\nСыр Пармезан - 100 г\nСухарики - 100 г\nСоус Цезарь - 100 мл', '4 порции', '30 минут', '1. Обжарьте куриное филе до золотистой корочки.\n2. Нарежьте курицу, помидоры, порвите салат.\n3. Смешайте все ингредиенты в миске.\n4. Добавьте сухарики и соус.\n5. Посыпьте тёртым пармезаном.', 'caesar-salad-1.jpg,caesar-salad-2.jpg', '0'),
(10, 'Салат Греческий', 'greek-salad.jpg', 'Салат с помидорами, огурцами и сыром фета', 'Помидоры - 3 шт\nОгурцы - 2 шт\nПерец болгарский - 1 шт\nЛук красный - 1 шт\nСыр Фета - 200 г\nМаслины - 100 г\nОливковое масло - 3 ст.л.', '3 порции', '20 минут', '1. Нарежьте овощи крупными кубиками.\n2. Добавьте маслины и нарезанный лук.\n3. Сверху выложите кубики феты.\n4. Заправьте оливковым маслом.\n5. Аккуратно перемешайте.', 'greek-salad-1.jpg,greek-salad-2.jpg', '0'),
(11, 'Хлеб ржаной', 'rye-bread.jpg', 'Ароматный домашний хлеб из ржаной муки', 'Мука ржаная - 300 г\nМука пшеничная - 200 г\nВода - 350 мл\nДрожжи - 10 г\nСоль - 1 ч.л.\nСахар - 1 ст.л.', '1 буханка', '120 минут', '1. Смешайте оба вида муки, соль, сахар.\n2. Разведите дрожжи в тёплой воде.\n3. Замесите тесто, оставьте на 1 час.\n4. Сформируйте буханку, дайте подняться 30 минут.\n5. Выпекайте при 200°C 40 минут.', 'rye-bread-1.jpg,rye-bread-2.jpg,rye-bread-3.jpg', '0'),
(12, 'Хлеб пшеничный', 'wheat-bread.jpg', 'Классический белый хлеб с хрустящей корочкой', 'Мука - 500 г\nВода - 300 мл\nДрожжи - 10 г\nСоль - 1 ч.л.\nСахар - 1 ст.л.\nМасло растительное - 2 ст.л.', '1 буханка', '100 минут', '1. Разведите дрожжи с сахаром в тёплой воде.\n2. Добавьте муку, соль, масло, замесите тесто.\n3. Оставьте подниматься на 1 час.\n4. Сформируйте буханку, дайте подняться 30 минут.\n5. Выпекайте при 200°C 35 минут.', 'wheat-bread-1.jpg,wheat-bread-2.jpg,wheat-bread-3.jpg', '0'),
(13, 'Веганский боул', 'vegan-bowl.jpg', 'Боул с киноа, авокадо и овощами', 'Киноа - 200 г\nАвокадо - 1 шт\nПомидоры черри - 10 шт\nОгурец - 1 шт\nШпинат - 100 г\nЛимонный сок - 2 ст.л.', '2 порции', '25 минут', '1. Отварите киноа 15 минут.\n2. Нарежьте авокадо, помидоры, огурец.\n3. Выложите киноа в миску.\n4. Сверху разложите овощи и шпинат.\n5. Заправьте лимонным соком.', 'vegan-bowl-1.jpg,vegan-bowl-2.jpg', '0'),
(14, 'Веганские котлеты', 'vegan-cutlets.jpg', 'Котлеты из нута', 'Нут - 300 г\nЛук - 1 шт\nЧеснок - 2 зубчика\nМука - 3 ст.л.\nСпеции - по вкусу\nМасло для жарки', '6 порций', '40 минут', '1. Замочите нут на ночь, затем отварите.\n2. Измельчите нут с луком и чесноком в блендере.\n3. Добавьте муку и специи, перемешайте.\n4. Сформируйте котлеты.\n5. Обжарьте с двух сторон до корочки.', 'vegan-cutlets-1.jpg,vegan-cutlets-2.jpg,vegan-cutlets-3.jpg', '0'),
(15, 'Смузи клубничный', 'strawberry-smoothie.jpg', 'Освежающий смузи из клубники и банана', 'Клубника - 200 г\nБанан - 1 шт\nЙогурт - 200 мл\nМёд - 1 ст.л.\nЛёд - по желанию', '2 порции', '10 минут', '1. Вымойте клубнику, удалите хвостики.\n2. Нарежьте банан кружочками.\n3. Сложите всё в блендер.\n4. Добавьте йогурт и мёд.\n5. Взбейте до однородности.', 'strawberry-smoothie-1.jpg,strawberry-smoothie-2.jpg', '3'),
(16, 'Смузи зелёный', 'green-smoothie.jpg', 'Полезный смузи из шпината и яблока', 'Шпинат - 100 г\nЯблоко - 1 шт\nБанан - 1 шт\nВода - 200 мл\nЛимонный сок - 1 ст.л.', '2 порции', '10 минут', '1. Вымойте шпинат и яблоко.\n2. Нарежьте яблоко и банан.\n3. Сложите всё в блендер.\n4. Добавьте воду и лимонный сок.\n5. Взбейте до однородной консистенции.', 'green-smoothie-1.jpg,green-smoothie-2.jpg', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `icon`) VALUES
(1, 'пироги', 'pies.jpg'),
(2, 'завтраки', 'zavtraki.jpg'),
(3, 'печенье', 'cookies.jpg'),
(4, 'супы', 'soups.jpg'),
(5, 'салаты', 'salad.jpg'),
(6, 'хлеб', 'bread.jpg'),
(7, 'веган', 'vegan.jpg'),
(8, 'смузи', 'smoothie.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `recipes`
--

CREATE TABLE `recipes` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `likes` varchar(20) NOT NULL,
  `categories` varchar(155) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `recipes`
--

INSERT INTO `recipes` (`id`, `title`, `icon`, `description`, `likes`, `categories`) VALUES
(1, 'Пирог яблочный', 'apple-pie.jpg', 'Пирог с яблоками и корицей', '0', '1'),
(2, 'Пирог мясной', 'meat-pie.jpg', 'Сытный пирог с мясной начинкой', '0', '1'),
(3, 'Омлет', 'omelet.jpg', 'Пышный омлет с зеленью', '0', '2'),
(4, 'Сырники', 'syrniki.jpg', 'Нежные творожные сырники со сметаной', '0', '2'),
(5, 'Печенье шоколадное', 'choco-cookies.jpg', 'Мягкое печенье с кусочками шоколада', '0', '3'),
(6, 'Печенье овсяное', 'oat-cookies.jpg', 'Полезное овсяное печенье с изюмом', '0', '3'),
(7, 'Суп куриный', 'chicken-soup.jpg', 'Лёгкий куриный суп с вермишелью', '0', '4'),
(8, 'Суп грибной', 'mushroom-soup.jpg', 'Суп из лесных грибов', '0', '4'),
(9, 'Салат Цезарь', 'caesar-salad.jpg', 'Классический салат с курицей и соусом', '0', '5'),
(10, 'Салат Греческий', 'greek-salad.jpg', 'Салат с помидорами, огурцами и сыром фета', '0', '5'),
(11, 'Хлеб ржаной', 'rye-bread.jpg', 'Ароматный домашний хлеб из ржаной муки', '0', '6'),
(12, 'Хлеб пшеничный', 'wheat-bread.jpg', 'Классический белый хлеб с хрустящей корочкой', '0', '6'),
(13, 'Веганский боул', 'vegan-bowl.jpg', 'Боул с киноа, авокадо и овощами', '0', '7'),
(14, 'Веганские котлеты', 'vegan-cutlets.jpg', 'Котлеты из нута', '0', '7'),
(15, 'Смузи клубничный', 'strawberry-smoothie.jpg', 'Освежающий смузи из клубники и банана', '2', '8'),
(16, 'Смузи зелёный', 'green-smoothie.jpg', 'Полезный смузи из шпината и яблока', '0', '8');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`) VALUES
(4, 'jackie', '$2y$10$85N3WVzaNn8zJlKGePorx..FM.egCr/q7mxd9yE2bhxMQkHGAXcty'),
(5, 'mordovskoy', '$2y$10$l3lAb5/t5Pz1YWqyro9amuMzYAcWa/3bfRj84b.exzaU0l.RIX4aa');

-- --------------------------------------------------------

--
-- Структура таблицы `user_likes`
--

CREATE TABLE `user_likes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_likes`
--

INSERT INTO `user_likes` (`id`, `user_id`, `recipe_id`, `created_at`) VALUES
(6, 5, 15, '2026-04-20 18:38:22'),
(7, 4, 15, '2026-04-20 18:38:46');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `card_recipes`
--
ALTER TABLE `card_recipes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_like` (`user_id`,`recipe_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `card_recipes`
--
ALTER TABLE `card_recipes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `user_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_likes_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
