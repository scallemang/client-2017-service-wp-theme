<div class="wrap">
    <h2>Teledent Settings</h2>
    <form method="post" action="options.php">
        <?php @settings_fields('teledent-group'); ?>
        <?php @do_settings_fields('teledent-group'); ?>

        <?php do_settings_sections('teledent'); ?>

        <?php @submit_button(); ?>
    </form>
</div>