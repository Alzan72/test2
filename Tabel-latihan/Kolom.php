<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    
    <?php
    session_start();

    //cookie
    if (isset($_COOKIE['status'])) {
      if (@$_COOKIE['status']='sudahlogin') { 
        @$_SESSION['status']='login';
        @$_SESSION['username']=$_COOKIE['user'];
      }
    };

// login
if(@$_SESSION['status']!="login" ){
  header("location:login.php?pesan=belum_login");
} else {
  echo "";
}
    if(isset($_GET['pesan'])){
		$pesan = $_GET['pesan'];
		if($pesan == "input"){
			echo "<script>alert('Data telah di tambahkan')</script>
      ";
		}else if($pesan == "update"){
			echo "<script>alert('Data telah di disimpan')</script>
      ";
		}else if($pesan == "hapus"){
			echo "<script>alert('Data telah di hapus')</script>
      ";
		}
    else if($pesan == "pilih-data"){
			echo "<script>alert('Pilih data yang ingin dihapus')</script>
      ";
		}
    
}
    ?>
    

    <main>
    <div class="container">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
      </ul>
    </header>
    
  </div>

  <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="display-5 fw-bold">Welcome ,<?php echo $_SESSION['username']; ?></h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
      </div>
    </div>
  </div>

 

<!-- tambah data -->
<a href="tambah-admin.php">+ Tambah data</a>



    </main>
    <form action="" method="post">
      <label for="">cari</label><br>
      <input type="text" name="kata" id="">
      <button name="cari">Cari</button>
    </form>

    <table class="table">
  <thead>
    <tr>
    <th scope="col">No.</th>
      <th scope="col">Menu</th>
      <th scope="col">Pilih</th>
      <th scope="col">ID.</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Penjual</th>
      <th scope="col">year</th>
      <th scope="col">month</th>
      <th scope="col">date</th>
      <th scope="col">mon</th>
      <th scope="col">tue</th>
      <th scope="col">wed</th>     
      <th scope="col">thur</th>  
    </tr>
  </thead>
  
  
  <tbody>


<?php
// $pesan = $_GET['pesan'];
// if($pesan == "update"){
//   echo "Data berhasil di input.";
// };

include 'koneksi-server.php';



$dataTampil=10;
$data="SELECT * FROM `silabus`";
$hasildata=$conn->query($data);

$jumlahdata=$hasildata->num_rows;

$jumlahHalaman=ceil($jumlahdata/$dataTampil);
 if (isset($_GET['halaman'])) {
  $halaman=$_GET['halaman'];
}else {
  $halaman=1;
};
$awaldata=($dataTampil * $halaman)-$dataTampil;

// cari
$cari=@$_POST['cari'];
$kata=@$_POST['kata'];
if (isset($cari)) {
  $sql="SELECT * FROM silabus WHERE penjual LIKE'%$kata%' OR Year LIKE'%$kata%' OR month LIKE'%$kata%' OR date LIKE'%$kata%' OR week LIKE'%$kata%' OR mon LIKE'%$kata%' OR tue LIKE'%$kata%' OR wed LIKE'%$kata%' OR thur LIKE'%$kata%'";
} else {
  $sql = "SELECT * FROM `silabus` LIMIT $awaldata , $dataTampil";
}

// cari


$result = $conn->query($sql);

$no=1;


echo "<form action='hapus.php' method='post'>";

  while($row = $result->fetch_assoc()) {
    echo "
    <tr>
    <td>$no</td>
    <td><a href=\"edit.php?id=".$row["ID"]."\" >detail</a> </td>
      <td> <input type='checkbox' name='list[]'  value=".$row["ID"]."> </td>
      <td> idbc-". $row["ID"]. "</td>
      
      <td>". date('d-m-y | H-i', strtotime($row["Tanggal"])) ."</td>
      <td>" . $row["penjual"]. "</td>
      <td>" . $row["Year"]. "</td>
      <td>" . $row["month"]. "</td>
      <td>" . $row["date"]. "</td>
      <td>" . $row["mon"]. "</td>
      <td>" . $row["tue"]. "</td>
      <td><a href='gambar/" . $row["wed"]. " ' target='_blank'><img src='gambar/" . $row["wed"]. " 'width=60px height=40px></a> </td>
      <td>" . $row["thur"]. "</td>
     
      
    </tr>";
    $no++;
    

  }
  

$conn->close();

?>
<a href="logout.php">Log Out</a> <br>
<button>hapus</button>


</form>



</tbody>
</table>

<div class="row justify-content-center">
<div class="col-5">
<nav aria-label="Page navigation example" >
  <ul class="pagination">  
<?php
if (!isset($cari)) {
  # code...

$halkurang=$halaman-1;
if ($halaman > 1) {
  echo "<li class='page-item'><a class='page-link' href='?halaman=$halkurang'>Previous</a></li>";
}

for ($i=1; $i <= $jumlahHalaman; $i++) { 
  if ($i == $halaman ) {
    echo "<li class='page-item active'><a class='page-link' href='?halaman=$i'>$i</a></li>";
  } else {
    echo "<li class='page-item '><a class='page-link' href='?halaman=$i'>$i</a></li>";
  }
  
}
$haltambah=$halaman+1;
if ( $halaman <$jumlahHalaman) {
  echo "<li class='page-item'><a class='page-link' href='?halaman=$haltambah'>Next</a></li>";
}
}
?>
  </ul>
</nav>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>