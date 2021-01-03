<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <?php if($user) :?>
        <aside class="column">
            <div class="side-nav">
                <h4 class="heading"><?= __('Actions') ?></h4>
                <?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->dept_no], ['class' => 'side-nav-item']) ?>
                <?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->dept_no], ['confirm' => __('Are you sure you want to delete # {0}?', $department->dept_no), 'class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('List Departments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
                <?= $this->Html->link(__('New Department'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
            </div>
        </aside>
    <?php endif; ?>
    <div class="column-responsive column-80">
        <div class="departments view content">
            <div class="card" style="width: 18rem;">
                <?= $this->Html->image('department/' . $department->picture, [
                    'alt' => __($department->dept_name),
                    'class' => 'card-img-top',
                    ]) ?>
                <div class="card-body">
                    <h5 class="card-title"><?= __($department->dept_name) ?></h5>
                    <p class="card-text">
                        <?= __($department->description) ?>
                    </p>
                    <span><?= __($department->address) ?></span>
                    <?php if (isset($dept_working) && $department->dept_no === $dept_working) : ?>
                        <?= $this->Html->link(__("Department's rules"), "/roi/$department->rules", [
                            'class' => 'btn btn-primary',
                        ]) ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (isset($manager)) : ?>
                <div>
                    <?= $this->Html->image('employees/' . $manager[0]['picture'], [
                        'alt' => $manager[0]['emp_no'],
                        'width' => 60,
                        'height' => 60,
                    ]) ?>
                    <p><?= strtoupper($manager[0]['last_name']) . ' ' . $manager[0]['first_name']?>
                    <?php if ($user) : ?>
                        <?= $this->Form->postLink(__('Revoke'), [
                            'controller' => 'deptManager',
                            'action' => 'revoke',
                            $manager[0]['emp_no'],$department->dept_no,
                        ],
                        ['confirm' => __('Etes vous sûr de vouloir révoquer ce maanger')]) ?>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
            <?php if ($user) : ?>
                <table>
                    <thead>
                        <tr>
                            <th><?= __('emp_no') ?>
                            <th><?= __('from_date') ?>
                            <?php if (!isset($manager)) :?>
                                <th><?= __('Promouvoir') ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($employees as $employee) : ?>
                            <tr>
                                <td><?= $employee->emp_no ?></td>
                                <td><?= $employee->from_date ?></td>
                                <?php if (!isset($manager)) : ?>
                                    <td><?= $this->Html->link(__('Promouvoir'), [
                                        'controller' => 'deptManager',
                                        'action' => 'promote',
                                        $employee->emp_no, $department->dept_no
                                    ],
                                    ['confirm' => 'Etes vous sûr de voulir promouvoir cet employé en manager']) ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
            <?php endif; ?>
        </div>
    </div>
</div>
