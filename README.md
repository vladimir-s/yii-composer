yii-composer
============

### Simple Yii + Composer + Imagine application

The application shows basic usage of [Yii framework](http://www.yiiframework.com/), [Composer](http://getcomposer.org/) and [Imagine](https://github.com/avalanche123/Imagine) library. It allows to upload photos and automatically create thumbnails for them.

Installation
============

1. Create a folder under DOCUMENT_ROOT of your server (e.g. yii-composer).
2. Clone this repo to the folder `git clone https://github.com/vladimir-s/yii-composer.git .`
3. Run `composer install` (this command will download all dependencies). You should install [Composer](http://getcomposer.org/) before running this command.
3. Create database and set its credentials in `public_html/protected/config/main.php` and `public_html/protected/config/console.php`.
4. Run `yiic migrate` from the folder `public_html/protected/` (this command will create images table in the database).

Usage
=====

1. Open `http://localhost/yii-composer/public_html/index.php` and login with `admin/admin`.
2. Go to `http://localhost/yii-composer/public_html/index.php?r=images/create` to upload image.