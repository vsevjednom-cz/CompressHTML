<?php

function compressJS($buffer) {

$replace = array(
"/\/\*[\s\S]*?\*\//" => '',//remove nultile line comment
"/\/\/.*$/" => '',//remove single line comment
'#[\r\n]+#'   => "\n",// remove blank lines and \r's
'#\n([ \t]*//.*?\n)*#s'   => "\n",// strip line comments (whole line only)
'#([^\\])//([^\'"\n]*)\n#s' => "\\1\n",
'#\n\s+#' => "\n",// strip excess whitespace
'#\s+\n#' => "\n",// strip excess whitespace
'#(//[^\n]*\n)#s' => "\\1\n", // extra line feed after any comments left
);

$search = array_keys( $replace );
$script = preg_replace( $search, $replace, $buffer );
$replace = array(
"&&\n" => '&&',
'|| ' => '||',
"(\n"  => '(',
")\n"  => ')',
"[\n"  => '[',
"]\n"  => ']',
"+\n"  => '+',
",\n"  => ',',
"?\n"  => '?',
":\n"  => ':',
";\n"  => ';',
"{\n"  => '{',
"\n]"  => ']',
"\n)"  => ')',
"\n}"  => '}',
' ='  => '=',
'= '  => '=',
"\n\n" => ' ',
'if (' => 'if(',
' || ' => '||'
);
$search = array_keys($replace);
$script = str_replace( $search, $replace, $script );
$script = str_replace(';}', '}',$script);
return  $script;

}

?>
