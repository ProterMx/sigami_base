WordPress Skeleton
===================

This WordPress Theme is a combination of 320Press WordPress Boostrap and Roots theme. 

I read all code of both themes and got the best from them.

GETTING STARTED
_______________

To get started, open Terminal or a command prompt and run:

	cd path/to/wp-content/themes
	git clone https://github.com/sigami/sigami_base.git
	npm install
	bower install
	grunt dev

How it works
____________

`npm install` Downloads the node modules necessary to run the grunt tasks.
`bower install` Downloads all dependencies: JavaScript and CSS into vendor folder
`grunt dev` Runs a watch for all less files or js.

After you installed the theme, and run `grunt dev`, all less files or js files you modify inside library/ will be compressed into one library/dist/css/jutzu.css and library/dist/js/jutzu.min.js using grunt.

All Bootstrap JavaScript is included

Extra Dependencies included 
___________________________

* Font Awesome
* Animate.css
* WOW

Multi-Lingual
_____________

Translated in 7 languages - Spanish, French, Portuguese, Italian, Dutch, Swedish and German. 

Page Templates
______________

We’ve packaged four different page templates into this theme.

    - Homepage template 
    - Standard page with right sidebar 
    - Page with left sidebar
    - Full width page


Sidebars
________

There are two different sidebars. One for the homepage and one for the other pages. Add widgets to them.
