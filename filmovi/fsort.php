<?php  
 //sort.php  
 $connect = mysqli_connect("localhost", "root", "", "filmovi");  
 $output = '';  
 $order = $_POST["order"];  
 if($order == 'desc')  
 {  
      $order = 'asc';  
 }  
 else  
 {  
      $order = 'desc';  
 }  
 $query = "SELECT * , g.ime_prezime FROM film f LEFT JOIN glumac g on (f.idglumac=g.idglumac)
           ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-bordered table-dark" id="filmoviTabela">
     <thead>
          <tr>
               <th scope="col"><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>
               <th scope="col"><a class="column_sort" id="naziv" data-order="'.$order.'" href="#">Naziv</a></th>
               <th scope="col"><a class="column_sort" id="zanr" data-order="'.$order.'" href="#">Zanr</a></th>
               <th scope="col"><a class="column_sort" id="trajanje" data-order="'.$order.'" href="#">Trajanje</a></th>
               <th scope="col"><a class="column_sort" id="uloga" data-order="'.$order.'" href="#">Uloga</a></th> 
               <th scope="col">Glumac</th>
               <th scope="col">Izmeni</th>
               <th scope="col">Obrisi</th>
          </tr>
     </thead>
 ';  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
     <tbody id="myTable">
          <tr>
                        
               <td>' . $row['id'] . '</td>
               <td>' . $row['naziv'] . '</td>
               <td>' . $row['zanr'] . '</td>
               <td>' . $row['trajanje'] . '</td>
               <td>' . $row['uloga'] . '</td>
               <td>' . $row['ime_prezime'] . '</td>
               <td> 
                    <button type="edit" class="btn btn-success editbtn">IZMENI</button>
               </td>
               <td> 
                    <button type="button" class="btn btn-danger deletebtn">OBRISI</button>
               </td>

          </tr>
                        
                        
     </tbody>
      ';  
 }
 
 
 $output .= '</table>';  
 echo $output;  
 ?>  