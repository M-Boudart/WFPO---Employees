<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department[]|\Cake\Collection\CollectionInterface $departments
 */
?>

<div class="departments index content">
    <?= $this->Html->link(__('New Department'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Departments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('dept_no') ?></th>
                    <th><?= $this->Paginator->sort('dept_name') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= __('Manager') ?></th>
                    <th><?= __('Nb employees') ?></th>
                    <th><?= __('Postes à pourvoir') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $department): ?>
                <tr>
                    <td><?= h($department->dept_no) ?></td>
                    <td><?= h($department->dept_name) ?></td>
                    <td><?= h($department->description) ?></td>
                    <td><?= $this->Html->image('employees/' . $managers[$department->dept_no]['picture'],[
                        'alt' => __('Employee ') . $managers[$department->dept_no]['emp_no'],
                        'url' => ['controller' => 'employees', 'action' => 'view', $managers[$department->dept_no]['emp_no']],
                        'width' => 60,
                        'height' => 60
                    ]) ?></td>
                    <td><?= $employeesNumber[$department->dept_no]?></td>
                    <td>
                        <?= $postesVacants[$department->dept_no] ?>
                        <?php if($postesVacants[$department->dept_no] > 0) : ?>
                            <?= $this->Html->link(
                                __('Apply'),
                                ['controller' => 'vacancies', 'action' => 'displayJobsOffers', $department->dept_no],
                            ) ?>
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $department->dept_no]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $department->dept_no]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $department->dept_no], ['confirm' => __('Are you sure you want to delete # {0}?', $department->dept_no)]) ?>
                    </td>
                    
                </tr>
                <?php endforeach; ?>
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
