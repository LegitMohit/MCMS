<link rel="stylesheet" href="/css/edit.css">
<div class="appointments form">
    <h2>Edit Patient</h2>
    <?= $this->Form->create($patient) ?>
    <fieldset>
        <legend><?= __('Update Patient Details') ?></legend>
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
            ]);
            echo $this->Form->control('date_of_birth', [
                'type' => 'date',
                'max' => date('Y-m-d'), // Prevents selecting future dates
                'min' => date('Y-m-d', strtotime('-150 years')), // Reasonable minimum date
                'label' => 'Date of Birth',
                'required' => true
            ]);
            echo $this->Form->control('address', [
                'type' => 'text',
                'label' => 'Address',
                'required' => true
            ]);
            echo $this->Form->control('medical_history', [
                'type' => 'text',
                'label' => 'Medical History',
                'required' => true
            ]);
        ?>
   </fieldset>
    <div class="button-container">
        <?= $this->Form->button(__('Update Patient'), ['class' => 'button']) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'button cancel-btn']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>

