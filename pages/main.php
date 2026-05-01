<?php
session_start();
require_once '../components/connect.php';

$isLoggedIn = isLoggedIn();
$userId = $_SESSION['user_id'] ?? 0;
$userLogin = getUserLogin();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="../components/styles/base.css">
    <link rel="stylesheet" href="../components/styles/main.css">
    <link rel="stylesheet" href="../components/styles/recipes.css">
    <script src="../components/header.js" defer></script>
    <script src="../components/footer.js" defer></script>
</head>
<body data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>" data-user-login="<?php echo safe($userLogin); ?>">
    <my-header title="главное окно" link-text="категории" link-url="categories.php"></my-header>
    <main>
        <div class="welcome-image">
            <img src="../images/ui/welcome-text.png" alt="COOK GO!">
        </div>
        <?php if ($isLoggedIn): ?>
            <div class="favorites-section">
                <div class="favorites-header"><p>ВАМ ПОНРАВИЛОСЬ</p></div>
                <?php
                $q = "SELECT r.id, r.title, r.image_data, r.image_type, r.description, r.likes, c.title as cat_title, c.id as cat_id
                      FROM user_likes ul
                      JOIN recipes r ON ul.recipe_id = r.id
                      JOIN categories c ON r.category_id = c.id
                      WHERE ul.user_id = $userId
                      ORDER BY ul.created_at DESC";
                $res = mysqli_query($conn, $q);
                if ($res && mysqli_num_rows($res) > 0) {
                    echo '<div class="favorites-grid">';
                    while ($row = mysqli_fetch_array($res)) {
                        $id = $row['id'];
                        $title = safe($row['title']);
                        $desc = safe($row['description']);
                        $likes = $row['likes'];
                        $catTitle = safe($row['cat_title']);
                        $catId = $row['cat_id'];
                        $catEnc = urlencode($catTitle);
                        $imgSrc = '';
                        if (!empty($row['image_data'])) {
                            $imgSrc = 'data:' . $row['image_type'] . ';base64,' . base64_encode($row['image_data']);
                        }
                        echo "
                        <a href='recipe_card.php?recipe_id=$id&category_id=$catId&category_title=$catEnc' class='recipe-card'>
                            <div class='recipe-image'><img src='$imgSrc' alt='$title'></div>
                            <div class='recipe-info'>
                                <div class='recipe-text'>
                                    <h2 class='recipe-title'>$title</h2>
                                    <p class='recipe-description'>$desc</p>
                                </div>
                                <div class='recipe-likes'>
                                    <span class='likes-count'>$likes</span>
                                    <img src='../images/ui/heart-filled.png' class='heart-icon-small' alt='like'>
                                </div>
                            </div>
                        </a>";
                    }
                    echo '</div>';
                } else {
                    echo '<div class="no-favorites">У вас пока нет избранных рецептов</div>';
                }
                ?>
            </div>
        <?php else: ?>
            <div class="favorites-section">
                <div class="login-prompt">
                    <p><a href="login.php">Войдите</a> или <a href="register.php">зарегистрируйтесь</a>, чтобы сохранять понравившиеся рецепты!</p>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <my-footer></my-footer>
</body>
</html>