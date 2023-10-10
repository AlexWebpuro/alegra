<div class="wrap">
    <h1>Alegra plugin</h1>
    <php settings_errors(); ?>
    <form method="post" action="options.php" data-url=<?php echo admin_url( 'admin-ajax.php'); ?> >
        <?php
            settings_fields( 'alegra_options_group' );
            do_settings_sections( 'alegra' );
            submit_button();
        ?>
    </form>
    <div class="alegra__notice notice__success hidden" >
        <span>
            Your connection was successfully!
        </span>
    </div>
    <div class="alegra__notice notice__failed hidden" >
        <span>
            Your connection was failed!
        </span>
    </div>
    <div class="alegra__notice notice__api hidden" >
        <span>
            Verifing your credentials, please wait!
        </span>
    </div>
    <div class="alegra__notice notice__api notice__api--success hidden" >
        <span>
            Your credentials are right, we are connecting with Alegra!
        </span>
    </div>
    <div class="alegra__notice notice__api notice__api--failed hidden" >
        <span>
            Your credentials are incorrect, please verify <a href="https://mi.alegra.com/integrations/api/">here</a>!
        </span>
        <span>Remember you must be loggged in <strong>alegra.com</strong> and have a available plan.</span>
    </div>
</div>