<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Log\Log;
use Cake\I18n\FrozenTime;

class AppointmentsController extends AppController
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
        $appointments = $this->Paginator->paginate($this->Appointments->find()->contain(['Patients', 'Doctors']));
        $this->set(compact('appointments'));
    }
    
    public function addAppointments()
    {
        $appointment = $this->Appointments->newEmptyEntity();
        // Get the authenticated user
        $user = $this->request->getAttribute('identity');
        
        // Load the Patients model
        $this->loadModel('Patients');
        // Get all patients
        $patients = $this->Patients->find('list', [
            'keyField' => 'Patient_id',
            'valueField' => function ($patient) {
                return $patient->first_name . ' ' . $patient->last_name;
            
            }
        ])->toArray();
        
        // Load the Doctors model
        $this->loadModel('Doctors');
        // Get all doctors
        $doctors = $this->Doctors->find('list', [
            'keyField' => 'doctor_id',
            'valueField' => function ($doctor) {
                return $doctor->first_name . ' ' . $doctor->last_name . ' (' . $doctor->specialization . ')';
            }
        ])->toArray();
        
        if ($this->request->is('post')) {
            $appointmentData = $this->request->getData();
            $appointmentData['userId'] = $user->userId;
            // Set timezone to Asia/Kolkata and get current time
            date_default_timezone_set('Asia/Kolkata');
            $currentTime = FrozenTime::now();
            $appointmentData['created'] = $currentTime;
            $appointmentData['modified'] = $currentTime;
            
            // Convert appointment_date to FrozenTime
            if (!empty($appointmentData['appointment_date'])) {
                $appointmentData['appointment_date'] = new \Cake\I18n\FrozenTime($appointmentData['appointment_date']);
            }
            
            // Log the attempt to create a doctor
            Log::debug('Attempting to create appointment with data: ' . json_encode($appointmentData));
            
            $appointment = $this->Appointments->patchEntity($appointment, $appointmentData);

            // Log any validation errors if they exist
            if ($appointment->getErrors()) {
                Log::debug('Validation errors occurred: ' . json_encode($appointment->getErrors()));
            }

            try {
                if ($this->Appointments->save($appointment)) {
                    Log::info('Appointment created successfully with ID: ' . $appointment->appointment_id);
                    $this->Flash->success(__('The appointment has been created.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    Log::error('Failed to save appointment. Errors: ' . json_encode($appointment->getErrors()));
                    $this->Flash->error(__('The appointment could not be created. Please, try again.'));
                }
            } catch (\Exception $e) {
                // Log the detailed exception
                Log::error('Exception occurred while saving appointment: ' . $e->getMessage());
                Log::error('Stack trace: ' . $e->getTraceAsString());
                $this->Flash->error(__('An error occurred: ') . $e->getMessage());
            }
        }
        // Pass both doctor and user to the view
        $this->set(compact('appointment', 'user', 'patients', 'doctors'));
    }
    public function appointmentApi()
    {
        $this->RequestHandler->renderAs($this, 'json');
        $appointments = $this->Appointments->find('all');
        $this->set('appointments', $appointments);
        $this->viewBuilder()->setOption('serialize', ['appointments']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        try {
            $appointment = $this->Appointments->get($id);
            if ($this->Appointments->delete($appointment)) {
                $this->Flash->success(__('The appointment has been deleted.'));
            } else {
                $this->Flash->error(__('The appointment could not be deleted. Please, try again.'));
            }
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            $this->Flash->error(__('The appointment does not exist.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }
    
    public function edit($id = null)
    {
        try {
            $appointment = $this->Appointments->get($id, [
                'contain' => ['Patients', 'Doctors'] // Load associated data
            ]);
            
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data = $this->request->getData();
                // Debug the incoming data
                
                // Ensure we keep the original appointment ID
                $data['appointment_id'] = $id;
                $data['modified'] = \Cake\I18n\FrozenTime::now();
                // Convert appointment_date to FrozenTime
                if (!empty($data['appointment_date'])) {
                    try {
                        $data['appointment_date'] = new \Cake\I18n\FrozenTime($data['appointment_date']);
                    } catch (\Exception $e) {
                        $this->Flash->error(__('Invalid appointment date format.'));
                        return;
                    }
                }
                
                $appointment = $this->Appointments->patchEntity($appointment, $data);
                
                if ($appointment->getErrors()) {
                    $this->log('Validation errors: ' . json_encode($appointment->getErrors()), 'debug');
                }
                
                if ($this->Appointments->save($appointment)) {
                    $this->Flash->success(__('The appointment has been updated successfully.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    // Debug why save failed
                    $this->Flash->error(__('Unable to update the appointment. Please check the form and try again.'));
                }
            }

            // Get lists for dropdowns
            $patients = $this->Appointments->Patients->find('list', [
                'keyField' => 'Patient_id',
                'valueField' => function ($patient) {
                    return $patient->first_name . ' ' . $patient->last_name;
                }
            ])->toArray();
            
            $doctors = $this->Appointments->Doctors->find('list', [
                'keyField' => 'doctor_id',
                'valueField' => function ($doctor) {
                    return $doctor->first_name . ' ' . $doctor->last_name . ' (' . $doctor->specialization . ')';
                }
            ])->toArray();

            $this->set(compact('appointment', 'patients', 'doctors'));
            
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            $this->Flash->error(__('Invalid appointment ID. The appointment was not found.'));
            return $this->redirect(['action' => 'index']);
        } catch (\Exception $e) {
            $this->Flash->error(__('An error occurred while processing your request.'));
            return $this->redirect(['action' => 'index']);
        }
    }
}