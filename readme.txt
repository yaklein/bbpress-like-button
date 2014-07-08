=== bbPress Like Button ===
Tags: rate, rating, ratings, vote, votes, voting, star, like, widget, widgets, comment, comments, post, posts, page, admin, plugin, ajax, buddypress, bbpress
Requires at least: 2.6
Tested up to: 3.9.1
Stable tag: 1.5.1
Contributors: Jordi Plana
Donate link: http://jordiplana.com/go/bbpress-like-button-donation
License: GPLv2 or later

Add a Like button in all your posts and replies. Let the users appreciate others contribution.

== Description ==
**Updated to work with Wordpress 3.9.X and bbPress 2.5.X**

bbPress Like button adds automatically a **Like Button** (Youtube alike) in all your forum posts and replies. It allows users to give some greetings to others contributions. 


= Install & go =
Download, install and enable the plugin and you're ready to go. The plugin comes autoconfigured by default, and will show up automatically, using the bbPress native workflow functions. If you want to customize it feel free to look at the settings page.

= BuddyPress integration =
Enable the like button to appear on the activity stream for BuddyPress. Configure the message you want to show on the BuddyPress Activity stream, with some placeholders available for more customization.

= Flexible design =
New features were introduced to help you fitting the plugin style into your theme. You can show or hide a label of text to show next to the thumbs up icon. The texts shown on the frontend are now adjustable through the settings page.

= Translation ready =
The plugin was designed with language support from the very beginning. Some users made their own contribution by providing translation of the plugin to other languages. The plugin comes with .po files. Feel free to translate it to your language!

* English
* Macedonian (by [crazy-nomce](http://wordpress.org/support/profile/crazy-nomce))
* Persian (by [Mortaza Nazari](http://m-nazari.ir))
* Serbo-Croatian (by [Borisa Djuraskovic](http://www.webhostinghub.com))
* Spanish

= Shortcodes ready =
You can use a collection of shortcodes to embed some cool stadistics into posts, pages and widgets.

* **[most_liked_users]** and **[most_liked_users exclude_admins=true]**
* **[most_liking_users]**
* **[most_liked_posts]**

= Bug fixes =
Version 1.5 includes lots of fixes for both minor and critical issues. The most important ones are:

* Bug that was making to like more than one reply at the same time.
* [Chrome] Bug in javascript making the like counter to show as NaN
* [Firefox] Bug in javascript that was attaching new value to the end of the old like counter
* Bug not showing post/reply title on statistics.
* Bug showing post/reply ID on the logs.

= Roadmap =
The plugin is under development and it will include lots of new features on upcoming releases. Find below the list of future improvements.

* Styles collection
* Hide/Show button only on reply/original post
* Tooltips on the frontend showing information and avatars of the user who like the post
* Unlike button
* Public like (unregistered users)
* Widget for post/user with more likes
* Email notifications for users

= Official site =
For more information about this plugin you can check the [official site](http://jordiplana.com/bbpress-like-button-plugin).

= Thanks =
Thanks to Gilbert Pellegrom for his excelent [Wordpress Settings Framework](http://gilbert.pellegrom.me/wordpress-settings-framework/).

== Installation ==

1. Upload the plugin to your plugins directory.
2. Activate the plugin.
3. Enjoy!

== Screenshots ==

1. Example of the Like button showing automatically on the forums.
2. BuddyPress activity stream integration.
3. Settings page for bbPress Like Button options.
4. Logs of the user activity.
5. Statistics showing top users, posts, etc.

== Frequently Asked Questions ==

= I installed version 1.2 or 1.3 of the plugin and apparently it does not track likes =
Version 1.2 and 1.3 of the plugin had a bug on plugin activation. Is solved in version 1.4 and above. Please update your plugin

= Why does not appear the like button in the frontend? =
Plugin waits for **bbp_theme_before_reply_admin_links** action. Check your theme for this action. Another solutions is to add manually a call to the function that shows the button: **bbp_like_button()**.

= Where can I find plugin support? =
You can ask questions about the plugin in the plugin official site: [bbPress Like Button](http://jordiplana.com/bbpress-like-button-plugin)

== Upgrade notice ==
This upgrade solve some major bugs and provides more features, such as BuddyPress integration and more styling options.

== Change Log ==
= 1.5 =
* BuddyPress activity stream integration.
* Improved settings page.
* More styling options.
* Adjustable labels.
* Bug that was making to like more than one reply at the same time.
* [Chrome] Bug in javascript making the like counter to show as NaN
* [Firefox] Bug in javascript that was attaching new value to the end of the old like counter
* Bug not showing post/reply title on statistics.
* Bug showing post/reply ID on the logs.

= 1.4 =
* **MAJOR UPGRADE**
* Fixed broken plugin
* Removed custom database table creation and usage
* Moved all data saving to Wordpress native tables
* Fixed static files loading
* Rework on Like logs (removed date timestamp and sortable options for the grid)
* Code clean up
* New translation: Serbo-Croatian
= 1.3 =
* Fixed activation hook error (creating plugin table)
* Added Macedonian language
= 1.2 =
* Fixed error with the Grid (Likes Log)
* Fixed AJAX Error
* Settings page
* Data sanitization (security)
= 1.1 =
* Typo Errors
= 1.0 =
* Initial release.
