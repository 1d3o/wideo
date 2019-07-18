<?php get_header(); ?>

<main role="main">

<?php if ( have_posts() ) :?>
  <?php while ( have_posts() ) : the_post(); ?>
    <section>
      <h1>Homepage</h1>
      <p>This is the main template used to show the homepage of the website.</p>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

</main>

<?php get_footer(); ?>
