<?php

	include 'connection.php';
	$compl_type = $_SESSION['ad_type'];
	$sqlcomp = "SELECT * FROM complain WHERE comp_type = '$compl_type' ";
	$result = mysqli_query($conn,$sqlcomp);
	$noOfComp = mysqli_num_rows($result);
	$cur_time = date("h:i:s");
	$type = 0;

	function calc_time($a)
  {
    if ($a < 60)
    {
    	$GLOBALS['type'] = 1;
      return $a;
    }
    else if ($a < 3600)
    {
    	$GLOBALS['type'] = 2;
      return floor($a/60) ;
    }
    else if ($a < 86400)
    {	
    	$GLOBALS['type'] = 3;
    	return floor($a/3600) ;
    }
    else
    {
    	$GLOBALS['type'] = 4;
    	return floor($a/86400);
    }
  }

  function show_time($b)
  {
  	if ($b == 1)
  		return ' seconds ago';
  	else if ($b == 2)
  		return ' minutes ago';
  	else if ($b == 3)
  		return ' hours ago';
  	else 
  		return ' days ago';
  }

?>