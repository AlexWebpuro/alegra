<?php

?>
    <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
        <?php
        // output security fields for the registered setting "wporg_options"
        settings_fields( 'alegra_settings' );
        // output setting sections and their fields
        // (sections are registered for "wporg", each field is registered to a specific section)
        do_settings_sections( 'alegra_settings' );
        // output save settings button
        submit_button( __( 'Save Settings', ALG_DOMAIN ) );
        ?>
      </form>
    </div>