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

        $request = $this->endpoint. $request;
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
                $request = 'droplets/new';
            } else {
                // request a specific droplet
                $request = 'droplets/' . $id;
            }
        } elseif(!empty($id) && !empty($action)) {
            // carry out an operation on a specific droplet
            $request = 'droplets/' . $id . '/' . $action;
        } else {
            // list all my droplets
            $request = 'droplets';
        }
        return $this->handleRequest($request, $params);
    }

/**
 * droplet regions
 */
    public function regions() {
            return $this->handleRequest('regions');
    }

/**
 * droplet sizes
 */
    public function sizes() {
            return $this->handleRequest('sizes');
    }

/**
 * images
 */
    public function images($id=null, $action=null, $params=array()) {
        if(!empty($id) && empty($action)) {
            // fetch details of a specific image
            $request = 'images/' . $id;
        } elseif(!empty($id) && !empty($action)) {
            // perfom an action on an image
            $request = 'images/' . $id . '/' . $action;
        } else {
            // list all available images
            $request = 'images';
        }
        return $this->handleRequest($request, $params);
    }

/**
 * sshKeys
 */
    public function sshKeys($id=null, $action=null, $params=array()) {
        if(!empty($id) && empty($action)) {
            // check if this is a new ssh key
            if($id == 'new') {
                // create a new droplet
                $request = 'ssh_keys/new';
            } else {
                // request a specific droplet
                $request = 'ssh_keys/' . $id;
            }
        } elseif(!empty($id) && !empty($action)) {
            // carry out an operation on a specific ssh keys
            $request = 'ssh_keys/' . $id . '/' . $action;
        } else {
            // list all my ssh keys
            $request = 'ssh_keys';
        }
        return $this->handleRequest($request, $params);
    }

/**
 * domains
 */
    public function domains($id=null, $action=null, $params=array()) {
        if(!empty($id) && empty($action)) {
            // check if this is a new domain
            if($id == 'new') {
                // create a new domain
                $request = 'domains/new';
            } else {
                // request a specific domain
                $request = 'domains/' . $id;
            }
        } elseif(!empty($id) && !empty($action)) {
            // carry out an operation on a  specific domain
            $request = 'domains/' . $id . '/' . $action;
        } else {
            // list all my domains
            $request = 'domains';
        }
        return $this->handleRequest($request, $params);
    }

/**
 * domain records
 */
    public function domainRecords($domain_id=null, $id=null, $action=null, $params=array()) {
        if(!empty($id) && empty($action)) {
            // check if this is a new domain record
            if($id == 'new') {
                // create a new domain record
                $request = 'domains/' . $domain_id . '/records/new';
            } else {
                // request a specific domain record
                $request = 'domains/' . $domain_id . '/records/' .  $id;
            }
        } elseif(!empty($id) && !empty($action)) {
            // carry out an operation on a  specific domain record
            $request = 'domains/' .$domain_id . '/records/' . $id . '/' . $action;
        } else {
            // list all my domain records
            $request = 'domains/' . $domain_id . '/records';
        }
        return $this->handleRequest($request, $params);
    }
/**
 * events
 */
    public function events($id) {
            return $this->handleRequest('events/'.$id);
    }
}
