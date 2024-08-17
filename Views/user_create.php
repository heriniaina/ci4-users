<?php echo $this->extend('admin'); ?>
<?php $this->section('content'); ?>

<form method="post">
    <?php echo csrf_field(); ?>
    <div class="mb-3">
        <label for="username" class="form-label"><?php echo lang('Users.username') ?></label>
        <input
            type="text"
            class="form-control"
            name="username"
            id="username"
            aria-describedby="helpUsername"
            placeholder=""
            value="" />
        <small id="helpUsername" class="form-text text-muted"><?php echo lang('Users.username_help') ?></small>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label"><?php echo lang('Users.email') ?></label>
        <input
            type="email"
            class="form-control"
            name="email"
            id="email"
            aria-describedby="helpId"
            placeholder="email@domain.tld"
            value="" />
        <small id="helpId" class="form-text text-muted"><?php echo lang('Users.email_help') ?></small>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label"><?php echo lang('Users.password') ?></label>
        <input
            type="password"
            class="form-control"
            name="password"
            id="password"
            aria-describedby="passwordHelp"
            placeholder="****************" />
        <small id="passwordHelp" class="form-text text-muted"><?php echo lang('Users.password_help') ?></small>
    </div>
    <button
        type="submit"
        class="btn btn-primary">
        <?php echo lang('Users.save'); ?>
    </button>
</form>
<?php $this->endSection(); ?>