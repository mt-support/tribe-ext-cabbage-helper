var cabbageHelper = {};
var cabbageHelperData = cabbageHelperData || {};

jQuery( function( $ ) {
	var $cabbageBox;
	var $tipBox;
	var expanded = false;

	if (
		! cabbageHelperData.hasOwnProperty( 'context' )
		|| ! cabbageHelperData.hasOwnProperty( 'tips' )
		|| cabbageHelperData.tips.length == 0
	) {
		return;
	}



	function setupCabbageBox() {
		createCabbageBoxHtml();
		populateCabbageBox();
		showHideCabbageBox();
	}

	function createCabbageBoxHtml() {
		var logo  = '<img src="' + cabbageHelperData.logoUrl + '" class="logo">';
		var title = '<h3>' + cabbageHelperData.i18n.cabbageHelper + '</h3>';
		var tips  = '<div class="tips"></div>';
		$( 'body' ).append( '<div id="cabbage-box">' + title + logo + tips + '</div>' );

		$cabbageBox = $( '#cabbage-box' );
		$tipBox = $cabbageBox.find( '.tips' );
	}

	function populateCabbageBox() {
		var tipList = '<ul>';

		for ( var i = 0; i < cabbageHelperData.tips.length; i++ ) {
			tipList += '<li>' + cabbageHelperData.tips[ i ] + '</li>';
		}

		$tipBox.html( tipList + '</ul>' );
	}

	function showHideCabbageBox() {
		$cabbageBox.click( function() {
			if ( ! expanded ) {
				expandCabbageBox();
			}
			else {
				collapseCabbageBox();
			}
		} );
	}

	function expandCabbageBox() {
		$cabbageBox.addClass( 'expanded' );
		expanded = true;
	}

	function collapseCabbageBox() {
		$cabbageBox.removeClass( 'expanded' );
		expanded = false;
	}

	setupCabbageBox();
} );