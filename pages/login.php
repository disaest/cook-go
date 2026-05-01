<?php
session_start();
require_once '../components/connect.php';

$error = '';
$logout = $_GET['logout'] ?? '';
$registered = $_GET['registered'] ?? '';
$isLoggedIn = isLoggedIn();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isLoggedIn) {
    $login = trim($_POST['login'] ?? '');
    $pass = $_POST['password'] ?? '';
    if (empty($login) || empty($pass)) {
        $error = 'Введите логин и пароль';
    } else {
        $esc = mysqli_real_escape_string($conn, $login);
        $q = "SELECT id, login, pass FROM users WHERE login = '$esc'";
        $res = mysqli_query($conn, $q);
        $user = mysqli_fetch_array($res);
        if ($user && password_verify($pass, $user['pass'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $user['login'];
            header('Location: main.php');
            exit;
        } else {
            $error = 'Неверный логин или пароль';
        }
    }
}
$userLogin = getUserLogin();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="../components/styles/base.css">
    <link rel="stylesheet" href="../components/styles/forms.css">
    <script src="../components/header.js" defer></script>
    <script src="../components/footer.js" defer></script>
</head>
<body class="login-page" data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>" data-user-login="<?php echo safe($userLogin); ?>">
    <my-header title="вход" link-text="главное окно" link-url="main.php"></my-header>
    <main>
        <div class="form-wrapper">
            <div class="form-header"><p>Вход</p></div>
            <div class="form-container">
                <?php if ($registered == '1'): ?>
                    <div class="success-message">Регистрация успешна! Теперь вы можете войти.</div>
                <?php endif; ?>
                <?php if ($logout == '1'): ?>
                    <div class="already-logged-message">Вы вышли из аккаунта</div>
                <?php endif; ?>
                <?php if ($isLoggedIn): ?>
                    <div class="already-logged-message">Вы уже вошли как <strong><?php echo safe($userLogin); ?></strong></div>
                    <div class="logout-link"><a href="../logout.php">Хотите выйти?</a></div>
                <?php else: ?>
                    <?php if ($error): ?><div class="error-message"><?php echo safe($error); ?></div><?php endif; ?>
                    <form method="POST">
                        <div class="form-group">
                            <label>Логин</label>
                            <input type="text" name="login" placeholder="Введите логин" value="<?php echo safe($_POST['login'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Пароль</label>
                            <input type="password" name="password" placeholder="Введите пароль" required>
                        </div>
                        <button type="submit" class="submit-btn">Войти</button>
                    </form>
                    <div class="form-link"><a href="register.php">Нет аккаунта? Зарегистрироваться</a></div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <my-footer></my-footer>
</body>
</html>