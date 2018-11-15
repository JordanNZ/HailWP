<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://spfwebsites.co.nz/about-us
 * @since      1.0.0
 *
 * @package    Spf_Hail
 * @subpackage Spf_Hail/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <form action="options.php" method="post">
        <?php
            settings_fields( $this->plugin_name );
            do_settings_sections( $this->plugin_name );
            submit_button();
        ?>
    </form>

    <?php if(get_option('spf_hail_orginization_id') == "") { ?>
        <p>Pick an Orginization to view a list of articles avaliable to use</p>
   <?php } else { 
			$spf = Hail_Helper::getInstance();
            $articles = $spf->getAllArticles();
            
            foreach($articles as $article) {
	?>
        <strong><?php echo $article['title'] ?></strong>: <?php echo $article['id']?><br>
            <?php 
        } 
    }
?>


</div>
