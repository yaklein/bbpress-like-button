<?php
//Load wordpress core
require_once('../../../wp-load.php');

extract($_POST);

//Defaults
if(!isset($sortname) || $sortname == ''){
    $sortname = 'meta_id';
}
if(!isset($sortorder)){
    $sortorder = 'desc';
}
if(!isset($rp)){
    $rp = '1000';
}
if(!isset($page)){
    $page = 1;
}
$sortorder = strtoupper($sortorder);
$offset = ((Integer)$page - 1) * $rp;

//Get the data
global $wpdb;
$table_name = $wpdb->prefix.'postmeta';

$results = $wpdb->get_results("SELECT * FROM $table_name where meta_key = 'bbpl_like' ORDER BY $sortname $sortorder LIMIT $rp OFFSET $offset",ARRAY_A);

if(!empty($results)){
    
    $data = array();
    
    foreach($results as $like){
        //Preprocess
        $user = get_userdata($like['meta_value']);
        $post = get_post($like['post_id']);
        $post_title = $post->post_title;

        if($post->post_type=='reply'){
            $parent_id = $post->post_parent;
            $extra_link = '#post-'.$post->ID;
            if(empty($post_title)) {
                $post_title = get_the_title($post->post_parent);
            }
        }else{
            $parent_id = $like['post_id'];
            $extra_link = '';
            $post_title .= ' (OP)';
        }
        $link = get_permalink($parent_id).$extra_link;

        //Output
        $data[]['cell'] = array(
            $user->user_login,
            $post_title,
            '<a href="post.php?post='.$like['post_id'].'&action=edit" target="_blank" >'.__('Edit','bbpl').'</a> | <a href="'.$link.'" target="_blank" >'.__('View','bbpl').'</a>'
        );
    }
    echo json_encode(array('page' => 1, 'total' => count($results), 'rows' => $data));
}
die;