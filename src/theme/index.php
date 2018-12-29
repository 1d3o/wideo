<?php get_header(); ?>

<main role="main">

<h1>Posts list</h1>
<p>This is the main template used to show the list of posts.</p>

<?php if ( have_posts() ) :?>
  <?php while ( have_posts() ) : the_post(); ?>
    <section>
      <h2><?php echo get_the_title(); ?></h2>
      <p><?php echo get_the_content(); ?></p>
    </section>
  <?php endwhile; ?>
<?php endif; ?>

</main>

<?php get_footer(); ?>