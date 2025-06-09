<?php
$this->assign('title', 'Sign Up - MCMS');
?>
<div class="users form content">
    <?= $this->Flash->render() ?>
    <h3>Sign Up</h3>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Create your account') ?></legend>
        <?= $this->Form->control('userName', [
            'label' => 'Full Name',
            'required' => true,
            'placeholder' => 'Enter your full name'
        ]) ?>
        <?= $this->Form->control('email', [
            'required' => true,
            'placeholder' => 'Enter your email address'
        ]) ?>
        <?= $this->Form->control('password', [
            'required' => true,
            'placeholder' => 'Choose a password (minimum 6 characters)'
        ]) ?>
        <?= $this->Form->control('role', [
            'options' => [
                'admin' => 'Admin',
                'patient' => 'Patient',
                'doctor' => 'Doctor'
            ],
            'empty' => '-- Select Role --',
            'required' => true,
            'label' => 'I am a'
        ]) ?>
    </fieldset>
    <?= $this->Form->button(__('Create Account'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>

    <div class="login-link" style="margin-top: 2rem; text-align: center;">
        <p>Already have an account? <?= $this->Html->link('Login here', ['action' => 'login']) ?></p>
    </div>
</div>
