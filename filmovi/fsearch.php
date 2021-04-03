<?php
  //require_once "database.php";
  $conn=mysqli_connect("localhost","root","","filmovi");

  if (isset($_POST['query'])) {
     
    $query = "SELECT f.*, g.ime_prezime FROM film f left join glumac g on (f.idglumac=g.idglumac)  
                                        WHERE f.naziv LIKE '%{$_POST['query']}%' 
                                        OR f.zanr LIKE '%{$_POST['query']}%'
                                        OR f.godina LIKE '%{$_POST['query']}%' 
                                        OR f.uloga LIKE '%{$_POST['query']}%'";
                                          
    $result = mysqli_query($conn, $query);
 
  if (mysqli_num_rows($result) > 0) {
    echo '<div class="card">';
      echo '<div class="card-body">';
        echo '<table class="table table-hover" id="filmoviTabela">';
          echo '<thead>';
            echo '<tr>';
                echo '<th scope="col"><a class="column_sort" id="id" data-order="desc" href="#">ID</a></th>';
                echo '<th scope="col"><a class="column_sort" id="naziv" data-order="desc" href="#">Naziv</a></th>';
                echo '<th scope="col"><a class="column_sort" id="zanr" data-order="desc" href="#">Zanr</a></th>';
                echo '<th scope="col"><a class="column_sort" id="godina" data-order="desc" href="#">Trajanje</a></th>';
                echo '<th scope="col"><a class="column_sort" id="uloga" data-order="desc" href="#">Uloga</a></th>';
                echo '<th scope="col">Glumac</th>';
                //echo '<th scope="col">Izmeni</th>';
                //echo '<th scope="col">Obrisi</th>';
            echo '</tr>';
          echo '</thead>' ; 
          while ($film = mysqli_fetch_array($result)){
          echo '<tr>';

            echo '<td>'.$film['id'].'</td>';
            echo '<td>'.$film['naziv'].'</td>';
            echo '<td>'.$film['zanr'].'</td>';
            echo '<td>'.$film['godina'].'</td>';
            echo '<td>'.$film['uloga'].'</td>';
            echo '<td>'.$film['ime_prezime'].'</td>';
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
    echo "<h5 style='color:white; text-align:center'>Film nije pronadjen...</h5>";
    }
  } 
?>