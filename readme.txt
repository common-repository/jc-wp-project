=== Jc Wp Project ===
Contributors: mbstef
Donate link: http://www.jacomeit.com/archiv/jc-wp-project
Tags: project,status
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: 1.0.1

Insert project status progressbar into posts/pages or as widget on simple way. 
Works with custom fields and shortcodes.

== Description ==

Für eine deutsche Beschreibung besuchen Sie bitte 
[die Autor-Seite](http://www.jacomeit.com/archiv/jc-wp-project/)

If you write an project article / a project page and would like insert a simple 
progressbar to show the status of the project, this plugin will be yours.

Insert on an article / a page simply a custom field with name jcProjectStatus 
and a percentile value between 1 and 100, and/or another custom field with the 
name jcProjectExcerpt with a short description of the project as value.

After then put the shortcode [jcWpProjectStatus] in the editor where you want 
to locate the progressbar in the post and on the frontend will show a animate 
progressbar with your percentile status of work.

Futher you can make a page (or article) to show a listing of all public projects
with the status of each project and also the linked title to the post of them. 
Doing this with the shortcode [jcWpProjects] into the editor where you want to 
locate the listing.

A sidebar widget completes the plugin, where you can show animate little 
progressbars for each active project with linked title to the post. You can set 
it to show all active projects or a choose amount of them.

== Installation ==

Simply upload the plugin to the plugin dir of wordpress and activate it.

You can use the custom fields on the articles / pages and shortcodes to show the 
progressbar or use the Sidebar - widget to show a listing of your active 
projects.

If you want to show a progressbar on a post, set in the custom fields a new 
combination with name "jcProjectStatus" and the percentile value between 1 and 
100. Put the shortcode [jcWpProjectStatus] into the article where you want to 
locate the animate progressbar.

If you want to show a listing of all active projects (public posts), put the 
shortcode [jcWpProjects] into the article where you want to showing the li-
listing with all active projects each with linked title to the post and animate
progressbar.

== Frequently Asked Questions ==

= How use it in articles/pages? =

Put in the custom field the name "jcProjectStatus" and into the value the 
percentile number between 1 and 100 for the project-status.

Into the article you can show the progressbar of this project with the 
shortcode [jcWpProjectStatus] there where the shortcode locate.

For using the project-listing you can describe the project with a short 
description into a new custom field with name "jcProjectExcerpt" and the 
description into the value of them.

= How i can show a project-listing of all active projects? =

Put the shortcode [jcWpProjects] into the editor of the post, where the 
project-listing should be shown.

= How i use the sidebar widget? =

After you put the widget on any sidebar, you can give them a title and 
set the number of shown projects-progressbars on this. If you want to 
show all, select "all".

= How i can change the color of the progressbar? =

Into the plugin directory are the css-folder, where an excerpt of the jqeryui
CSS of Redmond style located. The used images of the css are located in the 
folder images. Change the image images/ui-bg_gloss-wave_55_5c9ccc_500x100.png 
with 500 pixel width and 100 pixel height in this color what you want and 
replace it in this folder. 

== Screenshots ==

1. screenshot-1.png
2. screenshot-2.png
3. screenshot-3.png

== Changelog ==

= Version 1.0.1 = 

* Change the wrong author url

= Version 1.0 =

* Final version of the plugin with all basic functions
