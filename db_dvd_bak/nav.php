<?php require_once("../lib/head.html") ?>
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
        justify-content: center;
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
</style>
<div class="banner">
    <div class="container">
        <div class="banner-content">
            <img src="./assets/icon.jpeg" alt="Logo" class="banner-logo">
            <h1 class="banner-title">By ETTORE & LUCA</h1>
        </div>
    </div>
</div>