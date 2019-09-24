<?php
/**
 * Exif Caption
 *
 * @package    Exif Caption
 * @subpackage ExifCaption Main Functions
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

/** ==================================================
 * Main Functions
 */
class ExifCaption {

	/** ==================================================
	 * Get meta data
	 *
	 * @param int    $attach_id  attach_id.
	 * @param string $exif_text_tag  exif_text_tag.
	 * @return array $exif_text(string)
	 * @since 1.0
	 */
	public function getmeta( $attach_id, $exif_text_tag ) {

		$metadata = wp_get_attachment_metadata( $attach_id );
		if ( ! $metadata ) {
			return;
		}

		$file_path = get_attached_file( $attach_id );
		$exif = @exif_read_data( $file_path, 0, true );
		if ( ! $exif ) {
			return;
		}

		$exifdatas = array();
		if ( $metadata['image_meta']['title'] ) {
			$exifdatas['title'] = $metadata['image_meta']['title'];
		}
		if ( $metadata['image_meta']['credit'] ) {
			$exifdatas['credit'] = $metadata['image_meta']['credit'];
		}
		if ( $metadata['image_meta']['camera'] ) {
			$exifdatas['camera'] = $metadata['image_meta']['camera'];
		}
		if ( $metadata['image_meta']['caption'] ) {
			$exifdatas['caption'] = $metadata['image_meta']['caption'];
		}
		$exif_ux_time = $metadata['image_meta']['created_timestamp'];
		if ( ! empty( $exif_ux_time ) ) {
			$exifdatas['created_timestamp'] = date_i18n( 'Y-m-d H:i:s', $exif_ux_time, false );
		} else {
			if ( isset( $exif['EXIF']['DateTimeOriginal'] ) && ! empty( $exif['EXIF']['DateTimeOriginal'] ) ) {
				$shooting_date_time = $exif['EXIF']['DateTimeOriginal'];
				$shooting_date = str_replace( ':', '-', substr( $shooting_date_time, 0, 10 ) );
				$shooting_time = substr( $shooting_date_time, 10 );
				$exifdatas['created_timestamp'] = $shooting_date . $shooting_time;
			}
		}
		if ( $metadata['image_meta']['copyright'] ) {
			$exifdatas['copyright'] = $metadata['image_meta']['copyright'];
		}
		if ( $metadata['image_meta']['aperture'] ) {
			$exifdatas['aperture'] = 'f/' . $metadata['image_meta']['aperture'];
		}
		if ( $metadata['image_meta']['shutter_speed'] ) {
			if ( $metadata['image_meta']['shutter_speed'] < 1 ) {
				$shutter = round( 1 / $metadata['image_meta']['shutter_speed'] );
				$exifdatas['shutter_speed'] = '1/' . $shutter . 'sec';
			} else {
				$exifdatas['shutter_speed'] = $metadata['image_meta']['shutter_speed'] . 'sec';
			}
		}
		if ( $metadata['image_meta']['iso'] ) {
			$exifdatas['iso'] = 'ISO-' . $metadata['image_meta']['iso'];
		}
		if ( $metadata['image_meta']['focal_length'] ) {
			$exifdatas['focal_length'] = $metadata['image_meta']['focal_length'] . 'mm';
		}
		if ( isset( $exif['WhiteBalance'] ) ) {
			if ( 0 == $exif['WhiteBalance'] ) {
				$exifdatas['white_balance'] = __( 'Auto' );
			} else {
				$exifdatas['white_balance'] = __( 'Manual' );
			}
		}

		$exif_text = null;
		if ( $exifdatas ) {
			$exif_text = $exif_text_tag;
			foreach ( $exifdatas as $item => $exif ) {
				$exif_text = str_replace( '%' . $item . '%', $exif, $exif_text );
			}
			preg_match_all( '/%(.*?)%/', $exif_text, $exif_text_per_match );
			foreach ( $exif_text_per_match as $key1 ) {
				foreach ( $key1 as $key2 ) {
					$exif_text = str_replace( '%' . $key2 . '%', '', $exif_text );
				}
			}
		}

		return $exif_text;

	}

	/** ==================================================
	 * Replace contents caption
	 *
	 * @param int    $re_id_attache  re_id_attache.
	 * @param string $caption  caption.
	 * @return string $message
	 * @since 1.0
	 */
	public function replace_content_caption( $re_id_attache, $caption ) {

		global $wpdb;
		$wpdb->search_attache_id = 'id="attachment_' . $re_id_attache . '"';
		$search_posts = $wpdb->get_results(
			"
								SELECT ID,post_status,post_content
								FROM $wpdb->posts
								WHERE instr(post_content, '$wpdb->search_attache_id') > 0
								"
		);

		$message = 'success';
		if ( $search_posts ) {
			foreach ( $search_posts as $search_post ) {
				if ( 'publish' === $search_post->post_status ) {
					$content = $search_post->post_content;
					if ( preg_match_all( '/\[caption(.+?)\](.+?)\[\/caption\]/i', $content, $result ) !== false ) {
						$dbchange = false;
						$alt_string = null;
						$caption_string = null;
						$caption_content = null;
						foreach ( $result[0] as $value ) {
							if ( stristr( $value, $search_attache_id ) ) {
								$caption_content = $value;
								if ( preg_match( '/alt="(.+?)"/i', $value, $matches1 ) ) {
									$alt_string = $matches1[1];
									$value = str_replace( $alt_string, $caption, $value );
									$dbchange = true;
								}
								if ( strpos( $value, '/a>' ) ) {
									if ( preg_match( '/\/a>(.+?)\[\/caption\]/i', $value, $matches2 ) ) {
										$caption_string = $matches2[1];
										$value = str_replace( $caption_string, $caption, $value );
										$dbchange = true;
									}
								} else {
									if ( preg_match( '/\/>(.+?)\[\/caption\]/i', $value, $matches2 ) ) {
										$caption_string = $matches2[1];
										$value = str_replace( $caption_string, $caption, $value );
										$dbchange = true;
									}
								}
								$content = str_replace( $caption_content, $value, $content );
							}
						}
						if ( $dbchange ) {
							/* Change DB Attachement post */
							$update_array = array(
								'post_content' => $content,
							);
							$id_array = array( 'ID' => $search_post->ID );
							$wpdb->show_errors();
							$wpdb->update( $wpdb->posts, $update_array, $id_array, array( '%s' ), array( '%d' ) );
							if ( '' !== $wpdb->last_error ) {
								$message = $wpdb->print_error();
							}
							unset( $update_array, $id_array );
						}
					}
				}
			}
		}

		return $message;

	}

}


