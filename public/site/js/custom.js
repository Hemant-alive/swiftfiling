$(function(){
	$("#navbar>ul>li.dropdown>a").after('<div class="child-trigger"></div>');
	  $('.navbar-brand').after ('<button class="navbar-toggle collapsed" data-target="#navbar"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>')
	  $(".navbar-toggle").click(function (){
	    $("#navbar").slideToggle(250);
	    $("body").toggleClass("mobile-open");
	    $(".child-trigger").removeClass("child-open");
	    $(".mega-dropdown-menu").slideUp(250);
	    return false
	  });

	  $(".child-trigger").click(function(){
	    $(this).parent().siblings(".mega-dropdown").find(".child-trigger").removeClass("child-open");
	    $(this).parent().siblings(".mega-dropdown").find(".mega-dropdown-menu").slideUp(250);
	    $(this).next(".mega-dropdown-menu").slideToggle(250);
	    $(this).next(".mega-dropdown-menu").children(".mega-dropdown").find(".mega-dropdown-menu").slideUp(250);
	    $(this).next(".mega-dropdown-menu").children(".mega-dropdown").find(".child-trigger").removeClass("child-open");
	    $(this).toggleClass("child-open");
	    return false
	  });
	
	$(".custom-tabber-wrapper").hide();
	$("#accordion ul li>h2").click(function(){
		$(this).parent().addClass('more_active');
		$(this).parent().siblings().removeClass('more_active');
		$(this).parent().siblings().find('.custom-tabber-wrapper').slideUp(250);	
		$(this).next().slideToggle(250);
	}); 

	
	$(".custom-package-form-wrapper>tbody>tr>th").each(function(){
		$(this).click(function(){
			$(".custom-package-form-wrapper tbody>tr>th").removeClass("table_active");
			$(this).toggleClass("table_active");
			return false;
		});
	});
	$(".custom-continue").click(function(){	
		$(".custom-package-wrapper").toggleClass("get_next");
	}); 
      
	$(document).on('click','.custom-table-form',function(){
		$('colgroup').removeClass('more_active');
		$('input[name="optradio"]').prop('checked',false);
		var p = $(this).parents('th').index();
		p = p+1;
		$('colgroup:nth-child('+p+')').addClass('more_active');
		$(this).find('input[type="radio"]').prop('checked',true);
		
	});
	$('.form-check-label-two, .custom-registered-policy-two').click(function(){
		$(".custom-members, .custom-provide-registered").hide();
		$(".custom-manager, .custom-registered").show();
	});
	$('.form-check-label-one, .custom-registered-policy-one').click(function(){
		$(".custom-manager, .custom-registered").hide();
		$(".custom-members, .custom-provide-registered").show();
	});
	
    $(".custom-select-lable > li").each(function(){
       $(document).on('click','.remove-lable',function(){
         $(this).parent().addClass('some-more-active');
       });
    });
	$(".addMembers").click(function(){
        $(".custom-members-wpapper ol").append('<li><span class="manager_name">Members#</span><div class="form-group"><input type="text" class="form-control" id="text" name="add_member[]" placeholder="Full Name"></div><span class="remove-lable"><i class="fa fa-times" aria-hidden="true"></i></span></li>');
        return false
    });
    $(".addmanager").click(function(){
        $(".custom-members-wrap ol").append(' <li><span class="manager_name">Manager#</span><div class="form-group"><input type="text" class="form-control" id="text" name="add_manager[]" placeholder="Full Name"></div><span class="remove-lable"><i class="fa fa-times" aria-hidden="true"></i></span></li>');
        return false
    });
	
	
	//$(".payment-otp-step").hide();
	/*$(".custom-paypal-method").hide();*/
	
	$(".amount-payment-option, .card-payment-option").click(function(){
	    $(".payment-otp-step").slideDown(250);
	});
	
	$(".custom-paypal-pay").click(function(){
		//$(".custom-card-pay").removeClass('pay_active');
		//$(".custom-paypal-pay").addClass('pay_active');
	    $(".flip-container").addClass('hover');
	});
	
	$(".custom-card-pay").click(function(){
		//$(".custom-paypal-pay").removeClass('pay_active');
		//$(".custom-card-pay").addClass('pay_active');
	    $(".flip-container").removeClass('hover');
	});

	/*$(".card-payment-option").click(function(){
		$(".amount-payment-option").removeClass('opt_pay_active');
		$(".card-payment-option").addClass('opt_pay_active');
	    return false
	});
	$(".amount-payment-option").click(function(){
		$(".card-payment-option").removeClass('opt_pay_active');
		$(".amount-payment-option").addClass('opt_pay_active');
	    return false
	});*/
	
});






