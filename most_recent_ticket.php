<?php

$txt = file_get_contents('tickets.txt');

  $re1='(<[^>]+>)';	# Tag 1
  $re2='(<[^>]+>)';	# Tag 2
  $re3='(<)';	# Any Single Character 1
  $re4='((?:[a-z][a-z]+))';	# Word 1
  $re5='(.)';	# Any Single Character 2
  $re6='((?:[a-z][a-z]+))';	# Word 2
  $re7='(=)';	# Any Single Character 3
  $re8='(")';	# Any Single Character 4
  $re9='((?:[a-z][a-z]+))';	# Word 3
  $re10='(")';	# Any Single Character 5
  $re11='( )';	# Any Single Character 6
  $re12='((?:[a-z][a-z0-9_]*))';	# Variable Name 1
  $re13='(=)';	# Any Single Character 7
  $re14='(")';	# Any Single Character 8
  $re15='((?:[a-z][a-z]+))';	# Word 4
  $re16='(\\[.*?\\])';	# Square Braces 1
  $re17='(")';	# Any Single Character 9
  $re18='(.)';	# Any Single Character 10
  $re19='(value)';	# Variable Name 2
  $re20='(=)';	# Any Single Character 11
  $re21='(")';	# Any Single Character 12
  $re22='(\\d+)';	# Integer Number 1
  $re23='(")';	# Any Single Character 13
  $re24='( )';	# Any Single Character 14
  $re25='((?:[a-z][a-z0-9_]*))';	# Variable Name 3
  $re26='(=)';	# Any Single Character 15
  $re27='(".*?")';	# Double Quote String 1
  $re28='( )';	# Any Single Character 16
  $re29='(\\/)';	# Any Single Character 17
  $re30='(>)';	# Any Single Character 18
  $re31='(<[^>]+>)';	# Tag 3
  $re32='(<[^>]+>)';	# Tag 4

  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10.$re11.$re12.$re13.$re14.$re15.$re16.$re17.$re18.$re19.$re20.$re21.$re22.$re23.$re24.$re25.$re26.$re27.$re28.$re29.$re30.$re31.$re32."/is", $txt, $matches))
  {
      $int1=$matches[22][0];
      print "$int1";
  }

?>
