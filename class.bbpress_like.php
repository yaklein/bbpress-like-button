<?php
class bbpress_like {
    public static function init() {
        wp_register_style( 'bbpl_public', plugins_url('css/bbpl_style.css', __FILE__) );
        wp_register_style( 'flexigrid', plugins_url('css/flexigrid.css', __FILE__) );
    }
  
    public static function admin_menu(){
        $pages = array();
//        add_menu_page(__('Likes','bbpl'), __('Likes','bbpl'), 'add_users', 'bbpress-likes' , array('bbpress_like','admin_screen'), plugins_url('bbpress-like/img/thumbs_up_15_15.png'), 100);
        $pages[] = add_menu_page(__('Likes Logs','bbpl'), __('Likes','bbpl'), 'add_users', 'bbpress-likes' , array('bbpress_like','logs_screen'), plugins_url('bbpress-like/img/thumbs_up_15_15.png'), 100);
        
        
//        $pages[] = add_submenu_page('bbpress-likes',__('Likes logs','bbpl'), __('Likes logs','bbpl'), 'add_users', 'bbpress-likes-logs', array('bbpress_like','logs_screen'));
        $pages[] = add_submenu_page('bbpress-likes',__('Likes stadistics','bbpl'), __('Likes stadistics','bbpl'), 'add_users', 'bbpress-likes-stadistics', array('bbpress_like','stadistics_screen'));
        
        //Add styles only for plugin pages
        foreach($pages as $page){
            add_action( 'admin_print_styles-' . $page, array('bbpress_like', 'admin_styles') );
        }
    }
    
    public static function plugin_activation(){
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';

        $sql = "CREATE TABLE IF NOT EXISTS ". $table_name . " (
            id int(11) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) NOT NULL,
            user_id bigint(20) NOT NULL,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            PRIMARY KEY (id)
            ) TYPE=MyISAM AUTO_INCREMENT=1;
        ";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
    
    public static function plugin_uninstall(){
        
    }
    /* STYLES AND SCRIPT START */
    public static function admin_styles(){
        wp_enqueue_style( 'flexigrid' );
        wp_enqueue_style( 'bbpl_public' );
    }
    
    public static function public_styles(){
        wp_enqueue_style('bbpl_public');
    }
    
    public static function admin_enqueue_scripts(){
        wp_enqueue_script( 
             'jquery.cookie'
            ,plugins_url('js/jquery.cookie.js', __FILE__)
            ,'jquery'
            ,'1.2'
            ,true 
        );
        wp_enqueue_script( 
             'flexigrid'
            ,plugins_url('js/flexigrid.js', __FILE__)
            ,'jquery'
            ,'1.1'
            ,true 
        );
        wp_enqueue_script( 
             'bbpl-functions'
            ,plugins_url('js/admin_functions.js', __FILE__)
            ,''
            ,'1.0'
            ,true 
        );
        wp_enqueue_script( 
             'jquery.tools.tooltip'
            ,plugins_url('js/jquery.tools.min.tooltip.js', __FILE__)
            ,'jquery'
            ,'1.2.7'
            ,true 
        );
    }
    
    public static function public_enqueue_scripts(){
        wp_enqueue_script( 
             'bbpl-functions'
            ,plugins_url('js/public_functions.js', __FILE__)
            ,''
            ,'1.0'
            ,true 
        );
        wp_enqueue_script( 
             'jquery.tools.tooltip'
            ,plugins_url('js/jquery.tools.min.tooltip.js', __FILE__)
            ,'jquery'
            ,'1.2.7'
            ,true 
        );
    }
    /* STYLES AND SCRIPT END */
    
    /* HELPER FUNCTIONS START */
    public static function get_like($user_id, $post_id){
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';
        
        $result = $wpdb->get_row("SELECT id FROM $table_name WHERE user_id = $user_id AND post_id = $post_id");

        return $result;
    }
    
    public static function get_who_liked($post_id){
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';
        
        $result = $wpdb->get_results("SELECT user_id FROM $table_name WHERE post_id = $post_id ORDER BY time DESC", ARRAY_A);

        return $result;
    }
    
    public static function delete_like(){
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';
        
        extract($_POST);
        
        if(!isset($id)) die;
        
        return $wpdb->query("DELETE FROM $table_name WHERE id = $id");
        
        die;
    }
    
    public static function like_this(){
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';
        
        extract($_POST);
        
        //Check if previously liked
        $liked = self::get_like($user_id, $post_id);
        if($liked){
            _e('This post was already liked by this user', 'bbpl');
        }else{
            //Insert like
            $result = $wpdb->insert($table_name, array('post_id' => $post_id, 'user_id' => $user_id, 'time' => date('Y-m-d H:i:s')));
            if(!$result){ _e('An error ocurred: ', 'bbpl').$wpdb->print_error(); }else{ _e('Liked successfully','bbpl');}
        }
        die;
    }
    
    public static function who_liked_tooltip($post_id, $limit = 3){
        $who_liked = self::get_who_liked($post_id);
        $who_liked_caption = array();
        $who_liked_users = array(); //for caching purposes
        foreach ($who_liked as $who){
            if(count($who_liked_users)>=$limit){
                $who_liked_caption[] = __('and','bbpl').' '.(count($who_liked)-$limit).' '.__('more people', 'bbpl');
                break;
            }
            if(!key_exists($who['user_id'], $who_liked_users)){
                $who_liked_users[$who['user_id']] = get_userdata($who['user_id']);
            }
            $who_liked_caption[] = $who_liked_users[$who['user_id']]->display_name;
        }
        return implode(', ',$who_liked_caption);
    }
    
    /* HELPER FUNCTIONS END */
    
    /* SHORTOCDES START */
    public static function get_most_liked_users_shortcode($atts){
        extract(shortcode_atts(array(
          'exclude_admins' => false
        ), $atts));
        return self::get_most_liked_users(false, $exclude_admins);
    }
    
    public static function get_most_liking_users_shortcode($atts){
        return self::get_most_liking_users(false);
    }
    
    public static function get_most_liked_posts_shortcode($atts){
        return self::get_most_liked_posts(false);
    }
    /* SHORTCODES END */
    
    /* STADISTICS START */
    public static function get_most_liked_posts($echo = true){
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';
        $result = $wpdb->get_results("SELECT COUNT(*) liked_post_count, bbpl.post_id liked_post_id, bbpl.*, po.post_author post_author FROM $table_name bbpl INNER JOIN {$wpdb->prefix}posts po ON po.ID = bbpl.post_id GROUP BY liked_post_id ORDER BY liked_post_count DESC, liked_post_id ASC", ARRAY_A);
        
        if(!$echo) ob_start();
        if($result){
            echo '<ol>';
            
            foreach($result as $liked_posts){
                $post = get_post($liked_posts['liked_post_id']);
                
                $who_liked_caption = self::who_liked_tooltip($post->ID);
                
                if($post->post_type=='reply'){
                    $parent_id = $post->post_parent;
                    $extra_link = '#post-'.$post->ID;
                }else{
                    $parent_id = $post->ID;
                    $extra_link = '';
                }
                $link = get_permalink($parent_id).$extra_link;
                $user = get_userdata($liked_posts['post_author']);
                if(current_user_can('add_users')){
                    $admin_links = '<a href="post.php?post='.$post->ID.'&action=edit" target="_blank" >'.__('Edit','bbpl').'</a>';
                }
                echo '<li><a href="'.$link.'" target="_blank" title="'.__('View','bbpl').'" >'.$post->post_title.'</a> '.__('by','bbpl').' '.$user->display_name.' <span class="who_liked" title="'.$who_liked_caption.' '.__('liked this', 'bbpl').'">('.$liked_posts['liked_post_count'].' '.__('likes','bbpl').')</span> '.$admin_links.'</li>';
            }
            echo '</ol>';
        }else{
            _e('Sorry! Nobody has liked any post or reply yet...','bbpl');
        }
        if(!$echo) return ob_get_clean();
    }
    public static function get_most_liked_users($echo = true, $exclude_admins = false, $get_only_data = false){
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';
        $result = $wpdb->get_results("SELECT COUNT(*) liked_user_count, po.post_author liked_user_id FROM $table_name bbpl INNER JOIN {$wpdb->prefix}posts po ON po.ID = bbpl.post_id GROUP BY liked_user_id ORDER BY liked_user_count DESC LIMIT 10", ARRAY_A);
        
        $get_only_data_arr = array();
        if(!$echo) ob_start();
        if($result){
            echo '<ol>';
            foreach($result as $liked_users){
                $user = get_userdata($liked_users['liked_user_id']);
                if($get_only_data){
                    $get_only_data_arr[] = array('user' => $user, 'number_likes' => $liked_users['liked_user_count']);
                }
                if($exclude_admins && $user->caps['administrator']==1) continue;
                echo '<li>'.$user->user_login.' ('.$liked_users['liked_user_count'].' '.__('likes','bbpl').')</li>';
            }
            echo '</ol>';
        }else{
            _e('Sorry! Nobody has liked any post or reply yet...','bbpl');
        }
        if($get_only_data){
            ob_get_clean();
            return $get_only_data_arr;
        }
        if(!$echo) return ob_get_clean();
    }
    
    public static function get_most_liking_users($echo = true, $exclude_admins = false){
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';
        $result = $wpdb->get_results("SELECT COUNT(*) liking_user_count, bbpl.user_id liking_user_id FROM $table_name bbpl INNER JOIN {$wpdb->prefix}posts po ON po.ID = bbpl.post_id GROUP BY bbpl.user_id ORDER BY liking_user_count DESC LIMIT 10", ARRAY_A);
        
        if(!$echo) ob_start();
        if($result){
            echo '<ol>';
            foreach($result as $liking_users){
                $user = get_userdata($liking_users['liking_user_id']);
                if($exclude_admins && $user->caps['administrator']==1) continue;
                echo '<li>'.$user->user_login.' ('.$liking_users['liking_user_count'].' '.__('likes','bbpl').')</li>';
            }
            echo '</ol>';
        }else{
            _e('Sorry! Nobody has liked any post or reply yet...','bbpl');
        }
        if(!$echo) return ob_get_clean();
    }
    /* STADISTICS END */
    
    /* OUTPUT FUNCTIONS START */
    public static function bbpl_show_button($echo = true){
        if ( !is_user_logged_in() ) return; //only for logged users
        
        global $post;
        $post_id = $post->ID;
        $user_id = get_current_user_id();
        
        $liked = (self::get_like($user_id, $post_id)) == NULL ? false : true;
        
        $link_caption = ($liked == true ? __('You liked this','bbpl') : __('Like this', 'bbpl'));
        
        ob_start();
        ?>
        <a href="#" data-user="<?php echo $user_id; ?>" data-post="<?php echo $post_id; ?>" title="<?php echo $link_caption; ?>" class="bbpl_button <?php echo $liked==true ? 'liked' : '' ?>"><span><?php echo $link_caption; ?></span></a>
        <?php
        $content = ob_get_clean();
        if($echo === false) { return $content; }else{ echo $content; }
    }
    
    public static function admin_screen(){
        ?>
        <div class="wrap">
            <h2><?php _e('Likes Options','bbpl'); ?></h2>
        </div>
        <div>
            <h3></h3>
            <p></p>
        </div>
        <?php
    }
    
    public static function stadistics_screen(){
        ?>
        <div class="wrap">
            <h2><?php _e('Likes stadistics','bbpl'); ?></h2>
        </div>
        <div>
            <h3><?php _e('Most liked users (admins included)', 'bbpl'); ?></h3>
            <p class="howto"><?php _e('Top 10 most liked users.', 'bbpl'); ?></p>
            <?php self::get_most_liked_users(); ?>
            
            <h3><?php _e('Most liked users (admins excluded)', 'bbpl'); ?></h3>
            <p class="howto"><?php _e('Top 10 most liked users.', 'bbpl'); ?></p>
            <?php self::get_most_liked_users(true, true); ?>
            
            <h3><?php _e('Most liking users', 'bbpl'); ?></h3>
            <p class="howto"><?php _e('Top 10 users who most use Like button.', 'bbpl'); ?></p>
            <?php self::get_most_liking_users(); ?>
            
            <h3><?php _e('Most liked posts', 'bbpl'); ?></h3>
            <p class="howto"><?php _e('Top 10 posts liked.', 'bbpl'); ?></p>
            <?php self::get_most_liked_posts(); ?>
        </div>
        <?php
    }
    
    public static function logs_screen(){
        ?>
        <div class="wrap">
            <h2><?php _e('Likes Logs','bbpl'); ?></h2>
        </div>
        <div>
        <h3></h3>
        <?php
        //Get the data
        global $wpdb;
        $table_name = $wpdb->prefix.'bbplike';
        $results = $wpdb->get_results("SELECT * FROM $table_name",ARRAY_A);
        
        if(empty($results)){
            ?>
            <p><?php _e('Sorry! Nobody has liked any post or reply yet...','bbpl'); ?></p>
            <?php
        }else{
            ?>
            <table class="likes_log_table"></table>
            <span id="flex_col_caption_0" class="hide"><?php _e('ID','bbpl'); ?></span>
            <span id="flex_col_caption_1" class="hide"><?php _e('Date','bbpl'); ?></span>
            <span id="flex_col_caption_2" class="hide"><?php _e('User','bbpl'); ?></span>
            <span id="flex_col_caption_3" class="hide"><?php _e('Post/Reply','bbpl'); ?></span>
            <span id="flex_col_caption_4" class="hide"><?php _e('Action','bbpl'); ?></span>
            <span id="flex_but_caption_1" class="hide"><?php _e('Delete like','bbpl'); ?></span>
            <?php
        }
        ?>
        </div>
        <?php
        /* OUTPUT FUNCTIONS END */
    }
}