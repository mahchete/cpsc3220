<html>
<head><title></title></head>

<body>
	<?php
		// First Names
		$firstNames = fopen('hw2_data/first_names.csv', 'r');
		$firstNames = fgetcsv($firstNames);

		//Last Names
		$lastNames = file("hw2_data/last_names.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

		//Street Names
		$streetNames = [];
		foreach (file("hw2_data/street_names.txt") as $temp) {
            if (ctype_space($temp))
                continue;
            $streetNames = array_merge($streetNames, explode(":",trim($temp)));
        }

		//Street Types
		$streetTypes = file_get_contents("hw2_data/street_types.txt");
		$streetTypes = str_replace(array("\n", ".."), '', $streetTypes);
		$streetTypes = trim($streetTypes);
		$streetTypes = explode(';', $streetTypes);

		//Domains
		$domains = [];
		$domainsFinal = [];
		foreach (file("hw2_data/domains.txt") as $tempString) {
		            $domains = array_merge($domains, explode(".",trim($tempString)));
		        }
		        $val = 0;
		        foreach ($domains as $value) {
		            if ($val%2 == 0) {
		                array_push($domainsFinal, $domains[$val].".".$domains[$val+1]); 
		            }
		            $val++;
		        }
	?>
		
	<!--- Printing arrays to user --->
	<?php
		print("<pre>");
		print("<h2>First Names</h2>");
		print_r($firstNames);
		print("<h2>Last Names</h2>");
		print_r($lastNames);
		print("<h2>Street Names</h2>");
		print_r($streetNames);
		print("<h2>Street Types</h2>");
		print_r($streetTypes);
		print("<h2>Domains</h2>");
		print_r($domainsFinal);
		print("</pre>")
	?>

	<table border="1">   
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>Email</th>
    </tr>

   <?php
    	for($row = 0; $row < count($firstNames); $row++) {
    		$randFirst = rand(0, 24);
    		$randLast = rand(0, 24);
    		$randNum = rand(0, 999);
    		$randStreet = rand(0, 37);
    		$randType = rand(0, 9);
    		$randDomain = rand(0, 7);

    		print("<tr>");
			print("<td>".$firstNames[$randFirst]."</td>");
			print("<td>".$lastNames[$randLast]."</td>");
			print("<td>".$randNum." ".$streetNames[$randStreet]." ".$streetTypes[$randType]."</td>");
			print("<td>".$firstNames[$randFirst].".".$lastNames[$randLast]."@".$domainsFinal[$randDomain]."</td>");
			print("</tr>");

			$email = "{$firstNames[$randFirst]}.{$lastNames[$randLast]}@{$domainsFinal[$randDomain]}";
			$full_name = "{$firstNames[$randFirst]}:{$lastNames[$randLast]}";
			$address = "{$randNum} {$streetNames[$randStreet]} {$streetTypes[$randType]}";

			$customer_data[] =  "{$full_name}:{$address}:{$email}";

			$file = fopen('customers.txt', 'w');
			foreach ($customer_data as $line) {
				fwrite($file, $line . PHP_EOL);
			}
			fclose($file);
    	}
	?>
    </table>

</body>
</html>