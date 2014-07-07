<?php

global $wpsf_settings;

// General Settings section
$wpsf_settings[] = array(
    'section_id' => 'bbpl_general',
    'section_title' => __('General Settings','bbpl'),
    'section_description' => __('Here you can adjust the plugin settings.','bbpl'),
    'section_order' => 5,
    'fields' => array(
        array(
            'id' => 'autoembed',
            'title' => __('Automatically embed button','bbpl'),
            'desc' => __('The plugin will try to automatically embed the Like Button. You can manually embed the button calling <strong>bbp_like_button()</strong> function inside the reply loop.','bbpl'),
            'type' => 'checkbox',
            'std' => 1
        ),
        array(
            'id' => 'buddypress_activity_stream',
            'title' => __('Show on BuddyPress activity stream','bbpl'),
            'desc' => __('If BuddyPress is enabled and this option is checked it will show an entry on BuddyPress activity stream every time a user clicks on the like button.','bbpl'),
            'type' => 'checkbox',
            'std' => 1
        ),
        array(
            'id' => 'show_like_button_label',
            'title' => __('Show button label','bbpl'),
            'desc' => __('If checked the plugin will show a text next to the icon.','bbpl'),
            'type' => 'checkbox',
            'std' => 0
        ),
        array(
            'id' => 'show_number',
            'title' => __('Show number of likes','bbpl'),
            'desc' => __('Show the number of likes next to the button.','bbpl'),
            'type' => 'checkbox',
            'std' => 0
        ),
        array(
            'id' => 'show_tooltip',
            'title' => __('Show tooltip','bbpl'),
            'desc' => __('Show tooltip, with people who liked, on shortcode lists output.','bbpl'),
            'type' => 'checkbox',
            'std' => 1
        ),
    )
);
$wpsf_settings[] = array(
    'section_id' => 'bbpl_labels',
    'section_title' => __('Label Settings','bbpl'),
    'section_description' => __('Adjust the labels used on the frontend. <br/>If you want to change all the other labels the plugin uses, you can do it using Poedit with the source catalog provided. <a href="http://jordiplana.com/translate-wordpress-plugin-theme-language" target="_blank">Read detailed instructions</a>','bbpl'),
    'section_order' => 6,
    'fields' => array(
        array(
            'id' => 'label_like_button_action',
            'title' => __('Like button, before click','bbpl'),
            'desc' => __('It will only show this label if <strong>Show button label</strong> option is enabled.','bbpl'),
            'type' => 'text',
            'std' => __('Like this','bbpl')
        ),
        array(
            'id' => 'label_like_button_action_done',
            'title' => __('Like button, after click','bbpl'),
            'desc' => __('It will only show this label if <strong>Show button label</strong> option is enabled.','bbpl'),
            'type' => 'text',
            'std' => __('You liked this','bbpl')
        ),
        array(
            'id' => 'label_like_button_buddypress',
            'title' => __('BuddyPress activity stream message','bbpl'),
            'desc' => __('Placeholders<ul><li>%%USERNAME%% - Public name of the user</li><li>%%TOPIC%% - Title of the topic where the like happened</li><li>%%FORUM%% - Title of the parent forum of the topic</li></ul><br/>It will only show this label if <strong>Show on BuddyPress activity stream</strong> option is enabled.','bbpl'),
            'type' => 'text',
            'std' => __('%%USERNAME%% likes a reply on %%TOPIC%%','bbpl')
        ),
    )
);
?>