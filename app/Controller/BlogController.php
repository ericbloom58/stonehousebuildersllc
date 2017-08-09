<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// File: /app/Controller/BlogsController.php
class BlogController extends AppController {
    public $helpers = array('Html', 'Form', 'Flash');
    public $components = array('Flash');
   
     public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('about_us', 'viewHomes', 'viewHome');
    }

    public function viewHome($id) {
        $home = $this->Blog->findById($id);
        
        $folder = "files/galleries/" . $home['Blog']['linked_gallery'];
        $images = array();
       if(!empty($home['Blog']['linked_gallery']))
       {
           foreach(glob($folder.'/*.*') as $file) {
               $images[] = $file;
}
        $this->set('images', $images);
       }
        $this->set('home', $home);
    }
    public function viewHomes() {
        $homes = $this->Blog->find('all', array('conditions' => array(
            'Blog.page_type' => 'house'
        )));
        $this->set('homes', $homes);
    }
    //Code for About Us Post
//    public function about_us() {
//        $this->set('biography', $this->Blog->findById(2));
//        $this->set('mission', $this->Blog->findById(3));
//        $this->set('whatwedo', $this->Blog->findById(4));
//        $this->set('testimonials', $this->Blog->findById(5));
//    }
    //End of Code for About Us Post
    
    //Code for News Blog
    public function news()
    {
        //$this->set('posts', $this->Post->find('all', array('order' => array('created' => 'DESC'), 'limit' => 1))); //Allows Posts to be shown on front pages
        //for each available blog post, print them out according to date.
    }
    //End of Code for News Blog
    
    
    public function admin_index() {
        $this->set('blogs', $this->Blog->find('all'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid blog'));
        }

        $blog = $this->Blog->findById($id);
        if (!$blog) {
            throw new NotFoundException(__('Invalid blog'));
        }
        $this->set('blog', $blog);
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            //Added this line
            
            if ($this->Blog->save($this->request->data)) {
                $this->Flash->success(__('Your blog has been saved.'));
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
            throw new NotFoundException(__('Invalid blog'));
        }

        $blog = $this->Blog->findById($id);
        if (!$blog) {
        throw new NotFoundException(__('Invalid blog'));
        }

        if ($this->request->is(array('blog', 'put'))) {
            $this->Blog->id = $id;
            if ($this->Blog->save($this->request->data)) {
                $this->Flash->success(__('Your blog has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your blog.'));
        }

        if (!$this->request->data) {
            $this->request->data = $blog;
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

        if ($this->Blog->delete($id)) {
            $this->Flash->success(
                __('The blog with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The blog with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
   }
   
   
   public function isAuthorized($user) {
        // All registered users can add blogs
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a blog can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $blogId = (int) $this->request->params['pass'][0];
            if ($this->Blog->isOwnedBy($blogId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
