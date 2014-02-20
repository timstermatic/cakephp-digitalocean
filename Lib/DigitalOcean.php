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
    public function handleRequest($request) {

        $request.='/?' . 'client_id=' . $this->clientId;
        $request.='&' . 'api_key=' . $this->apiKey;

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
    public function droplets($id=null, $action=null) {
        
        if(!empty($id) && empty($action)) {
            return $this->handleRequest($this->endpoint.'droplets/' . $id);
        } elseif(!empty($id) && !empty($action)) {
            return $this->handleRequest($this->endpoint.'droplets/' . $id . '/' . $action);
        } else {
            return $this->handleRequest($this->endpoint.'droplets');
        }

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

}
