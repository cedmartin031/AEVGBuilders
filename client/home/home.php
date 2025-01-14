<?php
include_once("../include/dbh.inc.php");
$dbh = new dbHandler;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../include/style.css">
    <link rel="stylesheet" href="home.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <!-- <script src="login.js"></script> -->
</head>

<body>

    <div class="container-fluid fixed-top px-0">
        <header class=" bg-light d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="../../images/aevg-nobg.png" class="" height="45">
            </a>



            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">



                <li><a href="../home/home.php" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="../aboutUs/aboutUs.php" class="nav-link px-2 link-dark">About Us</a></li>
                <li><a href="../projects/project.php" class="nav-link px-2 link-dark">Projects</a></li>
                <li><a href="../materials/materials.php" class="nav-link px-2 link-dark">Materials</a></li>

            </ul>


            <div class="col-md-3 d-flex justify-content-end">

                <!-- Checking if the session is set -->
                <?php if (!isset($_SESSION['id'])) { ?>


                    <a href="../register/register.php" class="btn btn-dark">Sign-up</a>
                    <a href="../login/login.php" class="btn btn-outline-dark me-2">Login</a>

                <?php } else { ?>

                    <!-- <img id="profileImg" src="<?php echo $dbh->getValueByID('image', $_SESSION['id']); ?>" class="rounded-circle" style="max-height: 50px">  -->
                    <!-- <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $dbh->getFullname($_SESSION['id']); ?>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-dark">

                            <li><a class="dropdown-item active" href="../profile/profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="../message/message.php">Message</a></li>
                            <li><a class="dropdown-item" href="../order/order.php">Order</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../logout/logout.phps">Logout</a></li>

                        </ul>
                    </div> -->
                    <div class="dropdown me-5">
                        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../<?php echo $dbh->getValueByID('image', $_SESSION['id']); ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                            <strong><?php echo $dbh->getFullname($_SESSION['id']); ?></strong>
                        </a>
                        <ul class="dropdown-menu text-small shadow">
                            <li><a class="dropdown-item active" href="../profile/profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="../message/message.php">Message</a></li>
                            <li><a class="dropdown-item" href="../order/order.php">Order</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../logout/logout.php">Logout</a></li>
                        </ul>
                    </div>

                <?php } ?>

            </div>
        </header>
    </div>


    <main>

        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../../images/e.png" class="d-block w-100 img-fluid bg-carousel vh-100">

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1 class="display-4">HOUSES</h1>

                            <p><a class="btn btn-lg btn-primary" href="../projects/project.php">View Projects</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../../images/interior.jpg" class="d-block w-100 img-fluid bg-carousel vh-100">

                    </svg>

                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1 class="display-4">INTERIOR DESIGN</h1>

                            <p><a class="btn btn-lg btn-primary" href="../projects/project.php">View Projects </a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="../../images/pool.jpg" class="d-block w-100 img-fluid bg-carousel vh-100">

                    </svg>

                    <div class="container">
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1 class="display-4 ">RESORTS</h1>

                                <p><a class="btn btn-lg btn-primary" href="../projects/project.php">View Projects</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>


            <!-- Marketing messaging and featurettes
  ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container marketing">

                <!-- Three columns of text below the carousel -->



                <!-- START THE FEATURETTES -->

                <hr>

                <div class="row d-flex align-items-center">
                    <div class="col-md-4">
                        <h2 class="featurette-heading fw-normal lh-1s">CONSULTATION</h2>
                        <p class="lead">We offer high-quality construction services to clients, and a key part of this involves providing accurate projections and project costing.</p>
                    </div>
                    <div class="col-md-8 ">

                        <img class="img-fluid" src="../../images/consultation.jpg">



                    </div>
                </div>

                <hr>

                <div class="row d-flex align-items-center">
                    <div class="col-md-8">
                        <img class="img-fluid" src="../../images/interior.jpg">

                    </div>
                    <div class="col-md-4">
                        <h2 class="fw-normal lh-1">INTERIOR DESIGN</h2>
                        <p class="lead">Planning and design of man-made spaces, a part of environmental design and closely related to architecture.</p>
                    </div>

                </div>

                <hr>

                <div class="row d-flex align-items-center">
                    <div class="col-md-4">
                        <h2 class="featurette-heading fw-normal lh-1">BUDGET ESTIMATION</h2>
                        <p class="lead"> Approximates the time and resources needed to plan and complete a project and develop and implement a viable budget.</p>
                    </div>
                    <div class="col-md-8">
                        <img class="img-fluid" src="../../images/budget.jpg">
                    </div>
                </div>
                <hr>

                <div class="row d-flex align-items-center">
                    <div class="col-md-8">
                        <img class="img-fluid" src="../../images/pm.jpg">
                    </div>
                    <div class="col-md-4">
                        <h2 class=" fw-normal lh-1">PROJECT MANAGEMENT</h2>
                        <p class="lead">Project documentation, planning, tracking, and communication—all with the goal of delivering work successfully</p>
                    </div>
                </div>

                <hr>

                <div class="row d-flex align-items-center">
                    <div class="col-md-4">
                        <h2 class="featurette-heading fw-normal lh-1">CONSTRUCTION</h2>
                        <p class="lead">Manufacture and trade based on the building, maintaining, and repairing structures.</p>
                    </div>
                    <div class="col-md-8">
                        <img class="img-fluid" src="../../images/construction.jpg">

                    </div>
                </div>
                <hr class="featurette-divider">

                <!-- /END THE FEATURETTES -->

            </div><!-- /.container -->


            <div class="container-slider h-100">
                <div class="row align-items-center h-100">
                    <div class="container rounded">
                        <h1 class="mb-2 text-center">Our Clients</h1>
                        <div class="slider">
                            <div class="logos">
                                <i class="fab fa-js fa-4x"></i>
                                <i class="fab fa-linkedin-in fa-4x"></i>
                                <i class="fab fa-dribbble fa-4x"></i>
                                <i class="fab fa-medium-m fa-4x"></i>
                                <i class="fab fa-github fa-4x"></i>
                            </div>
                            <div class="logos">
                                <i class="fab fa-js fa-4x"></i>
                                <i class="fab fa-linkedin-in fa-4x"></i>
                                <i class="fab fa-dribbble fa-4x"></i>
                                <i class="fab fa-medium-m fa-4x"></i>
                                <i class="fab fa-github fa-4x"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container">
                <footer class="py-3 my-4">
                    <ul class="nav justify-content-center border-bottom pb-3 mb-3">

                    </ul>
                    <p class="text-center text-muted">&copy; 2017 AEVG BUILDERS</p>

                </footer>

</body>
<!-- <script>
    $(document).ready(function() {

        var file = $("input[type=file]").get(0).files[0];

        if (file) {

            var reader = new FileReader();

            reader.onload = function() {
                $("#profileImg").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    });

</script> -->

</html>