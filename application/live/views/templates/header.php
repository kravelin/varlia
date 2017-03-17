<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Varlia Online website" />
        <meta name="author" content="Kele Kravelin" />

        <title><?php echo $title ?></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Fondamento:400i" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/css-social-buttons/1.3.0/css/zocial.min.css" />
        <link rel="stylesheet" href="http://weloveiconfonts.com/api/?family=zocial" />
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://www.varlia.online"><img alt="cougar logo" src="/images/logo-navbar.svg"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="http://varlia.online">Home</a></li>
                        <!-- Gods dropdown -->
                        <?php echo make_navbar_gods(); ?>
                        <!-- Locaionts dropdown -->
                        <?php echo make_navbar_locations(); ?>
                        <!-- Monsters dropdown -->
                        <?php echo make_navbar_monsters(); ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Courswork dropdown -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Coursework <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="http://www.udacity.com/">Udacity</a></li>
                                <li class="courses-dropdown-header"><b>IPND: Intro to Programming</b></li>
                                <li><a href="/ipnd/stage1/">Character Sheet Project</a></li>
                                <li><a href="/ipnd/stage3/">Movie Trailer Page Project</a></li>
                                <li class="courses-dropdown-header"><b>FSND: Full Stack Web Developer</b></li>
                                <li><a href="/fsnd/blog/">Responsive Design Blog Project</a></li>
                                <li><a href="/fsnd/portfolio/">Personal Portfolio Page Project</a></li>
                                <li><a href="/fsnd/mublog/">Multi-User Blog using Google App Engine</a></li>
                                <li role="separator" class="courses-dropdown-header"></li>
                                <li><a href="/courses.html">Courswork Summary Page</a></li>
                            </ul>
                        </li> <!-- /Coursework -->
                    </ul>
                </div> <!-- /.navbar-collaps -->
            </div> <!-- /.container-fluid -->
        </nav>
