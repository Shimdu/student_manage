<?php

// make db conection
require('../db.php');
// Check if person is logged in
require('../login_check.php');
mysqli_query($connection,'set names utf8');

$query = "SELECT name, avatar FROM teacher WHERE username = '$username'";
$tname = mysqli_fetch_array(mysqli_query($connection, $query));
mysqli_free_result(mysqli_query($connection, $query));

// Show bulletin board
$query = "SELECT content, time FROM bulletin INNER JOIN teacher ON bulletin.publisher_id = teacher.id ORDER BY time DESC";
$result = mysqli_query($connection,$query);

mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>首页 - 学生成绩管理系统</title>
        <!-- Mobile specific metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Force IE9 to render in normal mode -->
        <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,700|Droid+Sans:400,700' />
        <!--[if lt IE 9]>
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
            <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
            <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
        <![endif]-->
        <!-- Css files -->
        <!-- Icons -->
        <link href="../assets/css/icons.css" rel="stylesheet" />
        <!-- jQueryUI -->
        <link href="../assets/css/sprflat-theme/jquery.ui.all.css" rel="stylesheet" />
        <!-- Bootstrap stylesheets (included template modifications) -->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" />
        <!-- Plugins stylesheets (all plugin custom css) -->
        <link href="../assets/css/plugins.css" rel="stylesheet" />
        <!-- Main stylesheets (template main css file) -->
        <link href="../assets/css/main.css" rel="stylesheet" />
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/img/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/img/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/img/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/img/ico/apple-touch-icon-57-precomposed.png">
        <link rel="icon" href="../assets/img/ico/favicon.ico" type="image/png">
        <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
        <meta name="msapplication-TileColor" content="#3399cc" />
    </head>
    <body>
        <!-- Start #header -->
        <div id="header">
            <div class="container-fluid">
                <div class="navbar">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="home.php">
                            <i class="im-windows8 text-logo-element animated bounceIn"></i><span class="text-logo">学生</span><span class="text-slogan">管理</span> 
                        </a>
                    </div>
                    <nav class="top-nav" role="navigation">
                        <ul class="nav navbar-nav pull-left">
                            <li id="toggle-sidebar-li">
                                <a href="#" id="toggle-sidebar"><i class="en-arrow-left2"></i>
                        </a>
                            </li>
                            <li>
                                <a href="#" class="full-screen"><i class="fa-fullscreen"></i></a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown">
                                    <img class="user-avatar" src="../assets/img/avatars/<?php echo $tname['avatar'];?>"><?php echo $tname['name'];?></a>
                                <ul class="dropdown-menu right" role="menu">
                                    <li><a href="profile.php"><i class="st-user"></i>个人信息</a>
                                    </li>
                                    <li><a href="../logout.php"><i class="im-exit"></i>登出</a>
                                    </li>
                                </ul>
                            </li>
                            <li id="toggle-right-sidebar-li"><a href="../logout.php"><i class="im-switch"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Start .header-inner -->
        </div>
        <!-- End #header -->
        <!-- Start #sidebar -->
        <div id="sidebar">
            <!-- Start .sidebar-inner -->
            <div class="sidebar-inner">
                <!-- Start #sideNav -->
                <ul id="sideNav" class="nav nav-pills nav-stacked">
                    <li class="top-search">
                        <form>
                            <input type="text" name="search" placeholder="搜索...">
                            <button type="submit"><i class="ec-search s20"></i>
                            </button>
                        </form>
                    </li>
                    <li><a href="home.php">首页<i class="im-screen"></i></a>
                    </li>
                    <li><a href="bulletin.php">公告栏<i class="im-bullhorn"></i></a>
                    </li>
                    <li><a href="profile.php">个人信息<i class="im-profile"></i></a>
                    </li>
                    <li><a href="student.php">学生管理<i class="im-accessibility"></i></a>
                    </li>
                    <li><a href="grade_manage.php">成绩管理<i class="ec-archive2"></i></a>
                    </li>
                    <li><a href="grade.php"><i class="en-login"></i>成绩录入</a>
                    </li>
                    <li><a href="search.php"><i class="st-search"></i>搜索</a>
                    </li>
                    <li><a href="../logout.php"><i class="im-exit"></i>登出</a>
                    </li>
                </ul>
                <!-- End #sideNav -->
            </div>
            <!-- End .sidebar-inner -->
        </div>
        <!-- End #sidebar -->
        <!-- Start #content -->
        <div id="content">
            <!-- Start .content-wrapper -->
            <div class="content-wrapper">
                <div class="row">
                    <!-- Start .row -->
                    <!-- Start .page-header -->
                    <div class="col-lg-12 heading">
                        <h1 class="page-header"><i class="im-screen"></i>首页</h1>
                        <!-- Start .bredcrumb -->
                        <ul id="crumb" class="breadcrumb">
                        </ul>
                        <!-- End .breadcrumb -->
                        <!-- Start .option-buttons -->
                        <div class="option-buttons">
                            <div class="btn-toolbar" role="toolbar">
                                <div class="btn-group">
                                    <a id="clear-localstorage" class="btn tip" title="Reset panels position">
                                        <i class="ec-refresh s24"></i>
                                    </a>
                                </div>
                                <div class="btn-group dropdown">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenu2"><i class="ec-pencil s24"></i></a> 
                                    <div class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu2">
                                        <div class="option-dropdown">
                                            <div class="row">
                                                <p class="col-lg-12">快速发表</p>
                                                <form class="form-horizontal" role="form" method="post" action="bulletin.php">
                                                    <!-- End .form-group  -->
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <textarea class="form-control wysiwyg" placeholder="添加内容" name="content"></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- End .form-group  -->
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <button class="btn btn-success btn-xs pull-right" type="submit" name="submit">发 布</button>
                                                        </div>
                                                    </div>
                                                    <!-- End .form-group  -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3"><i class="ec-help s24"></i></a>
                                    <div class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu3">
                                        <div class="option-dropdown">
                                            <p>第一次访问？<a href="guide.php" id="app-tour" class="btn btn-success ml15">操作指南</a> 
                                            </p>
                                            <hr>
                                            <p>或者查看<a href="guide.php" class="btn btn-danger ml15">FAQ</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .option-buttons -->
                    </div>
                    <!-- End .page-header -->
                </div>
                <!-- End .row -->
                <div class="outlet">
                    <!-- Start .outlet -->
                    <!-- Page start here ( usual with .row ) -->
                    <div class="row">
                        <!-- Start .row -->
                        <div class="col-lg-4 col-md-4">
                            <div class="page-header">
                                <h5>校园风光</h5>
                            </div>
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators dotstyle center">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"><a href="#">slide1</a>
                                    </li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"><a href="#">slide2</a>
                                    </li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"><a href="#">slide3</a>
                                    </li>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="../assets/img/carousel/1.jpg" alt="Image1">
                                        <div class="carousel-caption">
                                            <h4>西南门</h4>
                                            <p>Wonderful gate in CDUT.</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="../assets/img/carousel/2.jpg" alt="Image2">
                                        <div class="carousel-caption">
                                            <h4>老图书馆</h4>
                                            <p>Wonderful aquatic library in CDUT.</p>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="../assets/img/carousel/3.jpg" alt="Image3">
                                        <div class="carousel-caption">
                                            <h4>新图书馆</h4>
                                            <p>Very nice and new library in CDUT.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <i class="en-arrow-left8"></i>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <i class="en-arrow-right8"></i>
                                </a>
                            </div><br>
                            <div class="page-header">
                                <h5>站内搜索</h5>
                            </div>
                            <form class="form-inline search-page-form" action="search.php" method="post">
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="content" placeholder="搜索...">
                                        <span class="input-group-btn">
                                            <button type="submit" name="submit" class="btn btn-primary"><i class="ec-search s16"></i></button>
                                        </span>
                                    </div><br>
                                </div>
                                <div class="col-lg-12">
                                    <div class="search-page-toolbar btn-toolbar" role="toolbar">
                                        <div class="btn-group pull-right" data-toggle="buttons">
                                            <label class="btn btn-default btn-lg">
                                                <input type="radio" name="options" id="option1" value="course" checked>课 程
                                            </label>
                                            <label class="btn btn-default btn-lg">
                                                <input type="radio" name="options" id="option2" value="student">学 生
                                            </label>
                                            <label class="btn btn-default btn-lg">
                                                <input type="radio" name="options" id="option2" value="teacher">老 师
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                        <div class="col-lg-6 col-md-6">
                            <div class="page-header">
                                <h5>公告栏</h5>
                            </div>
                            <table class="table display" id="datatable">
                                <thead>
                                    <tr>
                                        <th class="per5">#</th>
                                        <th class="per25">发布时间</th>
                                        <th class="per70">内容</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    while($row=mysqli_fetch_array($result)){
                                        echo "<tr>";
                                        echo "<td class=\"center\">".$i."</td>";
                                        echo "<td>".$row['time']."</td>";
                                        echo "<td>".$row['content']."</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                    mysqli_free_result($result);
                                    ?>
                                </tbody>
                            </table><br>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="page-header">
                                <h5>友情链接</h5>
                            </div>
                            <div class="list-group">
                                <a href="http://aao.cdut.edu.cn/aao/fj/2017jxrl.pdf" class="list-group-item">教学日历</a>
                                <a href="http://aao.cdut.edu.cn/aao/aao.php?aid=206&sort=380&sorid=382&from=passg" class="list-group-item">作息时间表</a>
                                <a href="http://xuanshu.hep.com.cn/" class="list-group-item">高教社教材信息查询</a>
                                <a href="http://www.cdut.edu.cn/jpkc/default.html" class="list-group-item">精品课程</a>
                            </div><br>
                            <div class="page-header">
                                <h5>教学资讯</h5>
                            </div>
                            <p>暂无信息..</p>
                        </div>
                    </div>
                    <!-- End .row -->
                    <!-- Page End here -->
                </div>
                <!-- End .outlet -->
            </div>
            <!-- End .content-wrapper -->
            <div class="clearfix"></div>
        </div>
        <!-- End #content -->
        <!-- Javascripts -->
        <!-- Load pace first -->
        <script src="../assets/plugins/core/pace/pace.min.js"></script>
        <!-- Important javascript libs(put in all pages) -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="../assets/js/libs/jquery-2.1.1.min.js">\x3C/script>')
        </script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
        window.jQuery || document.write('<script src="../assets/js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')
        </script>
        <!--[if lt IE 9]>
          <script type="text/javascript" src="../assets/js/libs/excanvas.min.js"></script>
          <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
          <script type="text/javascript" src="../assets/js/libs/respond.min.js"></script>
        <![endif]-->
        <!-- Bootstrap plugins -->
        <script src="../assets/js/bootstrap/bootstrap.js"></script>
        <!-- Core plugins ( not remove ever) -->
        <!-- Handle responsive view functions -->
        <script src="../assets/js/jRespond.min.js"></script>
        <!-- Custom scroll for sidebars,tables and etc. -->
        <script src="../assets/plugins/core/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../assets/plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js"></script>
        <!-- Resize text area in most pages -->
        <script src="../assets/plugins/forms/autosize/jquery.autosize.js"></script>
        <!-- Proivde quick search for many widgets -->
        <script src="../assets/plugins/core/quicksearch/jquery.quicksearch.js"></script>
        <!-- Bootbox confirm dialog for reset postion on panels -->
        <script src="../assets/plugins/ui/bootbox/bootbox.js"></script>
        <!-- Other plugins ( load only nessesary plugins for every page) -->
        <script src="../assets/plugins/core/moment/moment.min.js"></script>
        <script src="../assets/plugins/charts/sparklines/jquery.sparkline.js"></script>
        <script src="../assets/plugins/charts/pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="../assets/plugins/forms/icheck/jquery.icheck.js"></script>
        <script src="../assets/plugins/forms/tags/jquery.tagsinput.min.js"></script>
        <script src="../assets/plugins/forms/tinymce/tinymce.min.js"></script>
        <script src="../assets/plugins/tables/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/tables/datatables/jquery.dataTablesBS3.js"></script>
        <script src="../assets/plugins/tables/datatables/tabletools/ZeroClipboard.js"></script>
        <script src="../assets/plugins/tables/datatables/tabletools/TableTools.js"></script>
        <script src="../assets/plugins/misc/highlight/highlight.pack.js"></script>
        <script src="../assets/plugins/misc/countTo/jquery.countTo.js"></script>
        <script src="../assets/js/jquery.sprFlat.js"></script>
        <script src="../assets/js/app.js"></script>
        <script src="../assets/js/pages/data-tables.js"></script>
    </body>
</html>