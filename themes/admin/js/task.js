$(function() {
	$('#delete-button').parent().click(function(){
		var href = $(this).attr('href');		
		var atLeastOneIsChecked = $('input[name=\"cid[]\"]:checked').length > 0;
		if (!atLeastOneIsChecked) {
			alert('Please select at least one record to delete');
		} else if (window.confirm('Are you sure you want to delete the record?')) {
			document.getElementById('admin-form').action = href;
			document.getElementById('admin-form').submit();
		}
		return false;
	});
	
    $('#remove-button').parent().click(function(){
		var href = $(this).attr('href');		
		var atLeastOneIsChecked = $('input[name=\"cid[]\"]:checked').length > 0;
		if (!atLeastOneIsChecked) {
			alert('Please select at least one record to remove');
		} else if (window.confirm('Are you sure you want to remove the record?')) {
			document.getElementById('admin-form').action = href;
			document.getElementById('admin-form').submit();
		}
		return false;
	});
    
	$('#edit-button').parent().click(function(){
		var href = $(this).attr('href');		
		var atLeastOneIsChecked = $('input[name=\"cid[]\"]:checked').length > 0;
		if (!atLeastOneIsChecked) {
			alert('Please select at least one record to edit');
		} else {
			document.getElementById('admin-form').action = href;
			document.getElementById('admin-form').submit();
		}
		return false;
	});
	
	$('#save-button').parent().click(function(){
		var href = $(this).attr('href');				
		document.getElementById('admin-form').action = href;
		document.getElementById('admin-form').submit();
		return false;
	});
    
    $('#add-button').parent().click(function(){
		var href = $(this).attr('href');		
		var atLeastOneIsChecked = $('input[name=\"cid[]\"]:checked').length > 0;
		if (!atLeastOneIsChecked) {
			alert('Please select at least one record to add');
		} else {
			document.getElementById('admin-form').action = href;
			document.getElementById('admin-form').submit();
		}
		return false;
	});
    
    $(".sidebar .treeview").tree();
});

(function($) {
    "use strict";

    $.fn.tree = function() {

        return this.each(function() {
            var btn = $(this).children("a").first();
            var menu = $(this).children(".treeview-menu").first();
            var isActive = $(this).hasClass('active');

            //initialize already active menus
            if (isActive) {
                menu.show();
                btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
            }
            //Slide open or close the menu on link click
            btn.click(function(e) {
                e.preventDefault();
                if (isActive) {
                    //Slide up to close menu
                    menu.slideUp();
                    isActive = false;
                    btn.children(".fa-angle-down").first().removeClass("fa-angle-down").addClass("fa-angle-left");
                    btn.parent("li").removeClass("active");
                } else {
                    //Slide down to open menu
                    menu.slideDown();
                    isActive = true;
                    btn.children(".fa-angle-left").first().removeClass("fa-angle-left").addClass("fa-angle-down");
                    btn.parent("li").addClass("active");
                }
            });

            /* Add margins to submenu elements to give it a tree look */
            menu.find("li > a").each(function() {
                var pad = parseInt($(this).css("margin-left")) + 10;

                $(this).css({"margin-left": pad + "px"});
            });

        });

    };


}(jQuery));
