<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://spfwebsites.co.nz/about-us
 * @since      1.0.0
 *
 * @package    Spf_Hail
 * @subpackage Spf_Hail/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Spf_Hail
 * @subpackage Spf_Hail/admin
 * @author     Jordan Diamond <jordan@spfwebsites.co.nz>
 */
class Spf_Hail_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/spf-hail-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/spf-hail-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'spf_hail';
	

	

	public function Spf_Login() {
		echo '<link rel="stylesheet" type="text/css" href="' . plugin_dir_url( __FILE__ ) . 'css/login-styles.css" />';
	}
	
	public function my_login_logo_url() {
		return get_bloginfo( '/' );
	}
	

	public function my_login_logo_url_title() {
		return 'SPF Websites';
	}
	
	
	function spf_copyright_footer() {
     		echo '<div id="spf-footer">&copy; <a href="http://spf.nz" target="_blank">SPF Websites</a> Powered by <a href="https://wordpress.org"target="_blank">Wordpress</a> & <a href="https://get.hail.to" target="_blank">Hail</a></div>';
	}


	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'SPF + Hail Settings', 'spf-hail' ),
			__( 'SPF + Hail', 'spf-hail' ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'display_options_page' )
		);
	}
	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/spf-hail-admin-display.php';
	}



	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function register_setting() {
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'spf-hail' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);
		add_settings_field(
			$this->option_name . '_orginization',
			__( 'Choose an Orginization', 'spf-hail' ),
			array( $this, $this->option_name . '_orginization_id' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_orginization_id' )
		);
		
		register_setting( $this->plugin_name, $this->option_name . '_orginization_id');
	}
	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function spf_hail_general_cb() {
		echo '<p>' . __( 'Pick an orginization to pull the Hail content from.', 'spf-hail' ) . '</p>';
	}

	/**
	 * Render the treshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function spf_hail_orginization_id() {
		$org = get_option( $this->option_name . '_orginization_id' );
		$hail = Hail_Helper::getInstance();
		$listorg = $hail->getOrganisations();
	?>

	<select name="spf_hail_orginization_id" id="spf_hail_orginization_id">
		<?php
		foreach ($listorg as $listorgs) {
		?>
			<option value="<?php echo $listorgs['id']; ?>" <?php if(get_option( $this->option_name . '_orginization_id' ) == $listorgs['id']) { ?> selected <?php } ?>> <?php echo $listorgs['name']; ?></option>

		<?php
		}
	
	}


	function spf_dashboard_widget() {

		// Bail if not viewing the main dashboard page
		if ( get_current_screen()->base !== 'dashboard' ) {
			return;
		}
	
		?>
	
		<div id="custom-id" class="welcome-panel" style="display: none;">
			<div class="welcome-panel-content">
				<h2>Welcome to Your Hail + Wordpress Site!</h2>
				<p class="about-description">Find a few helpful links the guys at <a href="http://spf.nz" target="_blank">SPF</a> have assembled for you!</p>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h3>Get Started with Hail</h3>
						<a class="button button-primary button-hero load-customize hide-if-no-customize" href="https://hail.to/auth?type=existing">Login to Hail</a>
						<a class="button button-primary button-hero hide-if-customize" href="https://hail.to/auth?type=existing">Login to Hail</a>
						
					</div>
					<div class="welcome-panel-column">
						<h3>Quick Startup Guides</h3>
						<ul>
							<li><a href="https://hail.to/hail-create-curate-communicate/publication/0JOp2gn" class="welcome-icon welcome-edit-page">The Hail Dashboard</a></li>
							<li><a href="https://hail.to/hail-create-curate-communicate/publication/0JOp2gn/article/cK6C4uj" class="welcome-icon welcome-write-blog">Creating your first article</a></li>
							<li><a href="https://hail.to/hail-create-curate-communicate/publication/0JOp2gn/article/sEYZVLb" class="welcome-icon welcome-add-page">Tagging</a></li>
							<li><a href="/" class="welcome-icon welcome-view-site">View your site</a></li>
						</ul>
					</div>
					<div class="welcome-panel-column welcome-panel-last">
						<h3>Even More Links!</h3>
						<ul>
							<li><a href="https://hail.to/hail-create-curate-communicate/publication/0JOp2gn/article/vcC6mhs" class="welcome-icon welcome-write-blog">Publishing & Connections</a></li>
							<li><a href="https://hail.to/hail-create-curate-communicate/publication/0JOp2gn/article/anFS9na" class="welcome-icon welcome-learn-more">Creating your first newsletter publication</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<script>
			jQuery(document).ready(function($) {
				$('#welcome-panel').after($('#custom-id').show());
			});
		</script>
	
	<?php }


}
