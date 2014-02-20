CakePHP DigitalOcean
====================

A CakePHP Library for interacting with the DigitalOcean API.

Spin up and destroy servers for fun & profit from your web app or the shell.

# Requirements

* CakePHP 2.x
* A DigitalOcean account (http://www.digitalocean.com).
* Your DigitalOcean Client ID and API Key.

# Installation


### git submodule

In your app directory type:

```shell
git submodule add -b master https://github.com/timstermatic/cakephp-digitalocean Plugin/DigitalOcean
git submodule init
git submodule update
```

### git clone

In your `Plugin` directory type:

```shell
git clone -b master https://github.com/timstermatic/cakephp-digitalocean Plugin/DigitalOcean
```

# Using the Plugin:

Ensure you are loading it in your `APP/Config/bootstrap,php`

Either by loading all plugins:

`CakePlugin::loadAll()`

or explicitly:

`CakePlugin::load('DigitalOcean')`

Then initialize it:

`App::uses('DigitalOcean', 'DigitalOcean.Lib');`

`$do = new DigitalOcean('YOURCLIENTID','YOURAPIKEY');`


## Available calls:

!! creating droplets will be supported soon !!

### droplets($id=null, $action=null)

List your available droplets.

`$do->droplets()`

Pass with an id of a droplet to retrieve details for that droplet:

`$do->droplets(12345)`

Pass with an id and action to perform the requested action on that droplet

`$do->droplets(12345, 'reboot')`

A full list of available actions is here (https://developers.digitalocean.com/)



[![Build Status](https://travis-ci.org/timstermatic/cakephp-digitalocean.png?branch=master)](https://travis-ci.org/timstermatic/cakephp-digitalocean)








