/*
/*			Quienlocompra.com
/*			Propuesta de api desarrollada por Dannegm CC 2012
/*
/*			Vercion del API: 0.3.28.20
/*
/**/
(function(Qlc){
	var appID,
		appKey,
		user,
	Qlc = {
		vercion: '0.3.26.15',
		init: function(ext){
			appID = ext.appID;
			appKey = ext.appKey;
			user = ext.user;
		},
		run: function( jsonp_callback ){
			var dir = 'http://dannegm/www/quienlocompra/apps/gui.login.php?appID=' + appID,
				target = 'login',
				height = '350',
				width = '600';
			window.open(dir, target, 'width=' + width + ',height=' + height + ',scrollbars=NO');

			var jsonp_url = 'http://dannegm/www/quienlocompra/apps/api.php?ID=' + appID + '&Key=' + appKey + '&user=' + user + '&jsonp=true&callback=' + jsonp_callback;

			var head = document.getElementsByTagName("head")[0],
				script = document.createElement("script");
			script.type = "text/javascript";
			script.src = jsonp_url;
			head.appendChild(script);
		}
	};
	// Hacemos a Qlc parte de los objetos de window
	window.Qlc = Qlc;

})(window);

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
				'<style id="msgStyle">' +
					'#msgWrap { display: none; position: absolute; top: 100px; left: 0; right: 0; overflow: hidden; } #msgShadow { width: 500px; margin: auto; padding: 10px; background: rgb(40,40,40); background: rgba(0,0,0,.7); border-radius: 10px; overflow: hidden; } #msgBox { overflow: hidden; border-radius: 7px; box-shadow: 0 0 5px #000; } #msgTitle { display: block; overflow: hidden; border-radius: 7px 7px 0 0; background:  rgb(186,0,1) url("http://dannegm/www/quienlocompra/img/miniLogo.png") no-repeat left center; width: 580px; height: 40px; text-indent: -99999px; } .sprite { display: block; height: 10px; background: url("http://dannegm/www/quienlocompra/img/spritered.png"); } #msgContent { color: #444; display: block; overflow: hidden; font: 14px/1.4 sans-serif; padding: 10px; background: #fff; } #msgOptions { display: block; overflow: hidden; background: rgb(217,217,217) !important; border-radius: 0 0 7px 7px; padding: 5px; } #msgOptions a { text-decoration: none; color: #000; font: 12px sans-serif; display: block; float: right; margin: 5px; padding: 5px 7px; border: 1px solid rgb(127,127,127); background: #eee; background: -webkit-linear-gradient(top, rgb(242,242,242) 0%,rgb(217,217,217) 100%); border-radius: 3px; } #msgOptions a:focus { outline: none; box-shadow: 0 0 3px rgb(38,125,230); } #msgOptions a:hover { background: #fff; background: -webkit-linear-gradient(top, rgb(255,255,255) 0%,rgb(242,242,242) 100%); } #msgOptions a:active { background: rgb(242,242,242); } .dialogTitle { font-size: 16px; color: #222; background: #eee; margin: 0px; padding: 10px; } #msgOptions a.hot { color: #fff; background: rgb(149,55,53); background: -webkit-linear-gradient(top, rgb(149,55,53) 0%, rgb(99,37,35) 100%); } #msgOptions a.hot:hover { background: rgb(192,80,77); background: -webkit-linear-gradient(top, rgb(192,80,77) 0%, rgb(149,55,53) 100%); } #msgOptions a.hot:active { background: rgb(149,55,53); }' +
				'</style>' +
				'<div id="msgWrap">' +
					'<div id="msgShadow">' +
						'<div id="msgBox" class="msgDialog">' +
							'<div id="msgTitle"></div><div class="sprite"></div><div class="dialogTitle"></div>' +
							'<div id="msgContent"><p id="msgText"></p></div>' +
							'<div id="msgOptions"></div>' +
						'</div>' +
					'</div>' +
				'</div>'
			);
			var mWrap = jQuery('#msgWrap'),
				mTitle = jQuery('#msgTitle'),
				dTitle = jQuery('.dialogTitle');
				mContent = jQuery('#msgContent'),
				mText = jQuery('#msgText'),
				mOptions = jQuery('#msgOptions');
			mTitle.text('Quien lo compra');

			if( title == null ){ title = document.title; }
			dTitle.text(title);

			mWrap.css({
				'top': ( (jQuery(window).height() /3) - (mWrap.height() /3) ) + 'px'
			});

			switch( type ) {
				case 'alert':
					mText.text(msg);
					mText.html( mText.text().replace('\n', '<br />') );
					mOptions.append('<a id="msgOk" class="hot" href="#">Aceptar</a>');
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
					mOptions.append('<a id="msgOk" class="hot" href="#">Aceptar</a><a id="msgCancel" href="#">Cancelar</a>');
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
						mOptions.append('<a id="msgOpt' + b + '" class="msgOtpBtn ' + classes + '" href="' + action + '" target="_blank">' + label + '</a>');
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
	Qlc.alert = function(message, title, callback){
		utils.popup(title, message, 'alert', null, callback);
	},
	Qlc.confirm = function(message, title, callback){
		utils.popup(title, message, 'confirm', null, callback);
	},
	Qlc.dialog = function(message, title, options){
		utils.popup(title, message, 'dialog', options, null);
	};

})(window);