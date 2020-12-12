<div class="partners index content">
    <div class="table-responsive">
        <table>
            <tbody>
            <tr>
                <?php foreach ($partners as $partner): ?>
                    <td><?= $this->Html->image('partners/' . $partner->logo, [
                        'alt' => $partner->title,
                        'url' => $partner->url,
                        'width' => 80,
                        'length' => 80,
                    ]) ?></td>
                <?php endforeach; ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>