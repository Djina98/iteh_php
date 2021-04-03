<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="URF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FILMOVI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="/iteh/img/favicon.ico"/>
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    
</head>


<header>   

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <!--<a href="./index.html"><img src="img/logo2.png" alt=""></a>-->
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li><a href="/iteh/index.html">Pocetna</a></li>
                                <li class="active"><a href="/iteh/filmovi/film.php">Filmovi</a></li>
                                <li><a href="/iteh/glumci/glumac.php">Glumci</a></li>
         
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header Section End -->
 

</header>

<body>

<?php 

	include 'filmobrada.php';
    $model = new Database('filmovi');
    
    
    if (isset($_POST['insertdata'])) {

                    
                $data['naziv'] = $_POST['naziv'];
                $data['zanr'] = $_POST['zanr'];
                $data['godina'] = $_POST['godina'];
                $data['uloga'] = $_POST['uloga'];
                $data['idglumac'] = $_POST['insertidglumac'];

                $insert = $model->insert('film',$data);
         
    }
	
	if(isset($_POST['deletedata'])){

		$id=$_POST['fdelete_id'];
		$delete = $model->delete("film",'id',$id);
		
		if ($delete) {
            echo "<script>alert('Film je uspesno obrisan');</script>";
			echo "<script>window.location.href = 'film.php';</script>";
		}
    }
  
    
    if (isset($_POST['updatedata'])) {
        
        $id = $_POST['fupdate_id'];
        $naziv = $_POST['naziv'];
        $zanr = $_POST['zanr'];
        $godina = $_POST['godina'];
        $uloga = $_POST['uloga'];
        $idglumac = $_POST['editidglumac'];
    
            $update = $model->update('film', $id, $naziv, $zanr, $godina, $uloga, $idglumac);
    
            if($update){
                echo "<script>alert('Film je uspesno izmenjen!');</script>";
                echo "<script>window.location.href = 'film.php';</script>";
            }else{
                echo "<script>alert('Greska prilikom izmene filma!');</script>";
                echo "<script>window.location.href = 'filmobrada.php';</script>";
            }
    }     

?>

<!-- ################################# FORMA ZA DODAVANJE NOVOG #################################################### -->
<div class="modal fade" id="filmaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodaj novi film</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="film.php" method="POST">
        
        <div class="modal-body">
        
            <div class="form-group">
                <input type="text" name="naziv" class="form-control" placeholder="Unesite naziv filma">   
            </div>

            <div class="form-group">
                <input type="text" name="zanr" class="form-control" placeholder="Unesite zanr">
            </div>

            <div class="form-group">
                <input type="text" name="godina" class="form-control" placeholder="Unesite godinu objavljivanja filma">
            </div>

            <div class="form-group">
                <input type="text" name="uloga" class="form-control" placeholder="Unesite glavnu ulogu">
            </div>

            <div class="form-group">  
            <label for="glumac_odabir_insert"></label>
            <select name="insertidglumac">
            <option>--Izaberite glumca--</option>
                <?php
                    $mysqli = new mysqli('localhost','root', '','filmovi') or die(mysqli_error($mysqli));
                    $result = $mysqli->query("SELECT * FROM  glumac") or die($mysqli->error);
                    
                    while($row=$result->fetch_assoc()):
                ?>
                <option value="<?php echo $row['idglumac'];?>"><?php echo $row['ime_prezime'];?></option>
                <?php endwhile;?>        
            </select>
            </div>  

        </div>
        <div class="modal-footer">
        <button type="button" name="cancelsave" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
        <button type="submit" name="insertdata" class="btn btn-primary">Sacuvaj</button>
        </div>
        </form>
    </div>
  </div>
</div>

<!-- ################################# FORMA ZA IZMENU POSTOJECEG #################################################### -->

<div class="modal fade" id="filmeditmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Izmeni film</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="film.php" method="POST">
        
        <div class="modal-body">
        
            <input type="hidden" name="fupdate_id" id="fupdate_id">

            <div class="form-group">
                <input type="text" name="naziv" id="naziv" class="form-control" placeholder="Izmenite naziv">   
            </div>

            <div class="form-group">
                <input type="text" name="zanr" id="zanr" class="form-control" placeholder="Izmenite zanr">
            </div>

            <div class="form-group">
                <input type="text" name="godina" id="godina" class="form-control" placeholder="Izmenite godinu objavljivanja">
            </div>

            <div class="form-group">
                <input type="text" name="uloga" id="uloga" class="form-control" placeholder="Izmenite glavnu ulogu">
            </div>

            <div class="form-group">
            <label for="glumac_odabir_edit"></label>
            <select name="editidglumac" id="editidgumac">
            <option>--Izaberite novog glumca--</option>
                <?php
                    $mysqli = new mysqli('localhost','root', '','filmovi') or die(mysqli_error($mysqli));
                    $result = $mysqli->query("SELECT * FROM glumac") or die($mysqli->error);
                    
                    while($row=$result->fetch_assoc()):
                ?>
                <option value="<?php echo $row['idglumac'];?>"><?php echo $row['ime_prezime'];?></option>
                <?php endwhile;?>      
                    
            </select>
            </div>

        </div>

        <div class="modal-footer">
        <button type="button" name="cancelupdate" class="btn btn-secondary" data-dismiss="modal">Odustani</button>
        <button type="submit" name="updatedata" class="btn btn-primary">Sacuvaj izmene</button>
        </div>

        </form>
    </div>
  </div>
</div>

<!-- ################################# FORMA ZA BRISANJE POSTOJECEG #################################################### -->

<div class="modal fade" id="filmdeletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Brisanje filma</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="film.php" method="POST">
        
        <div class="modal-body">
        
            <input type="hidden" name="fdelete_id" id="fdelete_id">
            <h6>Da li ste sigurni da želite da obrišete izabrani film?</h6> 
        
        </div>

        <div class="modal-footer">
        <button type="button" name="canceldelete" class="btn btn-secondary" data-dismiss="modal">NE</button>
        <button type="submit" name="deletedata" class="btn btn-primary">DA</button>
        </div>
        
        </form>
    </div>
  </div>
</div>

<!-- ########################################### TABELA ###################################################-->

<section class="hero set-bg" data-setbg="img/blue.jpg">

    <div class="container">
    
        <div class="row justify-content-center">
            <!-- DUGME ZA POPUP ADD -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#filmaddmodal">
                    Dodaj novi film
                </button>             
        </div>
        <br>
                
        <!-- ZA PRETRAZIVANJE-->
        <div class="md-form active-pink active-pink-2 mb-3">
            <input class="form-control search" type="text" id="filmInput" onkeyup="myFunction()" placeholder="Pretrazite filmove">
        </div>
                
        <div id="output"></div>
        <br>
                
        <?php
                    
            $result = $model->fetch();
                    
        ?>
        <div class="card" id="tabela">
            <div class="card-body">
                    <table class="table table-hover" id="filmoviTabela">
                        <thead>
                            <tr>
                                <th scope="col"><a class="column_sort" id="id" data-order="desc" href="#">ID</a></th>
                                <th scope="col"><a class="column_sort" id="naziv" data-order="desc" href="#">Naziv</a></th>
                                <th scope="col"><a class="column_sort" id="zanr" data-order="desc" href="#">Zanr</a></th>
                                <th scope="col"><a class="column_sort" id="godina" data-order="desc" href="#">Godina</a></th>
                                <th scope="col"><a class="column_sort" id="uloga" data-order="desc" href="#">Uloga</a></th> 
                                <th scope="col">Glumac</th>
                                <th scope="col">Izmeni</th>
                                <th scope="col">Obrisi</th>
                            </tr>
                        </thead>
                <?php
                    if(!empty($result)){
                    foreach($result as $row)
                    {
                        
                ?>
                    <tbody id="myTable">
                        <tr>
                        
                        <td> <?php echo $row['id']; ?> </td>
                        <td> <?php echo $row['naziv']; ?> </td>
                        <td> <?php echo $row['zanr']; ?> </td>
                        <td> <?php echo $row['godina']; ?> </td>
                        <td> <?php echo $row['uloga']; ?> </td>
                        <td> <?php echo $row['ime_prezime']; ?> </td>
                        <td> 
                            <button type="edit" class="btn btn-success editbtn">IZMENI</button>
                        </td>
                        <td> 
                            <button type="button" class="btn btn-danger deletebtn">OBRISI</button>
                        </td>

                        </tr>
                        <tr>
                        
                    </tbody>
                <?php
                    }
                }else{
                    echo "no data";
                    }
                ?>
                    </table>
            </div>
       </div>
    </div>
</section>

     


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/jquery.barfiller.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>


<script>
    $(document).ready(function (){
        $('#filmoviTabela').on('click', '.editbtn', function(){
            $('#filmeditmodal').modal('show');

            $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {

                    return $(this).text();

                }).get();

                console.log(data);

                $('#fupdate_id').val(data[0]);
                $('#naziv').val(data[1]);
                $('#zanr').val(data[2]);
                $('#godina').val(data[3]);
                $('#uloga').val(data[4]);
                
        });
    });
</script>

<script>
    $(document).ready(function (){
        $('#filmoviTabela').on('click', '.deletebtn', function(event){
            $('#filmdeletemodal').modal('show');

            $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {

                    return $(this).text();

                }).get();

                console.log(data);

                $('#fdelete_id').val(data[0]);
               
        });
    });
</script>
<!--
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("filmInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("filmoviTabela");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
-->

<script type="text/javascript">
    $(document).ready(function(){
       $("#filmInput").keyup(function(){
          var query = $(this).val();
          if (query != "") {
            $.ajax({
              url: 'fsearch.php',
              method: 'POST',
              data: {query:query},
              success: function(data){
 
                $('#output').html(data);
                $('#output').css('display', 'block');
                $('#tabela').css('display', 'none');
 
                $("#filmInput").focusout(function(){
                    $('#output').css('display', 'none');
                    $('#tabela').css('display', 'block');
                });
                $("#filmInput").focusin(function(){
                    $('#output').css('display', 'block');
                    $('#tabela').css('display', 'none');
                });
              }
            });
          } else {
          $('#output').css('display', 'none');
          $('#tabela').css('display', 'block');
        }
      });
    })
</script>

<script>  
 $(document).ready(function(){  
      $(document).on('click', '.column_sort', function(){  
           var column_name = $(this).attr("id");  
           var order = $(this).data("order");  
           var arrow = '';  
           //glyphicon glyphicon-arrow-up  
           //glyphicon glyphicon-arrow-down  
           if(order == 'desc')  
           {  
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-down"></span>';  
           }  
           else  
           {  
                arrow = '&nbsp;<span class="glyphicon glyphicon-arrow-up"></span>';  
           }  
           $.ajax({  
                url:"fsort.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                     $('#filmoviTabela').html(data);  
                     $('#'+column_name+'').append(arrow);  
                }  
           })  
      });  
 });  
 </script>  

</body>
</html>