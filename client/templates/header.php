<?php

?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    background-image: url('mat.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;
}

.sidenav {
  height: 100%;
  width: 230px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav p{
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
}
.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

form.form1{
    background-image: url('form.jpg');
  max-width: 460px;
  margin: 20px auto; 
    padding:60px;
    color:#FFF;
}

.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button5 {background-color: #555555;}

table {
    background-color:  #dddddd;
  max-width:800px;
  margin: 20px auto; 
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

#Sup{
    
    text-align: center;
}

#publish{
    border: 0px;
    width: 100%;
    height: 2em;
}

#footer-padding{
 
}
</style>
</head>
<body>
<div class="sidenav">
  <p>Welcome
  <?php echo htmlspecialchars($_SESSION["username"]); ?></p>
  <a href="logout.php">Manage Account</a>

  <p>______________</p>
  
  <a href="index.php">Home</a>
  <a href="addNew.php">Add New Items</a>
  <a href="view.php">View Items</a>
  <a href="publish.php">Publish Items</a>
  
</div>