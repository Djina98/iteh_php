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
 $query = "SELECT * FROM glumac 
           ORDER BY ".$_POST["column_name"]." ".$_POST["order"]."";  
 $result = mysqli_query($connect, $query);  
 $output .= '  
 <table class="table table-bordered table-dark" id="glumciTabela">
     <thead>
          <tr>
               <th scope="col"><a class="column_sort" id="idglumac" data-order="'.$order.'" href="#">ID</a></th>
               <th scope="col"><a class="column_sort" id="ime_prezime" data-order="'.$order.'" href="#">Ime i prezime</a></th>
               <th scope="col"><a class="column_sort" id="godine" data-order="'.$order.'" href="#">Godine</a></th>
               <th scope="col"><a class="column_sort" id="mesto_rodjenja" data-order="'.$order.'" href="#">Mesto rodjenja</a></th>
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
                        
               <td>' . $row['idglumac'] . '</td>
               <td>' . $row['ime_prezime'] . '</td>
               <td>' . $row['godine'] . '</td>
               <td>' . $row['mesto_rodjenja'] . '</td>
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