<?php /* Template Name: Privacy */ ?>

<?php get_header('alt'); ?>

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
      <div class="modal__outside-click"></div>
    </div>

    <section style="margin-top: 60px; margin-bottom: 60px;">
      <div class="container-main">

        <h3 class="page-title"><?php the_field('page_title')?></h3>
        <div class="page-paragraph"><?php the_field('single_paragraph')?></div>

        <?php
          // check for rows (parent repeater)
          if( have_rows('content') ):

           	// loop through rows (parent repeater)
              while ( have_rows('content') ) : the_row();?>

              <h4 class="page-sub-title"><?php the_sub_field('page_sub_title')?></h4>

              <?php
              // check for rows (sub repeater)
							if( have_rows('page_paragraphs') ):

                // loop through rows (sub repeater)
                while( have_rows('page_paragraphs') ): the_row();?>

                  <div class="page-paragraph"><?php the_sub_field('page_paragraph')?></div>

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
    </section>

  <?php get_footer(); ?>
