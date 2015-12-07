<?php
#phpinfo();
$con =  new mysqli("localhost", "root", "332322385", "x2blog");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }


 $result = $con->query("select title from x2_blog");

                                if ($result->num_rows > 0) {
   #                                 echo "sss"; 
                                       while($row = $result->fetch_assoc()) {
                                  echo $row["title"]; 
                                    }
                              } else {
                                        echo "0 results";
                                }

?>
