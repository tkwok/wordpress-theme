<?php get_header();

  while(have_posts()) {
    the_post();
    pageBanner(array(
      'title' => 'Hello this is the title',
      'subtitle' => 'This is the page subtitle',
      'photo' => 'https://images-na.ssl-images-amazon.com/images/I/715jykrgmKL._SL1217_.jpg'
    ));
  ?>

  <div class="container container--narrow page-section">
    <?php
      $parentId = wp_get_post_parent_id(get_the_ID());

      if ($parentId) { ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
          <p>
            <a class="metabox__blog-home-link" href="<?php echo get_permalink($parentId); ?>">
              <i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parentId); ?>
            </a>
            <span class="metabox__main"><?php echo the_title(); ?></span>
          </p>
        </div>
      <?php }
    ?>

  <?php
    $childArray = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($parentId or $childArray) { ?>
      <div class="page-links">
        <h2 class="page-links__title">
          <a href="<?php echo get_permalink($parentId); ?>"><?php echo get_the_title($parentId); ?></a>
        </h2>
        <ul class="min-list">
          <?php
          if ($parentId) {
            $findChildrenOf = $parentId;
          } else {
            $findChildrenOf = get_the_ID();
          }

           wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order'
          )); ?>

        </ul>
      </div>
    <?php } ?>



    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>


  <?php }
    get_footer(); ?>
