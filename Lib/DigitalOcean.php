<?php
/**
 * DigitalOcean.php
 * Created by Tim Roberts 2014-02-20
 *
 * Licensed under the MIT License
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright   Tim Roberts 2014-02-20
 * @link        http://timstermatic.github.io
 *
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('HttpSocket', 'Network/Http');

class DigitalOceanException extends CakeException {}

class DigitalOcean {

/**
 * DigitalOcean Client ID
 * @var string
 */
    public $clientId;  

/**
 * DigitalOcean API Key
 * @var string
 */
    public $apiKey;  

/**
 * DigitalOcean endpoint
 * @var string
 */
    public $endpoint = 'https://api.digitalocean.com/';

/**
* HttpSocket class
* @var HttpSocket
*/        
    public $HttpSocket = null;

/**
 * Constructor
 *
 * @param string $clientId
 * @param string $apiKey
 * @return void
 */
    public function __construct($clientId, $apiKey) {
        $this->clientId = $clientId;
        $this->apiKey = $apiKey;
    }

/**
* Makes the HTTP Rest request
*
* @return void
**/
    public function handleRequest($request, $params=null) {

        $request .= '/?' . 'client_id=' . $this->clientId;
        $request .= '&' . 'api_key=' . $this->apiKey;

        if(!empty($params)) {
            foreach($params as $k=>$v) {
                $request .= '&' . $k . '=' . $v;
            }
        }

        if(!$this->HttpSocket) {
            $this->HttpSocket = new HttpSocket(array('ssl_verify_host'=>false));
        } 

        try {
            $response = $this->HttpSocket->request($request);
            return json_decode($response->body);
        } catch(SocketException $e) {
            throw new DigitalOceanException(__('Unable to complete the HTTP request.')); 
        }

    }

/**
 * droplets
 */
    public function droplets($id=null, $action=null, $params=array()) {
        if(!empty($id) && empty($action)) {
            // check if this is a new droplet request
            if($id == 'new') {
                // create a new droplet
                $request = $this->endpoint.'droplets/new';
            } else {
                // request a specific droplet
                $request = $this->endpoint.'droplets/' . $id;
            }
        } elseif(!empty($id) && !empty($action)) {
            // carry out an operation on a specific droplet
            $request = $this->endpoint.'droplets/' . $id . '/' . $action;
        } else {
            // list all my droplets
            $request = $this->endpoint.'droplets';
        }
        return $this->handleRequest($request, $params);
    }

/**
 * droplet regions
 */
    public function regions() {
            return $this->handleRequest($this->endpoint.'regions');
    }

/**
 * droplet sizes
 */
    public function sizes() {
            return $this->handleRequest($this->endpoint.'sizes');
    }

/**
 * images
 */
    public function images($id=null, $action=null, $params=array()) {
        if(!empty($id) && empty($action)) {
            // fetch details of a specific image
            $request = $this->endpoint.'images/' . $id;
        } elseif(!empty($id) && !empty($action)) {
            // perfom an action on an image
            $request = $this->endpoint.'images/' . $id . '/' . $action;
        } else {
            // list all available images
            $request = $this->endpoint.'images';
        }
        return $this->handleRequest($request, $params);
    }

/**
 * sshKeys
 */
    public function sshKeys($id=null, $action=null, $params=array()) {
        if(!empty($id) && empty($action)) {
            // check if this is a new droplet ssh keys
            if($id == 'new') {
                // create a new droplet
                $request = $this->endpoint.'ssh_keys/new';
            } else {
                // request a specific droplet
                $request = $this->endpoint.'ssh_keys/' . $id;
            }
        } elseif(!empty($id) && !empty($action)) {
            // carry out an operation on a specific ssh keys
            $request = $this->endpoint.'ssh_keys/' . $id . '/' . $action;
        } else {
            // list all my ssh keys
            $request = $this->endpoint.'ssh_keys';
        }
        return $this->handleRequest($request, $params);
    }

/**
 * events
 */
    public function events($id) {
            return $this->handleRequest($this->endpoint.'events/'.$id);
    }
}
