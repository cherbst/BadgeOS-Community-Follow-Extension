<?php
add_action( 'init',  function() {
	// if badgeos_community does not exist, bail
	if (!isset($GLOBALS['badgeos_community']))
		return;

    $GLOBALS['badgeos_community']->community_triggers[__( 'Social Actions', 'badgeos-community' )]
        ['badgeos_bp_follow_start_following'] = __( 'Follow another user', 'badgeos-community-follow' );
    $GLOBALS['badgeos_community']->community_triggers[__( 'Social Actions', 'badgeos-community' )]
        ['badgeos_bp_follow_new_follower'] = __( 'Get a new follower', 'badgeos-community-follow' );
}, 9 );

add_action( 'bp_follow_start_following',  function($follow) {
    do_action('badgeos_bp_follow_start_following');
    do_action('badgeos_bp_follow_new_follower', $follow->leader_id);
});

add_filter('badgeos_bp_trigger_event_user_id', function($user_ID, $current_filter, $args ){
    if ( 'badgeos_bp_follow_new_follower' == $current_filter )
		return absint( $args );
	return $user_ID;
}, 10, 3);