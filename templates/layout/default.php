<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

// $cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="https://img.icons8.com/ios-filled/50/FA5252/medical-id.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://img.icons8.com/ios-filled/50/FA5252/medical-id.png">
    <link rel="shortcut icon" href="https://img.icons8.com/ios-filled/50/FA5252/medical-id.png">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/') ?>"><span>Medical Clinic </span>Management System</a>
        </div>
        <button class="menu-toggle">
            <span class="hamburger"></span>
        </button>
        <div class="top-nav-links">
            <?php if (isset($user) && $user) : ?>
                <span class="welcome-text">Hello, <?= ucfirst(h($user->userName)) ?> (<?= ucfirst(h($user->role)) ?>)</span>
                <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'nav-link']) ?>
            <?php else : ?>
                <?= $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']) ?>
                <?= $this->Html->link('Signup', ['controller' => 'Users', 'action' => 'signup'], ['class' => 'nav-link']) ?>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="column">
                    <h5>Quick Links</h5>
                    <?= $this->Html->link('Home', ['controller' => 'home', 'action' => 'index']) ?>
                    <?= $this->Html->link('Appointments', ['controller' => 'Appointments', 'action' => 'index']) ?>
                    <?= $this->Html->link('Patients', ['controller' => 'Patients', 'action' => 'index']) ?>
                    <?= $this->Html->link('Doctors', ['controller' => 'Doctors', 'action' => 'index']) ?>
                </div>
                <div class="column">
                    <h5>Resources</h5>
                    <?= $this->Html->link('Privacy Policy', ['controller' => 'Pages', 'action' => 'privacyPolicy']) ?>
                    <?= $this->Html->link('Terms of Service', ['controller' => 'Pages', 'action' => 'terms']) ?>
                </div>
                <div class="column">
                    <h5>About MCMS</h5>
                    <p>Medical Clinic Management System streamlines healthcare operations, enhancing patient care and administrative efficiency.</p>
                </div>
            </div>
            <div class="row footer-bottom">
                <div class="column">
                    <p>&copy; <?= date('Y') ?> Medical Clinic Management System</p>
                </div>
            </div>
        </div>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.top-nav-links');
            
            menuToggle.addEventListener('click', function() {
                menuToggle.classList.toggle('active');
                navLinks.classList.toggle('active');
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.closest('.top-nav')) {
                    menuToggle.classList.remove('active');
                    navLinks.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>
