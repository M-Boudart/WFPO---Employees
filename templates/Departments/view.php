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
        </div>
    </div>
</div>
