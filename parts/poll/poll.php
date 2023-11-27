<?php

  function poll_vote() {

    $nonce = $_POST['nonce'];

      //if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
          //die ( 'Busted!');

  	if ( !is_numeric( $_POST['post_ID'] ) || !is_numeric( $_POST['answer_ID'] )  ) return;


    $post_id = $_POST['post_ID'];
    $meta_key =  '_poll_answer_count_'.$_POST['answer_ID'];
  	$current_votes_count = get_post_meta($post_id, $meta_key, true);

  	if(!poll_already_voted($post_id)) {
      $current_votes_count++;
      update_post_meta($post_id, $meta_key, $current_votes_count);
      die("$current_votes_count");
  	}
  	else {
  		die('already');
  	}
  	exit;
  }

  if( $_POST['action'] == 'poll-vote' ) {
    poll_vote();
  }



  function poll_already_voted($post_id) {
    $votes = isset($_COOKIE["votes_ids"]) ? unserialize(base64_decode($_COOKIE["votes_ids"])) : array();
  	if( in_array( $post_id,(array) $votes ) )
  	{
  			return true;
  	} else {
        $votes[] = $post_id;
        $votes = base64_encode(serialize($votes));
        setcookie('votes_ids', $votes, time()+31536000);
        return false;
    }
  	return false;
  }
