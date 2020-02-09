<?php

class cyz_sniffer{

	private static function get_user_agent() {
		return  $_SERVER['HTTP_USER_AGENT'];
  }
  
  private static function get_user_referer(){ 
    return $_SERVER['HTTP_REFERER'];
  }

	public static function get_user_ip() {
    $mainIp = '';

    if (getenv('HTTP_CLIENT_IP')) $mainIp = getenv('HTTP_CLIENT_IP');
    
    else if(getenv('HTTP_X_FORWARDED_FOR')) $mainIp = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED')) $mainIp = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR')) $mainIp = getenv('HTTP_FORWARDED_FOR');
  
    else if(getenv('HTTP_FORWARDED')) $mainIp = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR')) $mainIp = getenv('REMOTE_ADDR');

    else $mainIp = 'UNKNOWN';

		return $mainIp;
	}

	public static function get_os() {

		$user_agent = self::get_user_agent();
		$os_platform    =   "Unknown OS Platform";
		$os_array       =   array(
      '/Windows NT 10.0/i'    =>  'Windows 10'            , 
      '/windows nt 6.2/i'     =>  'Windows 8'             , 
      '/windows nt 5.2/i'     =>  'Windows Server 2003/XP', 
      '/windows nt 5.0/i'     =>  'Windows 2000'          , 
      '/windows nt 4.0/i'     =>  'Windows NT 4.0'        , 
      '/windows nt 3.1/i'     =>  'Windows NT 3.1'        , 
      '/android/i'            =>  'Android'               , 
      '/android 2.0.1/i'      =>  'Android 2.0.1'         , 
      '/android 2.2.1/i'      =>  'Android 2.2.1'         , 
      '/android 2.2.4/i'      =>  'Android 2.2.4'         , 
      '/android 2.3.1/i'      =>  'Android 2.3.1'         , 
      '/android 2.3.5/i'      =>  'Android 2.3.5'         , 
      '/android 3.0/i'        =>  'Android 3.0'           , 
      '/android 3.2.1/i'      =>  'Android 3.2.1'         , 
      '/android 3.2.4/i'      =>  'Android 3.2.4'         , 
      '/android 4.0.1/i'      =>  'Android 4.0.1'         , 
      '/android 4.0.4/i'      =>  'Android 4.0.4'         , 
      '/android 4.3/i'        =>  'Android 4.3'           , 
      '/android 4.4.2/i'      =>  'Android 4.4.2'         , 
      '/android 5.0/i'        =>  'Android 5.0'           , 
      '/ubuntu/i'             =>  'Ubuntu'                , 
      '/ipod/i'               =>  'iPod'                  , 
      '/blackberry/i'         =>  'BlackBerry'            ,
      '/windows nt 6.4/i'     =>  'Windows 10'            , 
      '/windows nt 6.1/i'     =>  'Windows 7'             , 
      '/windows nt 5.1/i'     =>  'Windows XP'            , 
      '/win98/i'              =>  'Windows 98'            , 
      '/windows nt 3.51/i'    =>  'Windows NT 3.51'       , 
      '/windows nt 3.11/i'    =>  'Windows 3.11'          , 
      '/android 1.6/i'        =>  'Android 1.6'           , 
      '/android 2.1/i'        =>  'Android 2.1'           , 
      '/android 2.2.2/i'      =>  'Android 2.2.2'         , 
      '/android 2.3/i'        =>  'Android 2.3'           , 
      '/android 2.3.3/i'      =>  'Android 2.3.3'         , 
      '/android 2.3.6/i'      =>  'Android 2.3.6'         , 
      '/android 3.1/i'        =>  'Android 3.1'           , 
      '/android 3.2.2/i'      =>  'Android 3.2.2'         , 
      '/android 4.0/i'        =>  'Android 4.0'           , 
      '/android 4.0.2/i'      =>  'Android 4.0.2'         , 
      '/android 4.2.1/i'      =>  'Android 4.2.1'         , 
      '/android 4.4/i'        =>  'Android 4.4'           , 
      '/android 4.4.3/i'      =>  'Android 4.4.3'         , 
      '/macintosh|mac os x/i' =>  'Mac OS X'              , 
      '/SymbianOS/i'          =>  'SymbianOS'             , 
      '/ipad/i'               =>  'iPad'                  , 
      '/bb/i'                 =>  'BlackBerry'            , 
      '/windows nt 6.3/i'     =>  'Windows 8.1'           ,
      '/windows nt 6.0/i'     =>  'Windows Vista'         ,
      '/windows me/i'         =>  'Windows ME'            ,
      '/win95/i'              =>  'Windows 95'            ,
      '/windows nt 3.5/i'     =>  'Windows NT 3.5'        ,
        '/linux/i'             =>  'Linux'                 ,
      '/android 2.0/i'        =>  'Android 2.0'           ,
      '/android 2.2/i'        =>  'Android 2.2'           ,
      '/android 2.2.3/i'      =>  'Android 2.2.3'         ,
      '/android 2.3.0/i'      =>  'Android 2.0.3'         ,
      '/android 2.3.4/i'      =>  'Android 2.3.4'         ,
      '/android 2.3.7/i'      =>  'Android 2.3.7'         ,
      '/android 3.2/i'        =>  'Android 3.1'           ,
      '/android 3.2.3/i'      =>  'Android 3.2.3'         ,
      '/android 4.0.0/i'      =>  'Android 4.0.0'         ,
      '/android 4.0.3/i'      =>  'Android 4.0.3'         ,
      '/android 4.2.2/i'      =>  'Android 4.2.2'         ,
      '/android 4.4.1/i'      =>  'Android 4.4.1'         ,
      '/android 4.4.4/i'      =>  'Android 4.4.4'         ,
      '/mac_powerpc/i'        =>  'Mac OS 9'              ,
      '/iphone/i'             =>  'iPhone'                ,
      '/tablet os/i'          =>  'Table OS'              ,
      '/webos/i'              =>  'Mobile'
    );

		foreach ($os_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}
    }
   
		return $os_platform;
	}

	public static function  get_browser() {

		$user_agent= self::get_user_agent();

		$browser        =   "Unknown Browser";

		$browser_array  =   array(
			'/msie/i'       =>  'Internet Explorer',
			'/Trident/i'    =>  'Internet Explorer',
			'/firefox/i'    =>  'Firefox',
			'/safari/i'     =>  'Safari',
			'/chrome/i'     =>  'Chrome',
			'/edge/i'       =>  'Edge',
			'/opera/i'      =>  'Opera',
			'/netscape/i'   =>  'Netscape',
			'/maxthon/i'    =>  'Maxthon',
			'/konqueror/i'  =>  'Konqueror',
			'/ubrowser/i'   =>  'UC Browser',
			'/mobile/i'     =>  'Handheld Browser'
		);

		foreach ($browser_array as $regex => $value) {
			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}
		}

		return $browser;
	}

	public static function  get_device(){

		$tablet_browser = 0;
		$mobile_browser = 0;

		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$tablet_browser++;
		}

		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
			$mobile_browser++;
		}

		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
			$mobile_browser++;
		}

		$mobile_ua = strtolower(substr(self::get_user_agent(), 0, 4));
		$mobile_agents = array(
			'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			'newt','noki','palm','pana','pant','phil','play','port','prox',
			'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
			'wapr','webc','winw','winw','xda ','xda-');

		if (in_array($mobile_ua,$mobile_agents)) {
			$mobile_browser++;
		}

		if (strpos(strtolower(self::get_user_agent()),'opera mini') > 0) {
			$mobile_browser++;
	    //Check for tablets on opera mini alternative headers
			$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
			if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
				$tablet_browser++;
			}
		}

    // do something for tablet devices
		if ($tablet_browser > 0) return 'Tablet';

    // do something for mobile devices
		else if ($mobile_browser > 0) return 'Mobile';

    // do something for everything else
		else return 'Computer';
	}
}
