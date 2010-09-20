/**
 * efa_increment = percentage by which each click increases/decreases size
 * efa_bigger = array of properties for 'increase font size' link
 * efa_reset = array of properties for 'reset font size' link
 * efa_smaller = array of properties for 'decrease font size' link
 *
 * properties array format:
 *		['before HTML',
 *		 'inside HTML',
 *		 'title text',
 *		 'class text',
 *		 'id text',
 *		 'name text',
 *		 'accesskey text',
 *		 'onmouseover JavaScript',
 *		 'onmouseout JavaScript',
 *		 'on focus JavaScript',
 *		 'after HTML'
 *		 ]
 */
var efa_default = 75.00; //%
var efa_increment = 10;  //%
/* Default multi-language vars and themedir name */
var efalang_zoomIn = 'Decrease font size';
var efalang_zoomReset = 'Reset font size';
var efalang_zoomOut = 'Increase font size';
var efathemedir = 'BlankTheme';

function Efa_Fontsize(increment,def) {
	this.w3c = (document.getElementById);
	this.ms = (document.all);
	this.userAgent = navigator.userAgent.toLowerCase();
	this.isOldOp = ((this.userAgent.indexOf('opera') != -1)&&(parseFloat(this.userAgent.substr(this.userAgent.indexOf('opera')+5)) <= 7));
	this.isMacIE = ((this.userAgent.indexOf('msie') != -1) && (this.userAgent.indexOf('mac') != -1) && (this.userAgent.indexOf('opera') == -1));
	if ((this.w3c || this.ms) && !this.isOldOp && !this.isMacIE) {
		this.increment = increment;
		this.def = def;
		this.defPx = Math.round(16*(def/100))
		this.base = 1;
		this.pref = def;
	} else {
		this.efaInit = new Function('return true;');
	}
}

efaInitValues = function(efaobject) {
  if ((efaobject.w3c || efaobject.ms) && !efaobject.isOldOp && !efaobject.isMacIE) {
	var bigger = ['<span class="fontresize-large">',
				  '<img src="'+document.location.pnbaseURL+'themes/'+efathemedir+'/images/pixel-trans.gif" width="16" height="16" alt="[+]" title="'+efalang_zoomIn+'" />',
				  efalang_zoomIn,
				  '',
				  '',
				  '',
				  '',
				  '',
				  '',
				  '',
				  '</span> '
				  ]

	var reset = ['<span class="fontresize-reset">',
				 '<img src="'+document.location.pnbaseURL+'themes/'+efathemedir+'/images/pixel-trans.gif" width="16" height="16" alt="[R]" title="'+efalang_zoomReset+'" />',
				 efalang_zoomReset,
				 '',
				 '',
				 '',
				 '',
				 '',
				 '',
				 '',
				 '</span> '
				 ]

	var smaller = ['<span class="fontresize-small">',
				   '<img src="'+document.location.pnbaseURL+'themes/'+efathemedir+'/images/pixel-trans.gif" width="16" height="16" alt="[-]" title="'+efalang_zoomOut+'" />',
				   efalang_zoomOut,
				   '',
				   '',
				   '',
				   '',
				   '',
				   '',
				   '',
				   '</span>'
				   ]
	efaobject.biggerLink = efaobject.getLinkHtml(1, bigger);
	efaobject.resetLink = efaobject.getLinkHtml(0, reset);
	efaobject.smallerLink = efaobject.getLinkHtml(-1, smaller);
  } else {
	efaobject.biggerLink = '';
	efaobject.resetLink = '';
	efaobject.smallerLink = '';
  }
  efaobject.allLinks = efaobject.biggerLink + efaobject.resetLink + efaobject.smallerLink;
}
// check the user's current base text size and adjust as necessary
Efa_Fontsize.prototype.efaInit = function() {
	efaInitValues(this);
	this.body = (this.w3c)?document.getElementsByTagName('body')[0].style:document.all.tags('body')[0].style;
	this.efaTest = (this.w3c)?document.getElementById('topnav'):document.all['topnav'];
	var h = (this.efaTest.clientHeight)?parseInt(this.efaTest.clientHeight):(this.efaTest.offsetHeight)?parseInt(this.efaTest.offsetHeight):999;
	if (h < this.defPx) this.base = this.defPx/h;
	this.body.fontSize = Math.round(this.pref*this.base) + '%';
}
// construct the HTML for the links; we expect -1, 1 or 0 for the direction, an array
// of properties to add to the <a> tag and HTML to go before, after and inside the tag
Efa_Fontsize.prototype.getLinkHtml = function(direction,properties) {
	var html = properties[0] + '<a href="#" onclick="efa_fontSize.setSize(' + direction + '); return false;"';
	html += (properties[2])?'title="' + properties[2] + '"':'';
	html += (properties[3])?'class="' + properties[3] + '"':'';
	html += (properties[4])?'id="' + properties[4] + '"':'';
	html += (properties[5])?'name="' + properties[5] + '"':'';
	html += (properties[6])?'accesskey="' + properties[6] + '"':'';
	html += (properties[7])?'onmouseover="' + properties[7] + '"':'';
	html += (properties[8])?'onmouseout="' + properties[8] + '"':'';
	html += (properties[9])?'onfocus="' + properties[9] + '"':'';
	return html += '>'+ properties[1] + '<' + '/a>' + properties[10];
}
// change the text size; expects a direction parameter of 1 (increase size), -1 (decrease size)
// or 0 (reset to default)
Efa_Fontsize.prototype.setSize = function(direction) {
	this.pref = (direction) ? this.pref+(direction*this.increment) : this.def;
	this.body.fontSize = Math.round(this.pref*this.base) + '%';
}
var  efa_fontSize = new Efa_Fontsize(efa_increment,efa_default);