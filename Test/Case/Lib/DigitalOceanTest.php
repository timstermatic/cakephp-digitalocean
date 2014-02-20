
<?php
/**
 * DigitalOceanTest.php
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

App::uses('DigitalOcean', 'DigitalOcean.Lib');

class DigitalOceanTestCase extends CakeTestCase {
/**
* DigitalOcean class
* @var DigitalOcean
*/        
    public $DigitalOcean;

/**
* setUp method
*
* @return void
*/ 
    public function setUp() {
        parent::setUp();
        $this->DigitalOcean = new DigitalOcean('clientId', 'apiKey');
    }

/**
* tearDown method
*
* @return void
*/
    public function tearDown() {
        parent::tearDown();
        unset($this->DigitalOcean);
    }



/**
* Test constructor
*
* @return void
* @author Tim Roberts
 */
    public function testConstructor() {
        $this->assertEqual('clientId' , $this->DigitalOcean->clientId);
        $this->assertEqual('apiKey' , $this->DigitalOcean->apiKey);
    }
}    
