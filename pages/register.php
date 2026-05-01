<?php
session_start();
require_once '../components/connect.php';

if (isLoggedIn()) {
    header('Location: main.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $pass = $_POST['password'] ?? '';
    $pass2 = $_POST['password_confirm'] ?? '';

    if (empty($login)) $error = 'Введите логин';
    elseif (strlen($login) < 3) $error = 'Логин не менее 3 символов';
    elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $login)) $error = 'Только латиница, цифры и _';
    elseif (empty($pass)) $error = 'Введите пароль';
    elseif (strlen($pass) < 4) $error = 'Пароль не менее 4 символов';
    elseif ($pass !== $pass2) $error = 'Пароли не совпадают';
    else {
        $esc = mysqli_real_escape_string($conn, $login);
        $check = mysqli_query($conn, "SELECT id FROM users WHERE login = '$esc'");
        if (mysqli_num_rows($check) > 0) {
            $error = 'Пользователь с таким логином уже существует';
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO users (login, pass) VALUES ('$esc', '$hash')");
            header('Location: login.php?registered=1');
            exit;
        }
    }
}
$isLoggedIn = isLoggedIn();
$userLogin = getUserLogin();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../components/style.css">
    <script src="../components/header.js" defer></script>
    <script src="../components/footer.js" defer></script>
</head>
<body class="register-page" data-logged-in="<?php echo $isLoggedIn ? 'true' : 'false'; ?>" data-user-login="<?php echo safe($userLogin); ?>">
    <my-header title="регистрация" link-text="главное окно" link-url="main.php"></my-header>

    <main>
        <div class="form-wrapper">
            <div class="form-header"><p>Регистрация</p></div>
            <div class="form-container">
                <?php if ($error): ?><div class="error-message"><?php echo safe($error); ?></div><?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Логин</label>
                        <input type="text" name="login" placeholder="Придумайте логин" value="<?php echo safe($_POST['login'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="password" name="password" placeholder="Придумайте пароль" required>
                    </div>
                    <div class="form-group">
                        <label>Подтверждение пароля</label>
                        <input type="password" name="password_confirm" placeholder="Повторите пароль" required>
                    </div>
                    <button type="submit" class="submit-btn">Зарегистрироваться</button>
                </form>
                <div class="form-link"><a href="login.php">Уже есть аккаунт? Войти</a></div>
            </div>
        </div>
    </main>

    <my-footer></my-footer>
</body>
</html>