<?php
/*
Plugin Name: KL User Info
Plugin URI: https://github.com/educate-sysadmin/kl-user-info
Description: Wordpress plugin to output user and roles via shortcode
Version: 0.1
Author: b.cunningham@ucl.ac.uk
Author URI: https://educate.london
License: GPL2
*/

function kl_user_info( $atts, $content = null ) {
    echo '<span class = "kl_user_info">'."\n";
    // get 
    $user;
    $roles = array();
    if (!is_user_logged_in()) {
        $user = 'Visitor';
        $roles[] = 'visitor';
    } else {
        // roles
        $user_object = wp_get_current_user();
        $user = $user_object->user_login;
        foreach ($user_object->roles as $role) {
            $roles[] = $role;
        }
    }
    // output
    // user
    echo '<span class= "kl_user">'.$user.'</span>'."\n";
    // roles
    $roles_output = '<span class= "kl_user_roles">';
    foreach ($roles as $role) {
       $roles_output .= '<span class= "kl_user_role kl_user_role_'.$role.'">'.$role.'</span>'.'<span class= "kl_user_info_delimiter">&nbsp;</span>';
    }
    $roles_output .= '</span>';
    echo $roles_output."\n";     
    echo '</span>'."\n";
}
add_shortcode('kl_user_info','kl_user_info');

/* sample css 
 span.kl_user_info_delimiter:last-child { display: none; }
.kl_user_info { color: grey; }
.kl_user_info .kl_user { font-weight: bold; } 
 */

/* sample js */
/*
jQuery(document).ready(function() {
	jQuery('.kl_user_info .kl_user_roles').prepend("(");
	jQuery('.kl_user_info .kl_user_roles').append(")");
	jQuery('.kl_user_info_delimiter').html(', ');
	jQuery('.kl_user_role').each(function() {
		jQuery(this).html(jQuery(this).html().replace("_"," "));
	})
});	 
 */


