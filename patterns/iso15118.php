<?php
$matchPatterns = array(
	'![‘’]!u' => '\'',
	'![“”]!u' => '"',
	'!(\r\n)?\s*ISO/IEC FDIS 15118-2:2013\(E\)\s*[0-9]*\s*© ISO/IEC 2013 – All rights reserved\s*[0-9]*\s*!' => "\n",
	// '!(\r\n)?\s*ISO/IEC FDIS 15118-2:2013\(E\)\s*(\r\n)?!' => "\n",
	'!\r\n([a-zA-Z\'"\(_-])!' => ' $1',
	'! NOTE(\d*)\s*!i' => "\n".'NOTE\1 ',
	'! (and|or|to)\s*\r\n!i' => '$1 ',
	'!]\s*!' => '] ',
);
