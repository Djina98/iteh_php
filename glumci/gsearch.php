<?php
  //require_once "database.php";
  $conn=mysqli_connect("localhost","root","","filmovi");

  if (isset($_POST['query'])) {
     
    $query = "SELECT * FROM glumac WHERE ime_prezime LIKE '%{$_POST['query']}%' 
                                        OR godine LIKE '%{$_POST['query']}%'
                                        OR mesto_rodjenja LIKE '%{$_POST['query']}%'"; 
                                        
                                          
    $result = mysqli_query($conn, $query);
 
  if (mysqli_num_rows($result) > 0) {
    echo '<div class="card">';
      echo '<div class="card-body">';
        echo '<table class="table table-hover" id="glumciTabela">';
          echo '<thead>';
            echo '<tr>';
                echo '<th scope="col"><a class="column_sort" id="idglumac" data-order="desc" href="#">ID</a></th>';
                echo '<th scope="col"><a class="column_sort" id="ime_prezime" data-order="desc" href="#">Ime i prezime</a></th>';
                echo '<th scope="col"><a class="column_sort" id="godine" data-order="desc" href="#">Godine</a></th>';
                echo '<th scope="col"><a class="column_sort" id="mesto_rodjenja" data-order="desc" href="#">Mesto rodjenja</a></th>';
                //echo '<th scope="col">Izmeni</th>';
                //echo '<th scope="col">Obrisi</th>';
            echo '</tr>';
          echo '</thead>' ; 
          while ($glumac = mysqli_fetch_array($result)){
          echo '<tr>';

            echo '<td>'.$glumac['idglumac'].'</td>';
            echo '<td>'.$glumac['ime_prezime'].'</td>';
            echo '<td>'.$glumac['godine'].'</td>';
            echo '<td>'.$glumac['mesto_rodjenja'].'</td>';
            /*echo '<td>  
                    <button type="edit" class="btn btn-success editbtn">IZMENI</button>
                  </td>';
            echo  '<td> 
                      <button type="button" class="btn btn-danger deletebtn">OBRISI</button>
                    </td>';*/
          
          echo '</tr>';   
          } 
        echo '</table>';
      echo '</div>';
    echo '</div>';
    } else {
        echo "<h5 style='color:white; text-align:center'>Glumac nije pronadjen...</h5>";
    }
  } 
?>