<?php
/**
 * Plugin Name: Activate.Reviews
 * Description: Activate.Reviews' WordPress Plugin
 * Version: 0.0.0
 * GitHub Plugin URI: https://github.com/GetMSM/ActivateReviews_WordPress_Plugin
*/
//	For change logs read the Git commit log.
/*	For documentation on any WordPress function,
	append function name to this URL:
	HTTPS://Developer.WordPress.Org/reference/functions/
*/
error_reporting(E_ALL); ini_set('display_errors', 1);
define(
	"Plugin_Name_Display",
	"Activate.Reviews"
);
define(
	"Plugin_Name_Safe",
	"WordPress_Plugin_ActivateReviews"
);
define(
	"Plugin_URL",
	plugins_url()."/ActivateReviews_WordPress_Plugin"
);
define(
	"Plugin_Style_URL",
	Plugin_URL."/Include/Style2.CSS"
);
define(
	"Plugin_Script_URL",
	Plugin_URL."/Include/Script2.JS"
);
define(
	"Plugin_Image_URL",
	Plugin_URL."/Share"
);
define(
	"Plugin_Version",
	"0.0.0"
);
define(
	"RID",
	"0"
);
//	Administration Menu
function
Plugin_Configuration
(  )
{	include_once plugin_dir_path(__FILE__).'/Include/Configuration.php';
}
function
Plugin_Administration
(  )
{	add_menu_page(
		Plugin_Name_Display,
		Plugin_Name_Display,
		"manage_options",
		Plugin_Name_Safe,
		"Plugin_Configuration",
		"none"//,
		/*78*/
	);
}
add_action(
	"admin_menu",
	"Plugin_Administration"
);
function
Plugin_Init
(  )
{	wp_enqueue_style(
		Plugin_Name_Safe."_plugin_style",
		Plugin_Style_URL,
		"",
		Plugin_Version
	);
	wp_enqueue_script(
		Plugin_Name_Safe."_plugin_script",
		Plugin_Script_URL,
		"",
		Plugin_Version,
		true
	);
}
add_action(
	"init",
	"Plugin_Init"
);
function
Plugin_Widget
(  )
{
	global $wpdb;
    $Table = Plugin_Name_Safe;
    $Query = $wpdb->prepare("SELECT * FROM $Table", NULL);
    $Results = $wpdb->get_results($Query);
        
	$Name = $Results[0]->Name;
	$Rating = $Results[0]->Rating;
	$ColorA = $Results[0]->ColorA;
	$ColorB = $Results[0]->ColorB;
		
	if ( !empty($Name) ) {
		
		?>
		<div class="ureviews-widget">
			<div class="reviewstream-rating">
				<a href="#/" class="ureview-toggle-button" style="background-color: <?php echo $ColorA; ?>;">
					<span style="background-color: <?php echo $ColorB; ?>;"></span>
				</a>
			</div>
			<div class="ureview-popup">
				<?php if( $Rating == 'yes' ){ ?>
				<div class="reviewmgr-header no-rating">
					<a href="https://activate.reviews" target="_blank">
						<img src="//activate.reviews/wp-content/uploads/2018/11/activate-reviews-RL-icon.png" style="width:80%;border:none;">
					</a>
				</div>
				<?php } else { ?>
				<div class="reviewmgr-header aggregrate-rating-header">
					<div	class="reviewmgr-stream"
						data-show-aggregate-rating="true"
						data-show-reviews="false"
						data-include-empty="false"
						data-review-limit="5"
						data-url="<?php echo $Name ?>/"
					></div>
				</div>
				<?php } ?>
				<div	class="reviewmgr-stream reviewmgr-content"
					data-review-limit="10"
					data-include-empty="false"
					data-url="<?php echo $Name ?>/"
				></div>
				<div style="left:10%;width:40%;height:40px;text-align:center;line-height:40px;" class="ureview-close-btn">
					<a class="reviewmgr-button" href="<?php echo $Name ?>/" style="font-weight:800;color:#FFFFFF;" data-replace="false">
						WRITE A REVIEW
					</a>
				</div>
				<div style="right:10%;width:30%;height:40px;text-align:center;line-height:40px;" class="ureview-close-btn">
					<a href="#/" style="font-weight:800;color:#FFFFFF;">
						CLOSE
					</a>
				</div>

			</div>
		</div>
		<?php
	}
}
add_action(
	"wp_footer",
	"Plugin_Widget"
);
function
Plugin_Activate
(  )
{	
	$Query =
		'CREATE TABLE IF NOT EXISTS `'.Plugin_Name_Safe.'` (
		`Id` int(11) NOT NULL AUTO_INCREMENT,
		`Name` varchar(150) DEFAULT NULL,
		`Rating` varchar(150) DEFAULT NULL,
		`ColorA` varchar(150) DEFAULT NULL,
		`ColorB` varchar(150) DEFAULT NULL,
		`Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (`Id`)
		) ENGINE=MyISAM DEFAULT CHARSET=latin1'
	; 	
	require_once(
		ABSPATH."wp-admin/includes/upgrade.php"
	);
	dbDelta($Query);

	$Table = Plugin_Name_Safe;
	$Data = array(
		'Id' => 1,
		'Name'      => NULL,
		'Rating'    => NULL,
		'ColorA'    => '#666666',
		'ColorB'    => '#CCCCCC'
	);
	$Format = array(
		'%d',
		'%s',
		'%s',
		'%s',
		'%s'
	);
	global $wpdb;
	$Replace = $wpdb->replace( $Table, $Data, $Format );
}
register_activation_hook(
	__FILE__,
	'Plugin_Activate'
);

function
Plugin_Delete
(  )
{	global $wpdb;
	$wpdb->query("Drop table If Exists ".Plugin_Name_Safe);
}
register_uninstall_hook(
	__FILE__,
	"Plugin_Delete"
);
/*function tl_save_error() {
	update_option( 'plugin_error',  ob_get_contents() );	
}
add_action( 'activated_plugin', 'tl_save_error' );
echo get_option( 'plugin_error' );*/