<?php
$matchPatterns = array(
'!__(construct|string|get|set|clone|destruct|unset)!i' => 'MAGIC_METHOD_PREFIX$1',
'!__(.*)__!isU' => '<strong>$1</strong>',
'!\'\'(.*)\'\'!isU' => '<em>$1</em>',
'!--(.*)--!isU' => '<del>$1</del>',
'!@@(.*)@@!isU' => '<code>$1</code>',
// $matchPatterns[] = '!\[([^\]|]*)|tag:([^\]|]*)\]!isU',
// $replacePatterns[] = '<a href="/tag/$2">$1</a>',
// $matchPatterns[] = '!\[([^\]|]*)\|([^\]|]+)\]!isU','!\[\s*?([^\]]+)\s*?\|([^\]|]+)\]!isU' => '<a href="$2">$1</a>',
// $matchPatterns[] = '!\(\(/public/([^\]|]+)|([^\]|]+)|([^\]|]+)|([^\]\)|]+)\)\)!','!\s*?\(\(/public/(.+)\|(.+)\|([clr])\|(.+)\)\)\s*?!iU',
// $replacePatterns[] = '\n<img src="/wp-content/uploads/\1" alt="\2" class="align\3 size-medium" />\n' => "\n<img src=\"/wp-content/uploads/$1\" alt=\"$2\" class=\"align$3 size-medium\" />\n";
// $matchPatterns[] = '!\s*///\s*\[([^\]]*)\]\s*?(.*)\s*?///(\s+|$)!isU','!\s*///\s*\[([^\]]*)\]\s*\[/[^\]]*\]\s+(.*)\s*?///(\s+|$)!isU',
// $matchPatterns[] = '!\s*///\s*\[([^\]]*)\]*\]\s+(.*)\s*?///(\s+|$)!isU' => "\n[$1]\n$2\n[/$1]\n";
'!\[apache\](.*)\[/apache\]!isU' => '[code]$1[/code]',
// Remove * in code'!(\[(?:xml|php|code|bash|sql|html|css)\].*)\*(.*\[/(?:xml|php|code|bash|sql|html|css)\])!isU' => '$1STAR$2',
'!([^\]]*);\s+([^\]]*)!isU' => "$1;\n$2";
'!\!?\!\!\s*([A-Z][a-zàâäéèêëîïôöùûü \':_\?,-]+)\s+([A-Z\*])!sU',
// $matchPatterns[] = '!\!\!\!\s*([A-Z][a-zàâäéèêëîïôöùûü \':_\?,-]+)\s+([A-Z\*])!sU' => "\n<h3>$1</h3>\n$2";
'! ((\t|  )+)!isU' => "\n$1";
/* Liste */
// $matchPatterns[] = '!\s*\*\s*(\S)!isU','!\s*\*\s*(\S[^\*]*)\s*\*\s+!isU' => "</li>\n<li>$1</li>\n<li>";
'!:\s*</li>(\s*<li>)!U' => ":\n<ul>$1";
/* Fin Liste */
'!(<\?php|\})\s*([ci\}])!i' => "$1\n$2";
'!\s+\?>\s+!' => "\n";
/* Citation */
'!\r!' => "";
'!%%% > %%%!sU' => "\n%%%";
'!%%%!' => "\n%%%";
'!%%% > (.+)\n!' => "$1\n";
// $matchPatterns[] = '! > (.+)\n!',
// $replacePatterns[] = "\n<pre>\n$1\n";
/* Fin Citation */
'!\s*%%%\s*!' => "\n\n";
'!alignR!' => "alignright";'!alignL!' => "alignleft";'!alignC!' => "aligncenter";
// Recreate __ under magic methods'!MAGIC_METHOD_PREFIX!' => '__',
// Recreate * in code
'!STAR!' => '*',
// $matchPatterns[] = '\s*\*\s*([^\*]+)/*\*\s*',
// $replacePatterns[] = "</li>\n<li>\1</li>\n<li>";
// $matchPatterns[] = '((/public/([^|]+)|([^|]+)|([^|]+)|([^)]+)))',
// $replacePatterns[] = '\n<img src="/wp-content/uploads/$3" alt="$4" class="align$5 size-medium" />\n',
);
