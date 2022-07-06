<?php /** Stampa menu principale */ ?>

<?php mainMenu(); ?>

<?php /**
 * Stampa ul con lingue disponibili
 * NOTE: Per la label non preoccuparti. Possono rinominarle io da backend.
 * */ ?>
<?php pll_the_languages(); ?>

<?php echo pll_current_language('name'); // lingua attuale ?>
