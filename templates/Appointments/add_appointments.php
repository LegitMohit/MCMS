<h1>Add Appointment</h1>
<?= $this->Form->create($appointment) ?>
<?= $this->Form->control('appointment_id', ['type' => 'hidden', 'value' => $appointment->appointment_id]) ?>
<?= $this->Form->control('userId', ['type' => 'hidden', 'value' => $user->userId]) ?>
<?= $this->Form->control('Patient_id', [
    'type' => 'select',
    'options' => $patients,
    'empty' => '-- Select Patient --',
    'label' => 'Patient',
    'class' => 'form-control',
    'required' => true
]) ?>
<?= $this->Form->control('doctor_id', [
    'type' => 'select',
    'options' => $doctors,
    'empty' => '-- Select Doctor --',
    'label' => 'Doctor',
    'class' => 'form-control',
    'required' => true
]) ?>
<?= $this->Form->control('appointment_date', [
    'type' => 'datetime-local',
    'label' => 'Appointment Date and Time',
    'required' => true,
    'min' => date('Y-m-d\TH:i'), // Minimum date is today
    'class' => 'form-control'
]) ?>
<?= $this->Form->control('status', [
    'type' => 'select',
    'options' => [
        'Pending' => 'Pending',
        'Done' => 'Done'
    ],
    'empty' => '-- Select Status --',
    'class' => 'form-control',
    'required' => true
]) ?>
<?= $this->Form->control('notes') ?>
<?= $this->Form->control('created', ['type' => 'hidden', 'value' => $appointment->created]) ?>
<?= $this->Form->control('modified', ['type' => 'hidden', 'value' => $appointment->modified]) ?>
<?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
