<?php echo $this->extend('admin'); ?>
<?php $this->section('content'); ?>

<p><?php echo $page_description; ?></p>
<form method="post">

    <?php echo csrf_field(); ?>
    <div class="mt-3">
        <button name="confirm" value="0" class="btn btn-secondary me-3"><?php echo lang('Base.cancel') ?></button>
        <button name="confirm" value="1" class="btn btn-primary"><?php echo lang('Base.confirm') ?></button>
    </div>
</form>


<?php $this->endSection(); ?>