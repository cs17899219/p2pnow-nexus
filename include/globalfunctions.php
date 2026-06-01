<?php
if(!defined('IN_TRACKER'))
die('Hacking attempt!');

function get_global_sp_state()
{
	global $Cache;
	static $global_promotion_state;
	if (!$global_promotion_state){
		if (!$global_promotion_state = $Cache->get_value('global_promotion_state')){
			$res = mysql_query("SELECT * FROM torrents_state");
			$row = mysql_fetch_assoc($res);
			$global_promotion_state = $row["global_sp_state"];
			$Cache->cache_value('global_promotion_state', $global_promotion_state, 57226);
		}
	}
	return $global_promotion_state;
}

// IP Validation
function validip($ip, $allow_private = false)
{
	$ip = trim($ip);
	if ($ip == "" || strpos($ip, ',') !== false || preg_match('/\s/', $ip))
		return false;
	if (function_exists('filter_var')) {
		$flags = 0;
		if (!$allow_private) {
			if (defined('FILTER_FLAG_NO_PRIV_RANGE'))
				$flags |= FILTER_FLAG_NO_PRIV_RANGE;
			if (defined('FILTER_FLAG_NO_RES_RANGE'))
				$flags |= FILTER_FLAG_NO_RES_RANGE;
		}
		return filter_var($ip, FILTER_VALIDATE_IP, $flags) !== false;
	}
	if (!empty($ip) && ip2long($ip) && $ip == long2ip(ip2long($ip)))
		return true;
	return false;
}

function is_trusted_proxy_ip($ip)
{
	global $trusted_proxy_ips;
	if (!isset($trusted_proxy_ips) || !$trusted_proxy_ips)
		return false;
	$trusted = preg_split('/[\s,]+/', $trusted_proxy_ips, -1, PREG_SPLIT_NO_EMPTY);
	return in_array($ip, $trusted);
}

function getip() {
	if (isset($_SERVER) && isset($_SERVER['REMOTE_ADDR'])) {
		$remote = $_SERVER['REMOTE_ADDR'];
	} else {
		$remote = getenv('REMOTE_ADDR');
	}
	$ip = validip($remote, true) ? $remote : '0.0.0.0';
	if (is_trusted_proxy_ip($ip)) {
		$forwarded = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : getenv('HTTP_X_FORWARDED_FOR');
		if ($forwarded) {
			$parts = explode(',', $forwarded);
			$candidate = trim($parts[0]);
			if (validip($candidate))
				$ip = $candidate;
		}
	}

	return $ip;
}

function sql_query($query)
{
	global $query_name;
	$query_name[] = $query;
	return mysql_query($query);
}

function sqlesc($value) {
		$value = "'" . mysql_real_escape_string($value) . "'";
	return $value;
}

function hash_pad($hash) {
    return str_pad($hash, 20);
}

function hash_where($name, $hash) {
	$shhash = preg_replace('/ *$/s', "", $hash);
	return "($name = " . sqlesc($hash) . " OR $name = " . sqlesc($shhash) . ")";
}
?>
