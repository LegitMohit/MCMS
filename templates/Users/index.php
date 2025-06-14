<h1>Users</h1>
<?= ucfirst($this->Identity->get('userName')) ?>
<h4><?= $this->Html->link('Add User', ['action' => 'signup']) ?></h4>
<table>
    <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Modified</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->userId ?></td>
                <td><?= $user->userName ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->created->i18nFormat('MMM dd, yyyy hh:mm:ss ', 'Asia/Kolkata') ?></td>
                <td><?= $user->modified->i18nFormat('MMM dd, yyyy hh:mm:ss ', 'Asia/Kolkata') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</table>