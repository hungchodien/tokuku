(function($) {
  $.fn.fadeImages = function(options) {
    var opt = $.extend({
      time: 2000, 
      fade: 1000, 
      dots: true,
      arrows: false, 
      complete: function() {} 
    }, options);
    var t = parseInt(opt.time),
      f = parseInt(opt.fade),
      d = opt.dots,
      i = 0,
      j = 0,
      l, m, set, me, cb = opt.complete,
      a = opt.arrows;
    m = $(this).find("div > div");
    me = $(this);
    m.hide();
    l = m.length;


    if (l <= 0) {
      return false;
    }

    if (d) {
      $(this).append("<div id='dots'></div>");
      for (j = 0; j < l; j++) {
        $(this).find("#dots").append("<a>" + (j + 1) + "</a>");
      }
      $(this).find("#dots a").eq(0).addClass("active");
     
      $(this).on("click", "#dots a", function(event) {
        event.preventDefault();
        clearTimeout(set);
        i = $(this).index();
        dots(i);
        show(i);
      });
    }
    
    if (a) {
      $(this).append("<a href='#' class='arrow prev'>PREV</a><a href='#' class='arrow next'>NEXT</a>");
      $(this).on("click", ".arrow.prev", function(event) {
        event.preventDefault();
        clearTimeout(set);
        i = me.find(".curr").index() - 1;
        if (i <= -1) {
          i = l - 1;
        }
        dots(i);
        show(i);

      });
      $(this).on("click", ".arrow.next", function(event) {
        event.preventDefault();
        clearTimeout(set);
        i = me.find(".curr").index() + 1;
        if (i >= l) {
          i = 0;
        }
        dots(i);
        show(i);
      });
    }
    
    show(0);
    play(0);
    
    function show(i) {
      m.eq(i).addClass("curr").css("z-index", 2).stop(true, true).fadeIn(f, cb);
      m.eq(i).siblings().css("z-index", 1).removeClass("curr").stop(true, true).fadeOut(f);
    }

   
    function dots(i) {
      me.find("#dots a").eq(i).addClass("active").siblings().removeClass();
    }

    
    function play(i) {
      if (i >= l - 1) {
        i = -1;
      }
      set = setTimeout(function() {
        show(i);
        dots(i);
        play(i)
      }, t + f);
      i++;
      return i;
    }
 
    /*me.hover(function() {
      i = me.find(".curr").index();
      clearTimeout(set);
    }, function() {
      i = me.find(".curr").index();
      play(i);
    });*/

    return this;
  }
}(jQuery));
