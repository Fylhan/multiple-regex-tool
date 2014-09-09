<?php
$matchPatterns = array(
	'^.*<body>\s*' => '',
	'\s*</body>.*$' => '',
	'<p>Sc.+ne ([IVX]+)<br\s*/>\s*' => '<h5>Scène $1</h5>'."\n".'<p>',
	'<p>\s*<br\s*/>\s*<em>(.*?)</em>\s*<br\s*/>\s*' => '<p><em>\1</em></p>'."\n".'<p>',
	'\s*<div class="body">\s*<h2>Acte ([IVX]+)</h2>\s*' => '<div class="body">'."\n".'<h4>Acte \1</h4>'."\n".'<br />'."\n".'',
	'\s*</div>\s*' => ''."\n".'</div>'."\n".'',
	'&#8722;' => '-',
	'(^|[\s,\.:-])(mérit|dir|devr|av|saur|voy|cherch|tromper|ser)oi(s)' => '$1$2ai$3',
	'(par)oi(ssant)' => '$1ai$2',
);
