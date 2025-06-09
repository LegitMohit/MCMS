<?php
    namespace App\Controller;

    use App\Controller\AppController;

    class HomeController extends AppController
    {
        public function beforeFilter(\Cake\Event\EventInterface $event)
        {
            parent::beforeFilter($event);
            // Allow index action to be accessed without authentication
            $this->Authentication->addUnauthenticatedActions(['index']);

        }

        public function index()
        {
            $this->set('title', 'Home');
            // Get the authenticated user data and pass it to the view
            $user = $this->Authentication->getIdentity();
            $this->set(compact('user'));
        }
    }
?>
