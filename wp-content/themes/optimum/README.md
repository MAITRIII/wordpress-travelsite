== Optimum ==
Tags: white, black, two-columns, left-sidebar, right-sidebar, responsive-layout, custom-background, custom-menu, featured-images, post-formats, sticky-post, rtl-language-support, theme-options, translation-ready
Tested up to: 4.9.6
Stable tag: 3.6
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Bundled Resources ==
* Font Awesome icons, Copyright Dave Gandy
License: Font: SIL OFL 1.1, CSS: MIT License
Source: http://fontawesome.io/

* BootStrap, Copyright 2011-2014 Twitter, Inc.
Licenses: MIT
Source: http://getbootstrap.com/

* Owl Carousel, Copyright 2013-2018 David Deutsch
Licenses: MIT
Source: https://github.com/OwlCarousel2/OwlCarousel2

* jQueryAppear, Copyright 2012 Andrey Sidorov
Licenses: MIT
Source: https://github.com/morr/jquery.appear/

* jQuery meanMenu, Copyright 2012-2014 Chris Wharton @ MeanThemes
Licenses: GNU General Public
Source: https://github.com/meanthemes/meanMenu

* SmoothScrolljs, Copyright 2014 Balazs Galambosi
Licenses: MIT
Source: https://gist.github.com/galambalazs/6477177/

* VelocityJS, Copyright 2014 Julian Shapiro
Licenses: MIT
Source: http://velocityjs.org/

* HTML5 Shiv, Copyright 2014 Alexander Farkas
Licenses: MIT/GPL2
Source: https://github.com/aFarkas/html5shiv

* Respond, Copyright 2014 Scott Jehl
Licenses: MIT
Source: http://j.mp/respondjs


== License ==

Optimum WordPress Theme, Copyright 2017 Pitabas Behera. Optimum is distributed under the terms of the GNU GPL.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see http://www.gnu.org/copyleft/gpl.html.


== Description ==

Optimum is a light weight and fully responsive WordPress theme well suited for great resume, skills page, portfolio, personal and any other creative websites and blogs. It's looks great on desktops, mobiles and tablets with a tidy mobile navigation menu. Theme comes with awesome slider, social icon integration and FontAwesome. The theme support all modern browsers like Firefox, Chrome, Safari, Opera and Internet Explorer 8, 9, 10 and 11. The theme supports Multiple layouts includes single column and 2 columns. You can check out the demo at http://testbase.info/c/theme/wp/optimum/


* Fully Bootstrap Power
* FontAwesome implementation
* jQuery smoothScroll
* Setup jQuery MeanMenu and Velocity for beautiful responsive animated menu.
* Implement jQuery appear for tracking element's appearance in browser viewport.
* Implement Theme Options for customize the Theme
* A just right amount of lean, well-commented, modern, HTML5 templates.
* A helpful 404 template.
* Unique page navigation
* Custom customizer for theme colors
* Custom background image
* Custom template tags in `includes/template-tags.php` that keep your templates clean and neat and prevent code duplication.
* Some small tweaks in `includes/extras.php` that can improve your theming experience.
* Keyboard navigation for image attachment templates. The script can be found in `js/keyboard-navigation.js`. It's enqueued in `functions.php`.
* Smartly organized starter CSS in `style.css` that will help you to quickly get your design off the ground.


== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.


== Frequently Asked Questions ==


= Does Optimum support Customizer API?  =

Yes! these are the following customizer settings
* Header settings
* Colors
* Social Media
* Home Page Slider
* Other Settings

= Where is my custom menu? =

You can activate an optional custom menu under Appearance -> Menus Check Main Menu, which will be displayed beneath the header area.

= Does Optimum support widgets? =

Yes! You can add widgets under Appearance -> Widgets, and they will appear in the sidebar, beneath the header area.

= Does Optimum support Post Formats? =

Optimum supports Aside, Image, Video, Quote and Link post formats.

= How do I add Home page Slider? =

You can add Slider following these steps:

* In your admin panel, go to Appearance -> Customize
* Open the Home Page Slider Section
* Enable the 'Do you want to display slider on homepage ?' checkbox.
* Provide the require Images and Description.
* Published the customizing settings.

= Does Optimum use featured images? =

Featured Images look best at 732 pixels wide or larger.



### Version 1.9
- Removed: accessibility-ready tag and remove default value from email field.

### Version 1.8
- Fixed: Content creation issue(removed slider Button URL and Button Text fields)

### Version 1.7
- Fixed: Slider description field escaping issue.
- New: Added option field for slider Button URL and Button Text

### Version 1.6
- Fixed: Minor CSS for accessibility ready.
- Fixed: Remove Default Banner Image field and added custom header option.
- Update: In customizer changed textarea to textfield.

### Version 1.5
- Fixed: Minor CSS for responsive and accessibility ready

### Version 1.4
- Update: Update README file to keep credits and license info of all third party resources.
- Update: Added unique prefix to add_image_size.
- Fixed: In Customizer theme option several rows in option table issue.
- Fixed: All Strings should have translatable content issue.
- Update: html5.js file removed from header.php and enqueued via wp_enqueue_script.
- Fixed: Overriding WordPress globals is prohibited in template-tags.php.
- Update: All theme text strings are to be translatable
- Update: Changed language file name to optimum.pot
- Update: Use the_archive_title() to display archive title in archive templates.
- Update: All untrusted data should be escaped properly before displaying
- Update: Inside HTML attributes, use the_title_attribute() instead of the_title()
- Update: In post meta, changed date format to get_option( 'date_format' ).
- Update: Changed the page template file name with tpl-.
- Update: Removed editor-style from theme tag
- Update: Removed custom search form and use get_search_form().
- Update: Theme default color CSS

### Version 1.3
- Update: Changed FontAwesome and BootStrap import CSS to Enqueue CSS
- Update: Changed the google font importing process as like Twenty_Seventeen way.
- Update: Changed Minify scripts to unminified version
- Update: OwlCarousel 2.3.2
- Update: Theme CSS for OwlCarousel

### Version 1.2
- Update: The Options Framework to the Customizer.
- Update: Theme CSS
- Update: Font-awesome 4.7.0
- Update: OwlCarousel 2.2.1
- Update: MeanMenu
- Update: SmoothScroll v1.4.6
- Update: VelocityJS.org 1.5.0
- Update: HTML5 Shiv 3.7.3
- Update: jQuery appear 0.3.6
- New: Installed *Lora* google font
- New: Theme color switcher option

### Version 1.1
- Fixed theme Tag names, translation text-domain issue and add add_theme_support for title tag.

### Version 1.0
- Initial release.
