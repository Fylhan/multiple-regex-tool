<?php

if (isset($_POST['inputpath']) || isset($_POST['input'])) {
	// -- Retrieve input(s)
	$inputList = array();
	// Input path: file(s) or folder
	if (isset($_POST['inputpath']) && NULL != $_POST['inputpath'] && "" != $_POST['inputpath']) {
		$inputpath = $_POST['inputpath'];
		// TODO: recursive on subfolder
		foreach (glob($inputpath, GLOB_BRACE) as $filename) {
			if (is_file($filename)) {
				$filenameList[] = $filename;
				$inputList[] = file_get_contents($filename);
			}
		}
	}
	else {
		$filenameList[] = 'input';
		$inputList[] = @$_POST['input'];
	}
	$matchPatternsFile = __DIR__.'/patterns/'.@$_POST['matchPatterns'].'.php';
	if (!is_file($matchPatternsFile)) {
		die('There is no such patterns: '.$matchPatternsFile);
	}
	include_once($matchPatternsFile);

	// -- Compute
	$outputList = array();
	mb_internal_encoding('UTF-8');
	foreach($inputList AS $input) {
		$output = $input;
		foreach($matchPatterns AS $pattern => $replace) {
			try {
				$output = preg_replace($pattern, $replace, $output);
				if (NULL == $output) {
					echo 'Error with this replacement: '.$pattern.' -> '.$replace.'<br />';
				}
			}
			catch(\Exception $e) {
				echo 'Error with this replacement: '.$pattern.' -> '.$replace.'<br />';
				var_dump($e);
			}
		}
		$outputList[] = $output;
	}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
	<title>Regex tool</title>
	<meta name="author" content="BN" />
</head>
<body>
	<form method="post">
	<fieldset>
		<legend>Pattern to search and replace</legend>
		<select id="matchPatterns" name="matchPatterns">
			<option value="iso15118">Clean norme ISO/IEC 15118</option>
			<option value="dot2wp">Dotclear => Wordpress</option>
			<option value="epub">Clean ePub</option>
		</select>
		<!--<label for="match0">Search</label>
			<input type="text" name="match[0]" id="match0" value="<?php echo @$_POST['match'][0]; ?>" style="width:100%;" />
		<label for="replace0">and replace by</label>
			<input type="text" name="replace[0]" id="replace0" value="<?php echo @$_POST['replace'][0]; ?>" style="width:100%;" />-->
	</fieldset>
	<fieldset>
		<legend>Will be applied on</legend>
		<input type="submit" value="Send" /><br />
		<label for="inputpath">This file or folder</label>
			<input type="text" name="inputpath" id="inputpath" value="<?php echo @$_POST['inputpath']; ?>" style="width:100%;" />
		<label for="input">or this input</label>
			<textarea name="input" id="input" style="width:100%;" rows="8"><?php echo @$_POST['input']; ?></textarea>
		<input type="submit" value="Send" /><br />
		<?php 
		if (isset($outputList) && count($outputList) > 0) {
			foreach($outputList AS $i => $output) {
				echo "\t\t".'<label for="output'.$i.'">Output: '.$filenameList[$i].'</label>'."\n".
					"\t\t\t".'<textarea name="ouput'.$i.'" id="output'.$i.'" style="width:100%;" rows="18">'.$output.
'</textarea>'."\n";
			}
		}
		?>
	</fieldset>
	</form>
</body>
</html>