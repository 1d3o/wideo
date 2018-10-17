<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<main role="main">

<?php if ( have_posts() ) :?>
  <?php while ( have_posts() ) : the_post(); ?>
    <section>

    </section>
  <?php endwhile; ?>
<?php endif; ?>

</main>

<?php get_footer(); ?>
