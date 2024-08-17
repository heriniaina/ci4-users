<?php echo $this->extend('admin');?>
<?php $this->section('content'); ?>

<a href="/users/create"><?php echo lang('Users.create_user') ?></a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th><?php echo lang('Users.username') ?></th>
            <th><?php echo lang('Users.email') ?></th>
            <th><?php echo lang('Users.action') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->email ?></td>
            <td>
                <a href="/users/edit/<?= $user->id ?>"><?php echo lang('Users.edit') ?></a> | 
                <a href="/users/delete/<?= $user->id ?>"><?php echo lang('Users.delete') ?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->endSection(); ?>