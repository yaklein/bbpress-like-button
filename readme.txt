=== bbPress Like Button ===
Tags: rate, rating, ratings, vote, votes, voting, star, like, widget, widgets, comment, comments, post, posts, page, admin, plugin, ajax, buddypress, bbpress
Requires at least: 2.6
Tested up to: 3.5
Stable tag: 1.0
Contributors: Jordi Plana

Add a Like button in all your posts and replies. Let the users appreciate others contribution.

== Description ==
bbPress Like button adds automatically a **Like Button** (Youtube alike) in all your forum posts and replies. It allows users to give some greetings to others contributions. 

= AJAX ready =
The plugin is designed to interact via AJAX in both sides: dashboard and frontend.

= Shortcodes =
You can use a collection of shortcodes to embed some cool stadistics into posts, pages and widgets.

* **[most_liked_users]** and **[most_liked_users exclude_admins=true]**
* **[most_liking_users]**
* **[most_liked_posts]**

= CSS3 and HTML5 =
All that prints the plugins is CSS3 and HTML5 compliant.

= Languages =
bbPress Like Button is currently in:

* English
* Spanish

The plugin comes with .po files. Feel free to translate it to your language!

= TODO/Wishlist =
**Dashboard**

* export likes log to CSV
* reply/post list view column with like number in the dashboard
* reset logs button
* add do_action and apply_filters
* Option: enable/disable tooltip
* Option: allow anonymous vote (ip)
* Option: allow like only replies (exclude OP)
* Option: automatically embed

**Frontend**

* icons set
* public unlike?
* widget most liked post/user
* show number of likes

= Official site =
For more information about this plugin you can check the [official site](http://jordiplana.com/bbpress-like-button-plugin).

== Installation ==

1. Upload the plugin to your plugins directory.
2. Activate the plugin.
3. Enjoy!

== Screenshots ==

1. Likes Log Screen. You are able to see all likes in a fancy grid.
2. Likes Stadistics. This screen shows top 10 users
3. Example of Like Button


== Frequently Asked Questions ==

= Why does not appear the like button in the frontend? =
Plugin waits for **bbp_theme_before_reply_admin_links** action. Check your theme for this action. Another solutions is to add manually a call to the function that shows the button: **bbp_like_button()**.

= Where can I find plugin support? =
You can ask questions about the plugin in the plugin official site: [bbPress Like Button](http://jordiplana.com/bbpress-like-button-plugin)

== Change Log ==
= 1.0 =
* Initial release.
= 1.1 =
* Typo Errors