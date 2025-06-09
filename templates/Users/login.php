<?php
$this->assign('title', 'Login ');
?>
<div class="users form content">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login'), ['class' => 'button']); ?>
    <?= $this->Form->end() ?>

    <div class="login-link" style="margin-top: 2rem; text-align: center;">
    <p>Don't have an account? <?= $this->Html->link('Sign up here', ['action' => 'signup']) ?></p>
</div>  
</div>