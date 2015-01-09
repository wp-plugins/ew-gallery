=== Plugin Name ===
Contributors: kpaske
Donate link: http://www.eastwestconsultinggroup.com/plugins/
Tags: ewcg, photo, gallery, folders, video, YouTube
Requires at least: 4.0.0
Tested up to: 4.0.1
Stable tag: 1.0 Beta
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The EW Gallery Plugin allows you to organize photos and YouTube videos on your WordPress website into folders and display each folder in its own Jssor slider with advanced customization settings.

== Description ==

The East West (EW) Gallery Plugin allows you to organize photos and YouTube videos on your WordPress website into folders and display each folder in its own Jssor slider.  Customization settings allow you to tailor the fonts, borders, colors, backgrounds and photo sizes to match your website theme.  There is also an option to display only the content from a single folder in a slideshow page (without the index links).

== Installation ==

1. Upload the contents of the `ew_gallery` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create new folders (“galleries”) by selecting “New EW Gallery” from the “EW Gallery” tab.  The EW Gallery supports both photo uploads and links to YouTube videos.
4. Insert shortcode into your pages to display your galleries.
5. Multiple galleries can be displayed using the following format:

[EWGallery_display gallery_ids=100,200,300]

6. A single gallery slideshow can be displayed (with no index) using the following format:

[EWGallery_display hideindex="true" gallery_id=400]

7. Gallery ids are displayed on the gallery index page by selecting “EW Galleries” from the “EW Gallery” tab.
8. Configure the display settings by selecting “EW Gallery Settings” from the “EW Gallery” tab.  Detailed descriptions of each setting are explained further in the “EW Gallery Settings” section of this readme below.

== Frequently Asked Questions ==

= How do I report bugs or make feature requests for new versions? =

Bugs and feature requests may be reported to info@eastwestconsultinggroup.com.

== Screenshots ==

1. This screen shot description corresponds to ew_gallery_screenshot1.png.

This first screenshot shows what the index of folders looks like.  Each thumbnail displays the first file in each folder.

2. This screen shot description corresponds to ew_gallery_screenshot2.png.

This second screenshot shows the slider page displaying the images from a single folder, with the index enabled to easily navigate between folders.

== Changelog ==

= 1.0 =

* Initial release.

== Upgrade Notice ==

== EW Gallery Settings ==

Following are detailed descriptions of each of the EW Gallery Settings:

= Gallery Index Settings =

Index Margin - The margin around the folder index.  This field accepts standard CSS margin values, i.e. "10px", "10px 5px", "10px 5px 0px 5px", "auto", etc.
Index Padding - The padding around the folder index.
Index Alignment - This setting determines how the index is aligned on the page.

= Gallery Thumbnail Settings =

Thumbnail Width - This is total width of the Index Thumbnails, including the border.  So for example, if you want the image to be 150px wide with a 3px border, set the width at 156px (3px + 150px + 3px).
Thumbnail Margin - This is the margin around each Index Thumbnail.
Thumbnail Padding - This setting applies to the padding around each Index Thumbnail.
Thumbnail Alignment - This setting will determine whether the thumbnails are aligned to the left, center, or right side of the page.
Thumbnail Border Style - The border around each thumbnail can be solid, dotted, or no border.
Thumbnail Border Width - The width of the border around each thumbnail.
Thumbnail Border Color - The thumbnail border color.
Thumbnail Border Radius - For rounded corners, use this setting.  For square thumbnails, set to 0px.

= Slider Settings =

Slider Wrapper Width - This setting applies to the maximum width of the container used for the slider and sets the maximum width of the slider and border.  In most cases it is best to set this as a percentage of the page container width, i.e. 80% or 100%, so that the slider will resize properly for different page resolutions.
Slider Wrapper Height - The settings applies to the maximum height of the container used for both the slider and thumbnails (inside the border).  The elements inside will adjust to fit inside this height and should be set appropriately for the highest supported resolution, 
Slider Width - The setting applies to the maximum internal width of the slider and thumbnails.  This should be set for the largest width at the highest supported resolution, such as 800px.
Slider Image Height - This setting applies to the height of the slider image.  This should be set to the Wrapper Height, minus the border and thumbnail heights.
Slider Margin - This setting applies to the margin around the slider and should usually be set to auto.
Slider Padding - This setting will create padding around the inside of the slider and is usually set to 0px.
Slider Border Style - Select a solid or dotted border, or no border.
Slider Border Width - Select the border width in pixels.
Slider Border Color - Select the color of the border around the slider.
Slider Border Radius - Use this setting for rounded corners.
Slider Background Color - This is the background color behind the slider photos and thumbnails.
Slider Background Transparent - Check this box to override the background color and use a transparent background.

= Slideshow Settings =

Autoplay Slides - Select this setting to cause the slideshow to start automatically.
Slide Duration - This is the length of time in milliseconds that each slide will display before scrolling.
Autoplay Delay - This is the length of time to wait before the slideshow starts if autoplay is selected.

= Index Link Settings =

Index Link Color - This is the font color of the index (folder) entries.
Index Link Hover Color - This is the color that will be used to highlight index entries when the user hovers their cursor over them.  It is also used as the separator color between index entries.

= Index Font Settings =

Index Font Size - This is the font size for standard resolution displays.
Index Font Size (Mobile Layout) - This is the font size used for mobile displays.
Index Font Family - This is the font family used for the index (folder) links.
