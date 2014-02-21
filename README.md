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

In your `app` directory type:

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

### droplets

##### Create a new droplet:

    $droplet = array(
        'name' => 'example.com',
        'image_id'=>1601,
        'region_id' => 2,
        'size_id'=>66
    );

    $do->droplets('new',null,$droplet)






##### Get details for a specific droplet:

`$do->droplets(12345)`

##### Perform an action on a droplet:

Pass with an id and action to perform the requested action on that droplet. You can pass a 3rd argument which is an array of $params if they are required by the api call.

A full list of available actions is here (https://developers.digitalocean.com/)

`$do->droplets(12345, 'reboot')`


### regions

##### Fetch a list of available regions:

`$do->regions()`

### images

##### List your available images:

`$do->images()`

##### Get details for a specific image:

`$do->images(12345)`

##### Perform an action on an image:

Pass with an id and action to perform the requested action on that image. You can pass a 3rd argument which is an array of $params if they are required by the api call.

A full list of available actions is here (https://developers.digitalocean.com/)

`$do->images(12345, 'destroy')`

### SSH Keys

##### Create a new key:

    $params = array(
        'name'=>'my key',
        'ssh_pub_key'=>'xxxxxx'
    );  
    $do->sshKeys('new', null, $params);


##### Fetch a list of your keys:

`$do->sshKeys()`

##### Get a specific key:

`$do->sshKeys(12345)`

##### Perform an action on an key:

Pass with an id and action to perform the requested action on that ssh key. You can pass a 3rd argument which is an array of $params if they are required by the api call.

A full list of available actions is here (https://developers.digitalocean.com/)

`$do->sshKeys(12345, 'destroy')`


[![Build Status](https://travis-ci.org/timstermatic/cakephp-digitalocean.png?branch=master)](https://travis-ci.org/timstermatic/cakephp-digitalocean)








