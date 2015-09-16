jQuery(document).ready(function($){
	console.log(obj);
	$('ul.accordion').dcAccordion({

		eventType : 'click',
		disableLink: true ,
		hoverDelay : 100 ,
		speed : 'slow'
	});
});