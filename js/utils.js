/*
/*		Utilidades utilizadas por el API
/*		Desarrollado por Dannegm CC 2011
/*
/*		Vercion: 3.2.2.1
/*
/**/
(function(utils){

	utils.popup = function(title, msg, type, options, callback) {
			jQuery('#msgWrap, #msgStyle').remove();
			jQuery('body').append(
				'<div id="msgWrap">' +
					'<div id="msgShadow">' +
						'<div id="msgBox" class="msgDialog">' +
							'<div id="msgTitle"></div><div class="sprite"></div>' +
							'<div id="msgContent"><p id="msgText"></p></div>' +
							'<div id="msgOptions"></div>' +
						'</div>' +
					'</div>' +
				'</div>'
			);
			var mWrap = jQuery('#msgWrap'),
				mTitle = jQuery('#msgTitle'),
				mContent = jQuery('#msgContent'),
				mText = jQuery('#msgText'),
				mOptions = jQuery('#msgOptions');

			if( title == null ){ title = document.title; }
			mTitle.text(title);

			mWrap.css({
				'top': ( (jQuery(window).height() /3) - (mWrap.height() /3) ) + 'px'
			});

			switch( type ) {
				case 'alert':
					mText.text(msg);
					mText.html( mText.text().replace('\n', '<br />') );
					mOptions.append('<a id="msgOk" class="button red" href="#">Aceptar</a>');
					jQuery('#msgOk').click( function(e) {
						e.preventDefault();
						jQuery('#msgWrap, #msgStyle').remove();
						if( callback ){ callback(true); }
					}).focus();
					jQuery(document).keyup( function(e) {
						switch( e.keyCode ){
							case 13: jQuery('#msgOk').trigger('click'); break;
							case 27: jQuery('#msgOk').trigger('click'); break;
						}
					});
				break;
				case 'confirm':
					mText.text(msg);
					mText.html( mText.text().replace('\n', '<br />') );
					mOptions.append('<a id="msgOk" class="button red" href="#">Aceptar</a><a id="msgCancel" class="button" href="#">Cancelar</a>');
					jQuery('#msgOk').click( function(e) {
						e.preventDefault();
						jQuery('#msgWrap, #msgStyle').remove();
						if( callback ){ callback(true); }
					}).focus();
					jQuery('#msgCancel').click( function(e) {
						e.preventDefault();
						jQuery('#msgWrap, #msgStyle').remove();
						if( callback ){ callback(false); }
					});
					jQuery(document).keyup( function(e) {
						switch( e.keyCode ){
							case 13: jQuery('#msgOk').trigger('click'); break;
							case 27: jQuery('#msgCancel').trigger('click'); break;
						}
					});
				break;
				case 'dialog':
					mContent.html(msg);
					for ( b = 0; b < options.length; ++b){
						var label = options[b].label,
							typee = options[b].type,
							action = options[b].action,
							classes = options[b].classes;

						var optHref = '#';
						if (typee == 'link'){
							optHref = action;
						}
						mOptions.append('<a id="msgOpt' + b + '" class="msgOtpBtn button ' + classes + '" href="' + action + '" target="_blank">' + label + '</a>');
						switch (typee){
							case 'link':
								jQuery('#msgOpt' + b).click( function(e) {
									jQuery('#msgWrap, #msgStyle').remove();
								});
							break;
							case 'funct':
								jQueryexec =  function(e){
									e.preventDefault();
									jQuery('#msgWrap, #msgStyle').fadeOut();
									if (action) { action(e); }
								};
								jQuery('#msgOpt' + b).unbind('click', jQueryexec).bind('click', jQueryexec);
							break;
							case 'event':
								switch (action){
									case 'close':
										jQuery('#msgOpt' + b).click( function(e) {
											e.preventDefault();
											jQuery('#msgWrap, #msgStyle').remove();
										});
									break;
								}
							break;
						}
					}
					jQuery(document).keyup( function(e) {
						switch( e.keyCode ){
							case 27: jQuery('#msgWrap, #msgStyle').remove(); break;
						}
					});
				break;
			}
			mWrap.fadeIn();
	},
	$alert = function(message, title, callback){
		utils.popup(title, message, 'alert', null, callback);
	},
	$confirm = function(message, title, callback){
		utils.popup(title, message, 'confirm', null, callback);
	},
	$dialog = function(message, title, options){
		utils.popup(title, message, 'dialog', options, null);
	};

})(window);