<?php get_header(); ?>

<main role="main">

  <h1>Page</h1>
  <p>This is a page of the template.</p>

  <?php if ( have_posts() ) :?>
    <turbo-frame-tag id="random" data-turbo-permanent>
      <?php echo rand(1, 100); ?>
    </turbo-frame-tag>

    <turbo-frame-tag id="index-posts">
      <?php while ( have_posts() ) : the_post(); ?>
        <section>
          <h2><?php echo get_the_title(); ?></h2>
          <p><?php echo get_the_content(); ?></p>
        </section>
      <?php endwhile; ?>
    </turbo-frame-tag>
    <turbo-frame-tag id="index-pagination">
      <a
        href="<?php echo get_next_posts_page_link(); ?>"
        data-turbo-frame="index-posts"
      >Next page</a>
    </turbo-frame-tag>
  <?php endif; ?>

</main>

<?php get_footer(); ?>
