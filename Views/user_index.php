<?php echo $this->extend('admin');?>
<?php $this->section('content'); ?>

<a href="<?php echo site_url('admin/users/create') ?>"><?php echo lang('Users.create_user') ?></a>

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
                <?php echo anchor('admin/users/edit/' . $user->id, lang('Users.edit')) ?> | 
                <?php echo anchor('admin/users/delete/' . $user->id, lang('Users.delete')) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->endSection(); ?>