jQuery(document).ready(function ($) {
  //navbar hamburger toggle
  $('.navbar-toggler').click(function () {
    $('.fa-bars-staggered').toggleClass('fa-xmark');
  });

  // masonry grid view
  if ($('.masonrygrid').length) {
    var $grid = $('.masonrygrid').masonry({
      itemSelector: '.grid-item'
    });
    $grid.imagesLoaded().progress(function () {
      $grid.masonry();
    });
  }

  //jump to anchor
  $("a[href^='#']").click(function () {
    var target = $(this.hash);
    if (target.length) {
      $('html,body').animate({
        scrollTop: target.offset().top - 70
      }, 'slow');
      return false;
    }
  });

  // scroll window or div to top
  $(window).scroll(function () {
    $(this).scrollTop() > 300 ? $('.back-to-top').fadeIn() : $('.back-to-top').fadeOut();
  });
  $('.artDesc').scroll(function () {
    $('.artDesc').scrollTop() > 300 ? $('.back-to-top').fadeIn() : $('.back-to-top').fadeOut();
  });

  $('.back-to-top').click(function () {
    $(".artDesc").scrollTop(0);
    $('html, body').animate({ scrollTop: 0 }, "slow");
    return false;
  });
  
  //change post title h1 to h2
   if ($(window).width() < 600) {
    $('.mainheading h1').replaceWith(function () {
      return $('<h2>', { html: $(this).html() });
    });
  }

  // explore topic modal
  $("#exploreTopicsModal form").submit(function (e) {
    e.preventDefault();
    var mType = this.mType.value;
    var sType = this.sType.value;
    if (mType && sType) {
      location.href = baseURL + "/material/" + mType + "/" + sType + "/first";
    }
  });

  // global search modal
  $("#searchModal form").submit(function (e) {
    e.preventDefault();
    var sTerm = this.sTerm.value;
    if (sTerm) {
      location.href = baseURL + "/search/" + sTerm;
    }
  });

  // contact form
  $("#contact form").submit(function (e) {
    e.preventDefault();
    var userName = this.userName.value;
    var userEmail = this.userEmail.value;
    var userMessage = this.userMessage.value;

    if (userName && userEmail && userMessage) {
      location.href = baseURL + "/contact/" + userName + "/" + userEmail + "/" + userMessage;
    }
  });

  // toggle article sidebar mob
  $('.toggleArtList').on('click', function () {
    $('.artList').toggleClass("active");
  });

  //zoom in article images
  new Zooming({
    bgColor: 'rgb(0, 0, 0)',
    scaleBase: 0.7,
  }).listen('.article-post img');
});

//dynamic select subject from category
function chooseSubject(elem) {
  var cslug = $(elem).val();
  if (cslug != '') {
    $.ajax({
      url: baseURL + "/UserControl/viewSubject",
      type: 'post',
      data: { cslug: cslug },
      dataType: 'json',
      success: function (res) {
        $('#sType').html('<option value="" selected disabled hidden>Choose Here</option>');
        if (res.length > 0) {
          for (let i = 0; i < res.length; i++) {
            var option = $('<option>', {
              value: res[i].sslug,
              text: res[i].sname,
            });
            $('#sType').append(option);
          }
        } else {
          var option = $('<option>', {
            value: '',
            text: 'No subject found ...',
          });
          $('#sType').append(option);
        }
      }
    });
  } else {
    $('#sType').html('<option value="" selected disabled hidden>Choose Here</option>');
  }
}

function getArtPos(elem) {
  localStorage.setItem("aid", $(elem).attr("id"));
}

$(document).ready(function () {
  var activeArticleId = localStorage.getItem("aid");

   if ($("#" + activeArticleId).length) {
     $("#" + activeArticleId).parents("li").each(function () {
       $(this).children("a").addClass("active");
       $(this).children("ul").removeClass("d-none");
     });
     
     var $elementToScroll = $('#' + activeArticleId);
     var elementHeight = $elementToScroll.outerHeight();
     var deviceHeight = $(window).height();
     if (elementHeight < deviceHeight) {
        var articlePosition = $elementToScroll.offset().top - (deviceHeight - elementHeight) / 2;
     } else {
        var articlePosition = $elementToScroll.offset().top;
     }
     $('.artList').scrollTop(articlePosition);
     
     $('#' + activeArticleId).css({ 'background': '#F5DEB3', 'font-weight': '500' });
   } else {
    $(".chapter-child-list").first().removeClass("d-none");
  }
});

function toggleChapter(elem) {
  $(elem).toggleClass("active");
  $(elem).next(".chapter-child-list").toggleClass("d-none");
}