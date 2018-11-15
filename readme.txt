=== SPF + Hail ===
Requires at least: 4.9
Tested up to: 4.9.6
Requires PHP: 5.3
License: GPL 2.0
License URI: https://github.com/JordanNZ/Hail/blob/master/LICENSE.txt

Plugin that allows for page content to be pulled from the Hail API through to the website using shortcodes, metaboxes etc.

== Changelog ==
1.0.11 - 2018-06-01
 - Added plugin version checking

1.0.10 - 2018-05-31
 Bit of a bump in the old version numbers there but some significant changes were made...

  - Updated class-spf-hail-public.php so articles are pulled through by article id instead of private tag id.
  - Updated spf-hail-admin-display.php to display a list of article id\'s if an organization is set.
  - Updated the template page so the template names are clear and also updated the shortcodes.
  - Updated metabox-spf-hail.php so the dropdowns pull articles instead of private tag ids.

1.0.6 - 2018-05-25
Update
  - Small maintenance update to address images being cropped in the gallery.

1.0.5 - 2018-03-08
Added
  - Updated the plugin to be more structured using A WP Plugin framework
  - Re-added hail_hero as made no sense to remove it


1.0.1 - 2018-03-01
Removed
  - Removed hail_hero and merged with hail_page
Added
  - Added Uikit Lightbox support
  - Added changelog.MD to git
  - Merged hail_hero to hail_page to work as an attribute instead of stand alone short code.
  

1.0 - 2018-02-01
Added
  - Created Plugin to work with hail connector.
  - README.MD created to show avaliable short codes and version details.
  - Added support for hero images
