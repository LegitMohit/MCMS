<?php
namespace App\Controller;

use App\Controller\AppController;

class DoctorsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
        $this->loadComponent('RequestHandler');
    }
    public function index()
    {
        $doctors = $this->Paginator->paginate($this->Doctors->find());
        $this->set(compact('doctors'));
    }
    
    public function addDoctors()
    {
        $doctor = $this->Doctors->newEmptyEntity();
        // Get the authenticated user
        $user = $this->request->getAttribute('identity');
        
        if ($this->request->is('post')) {
            $doctorData = $this->request->getData();
            $doctorData['userId'] = $user->userId;
            
            // Log the attempt to create a doctor
            
            $doctor = $this->Doctors->patchEntity($doctor, $doctorData);

            // Log any validation errors if they exist
            

            try {
                if ($this->Doctors->save($doctor)) {
                    $this->Flash->success(__('The doctor has been created.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The doctor could not be created. Please, try again.'));
                }
            } catch (\Exception $e) {
                // Log the detailed exception
                $this->Flash->error(__('An error occurred: ') . $e->getMessage());
            }
        }
        // Pass both doctor and user to the view
        $this->set(compact('doctor', 'user'));
    }
    public function doctorApi()
    {
        $this->RequestHandler->renderAs($this, 'json');
        $doctors = $this->Doctors->find('all');
        $this->set('doctors', $doctors);
        $this->viewBuilder()->setOption('serialize', ['doctors']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $doctor = $this->Doctors->get($id);
            if ($this->Doctors->delete($doctor)) {
                $this->Flash->success(__('The doctor has been deleted.'));
            } else {
                $this->Flash->error(__('The doctor could not be deleted. Please, try again.'));
            }
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            $this->Flash->error(__('The doctor does not exist.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
    public function edit($id = null)
    {
        $doctor = $this->Doctors->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $doctor = $this->Doctors->patchEntity($doctor, $this->request->getData());
            if ($this->Doctors->save($doctor)) {
                $this->Flash->success(__('The doctor has been updated.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The doctor could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('doctor'));
    }
}
