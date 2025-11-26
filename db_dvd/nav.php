<?php
require_once("../lib/head.html");
if (!defined('BASE_PATH')) {
    require_once("config.php");
}
?>
<style>
    .banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem 0;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .banner-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
    }

    .banner-left {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .banner-logo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .banner-title {
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        margin: 0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: white;
        background: rgba(255, 255, 255, 0.2);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        backdrop-filter: blur(10px);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .user-name {
        font-weight: bold;
        font-size: 1rem;
        margin: 0;
    }

    .user-role {
        font-size: 0.85rem;
        opacity: 0.9;
        margin: 0;
    }

    .btn-logout {
        background: rgba(255, 255, 255, 0.3);
        border: 2px solid white;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        text-decoration: none;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-logout:hover {
        background: white;
        color: #667eea;
        transform: translateY(-2px);
    }
</style>
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
                    // Mostra l'iniziale del nome
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