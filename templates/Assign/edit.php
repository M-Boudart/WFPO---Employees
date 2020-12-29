<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assign $assign
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assign->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assign->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Assign'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="assign form content">
            <?= $this->Form->create($assign) ?>
            <fieldset>
                <legend><?= __('Edit Assign') ?></legend>
                <?php
                    echo $this->Form->control('dept_no');
                    echo $this->Form->control('title_no');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('birthdate');
                    echo $this->Form->control('email');
                    echo $this->Form->control('cv');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
