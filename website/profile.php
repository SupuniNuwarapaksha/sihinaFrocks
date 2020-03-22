<?php
session_start();


if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
} else{
    $username=$_SESSION["username"];
}
include('../config/connectDB.php');


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--
Victory HTML CSS Template
https://templatemo.com/tm-507-victory
-->
        <title>profile</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/fontAwesome.css">
        <link rel="stylesheet" href="css/hero-slider.css">
        <link rel="stylesheet" href="css/owl-carousel.css">
        <link rel="stylesheet" href="css/templatemo-style.css">

        <link href="https://fonts.googleapis.com/css?family=Spectral:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <style>
            .bann{
                padding: 180px 0px;
                background-image: url('./img/dark1.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
                text-align: center;
	
            }
            .bann h4 {
                margin-top: 0px;
                font-family: 'Roboto', sans-serif;
                font-weight: 700;
                font-size: 15px;
                color: #fff;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .bann h2 {
                font-family: 'Spectral', serif;
                font-size: 44px;
                font-weight: 600;
                color: #fff;
                text-transform: uppercase;
            }

            .bann h1 {
                margin-top: 0px;
                margin-bottom: 20px;
                font-family: 'Spectral', serif;
                font-size: 48px;
                font-weight: 700;
                text-transform: uppercase;
                color: #fff;
            }

            .bann p {
                color: #fff;
                font-size: 14px;
                padding: 0px 25%;
                margin-bottom: 0px;
            }

        </style>
    </head>

<body>
    <div class="header">
        <div class="container">
            <a href="#" class="navbar-brand scroll-top">Sihina</a>
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!--/.navbar-header-->
                <div id="main-nav" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="store.php">Our Store</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {  ?>
                        <li><a href="login.php">LOGIN/REGISTER</a></li>
                        <?php } else { ?>
                        <li><a href="profile.php"><?php echo $_SESSION["username"] ;?></a></li>
                        <?php } ?>
                        <li>
                        
                    </ul>
                    
                </div>
                <!--/.navbar-collapse-->
            </nav>
            <!--/.navbar-->
        </div>
        <!--/.container-->
    </div>
    <!--/.header-->


    <section class="bann">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Sihina Frocks</h1>
                    <p>We can make your dream come true</p>
                </div>
            </div>
        </div>
    </section>

    <section>
    <p></p>
    <p></p>
    </section>


    <section class="services">
            <div class="container">
                <div class="row">

    <?php
    include('../config/connectDB.php');
    $sql="SELECT * FROM `order_item` WHERE user_name='$username'";
    $result=mysqli_query($conn,$sql);
    $orders=mysqli_fetch_all($result, MYSQLI_ASSOC);
    //print_r($orders);


    foreach($orders as $order){
        
        
        $fcode=$order['frock_id'];
        $sql1="SELECT * FROM frock WHERE fcode='$fcode'";
        $respond=mysqli_query($conn,$sql1);
        $frock=mysqli_fetch_assoc($respond);
       // print_r($frock);

       
       ?>

                <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="item col-md-12">
                     <div class="food-item">
                     <?php
                        $a=(strtotime($order['tdate'])-strtotime($order['fdate']))/86400;
                        $fee=$a*$frock['price'];
                     ?>
                     <?php $linkToPic=str_replace("open","uc",$frock['link']);?>
                     <img src="<?php echo $linkToPic ?>" >
                     <div class="price">Rs. <?php echo $fee; ?></div>
                        <div class="text-content">
                            <h4><?php echo $frock['fname']; ?></h4>
                            <p>From <?php echo $order['fdate']; ?></p>
                            <p>To <?php echo $order['tdate']; ?></p>
                            <?php
                            $a=(strtotime($order['tdate'])-strtotime($order['fdate']))/86400;
                            ?>
                            <p>For <?php echo $a; ?> days</p>
                            <?php if($order['accept']==1) : ?>
                            <p style="color:green;">accepted</p> 
                             <?php if($order['delivery']=='p') : ?> <p>You have to come to us and pickup persinally</p>
                             <?php else: ?> <p>We will deliver your order to the below address <br><?php echo $order['address'] ?></p>
                            <?php endif; ?>
                            <?php elseif($order['accept']==0): ?> <p style="color:blue;">Not yet </p>
                            <?php elseif($order['accept']==2): ?> <p style="color:red;">We are sorry! The frock was already booked</p>
                            <?php endif; ?>
                        </div>
                        </div>
                </div>

                </div>
               
    
    <?php } ?>
    </div>
        </div>
    </section>
    
    

    



    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>Copyright &copy; 2020 Sihina Frocks</p>
                </div>
                <div class="col-md-4">
                    <ul class="social-icons">
                        <li><a rel="nofollow" href="https://fb.com/templatemo"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p></p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

<!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>	-->
    <script type="text/javascript">
    $(document).ready(function() {
        // navigation click actions 
        $('.scroll-link').on('click', function(event){
            event.preventDefault();
            var sectionID = $(this).attr("data-id");
            scrollToID('#' + sectionID, 750);
        });
        // scroll to top action
        $('.scroll-top').on('click', function(event) {
            event.preventDefault();
            $('html, body').animate({scrollTop:0}, 'slow');         
        });
        // mobile nav toggle
        $('#nav-toggle').on('click', function (event) {
            event.preventDefault();
            $('#main-nav').toggleClass("open");
        });
    });
    // scroll function
    function scrollToID(id, speed){
        var offSet = 0;
        var targetOffset = $(id).offset().top - offSet;
        var mainNav = $('#main-nav');
        $('html,body').animate({scrollTop:targetOffset}, speed);
        if (mainNav.hasClass("open")) {
            mainNav.css("height", "1px").removeClass("in").addClass("collapse");
            mainNav.removeClass("open");
        }
    }
    if (typeof console === "undefined") {
        console = {
            log: function() { }
        };
    }
    </script>
</body>
</html>