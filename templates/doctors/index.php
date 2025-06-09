<link rel="stylesheet" href="/css/updateDelete.css">
<h1>Doctors</h1>
<?= ucfirst($this->Identity->get('userName')) ?>
<h3><?= $this->Html->link('Add Doctor', ['action' => 'add_doctors']) ?></h3>
<table>
    <thead>
        <tr>
                <th>Doctor ID</th>
                <th>first Name</th>
                <th>lastName</th>
                <th>Phone</th>
                <th>Specialization</th>
                <th>Availability Hours</th>
                <?php if ($this->Identity->get('role') == 'admin'): ?>
                    <th>Actions</th>
                <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($doctors as $doctor): ?>
            <tr>
                <td><?= $doctor->doctor_id ?></td>
                <td><?= $doctor->first_name ?></td>
                <td><?= $doctor->last_name ?></td>
                <td><?= $doctor->phone ?></td>
                <td><?= $doctor->specialization?></td>
                <td><?= $doctor->availability_hours ?></td>
                <?php if ($this->Identity->get('role') == 'admin'): ?>
                    <td class="actions">
                        <?= $this->Html->link('Update', ['action' => 'edit', $doctor->doctor_id], ['class' => 'button update-btn']) ?>
                        <?= $this->Form->postLink(
                            'Delete',
                            ['action' => 'delete', $doctor->doctor_id],
                            ['confirm' => 'Are you sure you want to delete this doctor?', 'class' => 'button delete-btn']
                        ) ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</table>