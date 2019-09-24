<?php
/**
 * Exif Caption
 *
 * @package    Exif Caption
 * @subpackage ExifCaptionRegist registered in the database
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

$exifcaptionregist = new ExifCaptionRegist();

/** ==================================================
 * Register Database
 */
class ExifCaptionRegist {

	/** ==================================================
	 * Construct
	 *
	 * @since 2.07
	 */
	public function __construct() {

		add_action( 'admin_init', array( $this, 'register_settings' ) );

	}

	/** ==================================================
	 * Settings register
	 *
	 * @since 1.0
	 */
	public function register_settings() {

		$wp_options_name = 'exifcaption_settings_' . get_current_user_id();

		$caption_insert = 'overwrite';
		$exif_text = '%title% %credit% %camera% %caption% %created_timestamp% %copyright% %aperture% %shutter_speed% %iso% %focal_length% %white_balance%';

		if ( ! get_option( $wp_options_name ) ) {
			if ( get_option( 'exifcaption_settings' ) ) {
				$exifcaption_settings = get_option( 'exifcaption_settings' );
				if ( array_key_exists( 'caption_insert', $exifcaption_settings ) ) {
					$caption_insert = $exifcaption_settings['caption_insert'];
				}
				if ( array_key_exists( 'exif_text', $exifcaption_settings ) ) {
					$exif_text = $exifcaption_settings['exif_text'];
				}
				delete_option( 'exifcaption_settings' );
			}
		} else {
			$exifcaption_settings = get_option( $wp_options_name );
			if ( array_key_exists( 'caption_insert', $exifcaption_settings ) ) {
				$caption_insert = $exifcaption_settings['caption_insert'];
			}
			if ( array_key_exists( 'exif_text', $exifcaption_settings ) ) {
				$exif_text = $exifcaption_settings['exif_text'];
			}
		}
		$exifcaption_tbl = array(
			'caption_insert' => $caption_insert,
			'exif_text' => $exif_text,
		);
		update_option( $wp_options_name, $exifcaption_tbl );

	}

}


