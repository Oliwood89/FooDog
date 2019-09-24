<?php
/**
 * Exif Caption
 *
 * @package    Exif Caption
 * @subpackage ExifCaptionAdmin Main & Management screen
/*
	Copyright (c) 2015- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; version 2 of the License.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

$exifcaptionadmin = new ExifCaptionAdmin();

/** ==================================================
 * Management screen
 */
class ExifCaptionAdmin {

	/** ==================================================
	 * Construct
	 *
	 * @since 2.07
	 */
	public function __construct() {

		if ( ! class_exists( 'ExifCaption' ) ) {
			require_once( dirname( __FILE__ ) . '/class-exifcaption.php' );
		}

		add_filter( 'plugin_action_links', array( $this, 'settings_link' ), 10, 2 );
		add_action( 'admin_menu', array( $this, 'add_pages' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_custom_wp_admin_style' ) );
		add_filter( 'manage_media_columns', array( $this, 'muc_column' ) );
		add_action( 'manage_media_custom_column', array( $this, 'muc_value' ), 10, 2 );
		add_action( 'admin_footer', array( $this, 'custom_bulk_admin_footer' ) );
		add_action( 'load-upload.php', array( $this, 'custom_bulk_action' ) );
		add_action( 'admin_notices', array( $this, 'custom_bulk_admin_notices' ) );

	}

	/** ==================================================
	 * Add a "Settings" link to the plugins page
	 *
	 * @param  array  $links  links array.
	 * @param  string $file   file.
	 * @return array  $links  links array.
	 * @since 1.00
	 */
	public function settings_link( $links, $file ) {
		static $this_plugin;
		if ( empty( $this_plugin ) ) {
			$this_plugin = 'exif-caption/exifcaption.php';
		}
		if ( $file == $this_plugin ) {
			$links[] = '<a href="' . admin_url( 'upload.php?page=exifcaption-settings' ) . '">' . __( 'Settings' ) . '</a>';
		}
			return $links;
	}

	/** ==================================================
	 * Settings page
	 *
	 * @since 1.0
	 */
	public function add_pages() {
		add_media_page(
			'Exif Caption ' . __( 'Settings' ),
			'Exif Caption ' . __( 'Settings' ),
			'upload_files',
			'exifcaption-settings',
			array( $this, 'settings_page' )
		);
	}

	/** ==================================================
	 * Add Css and Script
	 *
	 * @since 1.0
	 */
	public function load_custom_wp_admin_style() {
		if ( $this->is_my_plugin_screen() ) {
			wp_enqueue_style( 'jquery-responsiveTabs', plugin_dir_url( __DIR__ ) . 'css/responsive-tabs.css', array(), '1.4.0' );
			wp_enqueue_style( 'jquery-responsiveTabs-style', plugin_dir_url( __DIR__ ) . 'css/style.css', array(), '1.4.0' );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-responsiveTabs', plugin_dir_url( __DIR__ ) . 'js/jquery.responsiveTabs.min.js', array(), '1.4.0', false );
			wp_enqueue_script( 'exifcaption-js', plugin_dir_url( __DIR__ ) . 'js/jquery.exifcaption.js', array( 'jquery' ), '1.00', false );
		}
	}

	/** ==================================================
	 * For only admin style
	 *
	 * @since 1.0
	 */
	public function is_my_plugin_screen() {
		$screen = get_current_screen();
		if ( is_object( $screen ) && 'media_page_exifcaption-settings' == $screen->id ) {
			return true;
		} else {
			return false;
		}
	}

	/** ==================================================
	 * Sub Menu
	 */
	public function settings_page() {

		if ( ! current_user_can( 'upload_files' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
		}

		$this->options_updated();

		$exifcaption_settings = get_option( $this->wp_options_name() );
		$scriptname = admin_url( 'upload.php?page=exifcaption-settings' );

		?>
		<div class="wrap">

		<h2>Exif Caption</h2>

		<div id="exifcaption-admin-tabs">
			  <ul>
				<li><a href="#exifcaption-admin-tabs-1"><?php esc_html_e( 'Settings' ); ?></a></li>
				<li><a href="#exifcaption-admin-tabs-2"><?php esc_html_e( 'Donate to this plugin &#187;' ); ?></a></li>
			</ul>
			<div id="exifcaption-admin-tabs-1">
				<h2><?php esc_html_e( 'Settings' ); ?></h2>
				<form method="post" action="<?php echo esc_url( $scriptname ); ?>">
					<?php wp_nonce_field( 'efc_settings', 'exifcaption_tabs' ); ?>

					<div style="width: 100%; height: 100%; float: left;	margin: 5px; padding: 5px; border: #CCC 2px solid;">
						<h3><?php esc_html_e( 'Insertion into the caption.', 'exif-caption' ); ?></h3>
						<div style="display: block; padding:5px 5px;">
						<input type="radio" name="exifcaption_insert" value="overwrite" 
						<?php
						if ( 'overwrite' === $exifcaption_settings['caption_insert'] ) {
							echo 'checked';}
						?>
						>
						<?php esc_html_e( 'Overwrite', 'exif-caption' ); ?>
						</div>
						<div style="display: block; padding:5px 5px;">
						<input type="radio" name="exifcaption_insert" value="left" 
						<?php
						if ( 'left' === $exifcaption_settings['caption_insert'] ) {
							echo 'checked';}
						?>
						>
						<?php esc_html_e( 'Insert to left.', 'exif-caption' ); ?>
						</div>
						<div style="display: block; padding:5px 5px;">
						<input type="radio" name="exifcaption_insert" value="right" 
						<?php
						if ( 'right' === $exifcaption_settings['caption_insert'] ) {
							echo 'checked';}
						?>
						>
						<?php esc_html_e( 'Insert to right.', 'exif-caption' ); ?>
						</div>
						<div style="display: block; padding:5px 20px;">
							Exif <?php esc_html_e( 'Tags' ); ?>
							<input type="submit" style="position:relative; top:-5px;" class="button" name="ExifDefault" value="<?php esc_attr_e( 'Default' ); ?>" />
							<div style="display: block; padding:5px 20px;">
							<textarea name="exifcaption_exif_text" style="width: 100%;"><?php echo esc_textarea( $exifcaption_settings['exif_text'] ); ?></textarea>
								<div>
								<a href="https://codex.wordpress.org/Function_Reference/wp_read_image_metadata#Return%20Values" target="_blank" style="text-decoration: none; word-break: break-all;"><?php esc_html_e( 'For Exif tags, please read here.', 'exif-caption' ); ?></a>
								</div>
								<div style="display: block; padding:5px 20px;">
								<?php echo esc_html( __( 'Extend', 'exif-caption' ) . ' ' . __( 'Tags' ) ); ?>
									<div>
									<b>%white_balance%</b> : <?php esc_html_e( 'White balance mode(auto or manual).', 'exif-caption' ); ?>
									</div>
								</div>
							</div>
						</div>
						<div>
						<?php
						if ( is_multisite() ) {
							$extendmediaupload_install_url = network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=extend-media-upload' );
							$mediafromftp_install_url = network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=media-from-ftp' );
							$postdatetimechange_install_url = network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=post-date-time-change' );
						} else {
							$extendmediaupload_install_url = admin_url( 'plugin-install.php?tab=plugin-information&plugin=extend-media-upload' );
							$mediafromftp_install_url = admin_url( 'plugin-install.php?tab=plugin-information&plugin=media-from-ftp' );
							$postdatetimechange_install_url = admin_url( 'plugin-install.php?tab=plugin-information&plugin=post-date-time-change' );
						}
							$extendmediaupload_install_html = '<a href="' . $extendmediaupload_install_url . '" target="_blank" style="text-decoration: none; word-break: break-all;">Extend Media Upload</a>';
							$mediafromftp_install_html = '<a href="' . $mediafromftp_install_url . '" target="_blank" style="text-decoration: none; word-break: break-all;">Media from FTP</a>';
							$postdatetimechange_install_html = '<a href="' . $postdatetimechange_install_url . '" target="_blank" style="text-decoration: none; word-break: break-all;">Post Date Time Change</a>';
						?>
							<div style="display: block; padding:5px 5px;">
							<?php
							/* translators: Plugin install link */
							echo wp_kses_post( sprintf( __( 'If you want to insert the Exif at the media registration, Please use the %1$s or %2$s.', 'exif-caption' ), $extendmediaupload_install_html, $mediafromftp_install_html ) );
							?>
							</div>
							<div style="display: block; padding:5px 5px;">
							<?php
							/* translators: Plugin install link */
							echo wp_kses_post( sprintf( __( 'If you want to apply the Exif shooting date time at the media registration, Please use the %1$s or %2$s.', 'exif-caption' ), $extendmediaupload_install_html, $mediafromftp_install_html ) );
							?>
							</div>
							<div style="display: block; padding:5px 5px;">
							<?php
							/* translators: Plugin install link */
							echo wp_kses_post( sprintf( __( 'If you want to bulk change the date time to Exif shooting date time, Please use the %1$s.', 'exif-caption' ), $postdatetimechange_install_html ) );
							?>
							</div>
						</div>
					</div>
				<?php submit_button( __( 'Save Changes' ), 'large', 'Submit', false ); ?>
				</form>
			</div>
			<div id="exifcaption-admin-tabs-2">
			<?php $this->credit(); ?>
			</div>
		</div>

		</div>
		<?php
	}

	/** ==================================================
	 * Credit
	 *
	 * @since 1.00
	 */
	private function credit() {

		$plugin_name    = null;
		$plugin_ver_num = null;
		$plugin_path    = plugin_dir_path( __DIR__ );
		$plugin_dir     = untrailingslashit( $plugin_path );
		$slugs          = explode( '/', $plugin_dir );
		$slug           = end( $slugs );
		$files          = scandir( $plugin_dir );
		foreach ( $files as $file ) {
			if ( '.' === $file || '..' === $file || is_dir( $plugin_path . $file ) ) {
				continue;
			} else {
				$exts = explode( '.', $file );
				$ext  = strtolower( end( $exts ) );
				if ( 'php' === $ext ) {
					$plugin_datas = get_file_data(
						$plugin_path . $file,
						array(
							'name'    => 'Plugin Name',
							'version' => 'Version',
						)
					);
					if ( array_key_exists( 'name', $plugin_datas ) && ! empty( $plugin_datas['name'] ) && array_key_exists( 'version', $plugin_datas ) && ! empty( $plugin_datas['version'] ) ) {
						$plugin_name    = $plugin_datas['name'];
						$plugin_ver_num = $plugin_datas['version'];
						break;
					}
				}
			}
		}
		$plugin_version = __( 'Version:' ) . ' ' . $plugin_ver_num;
		/* translators: FAQ Link & Slug */
		$faq       = sprintf( esc_html__( 'https://wordpress.org/plugins/%s/faq', '%s' ), $slug );
		$support   = 'https://wordpress.org/support/plugin/' . $slug;
		$review    = 'https://wordpress.org/support/view/plugin-reviews/' . $slug;
		$translate = 'https://translate.wordpress.org/projects/wp-plugins/' . $slug;
		$facebook  = 'https://www.facebook.com/katsushikawamori/';
		$twitter   = 'https://twitter.com/dodesyo312';
		$youtube   = 'https://www.youtube.com/channel/UC5zTLeyROkvZm86OgNRcb_w';
		$donate    = sprintf( esc_html__( 'https://shop.riverforest-wp.info/donate/', '%s' ), $slug );

		?>
			<span style="font-weight: bold;">
			<div>
		<?php echo esc_html( $plugin_version ); ?> | 
			<a style="text-decoration: none;" href="<?php echo esc_url( $faq ); ?>" target="_blank"><?php esc_html_e( 'FAQ' ); ?></a> | <a style="text-decoration: none;" href="<?php echo esc_url( $support ); ?>" target="_blank"><?php esc_html_e( 'Support Forums' ); ?></a> | <a style="text-decoration: none;" href="<?php echo esc_url( $review ); ?>" target="_blank"><?php sprintf( esc_html_e( 'Reviews', '%s' ), $slug ); ?></a>
			</div>
			<div>
			<a style="text-decoration: none;" href="<?php echo esc_url( $translate ); ?>" target="_blank">
			<?php
			/* translators: Plugin translation link */
			echo sprintf( esc_html__( 'Translations for %s' ), esc_html( $plugin_name ) );
			?>
			</a> | <a style="text-decoration: none;" href="<?php echo esc_url( $facebook ); ?>" target="_blank"><span class="dashicons dashicons-facebook"></span></a> | <a style="text-decoration: none;" href="<?php echo esc_url( $twitter ); ?>" target="_blank"><span class="dashicons dashicons-twitter"></span></a> | <a style="text-decoration: none;" href="<?php echo esc_url( $youtube ); ?>" target="_blank"><span class="dashicons dashicons-video-alt3"></span></a>
			</div>
			</span>

			<div style="width: 250px; height: 180px; margin: 5px; padding: 5px; border: #CCC 2px solid;">
			<h3><?php sprintf( esc_html_e( 'Please make a donation if you like my work or would like to further the development of this plugin.', '%s' ), $slug ); ?></h3>
			<div style="text-align: right; margin: 5px; padding: 5px;"><span style="padding: 3px; color: #ffffff; background-color: #008000">Plugin Author</span> <span style="font-weight: bold;">Katsushi Kawamori</span></div>
			<button type="button" style="margin: 5px; padding: 5px;" onclick="window.open('<?php echo esc_url( $donate ); ?>')"><?php esc_html_e( 'Donate to this plugin &#187;' ); ?></button>
			</div>

			<?php

	}

	/** ==================================================
	 * Update wp_options table.
	 *
	 * @since 1.0
	 */
	public function options_updated() {

		if ( ! empty( $_POST ) ) {
			if ( isset( $_POST['exifcaption_tabs'] ) && ! empty( $_POST['exifcaption_tabs'] ) ) {
				if ( check_admin_referer( 'efc_settings', 'exifcaption_tabs' ) ) {
					$exifcaption_settings = get_option( $this->wp_options_name() );
					if ( ! empty( $_POST['exifcaption_insert'] ) ) {
						$caption_insert = sanitize_text_field( wp_unslash( $_POST['exifcaption_insert'] ) );
					} else {
						$caption_insert = $exifcaption_settings['caption_insert'];
					}
					if ( ! empty( $_POST['exifcaption_exif_text'] ) ) {
						$exif_text = wp_strip_all_tags( wp_unslash( $_POST['exifcaption_exif_text'] ) );
					} else {
						$exif_text = $exifcaption_settings['exif_text'];
					}
					if ( ! empty( $_POST['ExifDefault'] ) ) {
						$exif_text = '%title% %credit% %camera% %caption% %created_timestamp% %copyright% %aperture% %shutter_speed% %iso% %focal_length% %white_balance%';
					}
					$exifcaption_tbl = array(
						'caption_insert' => $caption_insert,
						'exif_text' => $exif_text,
					);
					update_option( $this->wp_options_name(), $exifcaption_tbl );
					echo '<div class="notice notice-success is-dismissible"><ul><li>' . esc_html__( 'Settings' ) . ' --> ' . esc_html__( 'Changes saved.' ) . '</li></ul></div>';
				}
			}
		}

	}

	/** ==================================================
	 * Media Library Column
	 *
	 * @param array $cols  cols.
	 * @return array $cols
	 * @since 2.0
	 */
	public function muc_column( $cols ) {

		global $pagenow;
		if ( 'upload.php' == $pagenow ) {
			$cols['media_caption'] = __( 'Caption' );
		}

		return $cols;
	}

	/** ==================================================
	 * Media Library Column
	 *
	 * @param string $column_name  column_name.
	 * @param int    $id  id.
	 * @since 2.0
	 */
	public function muc_value( $column_name, $id ) {

		if ( 'media_caption' == $column_name ) {

			$exifcaption_settings = get_option( $this->wp_options_name() );
			$caption_insert = $exifcaption_settings['caption_insert'];
			$exif_text_tag = $exifcaption_settings['exif_text'];

			global $wpdb;
			$attachments = $wpdb->get_results(
				$wpdb->prepare(
					"
						SELECT	post_excerpt
						FROM	$wpdb->posts
						WHERE	ID = %d
						",
					$id
				),
				ARRAY_A
			);

			$exifcaption = new ExifCaption();

			$exif_text = $exifcaption->getmeta( $id, $exif_text_tag );
			$input_html = null;
			if ( $exif_text ) {
				switch ( $caption_insert ) {
					case 'overwrite':
						$caption = $exif_text;
						break;
					case 'left':
						$caption = $exif_text . $attachments[0]['post_excerpt'];
						break;
					case 'right':
						$caption = $attachments[0]['post_excerpt'] . $exif_text;
						break;
				}

				$input_html .= '<div>[' . __( 'Current', 'exif-caption' ) . ']: ' . $attachments[0]['post_excerpt'];
				$input_html .= '</div>';
				$input_html .= '<div>[' . __( 'After', 'exif-caption' ) . ']:';
				$input_html .= '<textarea name="exifcaptiontexts[' . $id . ']" style="width: 100%">' . $caption . '</textarea>';
				$input_html .= '</div>';
				$input_html .= '</div>';

			}
			unset( $exifcaption );

			$allowed_input_html = array(
				'div'  => array(),
				'textarea'  => array(
					'name'  => array(),
					'style'  => array(),
				),
			);

			echo wp_kses( $input_html, $allowed_input_html );

		}

	}

	/** ==================================================
	 * Bulk Action Select
	 *
	 * @since 2.0
	 */
	public function custom_bulk_admin_footer() {
		global $pagenow;
		if ( 'upload.php' == $pagenow ) {
			?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('<option>').val('insertexifcaption').text('<?php esc_html_e( 'Insert Exif to Caption', 'exif-caption' ); ?>').appendTo("select[name='action']");
					jQuery('<option>').val('insertexifcaption').text('<?php esc_html_e( 'Insert Exif to Caption', 'exif-caption' ); ?>').appendTo("select[name='action2']");
				});
			</script>
			<?php
		}
	}

	/** ==================================================
	 * Bulk Action
	 *
	 * @since 2.0
	 */
	public function custom_bulk_action() {

		if ( ! isset( $_REQUEST['detached'] ) ) {

			/* get the action */
			$wp_list_table = _get_list_table( 'WP_Media_List_Table' );
			$action = $wp_list_table->current_action();

			$allowed_actions = array( 'insertexifcaption' );
			if ( ! in_array( $action, $allowed_actions ) ) {
				return;
			}

			check_admin_referer( 'bulk-media' );

			if ( isset( $_REQUEST['media'] ) ) {
				$post_ids = array_map( 'intval', $_REQUEST['media'] );
			}

			if ( empty( $post_ids ) ) {
				return;
			}

			$sendback = remove_query_arg( array( 'exifinserted', 'message', 'untrashed', 'deleted', 'ids' ), wp_get_referer() );
			if ( ! $sendback ) {
				$sendback = admin_url( "upload.php?post_type=$post_type" );
			}

			$pagenum = $wp_list_table->get_pagenum();
			$sendback = add_query_arg( 'paged', $pagenum, $sendback );

			switch ( $action ) {
				case 'insertexifcaption':
					$exifinserted = 0;
					if ( ! empty( $_REQUEST['exifcaptiontexts'] ) ) {
						$exifcaption_texts = array_map( 'wp_strip_all_tags', wp_unslash( $_REQUEST['exifcaptiontexts'] ) );
					} else {
						return;
					}

					$exifcaption = new ExifCaption();
					$exifcaption_settings = get_option( $this->wp_options_name() );
					$exif_text_tag = $exifcaption_settings['exif_text'];

					global $wpdb;
					$messages = array();
					foreach ( $post_ids as $post_id ) {
						/* check exif */
						$exif_text = $exifcaption->getmeta( $post_id, $exif_text_tag );
						if ( $exif_text ) {
							/* Change DB Attachement post */
							$update_array = array(
								'post_excerpt' => $exifcaption_texts[ $post_id ],
							);
							$id_array = array( 'ID' => $post_id );
							$wpdb->update( $wpdb->posts, $update_array, $id_array, array( '%s' ), array( '%d' ) );
							unset( $update_array, $id_array );

							$message = $exifcaption->replace_content_caption( $post_id, $exifcaption_texts[ $post_id ] );

							if ( $message ) {
								$messages[ $exifinserted ] = $message;
								$exifinserted++;
							}
						}
					}
					unset( $exifcaption );
					$sendback = add_query_arg(
						array(
							'exifinserted' => $exifinserted,
							'ids' => join( ',', $post_ids ),
							'message' => join(
								',',
								$messages
							),
						),
						$sendback
					);
					break;
				default:
					return;
			}

			$sendback = remove_query_arg( array( 'action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status', 'post', 'bulk_edit', 'post_view' ), $sendback );
			wp_redirect( $sendback );
			exit();

		}

	}

	/** ==================================================
	 * Bulk Action Message
	 *
	 * @since 2.0
	 */
	public function custom_bulk_admin_notices() {

		global $post_type, $pagenow;

		if ( 'upload.php' == $pagenow && 'attachment' == $post_type && isset( $_REQUEST['exifinserted'] ) && 0 < intval( $_REQUEST['exifinserted'] ) && isset( $_REQUEST['message'] ) ) {
			$messages = explode( ',', urldecode( wp_strip_all_tags( wp_unslash( $_REQUEST['message'] ) ) ) );
			$success_count = 0;
			foreach ( $messages as $message ) {
				if ( 'success' === $message ) {
					++$success_count;
				} else {
					echo '<div class="notice notice-error is-dismissible"><ul><li>' . esc_html( $message ) . '</li></ul></div>';
				}
			}
			if ( 0 < $success_count ) {
				/* translators: Success count */
				echo '<div class="notice notice-success is-dismissible"><ul><li>' . esc_html( sprintf( __( '%1$d media files updated.', 'exif-caption' ), $success_count ) ) . '</li></ul></div>';
			}
		}

	}

	/** ==================================================
	 * Options name
	 *
	 * @return string $this->wp_options_name()
	 * @since 2.12
	 */
	private function wp_options_name() {
		if ( ! function_exists( 'wp_get_current_user' ) ) {
			include_once( ABSPATH . 'wp-includes/pluggable.php' );
		}
		return 'exifcaption_settings_' . get_current_user_id();
	}

}


