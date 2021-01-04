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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employeeTitle->emp_no],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employeeTitle->emp_no), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Employee Title'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="employeeTitle form content">
            <?= $this->Form->create($employeeTitle) ?>
            <fieldset>
                <legend><?= __('Edit Employee Title') ?></legend>
                <?php
                    echo $this->Form->control('to_date', ['empty' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
