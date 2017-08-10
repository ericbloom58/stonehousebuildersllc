<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// File: /app/Controller/ContentsController.php
class ContentController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
   
     public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('about_us', 'viewHomes', 'viewHome');
    }

    public function viewHome($id) {
        $home = $this->Content->findById($id);
        
        $folder = "files/galleries/" . $home['Content']['linked_gallery'];
        $images = array();
       if(!empty($home['Content']['linked_gallery']))
       {
           foreach(glob($folder.'/*.*') as $file) {
               $images[] = $file;
}
        $this->set('images', $images);
       }
        $this->set('home', $home);
    }
    public function viewHomes($available = null) {
        if($available === null) {
        $homes = $this->Content->find('all', array('conditions' => array(
            'Content.page_type' => 'house'
        )));
        }
        else
        {
             $homes = $this->Content->find('all', array('conditions' => array(
            'Content.page_type' => 'house',
                 'Content.available' => 'yes'
        )));
        }
       
        $this->set('homes', $homes);
    }
    //Code for About Us Page
    public function about_us() {
        $this->set('biography', $this->Content->findById(13));
        $this->set('whybwus', $this->Content->findById(14));
        $this->set('mission', $this->Content->findById(3));
        $this->set('whatwedo', $this->Content->findById(4));
        $this->set('testimonials', $this->Content->findById(5));
    }
    //End of Code for About Us Page
    
    public function galleries($available=null) {
        if($available === null) {
        $homes = $this->Content->find('list', array(
            'fields' => array('id','linked_gallery'),
            'conditions' => array(
            'Content.page_type' => 'house'
        )));
        }
        else
        {
             $homes = $this->Content->find('list', array(
                 'fields' => array('id','linked_gallery'),
                 'conditions' => array(
            'Content.page_type' => 'house',
                 'Content.available' => 'yes'
        )));
        }

        
        $this->loadModel('Gallery');
       
        
        $galleries = $this->Gallery->find('all', array('conditions' => array('folder' => $homes)));

        foreach($galleries as $i => $gallery): 
            $log_directory = WWW_ROOT . 'files' . DS . 'galleries' . DS . $gallery['Gallery']['folder'];
                $files = array_diff(scandir($log_directory), array('.', '..'));
         //   pr($files);
    $galleries[$i]['Gallery']['first_image'] =  array_shift($files);


endforeach;

//pr($galleries); exit();
$this->set('galleries', $galleries);
    }
    
    public function gallery($id = null)
    {
        $this->loadModel('Gallery');
        $gallery = $this->Gallery->findById($id);
        $content = $this->Content->findByLinkedGallery($gallery['Gallery']['folder']);
        $this->set('content', $content);
        //pr($content);
        $galleries = $this->Gallery->find('all');
        
        $log_directory = WWW_ROOT . 'files' . DS . 'galleries' . DS . $gallery['Gallery']['folder'];
                $files = array_diff(scandir($log_directory), array('.', '..'));
         //   pr($files);
    $gallery['Gallery']['images'] =  $files;
    
    $this->set('gallery', $gallery);
    $this->set('galleries', $galleries);
    }
    //Code for News Blog
    public function news()
    {
        $this->loadModel('Blog');
        $news = $this->Blog->find('all', array(
            'order' => array(
                'created' => 'DESC'
            )
        ));
     //   pr($news); exit();
        $this->set('news', $news);
    }
    //End of Code for News Blog
    
    //Code for Home Page
    public function home()
    {
        $this->set('home', $this->Content->findById(7));
        $this->loadModel('Gallery');
        $galleries = $this->Gallery->find('all');
        $this->set('galleries', $galleries);
    }
    //End of Code for Home PAge
    //
    //Code for Build with us Pagee
    public function buildwithus()
    {
        $this->set('buildingprocess', $this->Content->findById(9));
        $this->set('stonehousedifference', $this->Content->findById(10));
        $this->set('buildonyourlot', $this->Content->findById(11));
    }
    //End of Code for Build with us Page
    
    public function admin_index() {
        $this->set('contents', $this->Content->find('all'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid content'));
        }

        $content = $this->Content->findById($id);
        if (!$content) {
            throw new NotFoundException(__('Invalid content'));
        }
        $this->set('content', $content);
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            //Added this line
            
            if ($this->Content->save($this->request->data)) {
                $this->Flash->success(__('Your content has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
        
        $directories = glob('files/galleries/*' , GLOB_ONLYDIR);
        $galleries = array(null => '{none}');
        foreach($directories as $d)
        {
            $n = explode("/", $d);
            $name = end($n);
            $galleries[$name] = $name;
        }
        $this->set('galleries', $galleries);
    }   
    
    public function admin_edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid content'));
        }

        $content = $this->Content->findById($id);
        if (!$content) {
        throw new NotFoundException(__('Invalid content'));
        }

        if ($this->request->is(array('content', 'put'))) {
            $this->Content->id = $id;
            if ($this->Content->save($this->request->data)) {
                $this->Flash->success(__('Your content has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your content.'));
        }

        if (!$this->request->data) {
            $this->request->data = $content;
        }
        $directories = glob('files/galleries/*' , GLOB_ONLYDIR);
        $galleries = array(null => '{none}');
        foreach($directories as $d)
        {
            $n = explode("/", $d);
            $name = end($n);
            $galleries[$name] = $name;
        }
        $this->set('galleries', $galleries);
   }
   
   public function admin_delete($id) {
       
        if ($this->Content->delete($id)) {
            $this->Flash->success(
                __('The content with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The content with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
   }
   
   
   public function isAuthorized($user) {
        // All registered users can add contents
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a content can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $contentId = (int) $this->request->params['pass'][0];
            if ($this->Content->isOwnedBy($contentId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}