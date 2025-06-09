<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\FrozenTime;
use App\Utility\Mailer;
// use Cake\I18n\Time;
// use DateTime;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler');
    }
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        
        if ($this->request->is('post')) {
            $result = $this->Authentication->getResult();
            
            // If the user is logged in send them away.
            if ($result->isValid()) {
                return $this->redirect(['controller' => 'home', 'action' => 'index']);

            }
            // Display error if user submitted and authentication failed
            $this->Flash->error('Invalid username or password');
        }
    }
    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'home', 'action' => 'index']);
    }
    public function index()
    {
        $users = $this->Paginator->paginate($this->Users->find());
        $this->set(compact('users'));
    }
    public function signup()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $userData = $this->request->getData();

            // Check if email already exists
            $emailExists = $this->Users->exists(['email' => $userData['email']]);
            if ($emailExists) {
                $this->Flash->error(__('Email already exists. Please use a different email.'));
            } else {
                // Remove userId before patching
                unset($userData['userId']);
                
                // Set timezone to Asia/Kolkata and get current time
                date_default_timezone_set('Asia/Kolkata');
                $currentTime = FrozenTime::now();
                $userData['created'] = $currentTime;
                $userData['modified'] = $currentTime;
                
                // Patch the entity with user input data
                $user = $this->Users->patchEntity($user, $userData);

                // Generate and set userId directly
                do {
                    $randomId = mt_rand(1000, 9999);
                    $exists = $this->Users->exists(['userId' => $randomId]);
                } while ($exists);
                
                // Set userId directly
                $user->userId = $randomId;

                try {
                    if ($this->Users->save($user)) {
                        // Initialize mailer and send welcome email
                        $mailer = new Mailer();
                        $emailSent = $mailer->sendWelcomeEmail($userData['email'], $userData['userName'], $userData['role']);
                        
                        if ($emailSent) {
                            $this->Flash->success(__('Your account has been created and a welcome email has been sent.'));
                        } else {
                            $this->Flash->success(__('Your account has been created, but we could not send the welcome email.'));
                            error_log("Failed to send welcome email to: " . $userData['email']);
                        }
                        
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The user could not be saved. Please, try again.'));
                    }
                } catch (\Exception $e) {
                    // Handle any exception (e.g., database errors)
                    $this->Flash->error(__('An error occurred: ') . $e->getMessage());
                }
            }
        }
        $this->set(compact('user'));
    }
    public function userApi()
    {
        $this->RequestHandler->renderAs($this, 'json');
        $users = $this->Users->find('all');
        $this->set('users', $users);
        $this->viewBuilder()->setOption('serialize', ['users']);
    }
    public function view($id = null)
    {
        $this->RequestHandler->renderAs($this, 'json');
        
        try {
            $user = $this->Users->get($id);
            $this->set('user', $user);
            $this->viewBuilder()->setOption('serialize', ['user']);
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            $this->response = $this->response->withStatus(404);
            $this->set('error', [
                'message' => 'User not found',
                'code' => 404
            ]);
            $this->viewBuilder()->setOption('serialize', ['error']);
        }
    }
}