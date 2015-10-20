<!-- app/Resources/views/lucky/number.html.php -->
<?php $view->extend('base.html.php') ?>

<?php $view['slots']->start('body') ?>
    <h1>Lucky Numbers: <?php echo $view->escape($luckyNumberList) ?>
<?php $view['slots']->stop() ?>