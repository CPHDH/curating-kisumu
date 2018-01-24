/*
JS loaded in footer
*/

// conditional load of bg img
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth
	||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
var viewport = updateViewportDimensions();
var article = document.querySelector('.single #content main article');
var featuredImg = article.attributes['data-image'].value;
if(featuredImg && viewport.width > 590){
	var css = '.single header[role="banner"]{background-image:url('+featuredImg+');}',
	    head = document.head || document.getElementsByTagName('head')[0],
	    style = document.createElement('style');
	style.type = 'text/css';
	if (style.styleSheet){
	  style.styleSheet.cssText = css;
	} else {
	  style.appendChild(document.createTextNode(css));
	}
	head.appendChild(style);
}
