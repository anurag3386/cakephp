<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $student
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Students'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>

            <?= $this->Html->link("Logout", ['controller' => 'Users','action' => 'logout']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="students form content">
            <?= $this->Form->create($student) ?>
            <fieldset>
                <legend><?= __('Add Student') ?></legend>
                <?php
                    echo $this->Form->control('firstName');
                    echo $this->Form->control('lastName');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('email',['type' => 'email']);
                    echo $this->Form->control('subjects._ids', array(
                        'label' => 'Subjects (Choose at least one)',
                        'multiple' => 'multiple',
                        'type' => 'select',
                        'options' => $subjectsOptions,
                        'style' => 'height:120px;',
                        'required'=>true
                    ));
                    echo $this->Form->control('dob',[
                        'type' => 'date',
                        'label' => 'Date of Birth'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<style>
    .error-message{color:red}
</style>    