<link rel="stylesheet" href="/css/updateDelete.css">
<h1>Patients</h1>
<?= ucfirst($this->Identity->get('userName')) ?>
<h3><?= $this->Html->link('Add Patient', ['action' => 'add_Patients']) ?></h3>
<div class="table-scroll-indicator">
    <table>
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Medical History</th>
                <?php if ($this->Identity->get('role') == 'admin'): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($patients as $patient): ?>
                <tr>
                    <td><?= $patient->Patient_id ?></td>
                    <td><?= $patient->first_name ?></td>
                    <td><?= $patient->last_name ?></td>
                    <td><?= $patient->phone ?></td>
                    <td><?= $patient->date_of_birth?></td>
                    <td><?= $patient->address ?></td>
                    <td><?= $patient->medical_history ?></td>
                    <?php if ($this->Identity->get('role') == 'admin'): ?>
                        <td class="actions">
                            <?= $this->Html->link('Update', ['action' => 'edit', $patient->Patient_id], ['class' => 'button update-btn']) ?>
                            <?= $this->Form->postLink(
                                'Delete',
                                ['action' => 'delete', $patient->Patient_id],
                                ['confirm' => 'Are you sure you want to delete this patient?', 'class' => 'button delete-btn']
                            ) ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>