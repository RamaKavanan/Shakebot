/*global $:false */

jQuery(document).ready(function($){'use strict';

	$('.nav.navbar-nav').onePageNav({
		currentClass: 'active',
	    changeHash: false,
	    scrollSpeed: 900,
	    scrollOffset: 60,
	    scrollThreshold: 0.3,
	    filter: ':not(.no-scroll)'
	});

	var stickyNavTop = $('#masthead').offset().top;

   	var stickyNav = function(){
	    var scrollTop = $(window).scrollTop();

	    if (scrollTop > stickyNavTop) { 
	        $('#masthead').addClass('sticky');
	    } else {
	        $('#masthead').removeClass('sticky'); 
	    }
	};

	stickyNav();

	$(window).scroll(function() {
		stickyNav();
	});
});

jQuery(document).ready(function($){'use strict';
    
    
    var currentUrl = window.location.href;
    //var halfUrl = window.location.protocol+'//'+window.location.host;
    var halfUrl = window.location.origin;
        if(currentUrl == halfUrl+"/shakebot/shakebotwp/index.php/my-stats/"){
            window.location.href= halfUrl+'/shakebot/shakebotwp/index.php/my-profile/#stats';
        }
        if(currentUrl == halfUrl+'/shakebot/shakebotwp/index.php/history-2/'){
            window.location.href= halfUrl+'/shakebot/shakebotwp/index.php/my-profile/#tab_b';        
        }
        if(currentUrl == halfUrl+'/shakebot/shakebotwp/index.php/settings/'){
            window.location.href= halfUrl+'/shakebot/shakebotwp/index.php/my-profile/#tab_c';        
        }
        if(currentUrl == halfUrl+'/shakebot/shakebotwp/index.php/all-products/'){
            window.location.href= halfUrl+'/shakebot/shakebotwp/index.php/recommended-products/?showdIdshd=,103,116,111&resultCatTypehd=RhiTotalScore';        
        }
    
    
    $('a').click(function(event){
        
        var currentAnchor = $(this).text();        
        
        if(currentAnchor == 'My Stats') {           
            event.preventDefault();
           window.location.href='/shakebot/shakebotwp/index.php/my-profile/#stats';                  
        }
        if(currentAnchor == 'History') {
            event.preventDefault();
           window.location.href='/shakebot/shakebotwp/index.php/my-profile/#tab_b';
           
        }
        if(currentAnchor == 'Settings') {
            event.preventDefault();
            window.location.href='/shakebot/shakebotwp/index.php/my-profile/#tab_c';
           
        } 
        
        if(currentAnchor == 'All Products') {
            event.preventDefault();
            window.location.href='/shakebot/shakebotwp/index.php/recommended-products/?showdIdshd=,103,116,111&resultCatTypehd=RhiTotalScore';
           
        } 
    });

});
