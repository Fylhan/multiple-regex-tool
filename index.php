<?php

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

// -- Retrieve patterns
$matchPatterns = array();
$replacePatterns = array();

// $matchPatterns[] = '^.*<body>\s*';
// $replacePatterns[] = '';

// $matchPatterns[] = '\s*</body>.*$';
// $replacePatterns[] = '';

// $matchPatterns[] = '<p>Sc.+ne ([IVX]+)<br\s*/>\s*';
// $replacePatterns[] = '<h5>Scène $1</h5>'."\n".'<p>';

// $matchPatterns[] = '<p>\s*<br\s*/>\s*<em>(.*?)</em>\s*<br\s*/>\s*';
// $replacePatterns[] = '<p><em>\1</em></p>'."\n".'<p>';

// $matchPatterns[] = '\s*<div class="body">\s*<h2>Acte ([IVX]+)</h2>\s*';
// $replacePatterns[] = '<div class="body">'."\n".'<h4>Acte \1</h4>'."\n".'<br />'."\n".'';

// $matchPatterns[] = '\s*</div>\s*';
// $replacePatterns[] = ''."\n".'</div>'."\n".'';

// $matchPatterns[] = '&#8722;';
// $replacePatterns[] = '-';

// $matchPatterns[] = '(^|[\s,\.:-])(mérit|dir|devr|av|saur|voy|cherch|tromper|ser)oi(s)';
// $replacePatterns[] = '$1$2ai$3';

// $matchPatterns[] = '(par)oi(ssant)';
// $replacePatterns[] = '$1ai$2';

// Striptag
$matchPatterns[] = "#<\s*/?(?:[a-zA-Z0-9-]+)(?: (?:\s*\w+=(['\"])(?:(?!\g{1}).|(?:(?<=\\\)\g{1}))+\g{1})*(?:\s*\w*\s*))?/?>#S";
$replacePatterns[] = ' ';

// -- Compute
$outputList = array();
foreach($inputList AS $input) {
	$output = $input;
	foreach($matchPatterns AS $i => $matchPattern) {
		// $output = preg_replace('!'.$matchPattern.'!isU', $replacePatterns[$i], $output);
		$output = preg_replace($matchPattern, $replacePatterns[$i], $output);
	}
	$outputList[] = $output;
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
	<!--<fieldset>
		<legend>Pattern to search and replace</legend>
		<label for="match0">Search</label>
			<input type="text" name="match[0]" id="match0" value="<?php echo @$_POST['match'][0]; ?>" style="width:100%;" />
		<label for="replace0">and replace by</label>
			<input type="text" name="replace[0]" id="replace0" value="<?php echo @$_POST['replace'][0]; ?>" style="width:100%;" />
	</fieldset>-->
	<fieldset>
		<legend>Will be applied on</legend>
		<input type="submit" value="Send" /><br />
		<label for="inputpath">This file or folder</label>
			<input type="text" name="inputpath" id="inputpath" value="<?php echo @$_POST['inputpath']; ?>" style="width:100%;" />
		<label for="input">or this input</label>
			<textarea name="input" id="input" style="width:100%;" rows="15"><?php echo @$_POST['input']; ?></textarea>
		<input type="submit" value="Send" /><br />
		<?php 
		if (isset($outputList) && count($outputList) > 0) {
			foreach($outputList AS $i => $output) {
				echo "\t\t".'<label for="output'.$i.'">Output: '.$filenameList[$i].'</label>'."\n".
					"\t\t\t".'<textarea name="ouput'.$i.'" id="output'.$i.'" style="width:100%;" rows="15">'.$output.
'</textarea>'."\n";
			}
		}
		?>
	</fieldset>
	</form>
</body>
</html>