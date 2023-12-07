<?php
/** Image Settings */


// /** Code to allow SVG files */
// function cc_mime_types($mimes) {
//   $mimes['svg'] = 'image/svg+xml';
//   return $mimes;
// }
// add_filter('upload_mimes', 'cc_mime_types');

// add_filter('wp_all_import_image_mime_type', 'wpai_image_mime_type', 10, 2);

// function wpai_image_mime_type($mime_type, $image_filepath) {
//   if (empty($mime_type) and preg_match('%\W(svg)$%i', basename($image_filepath))) {
//     return 'image/svg+xml';
//   }
//   return $mime_type;
// }


// function wp_check_svg($data, $file, $filename, $mimes) {
//     $filetype = wp_check_filetype( $filename, $mimes );
   
//     $ext = $filetype['ext'];
//     $type = $filetype['type'];
//     $proper_filename = $data['proper_filename'];
   
//     // Check if uploaded file is a SVG
//     if( $type !== 'image/svg+xml' || $ext !== 'svg' ) {
//         return $data;
//     }
   
//     // Make sure that the file is being uploaded by a trusted user
//     if( ! current_user_can( 'upload_files' ) ) {
//         return $data;
//     }
   
//     // Use WP_Filesystem to read the contents of the file
//     global $wp_filesystem;
//     if (empty($wp_filesystem)) {
//         require_once (ABSPATH . '/wp-admin/includes/file.php');
//         WP_Filesystem();
//     }
   
//     $content = $wp_filesystem->get_contents( $file );
   
//     // Use DOMDocument to parse the SVG file
//     $doc = new DOMDocument();
//     $doc->loadXML( $content );
   
//     // Check if the file contains any <script> tags
//     $scripts = $doc->getElementsByTagName( 'script' );
   
//     if ( $scripts->length > 0 ) {
//         // The file contains <script> tags, which is not allowed
//         return $data;
//     }
   
//     // The SVG file is safe, so return the original data
//     return $data;
//   }
//   add_filter( 'wp_handle_upload_prefilter', 'wp_check_svg' );
  
  
