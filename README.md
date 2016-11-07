=================
OKFN WordPress Theme
=================

OKFNWP is a WordPress theme built on Bootstrap and LESS.

Getting Started
---------------
**You'll need the following installed before continuing:**
  * [Node.js](http://nodejs.org): Use the installer provided on the NodeJS website.
  * [Grunt](http://gruntjs.com/): Run `[sudo] npm install -g grunt-cli`
  * [Bower](http://bower.io): Run `[sudo] npm install -g bower`

To get started run:

`npm install && bower install && grunt watch`


Templates
---------

**Homepage**

The homepage template is a regular full-width content page. Use the `[latestposts]` shortcode to display the latest blog posts.


Shortcodes
----------

**Latest Blog Posts**

To add a 3-column row of the latest blog posts, use:

  `[latestposts]`

To change the section heading from the default 'Latest posts from the blog', pass in a title="" parameter:

`[latestposts title="Recent Posts"]`

Multilingual content
--------------------

We recommend that you use [Polylang](https://wordpress.org/plugins/polylang/) with this theme.

Install and activate the plugin, and add some languages in the Settings > [Languages](https://polylang.pro/doc/create-languages/). Make sure you **first enter the language your content is written in**. Then, enter all additional languages you plan to use.

If this is the first time you activate Polylang on your site, you will be asked if you'd like to convert all existing posts to the default language - meaning, assing the default language to these posts. That will save you a lot of time and we recommend it. It might take a bit longer to complete, on larger web sites or slower servers.

Once the conversion is complete, you should set **URL modifications** and **Synchronization** in Settings > Languages > Settings. These settings may vary and depend on your prefference.

In case you're synchronizing you categories, tags or any other meta content types, you should translate all of those so that the correct meta is matched when creating content in different languages.

If you're already using WPML, you can easily migrate to Polylang with the [WPML to Polylang](https://wordpress.org/plugins/wpml-to-polylang/) plugin.
