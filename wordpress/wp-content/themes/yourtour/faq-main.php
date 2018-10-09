<?php /* Template Name: FAQ Main */ ?>

<?php get_header('alt'); ?>

    <section class="faq-content-container" style="overflow: hidden;">
      <div class="container-main">

        <div class="container-accordion">

          <div class="faq-top-section">
            <h2 class="faq-page-title"><?php the_field('page_title')?></h2>
            <button id="js-toggle-all" class="faq-expand-all">Expand all</button>
          </div>

          <?php
            // check for rows (parent repeater)
            if( have_rows('section') ):

             	// loop through rows (parent repeater)
                while ( have_rows('section') ) : the_row();?>

                <h3 class="accordion-title"><?php the_sub_field('accordion_title')?></h3>

                <?php
                // check for rows (sub repeater)
  							if( have_rows('accordion') ):

                  // loop through rows (sub repeater)
                  while( have_rows('accordion') ): the_row();?>

                  <button class="accordion-question"><?php the_sub_field('accordion_question')?></button>
                  <div class="accordion-answer">

                    <div><?php the_sub_field('accordion_answer')?></div>

                  </div>

                <?php  endwhile;

                else :

                // no rows found

                endif;
                ?>

          <?php  endwhile;

          else :

          // no rows found

          endif;?>

        </div>

        <div class="container-about">

          <h4 class="faq-about">About</h4>
          <p class="about-copy"><?php the_field('about_copy')?></p>

        </div>

      </div>
    </section>

  </body>

  <?php get_footer(); ?>
