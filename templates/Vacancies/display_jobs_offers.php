<h1><?= __("Jobs offers for department #$dept_no") ?></1>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th><?= __("Job's name") ?></th>
                <th><?= __("Description") ?></th>
                <th><?= __("Quantity") ?></th>
            </tr>
        </thead>
        <tbody>
            <!-- Formatage de $titleInfos à revoir -->
            <?php foreach($titleInfos as $infos) : ?>
                <tr>
                    <td><?= $infos[0]->title ?></td>
                    <td><?= $infos[0]->description ?></td>
                    <td><?=  $infos['quantity'] ?></td>
                    <td><?= $this->Html->link(__('Apply'), ['action' => 'apply', $infos[0]->title])?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>