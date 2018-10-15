// ACCORDIONS

$(document).ready(function () {

// Creator Modals

$(".creator-button-modal").on('click', function () {
  $("#modal-creator").addClass("active")
  $(".modal-creator-content").addClass("active")
})

$("#modal-close-creator").on('click', function () {
  $("#modal-creator").removeClass("active")
  $(".modal-creator-content").removeClass("active")
})

$(".modal__outside-click").on('click', function () {
  $("#modal-creator").removeClass("active")
  $(".modal-creator-content").removeClass("active")
})

// Contact Modals

$(".contact-button-modal").on('click', function () {
  $("#modal-contact").addClass("active")
  $(".modal-contact-content").addClass("active")
})

$("#modal-close-contact").on('click', function () {
  $("#modal-contact").removeClass("active")
  $(".modal-contact-content").removeClass("active")
})

$(".modal__outside-click").on('click', function () {
  $("#modal-contact").removeClass("active")
  $(".modal-contact-content").removeClass("active")
})

// Share Modals

$(".share-button-modal").on('click', function () {
  $("#modal-share-tour").addClass("active")
  $(".modal-share-tour").addClass("active")
})

$("#modal-close-share-tour").on('click', function () {
  $("#modal-share-tour").removeClass("active")
  $(".modal-share-tour").removeClass("active")
})

$(".modal__outside-click").on('click', function () {
  $("#modal-share-tour").removeClass("active")
  $(".modal-share-tour").removeClass("active")
})

// Accordions

  var accordions = document.getElementsByClassName("accordion-question")

  for (var i = 0; i < accordions.length; i++) {
    accordions[i].onclick = function() {
      this.classList.toggle('is-open');

      var content = this.nextElementSibling;
      if (content.style.maxHeight) {
        // accordion is open, we need to close it
        content.style.maxHeight = null;
      } else {
        // accordion is closed
        content.style.maxHeight = content.scrollHeight + "px";
      }
    }
  }

  var toggleAllButton = document.getElementById('js-toggle-all');
  if(toggleAllButton) {
    toggleAllButton.addEventListener('click' , function() {

      if(toggleAllButton.classList.contains('expanded')) {
        // Hide all
        for (var i = 0; i < accordions.length; i++) {
          accordions[i].classList.remove('is-open');
          var content = accordions[i].nextElementSibling;
          content.style.maxHeight = null;
        }
        toggleAllButton.classList.remove('expanded');
        toggleAllButton.innerHTML = 'Expand all';
      } else {
        // Open all
        for (var i = 0; i < accordions.length; i++) {
          accordions[i].classList.add('is-open');
          var content = accordions[i].nextElementSibling;
          content.style.maxHeight = content.scrollHeight + "px";
        }
        toggleAllButton.classList.add('expanded');
        toggleAllButton.innerHTML = 'Hide all';

      }
    });
  }

// Stiky CTA's on Tour Pages

$(window).bind('scroll', function () {

  var cta = document.getElementById('tour-page-sticky-cta');
  var info = document.getElementById('tour__sticky-content__info');
  var ctaHeight = $(window).height() - 230;
  if($(window).scrollTop() > ctaHeight) {

      cta.classList.add('fixed');
      info.classList.add('active');
  }

  else {

    $(cta.classList.remove('fixed'));
    $(info.classList.remove('active'));

  }


});

// function to change colour of copy button on click

// Get copy to clipboard button
var clipboardCopyBtn = document.getElementById('clipboard-button');

// Listen for open click
if(clipboardCopyBtn) {
  clipboardCopyBtn.addEventListener('click', clipboardCopySuccess);
}

// function to change button state
function clipboardCopySuccess() {
  clipboardCopyBtn.classList.add("active");
  document.getElementById('clipboard-button').innerHTML = 'Copied successfully!';
}


// Clipboard.js - Homepage App Link

new ClipboardJS('.clipboard-button');

var clipboard = new ClipboardJS('.btn');

clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});

// Mailchimp

  var $form = $('.js-mailchimp-form');
  if ($form.length > 0) {
    $('form input[type="submit"]').bind('click', function (event) {
      if (event) event.preventDefault();
      register($(this.closest('form')));
    })
  }


function register($form) {
  console.log("form", $form);
  // $('#mc-embedded-subscribe').val('Sending...');
  $.ajax({
    type: $form.attr('method'),
    url: $form.attr('action'),
    data: $form.serialize(),
    cache: false,
    dataType: 'jsonp',
    contentType: 'application/json; charset=utf-8',
    error: function (err) { alert('Could not connect to the registration server. Please try again later.') },
    success: function (data) {
      // $('#mc-embedded-subscribe').val('subscribe')
      if (data.result === 'success') {
        // Yeahhhh Success
        console.log(data.msg)
        $($form).closest(".o-modal").addClass("thank-you-message-shown");
      } else {
        // Something went wrong, do something to notify the user.
        console.log(data);
        console.log(data.msg, $($form).closest(".modal-form"));
        $(".modal-form-error", $form).addClass("active");
        $(".modal-form-error-name", $form).addClass("active");
      }
    }
  })
};

})

$(window).scroll(function() {
  parallaxHero();
});

function parallaxHero() {

  var wScroll = $(window).scrollTop();
  $('.parallax-hero').css('background-position', 'center '+(wScroll*0.75)+'px')

}

// Facebook Sharer Popup

$(document).ready(function() {
    $('.fb-share').click(function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'fbShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });
});

// Stop Slider (Slick)

$(document).ready(function(){
  $('.c-stop-slider--container').slick({
    swipeToSlide: true,
    SlidesToShow: 1,
    swipe: true,
    infinite: false,
    variableWidth: true,
    appendArrows: '.c-stop-slider--arrows-container'
  });

  $('.c-stop-slider--container').on('afterChange', function (event, slick, currentSlide) {

    var length = $('.js-slide-single').length;

        if(currentSlide === (length - 1)) {
            $('.slick-next').addClass('hidden');
        }
        else {
            $('.slick-next').removeClass('hidden');
        }

        if(currentSlide > 0) {
            $('.slick-prev').addClass('active');
        }
        else {
            $('.slick-prev').removeClass('active');
        }
    })
});

// Review Pagination

(function($) {

  $(document).ready(function() {

    $('.c-tour--reviews-pagination--container').customPaginate({

      itemsToPaginate: '.c-tour--single-user-review',
      activeClass: 'review-pagination--active'
  });
})

// Hambuger Menu Animation & Function

$(document).ready(function(){

  $('.hamburger-menu-container').click(function(){
    $('.hamburger-menu-container').toggleClass('active');
    $('.menu-overlay').toggleClass('active');
    $('body,html').toggleClass('hidden');
    $('body').toggleClass('relative');
  })

});

// Typed JS

$(document).ready(function(){

  var typed = new Typed('.explore-hero__typed-element', {
    strings: ["London", "Manchester", "Oxford", "Brighton", "Quorn", "Bonn", "Lisbon"],
    typeSpeed: 100,
    backSpeed: 50,
    loop: true,
  });

});

})(jQuery)
