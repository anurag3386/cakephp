<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Register User') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
        <? /* $this->Form->control('role', [
            'options' => ['admin' => 'Admin']
        ]) */ ?>
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>