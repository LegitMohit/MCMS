<link rel="stylesheet" href="/css/updateDelete.css">
<h1>Appointments</h1>
<?= ucfirst($this->Identity->get('userName')) ?>
<div class="search-container">
    <h4><?= $this->Html->link('Add Appointment', ['action' => 'add_Appointments']) ?></h4>
    <input type="text" id="searchInput" placeholder="Search appointments..." class="search-input" style="width: 45%;">
</div>
<table>
    <thead>
        <tr>
            <th>Appointment ID</th>
            <th>Patient</th>
            <th>Doctor</th>
            <th>Appointment Date</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Created</th>
            <th>Modified</th>
            <?php if ($this->Identity->get('role') == 'admin'): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?= $appointment->appointment_id ?></td>
                <td><?= $appointment->has('patient') ? h($appointment->patient->first_name . ' ' . $appointment->patient->last_name) : h($appointment->Patient_id) ?></td>
                <td><?= $appointment->has('doctor') ? h($appointment->doctor->first_name . ' ' . $appointment->doctor->last_name . ' (' . $appointment->doctor->specialization . ')') : h($appointment->doctor_id) ?></td>
                <td><?= $appointment->appointment_date ? $appointment->appointment_date->i18nFormat('MMM dd, yyyy hh:mm:ss ', 'Asia/Kolkata') : '' ?></td>
                <td><?= h($appointment->status) ?></td>
                <td><?= $appointment->notes ?></td>
                <td><?= $appointment->created->i18nFormat('MMM dd, yyyy hh:mm:ss ', 'Asia/Kolkata') ?></td>
                <td><?= $appointment->modified->i18nFormat('MMM dd, yyyy hh:mm:ss ', 'Asia/Kolkata') ?></td>
                <?php if ($this->Identity->get('role') == 'admin'): ?>
                <td class="actions">
                    <?= $this->Html->link('Update', ['action' => 'edit', $appointment->appointment_id], ['class' => 'button update-btn']) ?>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $appointment->appointment_id],
                        ['confirm' => 'Are you sure you want to delete this appointment?', 'class' => 'button delete-btn']
                    ) ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script src="/js/searchBar.js"></script>
