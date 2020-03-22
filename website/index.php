<?php

// Initialize the session
session_start();

//include('./registration.php');
include('../config/connectDB.php');
$sql1='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY added_at DESC LIMIT 3';
$result1=mysqli_query($conn,$sql1);
$new=mysqli_fetch_all($result1, MYSQLI_ASSOC);
//print_r($new);

$sql2='SELECT fname,fcode,price,material,size,link,fdescription FROM frock ORDER BY rating  DESC LIMIT 3';
$result2=mysqli_query($conn,$sql2);
$best=mysqli_fetch_all($result2, MYSQLI_ASSOC);

if(isset($_POST['form-submit'])){
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
    } else {
        $uname=$_SESSION["username"];
        $fdate=$_POST['fdate'];
        $hour=$_POST['hour'];

        //sql
        $sql="INSERT INTO appointment(uname,fdate,hour,accept) VALUES ('$uname','$fdate','$hour',0)";
        
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
        <title>Sihina</title>
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

            #book-table{
                padding: 80px 0px;
                background-image: url('./img/ban.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;
                text-align: center;
            }

            #book-table .heading h2 {
                margin-top: 0px;
                margin-bottom: 70px;
                font-size: 22px;
                font-weight: 700;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                color: #fff;
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


    <form  class="bann">
        <h4>Here you can find your favourite pre-shoot dress</h4>
        <h2>We can Rent it!</h2>
        <h4>Or design it with you</h4>
    </form>



    <section class="cook-delecious">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-offset-1">
                    <div class="first-image">
                        <img src="img/left.jpg" alt="" >
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="cook-content">
                        <h4>We can make your dream come true</h4>
                        <div class="contact-content">
                            <span>You can call us on:</span>
                            <h6>+ 1234 567 8910</h6>
                        </div>
                        <span>or</span>
                        <div class="primary-white-button">
                            <a href="#" class="scroll-link" data-id="book-table">Make an Appointment</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="second-image">
                        <img src="img/right.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="service-item">
                        <a href="evening.php">
                        <img src="img/evening.jpg" alt="Breakfast">
                        <h4>Evening</h4>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="service-item">
                        <a href="dark.php">
                        <img src="img/dark1.jpg" alt="Lunch">
                        <h4>Dark Theme</h4>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="service-item">
                        <a href="nature.php">
                        <img src="img/nature.jpg" alt="Dinner">
                        <h4>Nature Theme</h4>
                        </a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="service-item">
                        <a href="light.php">
                        <img src="img/light.jpg" alt="Desserts">
                        <h4>Light Theme</h4>
                        </a>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


    


    <section class="featured-food">
        <div class="container">
            <div class="row">
                <div class="heading">
                    <h2>What's New</h2>
                </div>
            </div>
            <?php foreach($new as $frock) :?> 
                <div class="service-item">
                <a href="order.php?id=<?php echo $frock['fcode'] ?>">
                <div class="col-md-4">
                    <div class="food-item">
                        <h2><?php echo $frock['fname'] ?></h2>
                        <?php $linkToPic=str_replace("open","uc",$frock['link']);?>
                        <img src="<?php echo $linkToPic ?>" alt="">
                        <div class="price">Rs. <?php echo $frock['price'] ?></div>
                        <div class="text-content">
                            <h4>Details</h4>
                            <p><?php echo $frock['fdescription'] ?></p>
                        </div>
                    </div>
                </div>
            </a>
            </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="book-table">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h2>Design Your dream dress</h2>
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-2 col-sm-12">
                    <div class="left-image">
                        <img src="img/sajbanner.jpg" height="282">
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="right-info">
                        <h4>Reserve a Day</h4>
                        <form id="form-submit" name="form-submit" action="" method="POST">
                        <div class="col-md-12">
                            <fieldset>
                            Select Date
                                <input name="fdate" type="date" class="form-control" id="fdate" placeholder="From Date" required="">
                            </fieldset>
                        </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <select required name='hour' onchange='this.form.()'>
                                            <option value="">Select hour</option>
                                            <option value="10-00">10:00</option>
                                            <option value="11-00">11:00</option>
                                            <option value="12-00">12:00</option>
                                            <option value="13-00">13:00</option>
                                            <option value="14-00">14:00</option>
                                            <option value="15-00">15:00</option>
                                            <option value="16-00">16:00</option>
                                            <option value="17-00">17:00</option>
                                            <option value="18-00">18:00</option>
                                            <option value="19-00">19:00</option>
                                        </select>
                                    </fieldset>
                                </div>
                                
                                <div class="col-md-6">
                                    <fieldset>
                                        <button type="submit" id="form-submit" name="form-submit" class="btn">Reserve</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-food">
        <div class="container">
            <div class="row">
                <div class="heading">
                    <h2>Top Ratings</h2>
                </div>
            </div>
            <?php foreach($best as $frock) :?> 
                <a href="order.php?id=<?php echo $frock['fcode'] ?>">
                <div class="service-item">
                <div class="col-md-4">
                    <div class="food-item">
                        <h2><?php echo $frock['fname'] ?></h2>
                        <?php $linkToPic=str_replace("open","uc",$frock['link']);?>
                        <img src="<?php echo $linkToPic ?>" alt="">
                        <div class="price">Rs. <?php echo $frock['price'] ?></div>
                        <div class="text-content">
                            <h4>Details</h4>
                            <p><?php echo $frock['fdescription'] ?></p>
                        </div>
                    </div>
                </div>
                </div>
            </a>
                <?php endforeach; ?>
            </div>
        </div>
        
    </section>
    <section class="bann"></section>
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