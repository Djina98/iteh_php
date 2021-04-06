<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="URF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GLUMCI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/gstyle.css">
    <link rel="icon" type="image/png" href="/iteh_php/img/favicon.ico"/>

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
                                <li><a href="/iteh_php/index.html">Pocetna</a></li>
                                <li><a href="/iteh_php/filmovi/film.php">Filmovi</a></li>
                                <li class="active"><a href="/iteh_php/glumci/glumac.php">Glumci</a></li>
         
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


	include 'glumacobrada.php';
    $model = new Database('filmovi');
    
    
    if (isset($_POST['insertdata'])) {

        if (isset($_POST['ime_prezime']) && isset($_POST['godine']) && isset($_POST['mesto_rodjenja'])) {
            if (!empty($_POST['ime_prezime']) && !empty($_POST['godine']) && !empty($_POST['mesto_rodjenja'])) {
                    
                $data['ime_prezime'] = $_POST['ime_prezime'];
                $data['godine'] = $_POST['godine'];
                $data['mesto_rodjenja'] = $_POST['mesto_rodjenja'];
                        

                $insert = $model->insert('glumac',$data);

                if($insert){
                    echo "<script>alert('Glumac je uspesno dodat!');</script>";
				    echo "<script>window.location.href = 'glumac.php';</script>";
                }else{
                    echo "<script>alert('Greska prilikom dodavanja novog glumca!');</script>";
				    echo "<script>window.location.href = 'glumac.php';</script>";
                }

            }else{
                echo "<script>alert('Sva polja su obavezna. Pokusajte ponovo!');</script>";
                echo "<script>window.location.href = 'glumac.php';</script>";
            }
        } 
    }
	
	if(isset($_POST['deletedata'])){

		$id=$_POST['gdelete_id'];
		$delete = $model->delete("glumac",'idglumac',$id);
		
		if ($delete) {
            echo "<script>alert('Glumac je uspesno obrisan');</script>";
			echo "<script>window.location.href = 'glumac.php';</script>";
		}
    }
  
    
    if (isset($_POST['updatedata'])) {
        if (isset($_POST['ime_prezime']) && isset($_POST['godine']) && isset($_POST['mesto_rodjenja'])) {
            if (!empty($_POST['ime_prezime']) && !empty($_POST['godine']) && !empty($_POST['mesto_rodjenja'])) {
                $id = $_POST['gupdate_id'];
                $ime_prezime = $_POST['ime_prezime'];
                $godine = $_POST['godine'];
                $mesto_rodjenja = $_POST['mesto_rodjenja'];
        
    
                $update = $model->update('glumac', $id, $ime_prezime, $godine, $mesto_rodjenja);
    
                if($update){
                    echo "<script>alert('Glumac je uspesno izmenjen!');</script>";
                    echo "<script>window.location.href = 'glumac.php';</script>";
                }else{
                    echo "<script>alert('Greska prilikom izmene glumca!');</script>";
                    echo "<script>window.location.href = 'glumacobrada.php';</script>";
                }
            }else{
                echo "<script>alert('Sva polja su obavezna. Pokusajte ponovo!');</script>";
                echo "<script>window.location.href = 'glumac.php';</script>";
            }
        } 
    }     

?>

<!-- ################################# FORMA ZA DODAVANJE NOVOG #################################################### -->
<div class="modal fade" id="glumacaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodaj novog glumca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="glumac.php" method="POST">
        
        <div class="modal-body">
        
            <div class="form-group">
                <input type="text" name="ime_prezime" class="form-control" placeholder="Unesite ime i prezime">   
            </div>

            <div class="form-group">
                <input type="text" name="godine" class="form-control" placeholder="Unesite godine">
            </div>

            <div class="form-group">
                <input type="text" name="mesto_rodjenja" class="form-control" placeholder="Unesite mesto rodjenja">
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

<div class="modal fade" id="glumaceditmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Izmeni glumca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="glumac.php" method="POST">
        
        <div class="modal-body">
        
            <input type="hidden" name="gupdate_id" id="gupdate_id">
            <div class="form-group">
                <input type="text" name="ime_prezime" id="ime_prezime" class="form-control" placeholder="Unesite ime i prezime">   
            </div>

            <div class="form-group">
                <input type="text" name="godine" id="godine" class="form-control" placeholder="Unesite godine">
            </div>

            <div class="form-group">
                <input type="text" name="mesto_rodjenja" id="mesto_rodjenja" class="form-control" placeholder="Unesite mesto rodjenja">
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

<div class="modal fade" id="glumacdeletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Brisanje glumca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="glumac.php" method="POST">
        
        <div class="modal-body">
        
            <input type="hidden" name="gdelete_id" id="gdelete_id">
            <h6>Da li ste sigurni da želite da obrišete izabranog glumca?</h6> 
        
        </div>
        <div class="modal-footer">
        <button type="button" name="canceldelete" class="btn btn-secondary" data-dismiss="modal">NE</button>
        <button type="submit" name="deletedata" class="btn btn-primary">DA</button>
        </div>
        </form>
    </div>
  </div>
</div>

<!-- ########################################## TABELA ##########################################################-->

<section class="hero set-bg" data-setbg="img/blue.jpg">
    <div class="container">
        <div class="row justify-content-center">
            <!-- DUGME ZA POPUP ADD -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#glumacaddmodal">
                Dodaj novog glumca
            </button>
        </div>
        <br>
        <!-- ZA PRETRAZIVANJE-->
        <div class="md-form active-pink active-pink-2 mb-3">
            <input class="form-control search" type="text" id="glumacInput" onkeyup="myFunction()" placeholder="Pretrazite glumce">
        </div>
        <br>

        <?php
                    
            $result = $model->fetch();
                    
        ?>

        <div id="output"></div>
        <br>

        <div class="card" id="tabela">
            <div class="card-body">
                <div>
                    <table class="table table-hover" id="glumciTabela">
                        <thead>
                            <tr>
                                <th scope="col"><a class="column_sort" id="idglumac" data-order="desc" href="#">ID</a></th>
                                <th scope="col"><a class="column_sort" id="ime_prezime" data-order="desc" href="#">Ime i prezime</a></th>
                                <th scope="col"><a class="column_sort" id="godine" data-order="desc" href="#">Godine</a></th>
                                <th scope="col"><a class="column_sort" id="mesto_rodjenja" data-order="desc" href="#">Mesto rodjenja</a></th>
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
                        
                        <td> <?php echo $row['idglumac']; ?> </td>
                        <td> <?php echo $row['ime_prezime']; ?> </td>
                        <td> <?php echo $row['godine']; ?> </td>
                        <td> <?php echo $row['mesto_rodjenja']; ?> </td>
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
    </div> 
    

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
        $('.editbtn').on('click', function(){
            $('#glumaceditmodal').modal('show');

            $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {

                    return $(this).text();

                }).get();

                console.log(data);

                $('#gupdate_id').val(data[0]);
                $('#ime_prezime').val(data[1]);
                $('#godine').val(data[2]);
                $('#mesto_rodjenja').val(data[3]);
        });
    });
</script>

<script>
    $(document).ready(function (){
        $('.deletebtn').on('click', function(){
            $('#glumacdeletemodal').modal('show');

            $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {

                    return $(this).text();

                }).get();

                console.log(data);

                $('#gdelete_id').val(data[0]);
               
        });
    });
</script>
<!--
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("glumacInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("glumciTabela");
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
       $("#glumacInput").keyup(function(){
          var query = $(this).val();
          if (query != "") {
            $.ajax({
              url: 'gsearch.php',
              method: 'POST',
              data: {query:query},
              success: function(data){
 
                $('#output').html(data);
                $('#output').css('display', 'block');
                $('#tabela').css('display', 'none');
 
                $("#glumacInput").focusout(function(){
                    $('#output').css('display', 'none');
                    $('#tabela').css('display', 'block');
                });
                $("#glumacInput").focusin(function(){
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
                url:"gsort.php",  
                method:"POST",  
                data:{column_name:column_name, order:order},  
                success:function(data)  
                {  
                     $('#glumciTabela').html(data);  
                     $('#'+column_name+'').append(arrow);  
                }  
           })  
      });  
 });  
 </script>  


</body>
</html>