<?php

  $txt = file_get_contents('ticketcontents.txt');

  $re1='(var)';	# Word 1
  $re2='( )';	# White Space 1
  $re3='(csrfToken)';	# Word 2
  $re4='( )';	# White Space 2
  $re5='(=)';	# Any Single Character 1
  $re6='( )';	# White Space 3
  $re7='(\')';	# Any Single Character 2
  $re8='.*?';	# Non-greedy match on filler
  $re9='((?:[a-z][a-z]*[0-9]+[a-z0-9]*))';	# Alphanum 1
  $re10='(\')';	# Any Single Character 3
  $re11='(;)';	# Any Single Character 4

  if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6.$re7.$re8.$re9.$re10.$re11."/is", $txt, $matches))
  {
      $word1=$matches[1][0];
      $ws1=$matches[2][0];
      $word2=$matches[3][0];
      $ws2=$matches[4][0];
      $c1=$matches[5][0];
      $ws3=$matches[6][0];
      $c2=$matches[7][0];
      $alphanum1=$matches[8][0];
      $c3=$matches[9][0];
      $c4=$matches[10][0];
      print "$alphanum1";
  }

?>
