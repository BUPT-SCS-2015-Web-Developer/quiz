(function($){
  $(function(){

    $('.button-collapse').sideNav();
	$('select').material_select();
	$('.materialboxed').materialbox();
	$('.dropdown-button').dropdown({
    inDuration: 300,
    outDuration: 225,
    constrain_width: true, // Does not change width of dropdown to that of the activator
    hover: false, // Activate on hover
    gutter: 0, // Spacing from edge
    belowOrigin: false // Displays dropdown below the button
    }
	);
       
	   
	
  }); // end of document ready
})(jQuery); // end of jQuery name space

