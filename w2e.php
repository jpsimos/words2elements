<!doctype html>
<html>
	<head>
		<!-- Dedicated to a chemical engineer... -->
		<meta charset="utf-8">
		<meta author="jacob psimos">
		<title>Words 2 Elements</title>
		<style type="text/css">
			blue{
				color: blue;
			}
			green{
				color: green;
			}
			z{
				color: red;
			}
			table{
				border-style: solid;
				border-width: 1px;
			}
			table tr,td{
				border-style: solid;
				border-width: 1px;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
		<form method="post">
			<label for="txtWord">Words</label>
			<input type="text" name="txtWords"> <input type="submit" value="Go">
		</form>
		<?php
			if(isset($_POST['txtWords'])){
				$csv = fopen('elements.csv', 'r');
				$symbols = array();
				fgetcsv($csv);
				while($row = fgetcsv($csv)){
					$symbols[$row[2]] = $row[1];
				}
				fclose($csv);
				$words = $_POST['txtWords'];
				echo "<table><tr><td colspan=\"2\">Some Combinations</td></tr><tr><td>$words&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
						. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td></tr>";
				foreach($symbols as $symbol => $element){
					if(($pos = stripos($words, $symbol)) !== FALSE){
						$words = str_ireplace($symbol, "<z>$symbol</z>", $words);
						echo "<tr><td>$words</td><td>$element</td></tr>";
					}
				}
				$words = $_POST['txtWords'];
				echo "</table><br><br><table><tr><td colspan=\"2\">Matches</td></tr><tr><td>$words&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
						. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td></tr>";
				foreach($symbols as $symbol => $element){
					if(($pos = stripos($words, $symbol)) !== FALSE){
						$out = str_ireplace($symbol, "<z>$symbol</z>", $words);
						echo "<tr><td>$out</td><td>$element</td></tr>";
					}
				}
				echo '</table>';
			}
		?>
	</body>
</html>
