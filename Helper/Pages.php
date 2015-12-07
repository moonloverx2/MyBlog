<script src="/Js/jquery.1.7.2.js"></script>
<script type="text/javascript">
$(function(){
   $("#"+<?php echo $cPage1?>).css("text-decoration","none");
});
</script>

<?php
function GetPages($pagename,$cout,$cPage,$search) {
 $cp = 1;
  $condition = "?";
 if ($cPage > 0) {
  $cp = $cPage;
 }
 if(empty($pagename))
 {
 	$pagename = "Index";
 }
  if(!empty($search))
  {
    $condition = $condition."Search=".$search;
  }
 
 if ($cout > 6) {
  if ($cp <= $cout - 4) {
   if ($cp > 1) {
    echo " <a href=\"/".$pagename."/" . ($cp - 1) .$condition. "\" title=\"上一页\" style=\"text-decoration:none;\">◄</a>";
    for($i = $cp - 1; $i <= $cp + 1; $i ++) {
     echo "<a id=" . $i . " href=\"/".$pagename."/" . $i .$condition. "\">" . $i . "</a>";
    }
   } else {
    echo " <a href=\"/".$pagename."/1\" title=\"上一页\" style=\"text-decoration:none;\">◄</a>";
    for($i = $cp; $i <= $cp + 2; $i ++) {
     echo "<a id=" . $i . " href=\"/".$pagename."/" . $i .$condition. "\">" . $i . "</a>";
    }
   }
   echo "...";
  } else {
   echo " <a href=\"/".$pagename."/" . ($cp - 1) .$condition. "\" title=\"上一页\" style=\"text-decoration:none;\">◄</a>";
   for($i = $cout - 4; $i <= $cout - 2; $i ++) {
    echo "<a id=" . $i . " href=\"/".$pagename."/" . $i .$condition. "\">" . $i . "</a>";
   }
  }
  for($i = $cout - 1; $i <= $cout; $i ++) {
   echo "<a id=" . $i . " href=\"/".$pagename."/" . $i .$condition. "\">" . $i . "</a>";
  }
  if ($cp < $cout) {
   echo "<a href=\"/".$pagename."/" . ($cp + 1) .$condition. "\" title=\"下一页\" style=\"text-decoration:none;\">►</a>";
  } else {
   echo "<a href=\"/".$pagename."/" . $cout .$condition. "\" title=\"下一页\" style=\"text-decoration:none;\">►</a>";
  }
 } else {
  if ($cp > 1) {
   echo " <a href=\"/".$pagename."/" . ($cp - 1) .$condition. "\" title=\"上一页\" style=\"text-decoration:none;\">◄</a>";
  } else {
   echo " <a href=\"/".$pagename."/1\" title=\"上一页\" style=\"text-decoration:none;\">◄</a>";
  }
  for($i = 1; $i <= $cout; $i ++) {
   echo "<a id=" . $i . " href=\"/".$pagename."/" . $i .$condition. "\">" . $i . "</a>";
  }
  if ($cp < $cout) {
   echo "<a href=\"/".$pagename."/" . ($cp + 1) .$condition. "\" title=\"下一页\" style=\"text-decoration:none;\">►</a>";
  } else {
   echo "<a href=\"/".$pagename."/" . $cout .$condition. "\" title=\"下一页\" style=\"text-decoration:none;\">►</a>";
  }
 }
}

/*
 * if ($result->num_rows > 0) {
 * echo " <a href=\"Index.php?Page=1\" title=\"上一页\" style=\"text-decoration:none;\">◄</a>";
 * $cout = mysql_num_rows($result);
 * echo $cout;
 * for($i = 0; $i < $cout; $i ++) {
 * echo "<a href=\"#\">".mysql_num_rows($result)."</a>";
 * }
 * echo "<a href=\"Index.php?Page=1\" title=\"下一页\" style=\"text-decoration:none;\">►</a>";
 * }
 */
?>

