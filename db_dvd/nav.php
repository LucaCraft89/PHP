<?php
require_once("../lib/head.html");
if (!defined('BASE_PATH')) {
    require_once("config.php");
}
?>
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>/assets/css/style.css">
<div class="banner">
    <div class="container">
        <div class="banner-content">
            <div class="banner-left">
                <img src="<?php echo BASE_PATH; ?>/assets/icon.jpeg" alt="Logo" class="banner-logo">
                <h1 class="banner-title">By ETTORE & LUCA</h1>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    <?php
                    if (isset($_SESSION['Nome'])) {
                        echo strtoupper(substr($_SESSION['Nome'], 0, 1));
                    }
                    ?>
                </div>
                <div class="user-details">
                    <p class="user-name">
                        <?php
                        if (isset($_SESSION['Nome']) && isset($_SESSION['Cognome'])) {
                            echo htmlspecialchars($_SESSION['Nome'] . ' ' . $_SESSION['Cognome']);
                        }
                        ?>
                    </p>
                    <p class="user-role">Cliente</p>
                </div>
                <a href="<?php echo BASE_PATH; ?>/auth/logout.php" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Esci
                </a>
            </div>
        </div>
    </div>
</div>