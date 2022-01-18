<!-- *************************************************************
 *****************************************************************
 ***                                                            **
 ***        Woolworths Electronic Ink Control System            **
 ***           Copyright (C) 2021, Vector Systems               **
 ***                   All Rights Reserved                      **
 ***                                                            **
 *****************************************************************
 ************************************************************* -->

 <?php
	$debug = 0; // debugging level (0 = off, 1 = light, 2 = heavy)

	//include 'defines.php'; // defines

	// pings the specified IP address
	// returns true if succeeded or false if it failed

	
	//require 'db_processor.php'; // database processor

	// locally used variables
	$error = 0;
	$devices = 0; // the amount of ESP32 devices found on the network
	
	// global variables
	//$data = 0; // used to store the NMAP data globally
	//$GLOBALS['$data'] = $data;
	$scan_count = 0;
    private function ping($ip_addr)
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
	private function getIPAddress(array $data) : string
	{
		$ip = "";
		$data = $data["address"];
		
		if (isset($data["@attributes"]))
		{
			if ($data["@attributes"]["addrtype"] === "ipv4")
			{
				$ip = $data["@attributes"]["addr"];
			}
		}
		else
		{
			foreach ($data as $address)
			{
				$attr = $address["@attributes"];
				
				if ($attr["addrtype"] === "ipv4")
				{
					$ip .= $attr["addr"] . " / ";
				}
			}
			
			$ip = substr($ip, 0, -3);
		}
		
		return $ip;
	}

	private function getMACAddress(array $data) : array
	{
		$mac = [];
		
		$data = array_values(
			array_filter($data["address"], function (array $address): bool
			{
				return isset($address["@attributes"]) && $address["@attributes"]["addrtype"] === "mac";
			})
		);
		
		if (isset($data[0]))
		{
			$mac = $data[0]["@attributes"];
		}
		
		return $mac;
	}

	private function ProcessNMAP()
	{
		// nmap
		//declare(strict_types=1);
		//@mkdir("errors"); // create the 'errors' directory
		//@touch("errors/errors.txt"); // nmap errors will go to this error file

		// $dataDirectory = __DIR__ . "\\errors\\";
		//$outFile = sys_get_temp_dir();
		$found = false;

		// the parameter 192.168.1.1/24 translates to start at IP address 192.168.1.1 and
		// work right through all IP addresses up to and including 192.168.1.255
		$scan = "192.168.1.2/24"; // scan url
		
		$dataDirectory = `\\errors\\`;
        $outFile = public_path("\\errors\\nmap_out.xml");
		
		// $outFile = __DIR__ . "\\errors\\nmap_out.xml";
		
		// specify process
		$descriptors = array(
			0 => array('pipe', 'r'), // stdin
			1 => array('pipe', 'w'), // stdout
			2 => array("file", "C:\\Webs\\woolworths-eink\\MASTER-SEVER\\public\\errors\\errors.txt", "a") // stderr is a file to write to
		);

		// attempt to scan 4 times
		for($i=0; $i<4; $i++)
		{
			$debug = 0;
			$process = proc_open("nmap -sn -oX \"$outFile\" $scan", $descriptors, $pipes, "C:\\Program Files (x86)\\NMap"); // handle nmap process
			proc_close($process); // close the process
			
			$GLOBALS['$data'] = json_decode(json_encode(simplexml_load_file($outFile)), true); // parse nmap output
			if($debug >= 1) echo 'i = ' . $i . '<br />'; // debugging
			
			$temp = $GLOBALS['$data'];
			
			foreach($temp["host"] as $host)
			{
				if(!empty(getMACAddress($host)["vendor"]))
				{
					if(getMACAddress($host)["vendor"] === "Espressif")
					{
						if($debug >= 1) echo 'Found'; // debugging
						$found = true; // yep, we got one
						
						break;
					}
				}
			}
			
			if($found == true) break; // stop the loop
		}
		
		// handle hosts for print (debugging)
		/*foreach ($data["host"] as $host)
		{
			echo "IP Address: " . $host["address"]["@attributes"]["addr"] . "<br>";
			echo "IP Address: " . getIPAddress($host) . "<br>";
			
			echo sprintf("<pre>%s</pre>", json_encode($host, JSON_PRETTY_PRINT)) . PHP_EOL . "<hr>";
		}*/
		
		//@unlink($outFile); // remove the nmap output
	}

?>

			<?php
			if(!(isset($_POST['eink_tag_add'])))
			{ ?>
				<style>
					#ajax {
						margin-left: 40%;
					}

					#rescan-button {
						width: 626px;
					}

					#network_list {
						margin: auto;
					}

					@media (max-width: 690px) {
						#rescan-button {
							width: 425px;
						}
						#network_list {
							margin: auto;
							width: 425px;
						}
					}
				</style>
				<nav id="sidebar">
					<div class="custom-menu">
						<button type="button" id="sidebarCollapse" class="btn btn-primary">
							<i class="fa fa-bars"></i>
							<span class="sr-only">Toggle Menu</span>
						</button>
					</div>
					<div class="p-4">
						<h1><img src="{{asset('vendor1/images/logo.png')}}" alt="Home"><a class="logo"><span>Electronic Ink Control System</span></a>
						</h1>
						
						<!-- https://fontawesome.com/icons/ -->
						<ul class="list-unstyled components mb-5">
							<li><a href="{{url('/home')}}"><span class="fa fa-list mr-3 fa-active"></span>Overview</a></li>
							<li class="active"><a href="{{url('/tag')}}"><span class="fas fa-tag mr-3"></span>Tags</a></li>
							<!-- <li><a href="{{url('/remove')}}"><span class="fas fa-minus mr-3"></span>Remove</a></li>
							<li><a href="{{url('/edit')}}"><span class="far fa-edit mr-3"></span>Edit</a></li>
							<li><a href="{{url('/search')}}"><span class="fa fa-search mr-3"></span>Search</a></li> -->
							<li><a href="{{url('/schedule')}}"><span class="far fa-calendar-plus mr-3"></span>Schedule</a></li>
							<li><a href="{{url('/notices')}}"><span class="fa fa-exclamation-triangle mr-3"></span>Notices</a></li>
							<li><a href="{{url('/settings')}}"><span class="fa fa-cog mr-3"></span>Settings</a></li>
							<li><a href="{{('/support')}}"><span class="fa fa-question-circle mr-3"></span>Support</a></li>
							<li><a href="{{url('/about')}}"><span class="fa fa-user mr-3"></span>About</a></li>
							<!--<li><a><span>&nbsp;</span></a></li>-->
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="fas fa-sign-out-alt mr-3"></span>Logout</a></li>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</ul>
						
						<!--<div class="mb-5">-->
						<h3 class="h6 mb-3">System Identification</h3>
						<div class="footer"><p>WEINK-ABC-123-DEF-456-HIJ</p></div>
						<!--<form action="#" class="subscribe-form">
							<div class="form-group d-flex">
								<div class="icon"><span class="icon-paper-plane"></span></div>
								<input type="text" class="form-control" placeholder="Enter Email Address">
							</div>
						</form>-->
						<!--</div>-->
						<br/>
						<h3 class="h6 mb-3">Store Location</h3>
						<div class="footer"><p>Shop M1/799 Richmond Rd, Colebee, NSW, 2761</p></div>
					</div>
				</nav>
			<?php } ?>

		<!-- Page Content  -->
		<div class="content container-fluid-nw" style="width: 100%;">
			<?php
			if(!(isset($_POST['eink_tag_add'])))
			{
				echo '<h2>Add</h2>';
				echo '<h6 class="mb-4">Add a new electronic ink tag to the store shelves</h6>';
				echo '<hr />';
			}
			else
			{
				echo '<div align="center">';
					echo '<h2>Connecting</h2>';
					echo '<h6 class="mb-4">Attempting to connect to the selected tag<br /><br />Please Wait</h6>';
				echo '</div>';
			}
			/*
			if(!(isset($_POST['eink_tag_add'])))
			{
			?>
				Enter part or all of the MAC Address of the eInk tag (including hyphens)
				<p></p>
				<form>
					<label for="fname">MAC Address: </label>
					&nbsp;
					<input type="text" id="serial" name="serial">
					<input type="submit" value="Submit">
				</form>
				<br />
				<br />
				Or manually select from the list below the tag you want to add.
				<br />
				If you can't see the matching MAC address, click on 'Rescan' below.
				<p></p>
				<?php
			}*/
			?>
			<?php
			if(isset($_POST['nmap_rescan']))
			{
				//echo "Rescanning the network. Please Wait...";
				//echo '<script type="text/javascript">window.location.replace("add.php");</script>';

				$eink_tag_add = false;
			}

			if(isset($_POST['eink_tag_add']))
			{						
				$post__ip_address = $_POST['post__ip_address'];
				if($debug >= 1) echo $post__ip_address; // debugging

				$ping_result = ping($post__ip_address); // ping the eInk tag to make sure it's connected to the router

				//echo '<script type="text/javascript">window.location.replace("errors/ping_error.php");</script>'; // refresh the page

				// debugging
				if($debug >= 1)
				{
					if($ping_result == true) echo "Ping Succeeded<br /><br />";
					else echo "Ping Failed<br /><br />";
				}

				// if we can't get a response from the device, error out
				if($ping_result == false)
				{
					//$error = 1;

					echo '<span style="color:red">Failed to communicate with the eIink tag.<br />Please try selecting \'Add\' from the side menu and try again.</span>';
					echo '<br /><br />';
					echo 'If you still get this error, ensure that the eInk tag is powered on and connected to the router';
				}
				else
				//if($error == 0)
				{
					/*?>
					<form>
						<label for="fname">Product Name: </label>&nbsp;<input type="text" id="serial" name="serial">
						<br />
						<label for="fname">Product Price: </label>&nbsp;<input type="text" id="serial" name="serial">
						<br />
						<label for="fname">Price&nbsp;</label>&nbsp;<input type="text" id="serial" name="serial">&nbsp;per<label for="fname"></label>&nbsp;<input type="text" id="serial" name="serial">&nbsp;gramm(s)
						<br />
						<br />
						<label for="fname">Enable 1/2 (half) price? (NOTE: You can always enable this later) </label>&nbsp;<input type="checkbox" id="serial" name="serial">
						<br />
						<br />
						<input type="submit" value="Add eInk Tag">
					</form>
					<?php*/

					/*echo "<script>
						window.open(\"http://$post__ip_address\", 'mywindow', 'location=1, status=1, scrollbars=1, resizable=1, directories=1, toolbar=1, titlebar=1');
					</script>";

					echo 'A new window was opened where you can enter the item details.';
					echo '<br />';
					echo 'If the window opened and failed to connect, please ensure the eInk tag is powered up and online. You will then need to try again by clicking on \'Add\' from the side menu.';
					echo '<br /><br />';
					echo 'Once you have submitted the data on the newly opened window, if you\'d like to add another tag, please click on \'Add\' again from the side menu.';*/

					//echo '<script type="text/javascript">window.location.replace(\'http://$ip_address\');</script>';
					echo '<script type="text/javascript">window.location.href = "http://' . $post__ip_address .'";</script>';
					?>
				<?php
				}
			}
			else
			{
				ProcessNMAP(); // execute NMAP.EXE on the server

				?>
				
				<table id="network_list" border=0>
					<tr>
						<td width="150px">IP Address&nbsp;
							<span style="font-size: 16px; color:gray;">
								<i class="fas fa-wifi"></i>
							</span>
						</td>
						<td width="175px">MAC Address&nbsp;
							<span style="font-size: 16px; color:gray;">
								<i class="fas fa-location-arrow"></i>
							</span>
						</td>
						<td width="170px">Vendor ID&nbsp;
							<span style="font-size: 16px; color:gray;">
								<i class="fas fa-address-card"></i>
							</span>
						</td>
						<td width="130px">&nbsp;</td>
					</tr>
					<tr>
						<td><!--&nbsp;--></td>
						<td><!--&nbsp;--></td>
						<td><!--&nbsp;--></td>
						<td><!--&nbsp;--></td>
					</tr>
					<?php
					$data = $GLOBALS['$data'];
					foreach ($data["host"] as $host):
					{
						$allowedNames = ["Espressif"];
						if(!empty(getMACAddress($host)["vendor"])) $vendor_name = getMACAddress($host)["vendor"] /*?? "-"*/;

						//echo $vendor_name . '<br />'; // debugging

						// only show ESP32 devices on the network
						if (in_array($vendor_name, $allowedNames))
						{
							$ip_address = getIPAddress($host, "ipv4") /*?? "-"*/;
							$mac_address = getMACAddress($host)["addr"] /*?? "-"*/;
							$ESP32_vendor_name = $vendor_name; // save it

							$devices += 1; // increment the counter by one
						}
						//else continue;
					}
					endforeach;
					
					if($devices > 0)
					{
					?>
						<tr>
							<td id='dev_ip_address'><?php echo $ip_address; ?></td>
							<td><?php echo strtoupper($mac_address); ?></td>
							<td><?php echo $ESP32_vendor_name; ?></td>
							<td>
								
									<input type="button" name="eink_tag_add" onclick="addconnect()" class="btn btn-outline-green" style=" width: 100%;" value="Add"/>
									<form method="post">
									<input type="hidden" name="post__ip_address" value="<?php echo $ip_address; ?>" >
									<input type="hidden" name="post__mac_address" value="<?php echo $mac_address; ?>" >
								</form>
							</td>
						</tr>
					<?php
					}
					else
					{
					?>
						<tr>
							<td><?php echo 'N/A'; ?></td>
							<td><?php echo 'N/A'; ?></td>
							<td><?php echo 'N/A'; ?></td>
							<td></td>
						</tr>
					<?php
					}
					if($devices == 0)
					{
						echo 'No Devices Found. Make sure the eInk tag is powered on and then try clicking on \'Rescan\'<br /><br />';
						/*
						?> <div id="network_list_hide"></div> <?php // hide the network list
						*/

						// execute NMAP.EXE on the server again if it's less than the count limit
						/*if($scan_count < 3)
						{
							ProcessNMAP();
							$scan_count += 1;
						}

						echo $scan_count;
						echo '<br />';*/
					}
					else
					{
						if($devices < 1 ) echo 'Found ' . $devices . ' eInk tags on the network';
						else echo 'Found ' . $devices . ' eInk tag on the network';
						echo '<br /><br />';

						?> <div id="network_list_show"></div> <?php // show the network list
					}
					?>
				</table>
				<br />
				<div style="width: fit-content; margin:auto;">
					<input type="button" onclick="location.reload()" name="nmap_rescan" id="rescan-button" class="btn btn-outline-green" value="Rescan"/>
				</div>
				
			<?php
			}
			?>
			<script type="text/javascript" src="{{asset('vendor1/js/jquery.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('vendor1/js/popper.js')}}"></script>
			<script src="{{asset('vendor1/js/bootstrap.min.js')}}"></script>
			<script src="{{asset('vendor1/js/bootstrap.bundle.min.js')}}"></script>
			<script type="text/javascript" src="{{asset('vendor1/js/main.js')}}"></script>
			<script>
			// show the network list
			$('#network_list_show').toggle(function()
			{
				$('#network_list').show() // just hide it
			});

			// hide the network list
			$('#network_list_hide').toggle(function()
			{
				$('#network_list').hide() // just hide it
			});

			// toggle the network list (show/hide)
			$('#network_list_toggle').toggle(function()
			{
				$('#network_list').toggle('fast', function() // toggle it with an animation
				{
					//alert($('#network_list').is(":visible")); // debugging
				});
			});
		</script>