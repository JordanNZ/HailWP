<?php
/**
 * Template Name: Hail Two Column
 *
 * @package WordPress
 * @subpackage Yootheme_Child
 * @since YooTheme 1.0
 */

 get_header();

$module1 = get_post_meta( get_the_ID(), 'hail_info_module_1', TRUE );
$module2 = get_post_meta( get_the_ID(), 'hail_info_module_2', TRUE );

?>

<div class="uk-section-default" uk-scrollspy="{target:[uk-scrollspy-class],cls:uk-animation-fade,delay:false}">
<div class="uk-background-cover uk-flex uk-flex-center uk-flex-middle uk-light" style="height: 300px; background-image: url('<?php echo do_shortcode('[hail_hero aid=' . $module1 .']'); ?>');">





                <div class="uk-width-1-1">
    
                        <div class="uk-container">
        
            

<div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid="">

<div class="uk-width-1-1@m uk-first-column">



    
    
        


<h1 class="uk-margin-remove-top uk-text-center uk-heading-primary uk-scrollspy-inview uk-animation-fade" uk-scrollspy-class="" style="">
<?php echo do_shortcode('[hail_title aid=' . $module1 .']'); ?></h1>

<div class="uk-margin uk-width-xlarge uk-margin-auto uk-text-center uk-scrollspy-inview uk-animation-fade" uk-scrollspy-class="" style="">
	<?php //echo do_shortcode('[hail_lead aid=' . $module1 .']'); ?>
</div>

    


</div>
</div>


                        </div>
        
                </div>
    

</div>

</div>

<div class="uk-section-default uk-section" uk-scrollspy="{target:[uk-scrollspy-class],cls:uk-animation-slide-top-small,delay:300}">

    
        
        
        
            
<div class="uk-container">



<div class="uk-margin-large uk-grid" uk-grid="">

<div class="uk-width-expand@m uk-first-column">





<h3 class="uk-h3 uk-scrollspy-inview uk-animation-slide-top-small" uk-scrollspy-class="" style="">
<?php echo do_shortcode('[hail_title aid=' . $module2 .']'); ?></h3>


<?php echo do_shortcode('[hail_page aid=' . $module2 .']'); ?>



</div>

<div class="uk-width-expand@m">




<h3 class="uk-h3 uk-scrollspy-inview uk-animation-slide-top-small" uk-scrollspy-class="" style="">
<?php echo do_shortcode('[hail_title aid=' . $module1 .']'); ?></h3>

<div class="uk-margin-small uk-scrollspy-inview uk-animation-slide-top-small" uk-scrollspy-class="" style="">
<?php echo do_shortcode('[hail_page aid=' . $module1 .']'); ?> 
</div>






</div>
</div>


</div>




</div>



<?php get_footer(); ?>
