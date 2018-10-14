<?php /* Template Name: FAQ Main */ ?>

<?php get_header('help'); ?>

    <div id="modal-contact" class="o-modal">
      <div class="modal-contact-content">
        <div class="modal-form">
          <span id="modal-close-contact">x</span>
          <!--[if lte IE 8]>
          <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
          <![endif]-->
          <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
          <script>
            hbspt.forms.create({
            portalId: "4733551",
            formId: "2b9a8f5e-d282-43df-9e7f-c5d1ed876f42"
          });
          </script>
        </div>

      </div>
    </div>

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

                  <button class="accordion-question">
                    <p class="accordion-question__q">Q.</p>
                    <p class="accordion-question__single-question"><?php the_sub_field('accordion_question')?></p>
                    <div class="accordion-question__plus-btn"></div>
                  </button>
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
