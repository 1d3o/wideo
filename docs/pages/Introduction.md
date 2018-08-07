# Introduction

Wideo is a Wordpress theme framework that includes all you need to create awesome websites.

It uses <b>gulp task manager</b> to run tasks and compile assets, <b>browser sync</b> to syncronize and refresh browser when you are working and <b>npm</b> to manage front-end dependencies.

## File structure

- <b>./src/theme</b> : contains all files that are usually used on a Wordpress theme (style.css, screeshot.png and all .php template files).
  - <b>./src/theme/functions</b> : contains the classic functions.php content splitted on multiple files.
  - <b>./src/theme/plugin</b> : contains custom theme plugins.
- <b>./src/js</b> : contains all js modules. The gulp javascript task should take as source the main.js file.
- <b>./src/img</b> : contains all images used by the site.
- <b>./src/fonts</b> : contains all fonts used by the site.
- <b>./src/css</b> : contains all sass modules.The gulp style task shoult take as source the theme.scss and backend.scss files.

## Initialize a project

To initialize a new project you should copy the framework source code and <b>install dependencies</b>:

``` js
yarn install
```

After that you should <b>edit the style.css</b> file inside the ./src/theme directory to change the theme name:

``` css
/* ./src/theme/style.css */

/**
 Theme Name: Wideo
 Theme URI: 
 Author: ídeo
 Author URI: http://wwww.ideonetwork.it/
 Description: This is the main Wordpress theme for Website
 Version: 0.1.0
 License: GNU General Public License v2 or later
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
```

The last thing to do is to <b>change the gulp settings</b> about the dist directory and the proxy server for browser sync with your preferencies:

``` js
/* ./gulpfile.babel.js */

// ...

// Gulpfile settings.
// Update settings here.
// ***********************************************************

const distPath = '../dist' // <- change with a new path if you want
const proxy = 'http://localhost:8888' // <- change with a new url if you want

// ...
```

Now you can <b>start the development</b> or compile the project running the following commands:

``` js
npm run start // <- start the development environment
npm run dist // <- compile the template for production
```