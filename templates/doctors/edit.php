<link rel="stylesheet" href="/css/edit.css">
<div class="appointments form">
    <h2>Edit Doctor</h2>
    <?= $this->Form->create($doctor) ?>
    <fieldset>
        <legend><?= __('Update Doctor Details') ?></legend>
        <?php
            echo $this->Form->control('first_name', [
                'type' => 'text',
                'label' => 'First Name',
                'required' => true
            ]);
            echo $this->Form->control('last_name', [
                'type' => 'text',
                'label' => 'Last Name',
                'required' => true
            ]);
            echo $this->Form->control('phone', [
                'type' => 'number',
                'pattern' => '[0-9]{10}',
                'maxlength' => '10',
                'minlength' => '10',
                'title' => 'Please enter exactly 10 digits',
                'oninput' => 'javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);'
            ]) ;
            echo $this->Form->control('specialization', [
                'type' => 'text',
                'label' => 'Specialization',
                'required' => true,
                'class' => 'form-control'
            ]);
            echo $this->Form->control('availability_hours', [
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
            ]);
        ?>
    </fieldset>
    <div class="button-container">
        <?= $this->Form->button(__('Update Doctor'), ['class' => 'button']) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'button cancel-btn']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
