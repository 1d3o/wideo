<?php footerMenu(); ?>

<?php /** Per ottenere link social (NOTE: Mettiamo degli if in modo che, se il link non esiste, non mostriamo l'icona) */ ?>

<?php echo get_field('c_facebook', 'options'); ?>
<?php echo get_field('c_youtube', 'options'); ?>
<?php echo get_field('c_linkedin', 'options'); ?>