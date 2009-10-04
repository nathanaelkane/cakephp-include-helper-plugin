# CakePHP Include Helper Plugin

A simple helper for automagically including css & js assets (PHP 5 only).

This helper will check if the following css & js files exist in your CakePHP webroot. If they do, they will be included for the current page.

- /css/&lt;controller&gt;/&lt;action&gt;.css
- /css/&lt;controller&gt;/shared.css
- /js/&lt;controller&gt;/&lt;action&gt;.js
- /js/&lt;controller&gt;/shared.js

The built-in Pages controller is supported, read the Usage Scenario 2.

## Installation

Add as a git submodule

    git submodule add git://github.com/nathanaelkane/cakephp-include-helper-plugin.git app/plugins/include_helper

Alternatively, you can manually download the plugin and place the files in /app/plugins/include_helper

### Setup in CakePHP

Setup your app\_controller.php (eg. /app/app\_controller.php)

    <?php
    class AppController extends Controller {
        public $helpers = array('Html', 'Form', 'Javascript', 'IncludeHelper.Include');
    }
    ?>

Use in your layout: (eg. /app/views/layouts/default.ctp)

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title><?= $title_for_layout ?></title>
    <?= $html->css('default') ?>
    <?= $include->includeAssets() ?>
    </head>
    <body>
        <?= $content_for_layout ?>
    </body>

## Usage Scenarios

### Scenario 1 - Posts controller with an index action

Files that will be included if they exist:

- /css/posts/index.css
- /css/posts/shared.css
- /js/posts/index.js
- /js/posts/shared.js

### Scenario 2 - Pages controller with an 'example' static view, ie. /app/views/pages/example.ctp

Files that will be included if they exist:

- /css/pages/display_example.css
- /css/pages/shared.css
- /js/pages/display_example.js
- /js/pages/shared.js
