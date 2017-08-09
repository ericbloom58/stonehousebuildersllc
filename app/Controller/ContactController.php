<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class ContactController extends AppController {
    
    function beforeFilter() {
        $this->Auth->allow(array('contact'));
    }
    
    function contact(){
        
        
        if (!empty($this->request->data['Contact'])) {
            $message = "New Website Contact! <br /><br />";
        $message .= "Name: " . $this->request->data['Contact']['name'];
        $message .= "<br />Email: " . $this->request->data['Contact']['email'];
        $message .= "<br />Subject: " . $this->request->data['Contact']['subject'];
        $message .= "<br />Message: " . $this->request->data['Contact']['message'];
        $message .= "<br /><br />You can respond directly to the customer by replying to this email.";

        $email = new CakeEmail('default');
        
        $email->emailFormat('html')
                ->to("eric@net2sky.com")
                ->replyTo(trim($this->request->data['Contact']['email']))
                ->subject('New Website Contact!');
               $error = false;
                try{$email->send($message); }
                catch(Exception $e)
                {
                    $error = true;
   
                }
                
                $email->to('eric@net2sky.com');
                try{$email->send($message); }
                catch(Exception $e)
                {
                   $error = true;
   
                }
                
        
            
            
         if($error)
                   $this->Session->setFlash('An error has occurred in sending!');
         else
             $this->Session->setFlash('Your message has been sent successfully!');
        
            $this->redirect("/pages/contactus");
       
        }
        exit();
    }
    
}