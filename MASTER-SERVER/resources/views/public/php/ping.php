<?php
	//include 'defines.php'; // defines

	// pings the specified IP address
	// returns true if succeeded or false if it failed
	function ping($ip_addr)
	{
		$result = shell_exec("ping $ip_addr");

		/*if($debug >= 1)
		{
			echo $result;
			echo '<br />';
			echo '<br />';
		}*/

		if (strpos($result, 'Request timed out') !== false) return false; // failed
		else return true; // success
	}
?>