<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <?= $this->Html->image('logo.jpg', [
            'alt' => __('Logo home'),
            'url' => '/',
            'width' => 60,
            'length' => 60,
        ]); ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php foreach($links as $link) : ?>
                <li class="nav-item">
                    <?= $this->Html->link(
                        $link->text,
                        $link->url,
                        ['class' => 'nav-link active'],
                        ['aria-current' => 'page'],
                    ); ?>
                </li>
            <?php endforeach; ?>
                <li><?= $this->Html->link('logout', ['controller' => 'Employees', 'action' => 'logout']) ?></li>
                <li><?= $this->Html->link('login', ['controller' => 'Employees', 'action' => 'login']) ?></li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
</nav>