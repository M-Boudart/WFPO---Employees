<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EmployeeTitle $employeeTitle
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Employee Title'), ['action' => 'edit', $employeeTitle->emp_no], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Employee Title'), ['action' => 'delete', $employeeTitle->emp_no], ['confirm' => __('Are you sure you want to delete # {0}?', $employeeTitle->emp_no), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Employee Title'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Employee Title'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employeeTitle view content">
            <h3><?= h($employeeTitle->emp_no) ?></h3>
            <table>
                <tr>
                    <th><?= __('Emp No') ?></th>
                    <td><?= $this->Number->format($employeeTitle->emp_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title No') ?></th>
                    <td><?= $this->Number->format($employeeTitle->title_no) ?></td>
                </tr>
                <tr>
                    <th><?= __('From Date') ?></th>
                    <td><?= h($employeeTitle->from_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('To Date') ?></th>
                    <td><?= h($employeeTitle->to_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
