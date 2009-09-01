# CakePHP Include Helper Plugin

A simple helper for automagically including css & js assets (PHP 5 only)

## Example usage:

Extract the plugin to your CakePHP plugin directory, eg. .../project/app/plugins/include\_helper/

Setup your app\_controller.php (eg. .../project/app/app\_controller.php)

    <?php
    class AppController extends Controller {
        public $helpers = array('Html', 'Form', 'Javascript', 'IncludeHelper.Include');
    }
    ?>

Use in your layout: (eg. .../project/app/views/layouts/default.ctp)

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <title><?= $title_for_layout?></title>
    <?= $html->css('default') ?>
    <?= $include->includeAssets() ?>
    </head>
    <body>
        <?= $content_for_layout ?>
    </body>
    </html>
