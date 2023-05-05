<div class="students index content">
    <?= $this->Html->link(__('New Student'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Manage Students') ?></h3>
    <?= $this->Form->create(null,['type' => 'get']) ?>
     <?=  $this->Form->control('search_keyword', ['label' => false,'placeholder' => 'Search by name or email','value' => $this->request->getQuery('search_keyword')]); ?>
    <?= $this->Form->end() ?>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= __('ID') ?></th>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Email') ?></th>
                    <th><?= __('Date of Birth') ?></th>
                    <th><?= __('Subjects') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($students) > 0): ?>
                    <?php foreach ($students as $student): ?>
                        <?php 
                            $subjects =  []; 
                            foreach($student->subjects as $subject){
                                $subjects[]  = $subject->name;
                            }
                        
                        ?>
                    <tr>
                        <td><?= $this->Number->format($student->id) ?></td>
                        <td><?= h($student->full_name) ?></td>
                        <td><?= h($student->email) ?></td>
                        <td><?= date('d-m-Y',strtotime($student->dob)) ?></td>
                        <td><?= h(implode(", ", $subjects)) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $student->id], ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]) ?>

                            
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align:center;" >No record(s) found.</td></tr>
                <?php endif; ?>    
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>