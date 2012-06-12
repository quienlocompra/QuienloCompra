<?php
// Generar Key
function genKey ( $p ){
	$rCh = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
	$key = $p . "_";
	for ( $i = 0; $i < 8; $i++ ){
		$key .= $rCh{ rand(0,61) };
	}
	return $key;
}

// Formatea las coordenadas
function format_coor( $coor, $less = true ){
	$coor = str_replace('\r\n', '', $coor);
	$coor = str_split($coor);
	$coor = array_reverse($coor);
	$coor[] = '0';
	$coor[] = '0';

	$coor = $coor[7] . $coor[6] . $coor[5] . "." . $coor[4] . $coor[3] . $coor[2] . $coor[1] . $coor[0];

	if ( $less == false ) { $coor = '-' . $coor; }
	return $coor;
}

// Get browser
function getBrowser() {
	$u_agent = $_SERVER['HTTP_USER_AGENT'];
	$bname = 'Unknown';
	$platform = 'Unknown';
	$version = "";

	// Sistemas Operativos

	// Linux
	if ( preg_match('/linux/i', $u_agent) ) {
		$platform = 'Linux';
	}
	if ( preg_match('/Ubuntu/i', $u_agent) ) {
		$platform = 'Ubuntu';
	}
	if ( preg_match('/CrOS/i', $u_agent) ) {
		$platform = 'Chrome OS';
	}

	// Windows
	if ( preg_match('/windows|win32/i', $u_agent) ) {
		$platform = 'Windows';
	}
	if ( preg_match('/NT 5.1/i', $u_agent) ) {
		$platform = 'Windows XP';
	}
	if ( preg_match('/NT 6/i', $u_agent) ) {
		$platform = 'Windows Vista';
	}
	if ( preg_match('/NT 6.1/i', $u_agent) ) {
		$platform = 'Windows 7';
	}
	if ( preg_match('/Windows Phone OS 7|XBLWP7|ZuneWP7/i', $u_agent) ) {
		$platform = 'Windows Phone 7';
	}

	// MacOS
	if ( preg_match('/macintosh|mac os x/i', $u_agent) ) {
		$platform = 'Mac';
	}
	if ( preg_match('/X 10.3|X 10_3/i', $u_agent) ) {
		$platform = 'Mac OS X Phanter';
	}
	if ( preg_match('/X 10.4|X 10_4/i', $u_agent) ) {
		$platform = 'Mac OS X Tiger';
	}
	if ( preg_match('/X 10.5|X 10_5/i', $u_agent) ) {
		$platform = 'Mac OS X Leopard';
	}
	if ( preg_match('/X 10.6|X 10_6/i', $u_agent) ) {
		$platform = 'Mac OS X Snow Leopard';
	}
	if ( preg_match('/X 10.7|X 10_7/i', $u_agent) ) {
		$platform = 'Mac OS X Lion';
	}

	// iOS
	if ( preg_match('/iPad/i', $u_agent) ) {
		$platform = 'iPad';
	}
	if ( preg_match('/iPhone/i', $u_agent) ) {
		$platform = 'iPhone';
	}
	if ( preg_match('/iPod/i', $u_agent) ) {
		$platform = 'iPod';
	}

	// Android
	if ( preg_match('/Android/i', $u_agent) ) {
		$platform = 'Android';
	}
	// BlackBerry
	if ( preg_match('/BlackBerry/i', $u_agent) ) {
		$platform = 'BlackBerry';
	}
	// Symbian
	if ( preg_match('/SymbianOS|Symbian/i', $u_agent) ) {
		$platform = 'Symbian';
	}
	// MeeGo
	if ( preg_match('/MeeGo/i', $u_agent) ) {
		$platform = 'MeeGo';
	}

	// Navegadores

	// Chafaexplorer
	if( preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent) ) {
		$bname = 'Internet Explorer';
		$ub = "MSIE";
	// Firefox
	}elseif( preg_match('/Firefox/i',$u_agent) ){
		$bname = 'Mozilla Firefox';
		$ub = "Firefox";
	// Chrome
	}elseif( preg_match('/Chrome/i',$u_agent) ){
		$bname = 'Google Chrome';
		$ub = "Chrome";
	// Safari
	}elseif( preg_match('/Safari/i',$u_agent) ){
		$bname = 'Apple Safari';
		$ub = "Safari";
	// Opera
	}elseif( preg_match('/Opera/i',$u_agent) ){
		$bname = 'Opera';
		$ub = "Opera";
	// Android
	}elseif( preg_match('/Android/i',$u_agent) ){
		$bname = 'Android';
		$ub = "Android";
	}

	// Motores
	$eng = 'not found';
	if( preg_match('/Presto/i',$u_agent) ){
		$eng = 'Presto';
	}elseif( preg_match('/Trident|MSIE/i',$u_agent) ){
		$eng = 'Trident';
	}elseif( preg_match('/AppleWebKit\/53/i',$u_agent) ){
		$eng = 'WebKit';
	}elseif( preg_match('/Gecko\/20100101/i',$u_agent) ){
		$eng = 'Gecko';
	}

	// Tipo
	$type = 'Desktop';
	if( preg_match('/Tablet/i',$u_agent) ){
		$type = 'Tablet';
	}elseif( preg_match('/Touch/i',$u_agent) ){
		$type = 'Touch';
	}elseif( preg_match('/Mobi/i',$u_agent) ){
		$type = 'Mobil';
	}

	$known = array('Version', $ub, 'other');
	$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';

	if ( !preg_match_all($pattern, $u_agent, $matches) ) {
		// just continue
	}

	$i = count($matches['browser']);

	if ( $i != 1 ) {
		if ( strripos($u_agent, "Version") < strripos($u_agent, $ub) ){
			$version= $matches['version'][0];
		}else{
			$version= $matches['version'][1];
		}
	}else{
		$version= $matches['version'][0];
	}

	if ( $version == null || $version == "" ){
		$version = "?";
	}
	return array(
		'userAgent' => $u_agent,
		'name' => $bname,
		'nav' => $ub,
		'engine' => $eng,
		'type' => $type,
		'version' => $version,
		'platform' => $platform
	);
}

function html5support () {
	$nav = getBrowser();
	$ver = explode('0', $nav['version']);
	if (
		( $nav['engine'] == 'WebKit' ) ||
		( $nav['engine'] == 'Gecko' ) ||
		( $nav['nav'] == 'Opera' && $nav['version'] == 'Tablet' ) ||
		( $nav['nav'] == 'Opera' && $nav['version'] == 'Mobi' )
	){
		return "yep";
	}elseif ( 
		( $nav['nav'] == 'Chrome' && $ver[0] < 14 ) ||
		( $nav['nav'] == 'Firefox' && $ver[0] < 4 ) ||
		( $nav['nav'] == 'Safari' && $ver[0] < 5 ) ||
		( $nav['nav'] == 'Opera' && $ver[0] < 10 ) ||
		( $nav['nav'] == 'MSIE' && $ver[0] < 9  )
	){
		return "nope";
	}else{
		return "yep";
	}
}

function mobilsupport () {
	$nav = getBrowser();
	if ( 
		( $nav['platform'] == 'iPad' ) ||
		( $nav['platform'] == 'iPhone' ) ||
		( $nav['platform'] == 'iPod' ) ||
		( $nav['platform'] == 'Android' ) ||
		( $nav['platform'] == 'BlackBerry' ) ||
		( $nav['platform'] == 'Symbian' ) ||
		( $nav['platform'] == 'MeeGo' ) ||
		( $nav['nav'] == 'Opera' && $nav['version'] == 'Tablet' ) ||
		( $nav['nav'] == 'Opera' && $nav['version'] == 'Mobi' )
	){
		return "yep";
	}else{
		return "nope";
	}
}
?>