jQuery(document).ready(function($){
	console.log(obj);
	$('ul.accordion').dcAccordion({

		eventType  : obj.eventType,
		disableLink: false ,
		hoverDelay : obj.hoverDelay ,
		speed      : obj.speed
	});
});