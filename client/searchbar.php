<?php

//connect to database
$conn= mysqli_connect('localhost','tutorial', '1234', 'sihina');

//check the connetion
if(!$conn){
    echo ('Connection Error ').mysqli_connect_error();
}

$boo='';

if(isset($_GET['search'])){
  $query = htmlspecialchars($_GET['query']); 
 // echo $query;

 $sql="SELECT * FROM frock WHERE (`fcode` LIKE '%".$query."%') OR (`fname` LIKE '%".$query."%')";
 $result = mysqli_query($conn,$sql);

 $boo=mysqli_fetch_all($result, MYSQLI_ASSOC);
 
 //echo $query;

}
?>

<?php include('templates/header.php') ?>
<center>
<form action="searchbar.php" method="GET">
<input type="text" name="query">
<input type="submit" name="search">
</form>

<?php if($boo) {  ?>
<?php foreach($boo as $frock) :?> 
<table opacity: 0.5;>
<tr>
<th height="200" width="200">
<?php $linkToPic=str_replace("open","uc",$frock['link']);?>
<img src="<?php echo $linkToPic ?>" alt="" height="200" width="200">
</th>
<th>
<ul><h3>
<li><?php echo htmlspecialchars($frock['fname']);  ?></li>
<li><?php echo htmlspecialchars($frock['fcode']);  ?></li>
<li><?php echo htmlspecialchars($frock['price']);  ?></li>
<li><?php echo htmlspecialchars($frock['material']);  ?></li>
<li><?php echo htmlspecialchars($frock['size']);  ?></li>
<li><?php echo htmlspecialchars($frock['fdescription']);  ?></li>
<div style="width:500px;">
<div style="float: left; width: 130px"><button type="submit" class="msgBtn" onclick="window.location.href='viewFrockById.php?id=<?php echo $frock['fcode'] ?>'" >Edit or Publish</button></div>
<form action="index.php" method="POST"> 
<input type="hidden" name="id_to_delete" value="<?php echo $frock['fcode'] ; ?>">
<input type="submit" name="Delete" value="Delete" >
</form>
</div>
</h3>
</ul>
</th>
</tr>
</table>
<?php endforeach; ?>
<?php }  ?>
</center>
