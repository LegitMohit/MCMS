<?php
namespace App\Controller;

use App\Controller\AppController;

class PatientsController extends AppController
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
        $patients = $this->Paginator->paginate($this->Patients->find());
        $this->set(compact('patients'));
    }
    
    public function addPatients()
    {
        $patient = $this->Patients->newEmptyEntity();
        // Get the authenticated user
        $user = $this->request->getAttribute('identity');
        
        if ($this->request->is('post')) {
            $patientData = $this->request->getData();
            $patientData['userId'] = $user->userId;
            
            $patient = $this->Patients->patchEntity($patient, $patientData);

            try {
                if ($this->Patients->save($patient)) {
                    $this->Flash->success(__('The patient has been created.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The patient could not be created. Please, try again.'));
                }
            } catch (\Exception $e) {
                $this->Flash->error(__('An error occurred: ') . $e->getMessage());
            }
        }
        // Pass both patient and user to the view
        $this->set(compact('patient', 'user'));
    }
    public function patientApi()
    {
        $this->RequestHandler->renderAs($this, 'json');
        $patients = $this->Patients->find('all');
        $this->set('patients', $patients);
        $this->viewBuilder()->setOption('serialize', ['patients']);
    }

    public function view($id = null)
    {
        $this->RequestHandler->renderAs($this, 'json');
        
        try {
            $patient = $this->Patients->get($id);
            $this->set('patient', $patient);
            $this->viewBuilder()->setOption('serialize', ['patient']);
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            $this->response = $this->response->withStatus(404);
            $this->set('error', [
                'message' => 'Patient not found',
                'code' => 404
            ]);
            $this->viewBuilder()->setOption('serialize', ['error']);
        }
    }

    public function add()
    {
        $this->RequestHandler->renderAs($this, 'json');
        
        if (!$this->request->is('post')) {
            $this->response = $this->response->withStatus(405);
            $this->set('error', [
                'message' => 'Method not allowed',
                'code' => 405
            ]);
            $this->viewBuilder()->setOption('serialize', ['error']);
            return;
        }

        $patient = $this->Patients->newEmptyEntity();
        $patientData = $this->request->getData();
        
        // Get the authenticated user if available
        $user = $this->request->getAttribute('identity');
        if ($user) {
            $patientData['userId'] = $user->userId;
        }

        $patient = $this->Patients->patchEntity($patient, $patientData);

        try {
            if ($this->Patients->save($patient)) {
                $this->response = $this->response->withStatus(201); // Created
                $this->set('patient', $patient);
                $this->viewBuilder()->setOption('serialize', ['patient']);
            } else {
                $this->response = $this->response->withStatus(400);
                $this->set('error', [
                    'message' => 'Validation failed',
                    'errors' => $patient->getErrors(),
                    'code' => 400
                ]);
                $this->viewBuilder()->setOption('serialize', ['error']);
            }
        } catch (\Exception $e) {
            $this->response = $this->response->withStatus(500);
            $this->set('error', [
                'message' => 'An error occurred while creating the patient',
                'code' => 500
            ]);
            $this->viewBuilder()->setOption('serialize', ['error']);
        }
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $patient = $this->Patients->get($id);
            if ($this->Patients->delete($patient)) {
                $this->Flash->success(__('The patient has been deleted.'));
            } else {
                $this->Flash->error(__('The patient could not be deleted. Please, try again.'));
            }
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            $this->Flash->error(__('The patient does not exist.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
    public function edit($id = null)
    {
        $patient = $this->Patients->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $patient = $this->Patients->patchEntity($patient, $this->request->getData());
            if ($this->Patients->save($patient)) {
                $this->Flash->success(__('The patient has been updated.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The patient could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('patient'));
    }
}
