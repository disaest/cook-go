<?php
session_start();
require_once '../components/connect.php';
$isLoggedIn = isLoggedIn();
$userLogin = getUserLogin();

$category_id = (int)($_GET['category_id'] ?? 0);
$search = trim($_GET['search'] ?? '');

$catQ = "SELECT title FROM categories WHERE id = $category_id";
$catRes = mysqli_query($conn, $catQ);
$cat = mysqli_fetch_array($catRes);
$catTitle = safe($cat['title'] ?? 'категория');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рецепты - <?php echo $catTitle; ?></title>
    <link rel="stylesheet" href="../components/style.css">
    <script src="../components/header.js" defer></script>
    <script src="../components/footer.js" defer></script>
</head>
<body data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>" data-user-login="<?php echo safe($userLogin); ?>">
    <my-header title="<?php echo $catTitle; ?>" link-text="категории" link-url="categories.php"></my-header>

    <main>
        <div class="recipes-container">
            <div class="category-header"><p><?php echo $catTitle; ?></p></div>

            <div class="search-wrapper">
                <form method="GET" class="search-form">
                    <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                    <input type="text" name="search" class="search-input" placeholder="Поиск по рецептам..." value="<?php echo safe($search); ?>">
                    <button type="submit" class="search-btn">Поиск</button>
                    <?php if (!empty($search)): ?>
                        <a href="recipes.php?category_id=<?php echo $category_id; ?>" class="reset-btn">Сбросить</a>
                    <?php endif; ?>
                </form>
            </div>

            <?php
            $q = "SELECT id, title, description, likes FROM recipes WHERE category_id = $category_id";
            if (!empty($search)) {
                $esc = mysqli_real_escape_string($conn, $search);
                $q .= " AND (title LIKE '%$esc%' OR description LIKE '%$esc%')";
            }
            $q .= " ORDER BY id ASC";
            $res = mysqli_query($conn, $q);

            if (mysqli_num_rows($res) > 0) {
                echo '<div class="recipes-grid">';
                while ($row = mysqli_fetch_array($res)) {
                    $id = $row['id'];
                    $title = safe($row['title']);
                    $desc = safe($row['description']);
                    $likes = $row['likes'];
                    $catEnc = urlencode($catTitle);
                    echo "
                    <a href='recipe_card.php?recipe_id=$id&category_id=$category_id&category_title=$catEnc' class='recipe-card'>
                        <div class='recipe-image'><img src='image.php?id=$id' alt='$title'></div>
                        <div class='recipe-info'>
                            <div class='recipe-text'>
                                <h2 class='recipe-title'>$title</h2>
                                <p class='recipe-description'>$desc</p>
                            </div>
                            <div class='recipe-likes' data-recipe-id='$id'>
                                <span class='likes-count' id='likes-$id'>$likes</span>
                                <img src='../images/ui/heart-empty.png' class='heart-icon-small' id='heart-$id' alt='like'>
                            </div>
                        </div>
                    </a>";
                }
                echo '</div>';
            } else {
                echo '<div class="no-recipes">';
                echo !empty($search) ? 'По запросу ничего не найдено' : 'В этой категории пока нет рецептов';
                echo '</div>';
            }
            ?>
        </div>
    </main>

    <my-footer></my-footer>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const logged = document.body.dataset.loggedIn === 'true';
        if (!logged) {
            document.querySelectorAll('.recipe-likes').forEach(function(el) {
                const rid = el.dataset.recipeId;
                const span = document.getElementById('likes-' + rid);
                const img = document.getElementById('heart-' + rid);
                if (span && img) img.src = '../images/ui/heart-empty.png';
            });
        } else {
            fetch('../handlers/get_user_likes.php')
                .then(r => r.json())
                .then(data => {
                    const liked = data.likes || [];
                    document.querySelectorAll('.recipe-likes').forEach(function(el) {
                        const rid = el.dataset.recipeId;
                        const img = document.getElementById('heart-' + rid);
                        if (img && liked.includes(parseInt(rid))) img.src = '../images/ui/heart-filled.png';
                    });
                });
        }
    });
    </script>
</body>
</html>