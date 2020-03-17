<?php
// Initialize the session
session_start();



include('../config/connectDB.php');

if(isset($_GET['id'])){
    $code=mysqli_real_escape_string($conn, $_GET['id']);
    $sql="SELECT * FROM frock WHERE fcode='$code'";
    $res=mysqli_query($conn,$sql);
    $f=mysqli_fetch_assoc($res);
}


$sql1='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY added_at DESC LIMIT 1';
$result1=mysqli_query($conn,$sql1);
$new=mysqli_fetch_assoc($result1);
//print_r($new);

$sql2='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY added_at DESC LIMIT 1,1';
$result2=mysqli_query($conn,$sql2);
$new2=mysqli_fetch_assoc($result2);
//print_r($new2);

$sql3='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY added_at DESC LIMIT 2,1';
$result3=mysqli_query($conn,$sql3);
$new3=mysqli_fetch_assoc($result3);
//print_r($new2);

$sql4='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY rating  DESC LIMIT 1';
$result4=mysqli_query($conn,$sql4);
$best4=mysqli_fetch_assoc($result4);

$sql5='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY rating  DESC LIMIT 1,1';
$result5=mysqli_query($conn,$sql5);
$best5=mysqli_fetch_assoc($result5);

$sql6='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY rating  DESC LIMIT 2,1';
$result6=mysqli_query($conn,$sql6);
$best6=mysqli_fetch_assoc($result6);

$sql7='SELECT fname,fcode,price,material,size,link,fdescription FROM frock';
$result7=mysqli_query($conn,$sql7);
$frocks=mysqli_fetch_all($result7, MYSQLI_ASSOC);

//post data into the database
if(isset($_POST['form-submit'])){
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
    } else {
        $uname=$_SESSION["username"];
        $fdate=$_POST['fdate'];
        $tdate=$_POST['Tdate'];
        $delivery=$_POST['method'];
        $address=$_POST['address'];

        //sql
        $sql="INSERT INTO order_item(user_name,fdate,tdate,delivery,address,accept) VALUES ('$uname','$fdate','$tdate','$delivery','$address',0)";
        
        if(mysqli_query($conn,$sql)) {
            header("location: thanks.php");
        }

    } 
}


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
        <title>Victory - Our Menus</title>
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
                        <li><a href="menu.php">Our Store</a></li>
                        <li><a href="blog.php">Terms and Conditions</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
                <!--/.navbar-collapse-->
            </nav>
            <!--/.navbar-->
        </div>
        <!--/.container-->
    </div>
    <!--/.header-->


    



    <section >
        <div class="container">
            <div class="row" >
                <div class="col-md-12">
                    <div class="heading">
                       <center> <h2>Book Your Dress Now</h2></center>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <div class="left-image">
                    <?php $linkToPic=str_replace("open","uc",$f['link']);?>
                        <img src="<?php echo $linkToPic ?>" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="right-info">
                        <form id="form-submit" action="" method="POST">

                            <div class="row">
                                <div>
                                   <center> <h5><?php echo $f['fname']; ?> </h5>
                                    <h5>Rs. <?php echo $f['price']; ?> per day</h5> </center>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        From Date
                                        <input name="fdate" type="date" class="form-control" id="fdate" placeholder="From Date" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        To Date
                                        <input name="Tdate" type="date" class="form-control" id="Tdate" placeholder="From Date" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <select required name='method' onchange='this.form.()'>
                                            <option value="">Delivery Method</option>
                                            <option value="p">I pick up personally</option>
                                            <option value="d">Deliver me</option>
                                        </select>
                                    </fieldset>
                                </div>
                                
                                <div class="col-md-12">
                                    <fieldset>
                                        <input name="address" type="address" class="form-control" id="address" placeholder="Delivery Address" required="">
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <button type="submit" id="form-submit" name="form-submit" class="btn">Book Table</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section class="breakfast-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="breakfast-menu-content">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="left-image">
                                    <img src="img/dark.jpg" alt="Breakfast">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <h2>What's New</h2>
                                <div id="owl-breakfast" class="owl-carousel owl-theme">
                                    <div class="item col-md-12">
                                        <div class="food-item">
                                        <a href="order.php?id=<?php echo $new['fcode'] ?>">
                                        <?php $linkToPic=str_replace("open","uc",$new['link']);?>
                                            <img src="<?php echo $linkToPic ?>" alt="">
                                            <div class="price">Rs. <?php echo $new['price'] ?></div>
                                            <div class="text-content">
                                                <h4><?php echo $new['fname'] ?></h4>
                                                <p><?php echo $new['fdescription'] ?></p>
                                            </div> </a>
                                        </div>
                                    </div>
                                    <div class="item col-md-12">
                                        <div class="food-item">
                                        <a href="order.php?id=<?php echo $new2['fcode'] ?>">
                                        <?php $linkToPic=str_replace("open","uc",$new2['link']);?>
                                            <img src="<?php echo $linkToPic ?>" alt="">
                                            <div class="price">Rs. <?php echo $new2['price'] ?></div>
                                            <div class="text-content">
                                                <h4><?php echo $new2['fname'] ?></h4>
                                                <p><?php echo $new2['fdescription'] ?></p>
                                            </div> </a>
                                        </div>
                                    </div>
                                    <div class="item col-md-12">
                                        <div class="food-item">
                                        <a href="order.php?id=<?php echo $new3['fcode'] ?>">
                                        <?php $linkToPic=str_replace("open","uc",$new3['link']);?>
                                            <img src="<?php echo $linkToPic ?>" alt="">
                                            <div class="price">Rs. <?php echo $new3['price'] ?></div>
                                            <div class="text-content">
                                                <h4><?php echo $new3['fname'] ?></h4>
                                                <p><?php echo $new3['fdescription'] ?></p>
                                            </div> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="lunch-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="lunch-menu-content">
                        <div class="row">
                            <div class="col-md-7">
                                <h2>Top Ratings</h2>
                                <div id="owl-lunch" class="owl-carousel owl-theme">
                                    <div class="item col-md-12">
                                        <div class="food-item">
                                        <a href="order.php?id=<?php echo $best4['fcode'] ?>">
                                        <?php $linkToPic=str_replace("open","uc",$best4['link']);?>
                                            <img src="<?php echo $linkToPic ?>" alt="">
                                            <div class="price">Rs. <?php echo $best4['price'] ?></div>
                                            <div class="text-content">
                                                <h4><?php echo $best4['fname'] ?></h4>
                                                <p><?php echo $best4['fdescription'] ?></p>
                                            </div>
                                         </a>
                                        </div>
                                    </div>
                                    <div class="item col-md-12">
                                        <div class="food-item">
                                        <a href="order.php?id=<?php echo $best5['fcode'] ?>">
                                        <?php $linkToPic=str_replace("open","uc",$best5['link']);?>
                                            <img src="<?php echo $linkToPic ?>" alt="">
                                            <div class="price">Rs. <?php echo $best5['price'] ?></div>
                                            <div class="text-content">
                                                <h4><?php echo $best5['fname'] ?></h4>
                                                <p><?php echo $best5['fdescription'] ?></p>
                                            </div>
                                        </a>
                                        </div>
                                    </div>
                                    <div class="item col-md-12">
                                        <div class="food-item">
                                        <a href="order.php?id=<?php echo $best6['fcode'] ?>">
                                        <?php $linkToPic=str_replace("open","uc",$best6['link']);?>
                                            <img src="<?php echo $linkToPic ?>" alt="">
                                            <div class="price">Rs. <?php echo $best6['price'] ?></div>
                                            <div class="text-content">
                                                <h4><?php echo $best6['fname'] ?></h4>
                                                <p><?php echo $best6['fdescription'] ?></p>
                                            </div>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="left-image">
                                    <img src="img/top.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    



    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>Copyright &copy; 2020 Victory Template</p>
                </div>
                <div class="col-md-4">
                    <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p>Design: TemplateMo</p>
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