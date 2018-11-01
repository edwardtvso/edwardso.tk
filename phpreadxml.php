<?php
	
	//使用php讀取xml

    $file ="books.xml";
    $data = new XMLReader();  
    $data -> open($file); 

    $books = array();
    $j=0;
    
	$data1  = "<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'></head>";
	
	$data1 .= "<table style='border:1px solid red;";
    $data1 .= "border-collapse:collapse' border='1px'>";
    $data1 .= "<thead>";
    $data1 .= "<tr>";
    $data1 .= "<th>bookid</th>";
    $data1 .= "<th>booksname</th>";
    $data1 .= "</tr>";
    $data1 .= "</thead>";
    $data1 .= "<tbody>";
	
      while($data->read()){ 

        if($data -> depth ==2 && $data->nodeType ==1){

          switch($data->name){

           case "bookid":
		     $data1 .= "<tr>";
             $data->read();
             $books[$j]['bookid'] = $data -> value;
			 $data1 .= "<td>" . $books[$j]['bookid'] . "</td>";
             break;

			 case "booksname":
             $data->read();
             $books[$j]['booksname'] = $data -> value;
			 $data1 .= "<td>" . $books[$j]['booksname'] . "</td>";
			 $data1 .= "</tr>";
             $j++;
             break;
         }
       }  
    }
        $data1 .= "</tbody>";
        $data1 .= "</table>";
        echo $data1;

		print_r($j .= " books");
?>