<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
// app/Controller/AppController.php
class AppController extends Controller {
    //...

   public $components = array(
        'Flash',
       'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'index', 'admin' => true),
            'logoutRedirect' => array('controller' => 'pages','action' => 'display','home'),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            'authorize' => array('Controller') // Added this line
        )
    );

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

    // Default deny
        return false;
    }

    public function beforeFilter() {
        $this->Auth->allow('index', 'view', 'display', 'home', 'about_us', 'news', 'galleries', 'buildwithus', 'gallery');
		
        
        
	Router::connect('/', array('controller' => 'content', 'action' => 'home'));
        Router::connect('/about', array('controller' => 'content', 'action' => 'about_us'));
        Router::connect('/news', array('controller' => 'content', 'action' => 'news'));
        Router::connect('/blog', array('controller' => 'content', 'action' => 'news'));
        Router::connect('/galleries', array('controller' => 'content', 'action' => 'galleries'));
        Router::connect('/buildwithus', array('controller' => 'content', 'action' => 'buildwithus'));
    }
    
    public function beforeRender() {
        if ($this->request['prefix'] == 'admin' || $this->request['prefix'] == 'ajax')
			$this->layout = $this->request['prefix'];
        $this->set('section', 'web');
    }
    //...
}