<div class="wrap">
    <h1>Alegra plugin</h1>
    <php settings_errors(); ?>
    <form method="post" action="options.php" >
        <?php
            settings_fields( 'alegra_options_group' );
            do_settings_sections( 'alegra' );
            submit_button();
        ?>
    </form>
</div>