=== Search & Filter ===
Contributors: DesignsAndCode
Donate link: 
Tags: category, filter, taxonomy, search, wordpress
Requires at least: 3.5
Tested up to: 3.6
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Search and Filtering for Custom Posts, Categories, Tags and Taxonomies

== Installation ==

1. Upload the entire `search-filter` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

You will find 'Search & Filter' menu in your WordPress admin panel.

For basic usage, you can also have a look at the [plugin homepage](http://www.designsandcode.com/447/wordpress-search-filter-plugin-for-taxonomies/) or refer to the `Search & Filter` menu in your Wordpress admin panel.

== Frequently Asked Questions ==

= Some text/headings/labels for my different Taxonomies seem to be broken or don't appear correctly =

Search & Filter uses the Taxonomy object and its label properly, this means when registering custom taxonomies make sure you fill out valid values for the following labels:

* name
* singular_name
* search_items
* all_items

If you have used a plugin to register a custom taxonomy this info can normally be found under advanced settings.

== Screenshots ==

1. Full example of Search & Filter when used in a widget and with a combination of checkboxes, radio buttons and selects
2. Minimal example of Search & Filter embedded in the header
3. Minimal example of Search & Filter embedded in a widget

== Changelog ==

= 1.1.1 =
* Fixed: when submitting an empty search/filter, "?s=" now gets appended to the url (an empty search) to force load a results page, previously this was redirecting to the homepage which does not work for many use cases

= 1.1.0 =
* Added support for checkboxes and radio buttons, with the option to control this for each individual taxonomy.
* Added support to show or hide headings for each individual taxonomy.
* Added support to pass a class name through to Search & Filter widgets, this allows styling of different instances of Search & Filter
* Fixed problems with escaping output in search box
* Notice: This update will automatically add headings to taxonomy dropdowns, refer to usage and examples on how to disable them.

= 1.0.3 =
* Added some documention & screenshots to plugin page

= 1.0.2 =
* Version bump for WordPress plugins site

= 1.0.1 =
* Updated to use `label->all_items` in taxonomy object for dropdowns before using `label->name`
* Notice: This update may cause some labels to break, ensure you have set up your taxonomy properly including setting `label->all_items`

= 1.0.0 =
* Initial Release

== Upgrade Notice ==

Upgrade should be fully compatible with previous versions, however this update will automatically add headings to taxonomy dropdowns, refer to usage and examples on how to disable them.

== Description ==

Search & Filter is a simple search and filtering plugin for WordPress.  It is essentially an advancement of the WordPress search box, adding taxonomy filters to really refine your searches.

You can search by Category, Tag, Custom Taxonomy or any combination of these easily - you can even remove the search box and simply use it as a filtering system for your posts and pages.  Taxonomies can be displayed as dropdown selects, checkboxes or radio buttons.

For advanced usage & examples head over to the [plugin homepage](http://www.designsandcode.com/447/wordpress-search-filter-plugin-for-taxonomies/).

