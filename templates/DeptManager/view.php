<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DeptManager $deptManager
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Dept Manager'), ['action' => 'edit', $deptManager->emp_no], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Dept Manager'), ['action' => 'delete', $deptManager->emp_no], ['confirm' => __('Are you sure you want to delete # {0}?', $deptManager->emp_no), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Dept Manager'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Dept Manager'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="deptManager view content">
            <h3><?= h($deptManager->emp_no) ?></h3>
            <table>
                <tr>
                    <th><?= __('Dept No') ?></th>
                    <td><?= h($deptManager->dept_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Emp No') ?></th>
                    <td><?= $this->Number->format($deptManager->emp_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('From Date') ?></th>
                    <td><?= h($deptManager->from_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('To Date') ?></th>
                    <td><?= h($deptManager->to_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
