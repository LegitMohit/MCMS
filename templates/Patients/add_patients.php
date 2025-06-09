<h1>Add Patient</h1>
<?= $this->Identity->get('userName') ?>

<?= $this->Form->create($patient) ?>
<?= $this->Form->control('userId', ['type' => 'hidden', 'value' => $this->Identity->get('userId')]) ?>
<?= $this->Form->control('first_name') ?>
<?= $this->Form->control('last_name') ?>
<?= $this->Form->control('phone', [
    'type' => 'number',
    'pattern' => '[0-9]{10}',
    'maxlength' => '10',
    'minlength' => '10',
    'title' => 'Please enter exactly 10 digits',
    'oninput' => 'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'
]) ?>
<?= $this->Form->control('date_of_birth', [
    'type' => 'date',
    'max' => date('Y-m-d'), // Prevents selecting future dates
    'min' => date('Y-m-d', strtotime('-150 years')), // Reasonable minimum date
    'label' => 'Date of Birth',
    'required' => true
]) ?>
<?= $this->Form->control('address') ?>
<?= $this->Form->control('medical_history') ?>
<?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
