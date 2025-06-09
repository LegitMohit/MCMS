<h1>Add Doctor</h1>
<?= $this->Identity->get('userName') ?>

<?= $this->Form->create($doctor) ?>
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
<?= $this->Form->control('specialization')?>
<?= $this->Form->control('availability_hours', [
    'type' => 'select',
    'options' => [
        1 => "1 hour",
        2 => "2 hours",
        3 => "3 hours",
        4 => "4 hours",
        5 => "5 hours",
        6 => "6 hours",
        7 => "7 hours",
        8 => "8 hours",
        9 => "9 hours",
        10 => "10 hours"
    ],
    'empty' => 'Select Hours',
    'label' => 'Availability Hours',
    'class' => 'form-control',
    'required' => true
]) ?>
<?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'btn btn-primary']) ?>
<?= $this->Form->end() ?>
