<footer>
    <nav>
        <?php
        wp_nav_menu([
            'theme_location' => 'footer_menu',
            'container'      => false,
        ]);
        ?>
    </nav>
</footer>

<?php wp_footer(); ?>
</body>
</html>
