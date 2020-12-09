<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeptEmp $deptEmp
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Dept Emp'), ['action' => 'edit', $deptEmp->emp_no], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dept Emp'), ['action' => 'delete', $deptEmp->emp_no], ['confirm' => __('Are you sure you want to delete # {0}?', $deptEmp->emp_no), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dept Emp'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dept Emp'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deptEmp view content">
            <h3><?= h($deptEmp->emp_no) ?></h3>
            <table>
                <tr>
                    <th><?= __('Dept No') ?></th>
                    <td><?= h($deptEmp->dept_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Emp No') ?></th>
                    <td><?= $this->Number->format($deptEmp->emp_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('From Date') ?></th>
                    <td><?= h($deptEmp->from_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('To Date') ?></th>
                    <td><?= h($deptEmp->to_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
