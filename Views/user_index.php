<?php echo $this->extend('admin');?>
<?php $this->section('content'); ?>

<a href="/users/create"><?php echo lang('Users.create_user') ?></a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->email ?></td>
            <td>
                <a href="/users/edit/<?= $user->id ?>">Edit</a> | 
                <a href="/users/delete/<?= $user->id ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->endSection(); ?>