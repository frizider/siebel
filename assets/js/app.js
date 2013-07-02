$(window).load(function() {
	// When the page has loaded
	$(".loading").fadeOut(600);
});

$(document).ready(function() {
	
	var borderClasses = [ 
		'border-blue', 'border-green', 'border-red', 'border-yellow', 
		'border-orange', 'border-pink', 'border-purple', 'border-fuschia', 'border-lila'
	];
	var i = borderClasses.length, j, tempi, tempj;
	while ( --i ) {
		j = Math.floor( Math.random() * ( i + 1 ) );
		tempi = borderClasses[i];
		tempj = borderClasses[j];
		borderClasses[i] = tempj;
		borderClasses[j] = tempi;
	}
    $('.randomborder').each(function(i, val) {
        $(this).addClass(borderClasses[i]);
    });
	
	$('#datepicker, #datepicker2, .datepicker').datepicker();
	
	// handle for class href
	$('.href').click(function() {
		var link = $(this).attr('data-href');
		window.location.href = link;
	});
	
	// handle for class href
	$('.submit').click(function() {
		$('form').submit();
	});
	
	// Comment list colapse
	$(document).delegate('.commentlist > .row, .commentlist .list > div', 'click', function() {
		$(this).find('.comment-description').slideToggle();
	})
	
	// Delete modal
	$(document).delegate('a.delete, input.delete, button.delete','click', function(e) {
		e.preventDefault();
		var href = $(this).attr('data-href');
		$('#delete a.delete_confirm').attr('href', href);
		$('#delete').modal();
	})
	
	// Checkboxes
	$(document).delegate('.checkbox', 'click', function(e) {
		e.preventDefault();
		var name = $(this).attr('data-name');
		var value = $(this).attr('data-value');
		
		if($(this).hasClass('checked'))
			{
				$(this).removeClass('checked');
				$(document).find('input#'+name).val(0);
				$(this).find('i:first').removeClass('icon-ok');
			}
		else
			{
				$(this).addClass('checked');
				$(document).find('input#'+name).val(value);
				$(this).find('i:first').addClass('icon-ok');
			}
		
	});
	
	// Radio buttons
	$('.radio').click(function(e) {
		e.preventDefault();
		var name = $(this).attr('data-name');
		var value = $(this).attr('data-value');
		var parent = $(this).parent();
		$(parent).each(function() {
			$(this.children).removeClass('checked');
		});
		$(this).addClass('checked');
		$(document).find('input#'+name).val(value);
		
	});
	
	
	// Form submit
	$('.submit').click(function() {
		$('form').submit();
	});
	
	// Form dropdown
	$('form .dropdown li a').click(function(e) {
		e.preventDefault();
		var name = '.' + $(this).parent().attr('data-name');
		var value = $(this).attr('data-value');
		var label = $(this).attr('data-name');
		$(name).val(value);
		$('a'+name+' span').text(label);
	})

	
	// Generate Random Password
	$('button#generateRandomPassword').click(function(event) {

		event.preventDefault();
		var pwd = $.generateRandomPassword(8);

		$('.labelRandomPassword').text(pwd);
		$('input#password').val(pwd);
		$('input#password_confirm').val(pwd);

	});
	
	// Function to generate an random password.
	(function($) {

	  $.generateRandomPassword = function(limit) {

		limit = limit || 8;

		var password = '';

		var chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

		var list = chars.split('');
		var len = list.length, i = 0;

		do {

		  i++;

		  var index = Math.floor(Math.random() * len);

		  password += list[index];

		} while(i < limit);

		return password;

	  };


	})(jQuery);
});

// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S ALL JUST JUNK FOR OUR DOCS!
// ++++++++++++++++++++++++++++++++++++++++++

!function ($) {

  $(function(){

    // Disable certain links in docs
    $('section [href^=#]').click(function (e) {
      e.preventDefault()
    })

    // make code pretty
    window.prettyPrint && prettyPrint()

    // add-ons
    $('.add-on :checkbox').on('click', function () {
      var $this = $(this)
        , method = $this.attr('checked') ? 'addClass' : 'removeClass'
      $(this).parents('.add-on')[method]('active')
    })

    // position static twipsies for components page
    if ($(".twipsies a").length) {
      $(window).on('load resize', function () {
        $(".twipsies a").each(function () {
          $(this)
            .tooltip({
              placement: $(this).attr('title')
            , trigger: 'manual'
            })
            .tooltip('show')
          })
      })
    }

    // add tipsies to grid for scaffolding
    if ($('#grid-system').length) {
      $('#grid-system').tooltip({
          selector: '.show-grid > div'
        , title: function () { return $(this).width() + 'px' }
      })
    }

    // fix sub nav on scroll
    var $win = $(window)
      , $nav = $('.subnav')
      , navTop = $('.subnav').length && $('.subnav').offset().top - 130
      , isFixed = 0

    processScroll()

    $win.on('scroll', processScroll)

    function processScroll() {
      var i, scrollTop = $win.scrollTop()
      if (scrollTop >= navTop && !isFixed) {
        isFixed = 1
        $nav.addClass('subnav-fixed')
      } else if (scrollTop <= navTop && isFixed) {
        isFixed = 0
        $nav.removeClass('subnav-fixed')
      }
    }

    // tooltip demo
    $('a[rel=tooltip].brand').tooltip({
      placement: "bottom"
    })

    $('.tooltip-demo.well').tooltip({
      selector: "a[rel=tooltip]"
    })

    $('.tooltip-test').tooltip()
	
	$('a[rel=tooltip]').tooltip()

    $('.popover-test').popover()

    // popover demo
    $("a[rel=popover]")
      .popover()
      .click(function(e) {
        e.preventDefault()
      })

    // button state demo
    $('#fat-btn')
      .click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000)
      })

    // carousel demo
    $('#myCarousel').carousel()

    // javascript build logic
    var inputsComponent = $("#components.download input")
      , inputsPlugin = $("#plugins.download input")
      , inputsVariables = $("#variables.download input")

    // toggle all plugin checkboxes
    $('#components.download .toggle-all').on('click', function (e) {
      e.preventDefault()
      inputsComponent.attr('checked', !inputsComponent.is(':checked'))
    })

    $('#plugins.download .toggle-all').on('click', function (e) {
      e.preventDefault()
      inputsPlugin.attr('checked', !inputsPlugin.is(':checked'))
    })

    $('#variables.download .toggle-all').on('click', function (e) {
      e.preventDefault()
      inputsVariables.val('')
    })

    // request built javascript
    $('.download-btn').on('click', function () {

      var css = $("#components.download input:checked")
            .map(function () { return this.value })
            .toArray()
        , js = $("#plugins.download input:checked")
            .map(function () { return this.value })
            .toArray()
        , vars = {}
        , img = ['glyphicons-halflings.png', 'glyphicons-halflings-white.png']

    $("#variables.download input")
      .each(function () {
        $(this).val() && (vars[ $(this).prev().text() ] = $(this).val())
      })

      $.ajax({
        type: 'POST'
      , url: 'http://bootstrap.herokuapp.com'
      , dataType: 'jsonpi'
      , params: {
          js: js
        , css: css
        , vars: vars
        , img: img
      }
      })
    })

  })

// Modified from the original jsonpi https://github.com/benvinegar/jquery-jsonpi
$.ajaxTransport('jsonpi', function(opts, originalOptions, jqXHR) {
  var url = opts.url;

  return {
    send: function(_, completeCallback) {
      var name = 'jQuery_iframe_' + jQuery.now()
        , iframe, form

      iframe = $('<iframe>')
        .attr('name', name)
        .appendTo('head')

      form = $('<form>')
        .attr('method', opts.type) // GET or POST
        .attr('action', url)
        .attr('target', name)

      $.each(opts.params, function(k, v) {

        $('<input>')
          .attr('type', 'hidden')
          .attr('name', k)
          .attr('value', typeof v == 'string' ? v : JSON.stringify(v))
          .appendTo(form)
      })

      form.appendTo('body').submit()
    }
  }
})

}(window.jQuery)