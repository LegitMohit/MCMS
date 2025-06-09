<link rel="stylesheet" href="/css/edit.css">
<div class="appointments form">
    <h2>Edit Appointment</h2>
    <?= $this->Form->create($appointment) ?>
    <fieldset>
        <legend><?= __('Update Appointment Details') ?></legend>
        <?php
            echo $this->Form->control('Patient_id', [
                'options' => $patients,
                'empty' => 'Select Patient',
                'label' => 'Patient'
            ]);
            echo $this->Form->control('doctor_id', [
                'options' => $doctors,
                'empty' => 'Select Doctor',
                'label' => 'Doctor'
            ]);
            echo $this->Form->control('appointment_date', [
                'type' => 'datetime-local',
                'label' => 'Appointment Date and Time',
                'required' => true,
                'min' => date('Y-m-d\TH:i'),
                'value' => $appointment->appointment_date ? $appointment->appointment_date->format('Y-m-d\TH:i') : '',
                'class' => 'form-control'
            ]);
            echo $this->Form->control('status', [
                'type' => 'select',
                'options' => [
                    'Pending' => 'Pending',
                    'Done' => 'Done',
                ],
                'empty' => 'Select Status'
            ]);
            echo $this->Form->control('notes', [
                'type' => 'textarea',
                'label' => 'Notes'
            ]);
        ?>
    </fieldset>
    <div class="button-container">
        <?= $this->Form->button(__('Update Appointment'), ['class' => 'button']) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'button cancel-btn']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>

