<?php
$this->assign('title', 'Home');
?>

<div class="home-content">
    <!-- Hero Section -->
    <div class="hero">
    <h1>Welcome to Medical Clinic Management System</h1>
        <p class="lead">Streamlining healthcare management for better patient care</p>
        <?php if (!isset($user) || !$user) : ?>
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-circle"></i> Access Restricted: Please <?= $this->Html->link('login', ['controller' => 'Users', 'action' => 'login']) ?> to access the system.
            </div>
<?php else : ?>
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> Welcome, <?= ucfirst(h($user->userName)) ?>!
            </div>
        <?php endif; ?>
    </div>

    <!-- Features Section -->
    <div class="features row">
        <div class="column">
            <div class="feature-card">
                <h3>Patient Management</h3>
                <p>Efficiently manage patient records, medical history, and appointments in one centralized system.</p>
                <?= $this->Html->link('Manage Patients →', ['controller' => 'Patients', 'action' => 'index'], ['class' => 'button']) ?>
            </div>
        </div>
        
        <div class="column">
            <div class="feature-card">
                <h3>Doctor Directory</h3>
                <p>Complete directory of medical professionals with their specialties and availability.</p>
                <?= $this->Html->link('View Doctors →', ['controller' => 'Doctors', 'action' => 'index'], ['class' => 'button']) ?>
            </div>
        </div>
        <div class="column">
            <div class="feature-card">
                <h3>Appointment Scheduling</h3>
                <p>Easy-to-use appointment booking system with automated reminders and schedule management.</p>
                <?= $this->Html->link('Schedule Appointments →', ['controller' => 'Appointments', 'action' => 'index'], ['class' => 'button']) ?>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="info-section">
        <div class="row">
            <div class="column">
                <h2>Why Choose Our System?</h2>
                <ul>
                    <li>Secure and HIPAA-compliant patient data management</li>
                    <li>Real-time appointment tracking and updates</li>
                    <li>Comprehensive medical records management</li>
                    <li>Easy communication between staff and patients</li>
                    <li>Detailed reporting and analytics</li>
                </ul>
            </div>
            <div class="column">
                <h2>Getting Started</h2>
                <p>New to the system? Follow these steps:</p>
                <ol>
                    <li>Create your administrative account</li>
                    <li>Set up your clinic profile</li>
                    <li>Add your medical staff</li>
                    <li>Start managing appointments</li>
                </ol>
                <?php if (!$user) : ?>
                    <?= $this->Html->link('Get Started →', ['controller' => 'Users', 'action' => 'signup'], ['class' => 'button button-outline']) ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</div>
