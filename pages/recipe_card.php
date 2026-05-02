<?php
session_start();
require_once '../components/connect.php';

$isLoggedIn = isLoggedIn();
$userLogin = getUserLogin();
$userId = $_SESSION['user_id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $rid = (int)($_POST['recipe_id'] ?? 0);
    $action = $_POST['action'] ?? '';
    if ($userId && $rid) {
        if ($action === 'like') {
            mysqli_query($conn, "INSERT IGNORE INTO user_likes (user_id, recipe_id) VALUES ($userId, $rid)");
            mysqli_query($conn, "UPDATE recipes SET likes = likes + 1 WHERE id = $rid");
        } elseif ($action === 'unlike') {
            mysqli_query($conn, "DELETE FROM user_likes WHERE user_id = $userId AND recipe_id = $rid");
            mysqli_query($conn, "UPDATE recipes SET likes = GREATEST(likes - 1, 0) WHERE id = $rid");
        }
    }
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}
if (isset($_GET['check_like'])) {
    $rid = (int)($_GET['check_like'] ?? 0);
    $liked = false;
    if ($userId && $rid) {
        $res = mysqli_query($conn, "SELECT id FROM user_likes WHERE user_id = $userId AND recipe_id = $rid");
        $liked = mysqli_num_rows($res) > 0;
    }
    header('Content-Type: application/json');
    echo json_encode(['liked' => $liked]);
    exit;
}
$recipe_id = $_GET['recipe_id'] ?? 0;
$category_id = $_GET['category_id'] ?? 0;
$catTitle = safe(urldecode($_GET['category_title'] ?? 'категория'));

$q = "SELECT * FROM recipes WHERE id = $recipe_id";
$res = mysqli_query($conn, $q);
$r = mysqli_fetch_array($res);

if ($r) {
    $title = safe($r['title']);
    $desc = safe($r['description']);
    $likes = $r['likes'];
    $ingr = safe($r['ingridients'] ?? 'Не указано');
    $port = safe($r['portions'] ?? 'Не указано');
    $time = safe($r['time_for_cook'] ?? 'Не указано');
    $tut = safe($r['tutorial'] ?? '');
    $mainImg = '';
    if (!empty($r['image_data'])) {
        $mainImg = 'data:' . $r['image_type'] . ';base64,' . base64_encode($r['image_data']);
    }
    $stepCountRes = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM step_images WHERE recipe_id = $recipe_id");
    $stepCountRow = mysqli_fetch_array($stepCountRes);
    $stepCount = $stepCountRow['cnt'] ?? 0;
} else {
    $title = 'Рецепт не найден';
    $desc = $ingr = $port = $time = $tut = '';
    $likes = 0;
    $mainImg = '';
    $stepCount = 0;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="../components/styles/base.css">
    <link rel="stylesheet" href="../components/styles/recipe_card.css">
    <script src="../components/header.js" defer></script>
    <script src="../components/footer.js" defer></script>
</head>
<body data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>" data-user-login="<?php echo safe($userLogin); ?>">
    <my-header title="<?php echo $title; ?>" link-text="<?php echo $catTitle; ?>" link-url="recipes.php?category_id=<?php echo $category_id; ?>"></my-header>
    <main>
        <div class="recipe-detail-container">
            <?php if ($r): ?>
                <div class="recipe-card-full">
                    <div class="recipe-main-image">
                        <img src="<?php echo $mainImg; ?>" alt="<?php echo $title; ?>">
                    </div>
                    <div class="recipe-header-row">
                        <div class="recipe-text-content">
                            <h1 class="recipe-title-full"><?php echo $title; ?></h1>
                            <p class="recipe-description-full"><?php echo $desc; ?></p>
                        </div>
                        <div class="recipe-likes-right">
                            <span class="likes-count" id="likes-count"><?php echo $likes; ?></span>
                            <button class="like-btn" id="like-btn" data-recipe-id="<?php echo $recipe_id; ?>">
                                <img src="../images/ui/heart-empty.png" id="heart-icon" alt="like">
                            </button>
                        </div>
                    </div>
                    <div class="recipe-content-row">
                        <div class="ingredients-box">
                            <h3 class="ingredients-title">Ингредиенты:</h3>
                            <p class="ingredients-list"><?php echo nl2br($ingr); ?></p>
                        </div>
                        <div class="meta-info-box">
                            <div class="meta-item">
                                <p class="meta-label">Порций:</p>
                                <p class="meta-value"><?php echo $port; ?></p>
                            </div>
                            <div class="meta-item">
                                <p class="meta-label">Время приготовления:</p>
                                <p class="meta-value"><?php echo $time; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="recipe-section-header"><p>РЕЦЕПТ</p></div>
                    <div class="recipe-steps">
                        <?php
                        $steps = explode("\n", $tut);
                        $n = 1;
                        $stepIndex = 0;
                        foreach ($steps as $step):
                            $step = trim($step);
                            if (empty($step)) continue;
                            $stepImg = '';
                            if ($stepIndex < $stepCount) {
                                $stepQ = "SELECT image_data, image_type FROM step_images WHERE recipe_id = $recipe_id AND step_number = $stepIndex";
                                $stepRes = mysqli_query($conn, $stepQ);
                                if ($stepRes && mysqli_num_rows($stepRes) > 0) {
                                    $stepRow = mysqli_fetch_array($stepRes);
                                    $stepImg = 'data:' . $stepRow['image_type'] . ';base64,' . base64_encode($stepRow['image_data']);
                                }
                            }
                        ?>
                            <div class="step-item">
                                <p class="step-text"><?php echo $step; ?></p>
                                <?php if (!empty($stepImg)): ?>
                                    <div class="step-image">
                                        <img src="<?php echo $stepImg; ?>" alt="Шаг <?php echo $n; ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php 
                            $stepIndex++;
                            $n++; 
                        endforeach; 
                        ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="recipe-not-found">
                    <p>Рецепт не найден</p>
                    <a href="categories.php" class="back-link">← Вернуться к категориям</a>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <my-footer></my-footer>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('like-btn');
        if (!btn) return;
        const heart = document.getElementById('heart-icon');
        const count = document.getElementById('likes-count');
        const rid = btn.dataset.recipeId;
        const logged = document.body.dataset.loggedIn === 'true';
        if (!logged) {
            heart.src = '../images/ui/heart-empty.png';
        } else {
            fetch('recipe_card.php?check_like=' + rid)
                .then(r => r.json())
                .then(d => {
                    if (d.liked) {
                        btn.dataset.liked = 'true';
                        heart.src = '../images/ui/heart-filled.png';
                    }
                });
        }
        btn.addEventListener('click', function() {
            if (!logged) {
                const toast = document.createElement('div');
                toast.style.cssText = 'position:fixed; top:20px; left:50%; transform:translateX(-50%); background:#fff3cd; color:#856404; padding:14px 28px; border-radius:10px; font-family:"MPlus",sans-serif; font-size:18px; border:2px solid #ffc107; z-index:9999; text-align:center; min-width:400px;';
                toast.textContent = 'Чтобы ставить лайки, нужно войти в аккаунт';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
                return;
            }
            const liked = btn.dataset.liked === 'true';
            const action = liked ? 'unlike' : 'like';
            let cur = parseInt(count.textContent);
            fetch('recipe_card.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: 'recipe_id=' + rid + '&action=' + action
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    if (liked) {
                        count.textContent = cur - 1;
                        heart.src = '../images/ui/heart-empty.png';
                        btn.dataset.liked = 'false';
                    } else {
                        count.textContent = cur + 1;
                        heart.src = '../images/ui/heart-filled.png';
                        btn.dataset.liked = 'true';
                    }
                }
            });
        });
    });
    </script>
</body>
</html>