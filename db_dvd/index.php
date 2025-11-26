<?php
require_once('config.php');
session_start();

// If already logged in, redirect to menu
if (isset($_SESSION['SessionID'])) {
    header("Location: " . BASE_PATH . "/menu.php");
    exit();
}
require_once('../lib/head.html');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        max-width: 450px;
        width: 100%;
    }

    .login-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        text-align: center;
        color: white;
    }

    .login-logo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid white;
        margin-bottom: 1rem;
    }

    .login-body {
        padding: 2rem;
    }

    .btn-login {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.75rem;
        font-weight: bold;
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
</style>
</head>

<body>
    <div class="login-card">
        <div class="login-header">
            <img src="<?php echo BASE_PATH; ?>/assets/icon.jpeg" alt="Logo" class="login-logo">
            <h2 class="mb-0">DVD Rental System</h2>
            <p class="mb-0">By ETTORE & LUCA</p>
        </div>
        <div class="login-body">
            <h4 class="text-center mb-4">Accedi al tuo account</h4>
            <?php
            if (isset($_SESSION['login_error'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill"></i> ' . htmlspecialchars($_SESSION['login_error']) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
                unset($_SESSION['login_error']);
            }
            if (isset($_SESSION['registration_success'])) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i> ' . htmlspecialchars($_SESSION['registration_success']) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>';
                unset($_SESSION['registration_success']);
            }
            ?>
            <form action="<?php echo BASE_PATH; ?>/auth/login.php" method="post">
                <div class="mb-3">
                    <label for="phone" class="form-label">
                        <i class="bi bi-telephone-fill"></i> Numero di telefono
                    </label>
                    <input type="number" class="form-control" id="phone" name="phone"
                        placeholder="Inserisci il numero di telefono" required>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">
                        <i class="bi bi-lock-fill"></i> Password
                    </label>
                    <input type="password" class="form-control" id="pass" name="pass"
                        placeholder="Inserisci la password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-login w-100">
                    <i class="bi bi-box-arrow-in-right"></i> Accedi
                </button>
            </form>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-2">Non hai un account?</p>
                <a href="<?php echo BASE_PATH; ?>/auth/register_form.php" class="btn btn-outline-secondary">
                    <i class="bi bi-person-plus-fill"></i> Registrati
                </a>
            </div>
        </div>
    </div>
</body>

</html>