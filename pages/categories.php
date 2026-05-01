<?php
session_start();
require_once '../components/connect.php';

$isLoggedIn = isLoggedIn();
$userLogin = getUserLogin();
$search = trim($_GET['search'] ?? '');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категории</title>
    <link rel="stylesheet" href="../components/styles/base.css">
    <link rel="stylesheet" href="../components/styles/categories.css">
    <script src="../components/header.js" defer></script>
    <script src="../components/footer.js" defer></script>
</head>
<body data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>" data-user-login="<?php echo safe($userLogin); ?>">
    <my-header title="категории" link-text="главное окно" link-url="main.php"></my-header>
    <main>
        <div class="categories-container">
            <div class="search-wrapper">
                <form method="GET" action="" class="search-form">
                    <input type="text" name="search" class="search-input" placeholder="Поиск по категориям..." value="<?php echo safe($search); ?>">
                    <button type="submit" class="search-btn">Поиск</button>
                    <?php if (!empty($search)): ?>
                        <a href="categories.php" class="reset-btn">Сбросить</a>
                    <?php endif; ?>
                </form>
            </div>
            <div class="categories-grid">
                <?php
                $q = "SELECT id, title, image_data, image_type FROM categories";
                if (!empty($search)) {
                    $esc = mysqli_real_escape_string($conn, $search);
                    $q .= " WHERE title LIKE '%$esc%'";
                }
                $q .= " ORDER BY id ASC";
                $res = mysqli_query($conn, $q);
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($cat = mysqli_fetch_array($res)) {
                        $id = $cat['id'];
                        $title = safe($cat['title']);
                        $imgSrc = '';
                        if (!empty($cat['image_data'])) {
                            $imgSrc = 'data:' . $cat['image_type'] . ';base64,' . base64_encode($cat['image_data']);
                        }
                        echo "
                        <a href='recipes.php?category_id=$id' class='category-card'>
                            <div class='category-title'><p>$title</p></div>
                            <div class='category-image'><img src='$imgSrc' alt='$title'></div>
                        </a>";
                    }
                } else {
                    echo '<div class="no-categories">';
                    echo !empty($search) ? 'По запросу ничего не найдено' : 'Категории не добавлены';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </main>
    <my-footer></my-footer>
</body>
</html>