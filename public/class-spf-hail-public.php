<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://spfwebsites.co.nz/about-us
 * @since      1.0.0
 *
 * @package    Spf_Hail
 * @subpackage Spf_Hail/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Spf_Hail
 * @subpackage Spf_Hail/public
 * @author     Jordan Diamond <jordan@spfwebsites.co.nz>
 */
class Spf_Hail_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Spf_Hail_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Spf_Hail_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/spf-hail-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Spf_Hail_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Spf_Hail_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/spf-hail-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function hail_content( $atts ) {
		$atts = shortcode_atts(
			array(
				'aid' => '',
				'display_hero' => 'false',
				'attachment' => 'btn',
				'nogallery' => 'true',
			),
			$atts,
			'hail_page'
		);

		// get an instance of the Hail Helper which allows you to request any additional data from the API
		$hail = Hail_Helper::getInstance();
		
		// Grab the article ID
		$article_id = $atts['aid'];
		$article = $hail->getArticle($article_id);
		$jsn = isset( $_GET[ 'jsn' ] ) ? sanitize_text_field( $_GET['jsn'] ) : false; 
			if( '1' === $jsn ) {
				echo '<pre>'; print_r($article); echo '</pre>';	
			}
			
		// Return the content from the Articles with the article id
		$hail_page .= "";
			if($atts['display_hero'] == 'true'){
				if($article['hero_video']['service'] == "youtube") {
					$hail_page .= '<iframe width="100%" height="600px" src="https://www.youtube.com/embed/' .$article['hero_video']['service_data']. '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
				} elseif($article['hero_video']['service'] == "vimeo") {
					$hail_page .= '<iframe src="https://player.vimeo.com/video/' .$article['hero_video']['service_data']. '" width="100%" height="600px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
				}
				$hail_page .= '<div style="background-image: url(' .$article['hero_image']['file_1000_url']. ');" class="uk-background-norepeat uk-background-cover uk-background-center-center uk-background-fixed uk-section uk-section-large"></div>';
		}
			//$hail_page .= $article['title']. '<br>';
			$hail_page .= $article['body']. '<br>';
		
			// Image Gallery
			// Only load this if there is images within the article
			
			if($atts['nogallery'] == 'true') {
				$images = $hail->getArticleImages($article_id, true);
				if($images > 1 ) {
					$hail_page .= '<div uk-lightbox>';
					foreach ($images as $image) {
							$hail_page .= '<a href="' .$image['file_original_url']. '" data-type="image"><img src="' .$image['file_150_square_url']. '" class="uk-margin-small uk-margin-right" /></a>';
					}
					$hail_page .= '</div>';
				}
			}	
		
			
			// Video Gallery
			$hail_page .= '<div uk-lightbox>';
			for($i=0; $i < count($article['short_video_gallery']); $i++) {
				if($article['short_video_gallery'][$i]['service'] == "youtube") { 
					$hail_page .= '<a href="//www.youtube.com/watch?v=' .$article['short_video_gallery'][$i]['service_data']. '"><img src="' .$article['short_video_gallery'][$i]['preview']['file_150_square_url']. '" class="uk-margin-medium" /></a>';
				}elseif($article['short_video_gallery'][$i]['service'] == "vimeo") {
					$hail_page .= '<a href="//vimeo.com/' .$article['short_video_gallery'][$i]['service_data']. '"><img src="' .$article['short_video_gallery'][$i]['preview']['file_150_square_url']. '" class="uk-margin-small" /></a>';
				}
			}	
			$hail_page .= '</div>';
		
			// Attachments
			
			for($i=0; $i < count($article['attachments']); $i++) {
					if($atts['attachment'] != 'btn') {
						$hail_page .= '<a href="' .$article['attachments'][$i]['url'].'">  ' .$article['attachments'][$i]['name']. '  </a>';
					} else {
						$hail_page .= '<a class="el-content uk-button uk-button-secondary uk-button-large uk-margin uk-margin-right" href="' .$article['attachments'][$i]['url'].'">  ' .$article['attachments'][$i]['name']. '  </a>';
					}
					
		
			}
		
				
		
			// Return the values
		
			return $hail_page;
		
		}
		



		public function hail_heroimg( $atts1 ) {
			// Attributes
			$atts1 = shortcode_atts(
				array(
					'aid' => 'i9z8GIz',
					'width' => ''
				),
				$atts1,
				'hail_hero'
			);

			// get an instance of the Hail Helper which allows you to request any additional data from the API
			$hail = Hail_Helper::getInstance();
			
			// Grab the private tag ID
			$article_id = $atts1['aid'];
			$article = $hail->getArticle($article_id, false);
				
			// Return Featured Images/Video from the article 
			$hail_hero .= "";
				if(empty($atts1['width'])) {
					$hail_hero .= $article['hero_image']['file_1000_url'];
				} elseif(!empty($atts1['width'])) {
					$hail_hero .= '<div class="uk-margin uk-scrollspy-inview uk-animation-slide-bottom-medium" uk-scrollspy-class>';
			        $hail_hero .= '<img src="'. $article['hero_image']['file_1000_url'] .'" sizes="(min-width:'. $atts1['width'] .'px) '. $atts1['width'] .'px, 100vw" width="'. $atts1['width'] .'px" class="el-image uk-box-shadow-small" alt="">
			</div>';
			    
				} 
				// Return the values
				return $hail_hero;
			
			}
			

/**
 * Hail Hero Image
 */


		public function hail_titlem( $atts2 ) {
			// Attributes
			$atts2 = shortcode_atts(
				array(
					'aid' => 'i9z8GIz',
					
				),
				$atts2,
				'hail_title'
			);
		
			// get an instance of the Hail Helper which allows you to request any additional data from the API
			$hail = Hail_Helper::getInstance();
			
			// Grab the private tag ID
			$article_id = $atts2['aid'];
			$article = $hail->getArticle($article_id, false);
				
			// Return Featured Images/Video from the article 
			$hail_title .= "";
					$hail_title .= $article['title'];
			 
				// Return the values
				return $hail_title;
			
			}
			
			

		public function hail_leadm( $atts3 ) {
			// Attributes
			$atts3 = shortcode_atts(
				array(
					'aid' => 'i9z8GIz',
					
				),
				$atts3,
				'hail_lead'
			);

			// get an instance of the Hail Helper which allows you to request any additional data from the API
			$hail = Hail_Helper::getInstance();
			
			// Grab the private tag ID
			$article_id = $atts3['aid'];
			$article = $hail->getArticle($article_id, false);
				
			// Return Featured Images/Video from the article 
			$hail_lead .= "";
			$hail_lead .= $article['lead'];
			 
			// Return the values
			return $hail_lead;
			
			}
	
		public function hail_quick_links( $atts4 ) {
			// Attributes
			$atts4 = shortcode_atts(
				array(
					'aid' => 'i9z8GIz',
					
				),
				$atts4,
				'hail_links'
			);

			// get an instance of the Hail Helper which allows you to request any additional data from the API
			$hail = Hail_Helper::getInstance();
			
			// Grab the private tag ID
			$article_id = $atts4['aid'];
			$article = $hail->getArticle($article_id, false);
				
			// Return Featured Images/Video from the article 
			$hail_links .= "";
			$hail_links .= '<ul>';
				for($i=0; $i < count($article['quick_links']); $i++) {
					$hail_links .= '<li><a href="'. $article['quick_links'][$i]['name']['association']['entity'] . '">' . $article['quick_links'][$i]['name'] . '</a></li>';
				} 

			$hail_links .= '</ul>';
				// Return the values
				return $hail_links;
			
			}
			
			
public function hail_gallerym( $atts5 ) {
			// Attributes
			$atts5 = shortcode_atts(
				array(
					'aid' => 'i9z8GIz',
					
				),
				$atts5,
				'hail_gallery'
			);

			// get an instance of the Hail Helper which allows you to request any additional data from the API
			$hail = Hail_Helper::getInstance();
			
			// Grab the private tag ID
			$article_id = $atts5['aid'];
			$article = $hail->getArticle($article_id, false);
				
			// Return Featured Images/Video from the article 
			$hail_gallery .= "";
			
			
// Image Gallery
			// Only load this if there is images within the article
			
				$images = $hail->getArticleImages($article_id, true);
				if($images > 1 ) {
					//$hail_page .= '<div uk-lightbox>';
					foreach ($images as $image) {
							$hail_gallery .= '<img src="' .$image['file_original_url']. '" height="150px" width="150px" class="uk-margin-small uk-margin-right" />';
					}
					//$hail_gallery .= '</div>';
				}
				
			
		
			// Return the values
				return $hail_gallery;
			
			}

}
