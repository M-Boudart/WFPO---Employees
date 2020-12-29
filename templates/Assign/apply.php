<div class="row">
    <div class="column-responsive column-80">
        <div class="departments form content">
        <?= $this->Form->create($assign, ['enctype' => 'multipart/form-data']) ?>
            <fieldset>
                <legend><?= __('Apply for a job') ?></legend>
                <?php
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('first_name');
                    echo $this->Form->label('gender', 'Gender');
                    echo $this->Form->select('gender', [
                        'M' => 'Homme',
                        'F' => 'Femme',
                        'X' => 'Autre',
                    ]);
                    echo $this->Form->control('birthdate', ['type' => 'date']);
                    echo $this->Form->control('email', ['type' => 'email']);
                    echo $this->Form->control('cv', ['type' => 'file']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
