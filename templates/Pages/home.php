<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home']) ?>
    <?= $this->Html->css(["https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <header>
        <?= $cellMenu ?>
    </header>

    <!-- BIENVENUE -->
    <section class="bg-secondary mb-5">
        <div class="container text-center">

            <h1 class="p-2 text-white titreContent">Bienvenue chez deloitte </h1>

            <!-- UTILISER LA CLASSE POUR REGROUPER LES CARTES / PAS LA GRILLE BOOTSTRAP -->
            <div class="card-deck m-3 p-3">
                <div class="card ">
                    <div class="card-img-top">
                        <?= $this->Html->image('style/compagny.jpg', ['alt' => 'picture compagny']); ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center ">Plus d'informations sur notre entreprise</h5>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-block btn-outline-secondary " data-toggle="modal" data-target="#echarpeModal">Leader mondial des consultants</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img-top">
                        <?= $this->Html->image('style/womenAtWork.jpg', ['alt' => 'women at work']); ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Women At work !</h5>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-block btn-outline-secondary " data-toggle="modal" data-target="#coupeModal">Les femmes au travail </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img-top">
                        <?= $this->Html->image('style/work.jpg', ['alt' => 'women at work']); ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center">Votre futur carrière</h5>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-block btn-outline-secondary " data-toggle="modal" data-target="#baguetteModal">Nos offres d'emplois</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- QUI SOMME NOUS -->
    <section class="text-center">
        <h2 class="titreContent">Qui somme nous ?</h2>

        <div id="content" class="m-5">
            <p>Deloitte fait référence à un ou plusieurs cabinets membres de Deloitte Touche Tohmatsu Limited («DTTL»),
                son réseau mondial de cabinets membres et leurs entités liées. DTTL (également appelé «Deloitte Global»)
                et chacun de ses cabinets membres sont des entités indépendantes et juridiquement distinctes. DTTL ne fournit
                pas de services à des clients. Pour en savoir plus : www.deloitte.com/about. En France, Deloitte SAS est le cabinet
                membre de Deloitte Touche Tohmatsu Limited, et les services professionnels sont rendus par ses filiales et ses affiliés.</p><br>
        </div>

    </section>

    <!-- PRESSE -->
    <section class="text-center bg-secondary mb-5 ">
        <h2 class="titreContent text-white">Communiqué de presse</h2>
        <div class="card-deck m-3 p-3">
            <div class="card ">
                <div class="card-img-top">

                </div>
                <div class="card-body">
                    <h5 class="card-title text-center ">Charges déductiblesMise à jour mai 2020</h5>
                </div>
                <div class="card-footer">

                    <?= $this->Html->link('Voir plus', 'https://www2.deloitte.com/content/dam/Deloitte/be/Documents/Accountancy/FR/BrochuresFR/LRES_2020-Aftrekbare-Kosten-FR.pdf', ['class' => 'button', 'target' => '_blank']); ?>

                </div>
            </div>

            <div class="card">
                <div class="card-img-top">

                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Making an impact that matters</h5>
                </div>
                <div class="card-footer">

                    <?= $this->Html->link('Voir plus', 'https://www2.deloitte.com/content/dam/Deloitte/cn/Documents/about-deloitte/deloitte-cn-corporate-brochure-en-180111.pdf', ['class' => 'button', 'target' => '_blank']) ?>

                </div>
            </div>

            <div class="card">
                <div class="card-img-top">

                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Incruptive Innovation <br>Une démarche innovation pour garantir la croissance de demain !</h5>
                </div>
                <div class="card-footer">
                    <?= $this->Html->link('Voir plus', 'https://www2.deloitte.com/content/dam/Deloitte/fr/Documents/Technologie/Publications/deloitte_incruptive-innovation.pdf', ['class' => 'button', 'target' => '_blank']) ?>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- CARTE -->
    <section class="text-center mb-3">
        <h2 class="titreContent">Notre bureau a bruxelles</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2516.4816197028003!2d4.482741115633162!3d50.89630397953919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3dce1896ddd07%3A0x19a08d64e0690f7b!2sDeloitte%20Belgium!5e0!3m2!1sfr!2sbe!4v1608041796347!5m2!1sfr!2sbe" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <br>
    </section>

    <!-- QR CODE -->
    <section class="bg-light bg-gradient text-center">
        <h2>Télécharger notre application !</h2>
        
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white p-2 text-center p-5">
        <h2 class="text-white p-2 bt-2">No parteneraires !</h2>
        <div class="container">
            <?= $cellPartners ?>
        </div>


    </footer>

    <?= $this->Html->script(['https://code.jquery.com/jquery-3.5.1.slim.min.js']); ?>
    <?= $this->Html->script(['https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js']); ?>
</body>

</html>