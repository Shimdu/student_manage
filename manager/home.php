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

//students/teachers/course amount
$query = "SELECT COUNT(id) AS nums FROM course";
$result1 = mysqli_query($connection,$query);
$row1 = mysqli_fetch_array($result1);
mysqli_free_result($result1);
$course_to = $row1['nums'];

//Easy pie chart (popular courses)
$pie_color1 = array("","red-pie","purple-pie","blue-pie","teal-pie","green-pie");
$pie_color2 = array("","-red","-purple","-blue","-teal","-green");
$query = "SELECT name, COUNT(course_id) AS nums FROM student_course INNER JOIN course ON course.id = student_course.course_id GROUP BY name ORDER BY nums DESC LIMIT 6";
$result2 = mysqli_query($connection,$query);

//Pie chart 1
$query = "SELECT COUNT(id) AS nums FROM student WHERE gender = '男'";
$result3 = mysqli_query($connection, $query);
$res = mysqli_fetch_array($result3);
$student_m = (int)$res['nums'];
if($student_m==null){$student_m=0;}
mysqli_free_result($result3);
$query = "SELECT COUNT(id) AS nums FROM student WHERE gender = '女'";
$result3 = mysqli_query($connection, $query);
$res = mysqli_fetch_array($result3);
$student_f = (int)$res['nums'];
if($student_f==null){$student_f=0;}
mysqli_free_result($result3);
$student_to = $student_m + $student_f;
$student_m = $student_m/$student_to*100;
$student_f = $student_f/$student_to*100;

//Pie chart 2
$query = "SELECT COUNT(id) AS nums FROM teacher WHERE gender = '男'";
$result3 = mysqli_query($connection, $query);
$res = mysqli_fetch_array($result3);
$teacher_m = (int)$res['nums'];
if($teacher_m==null){$teacher_m=0;}
mysqli_free_result($result3);
$query = "SELECT COUNT(id) AS nums FROM teacher WHERE gender = '女'";
$result3 = mysqli_query($connection, $query);
$res = mysqli_fetch_array($result3);
$teacher_f = (int)$res['nums'];
if($teacher_f==null){$teacher_f=0;}
mysqli_free_result($result3);
$teacher_to = $teacher_m + $teacher_f;
$teacher_m = $teacher_m/$teacher_to*100;
$teacher_f = $teacher_f/$teacher_to*100;

// --Bar chart----
$bar_color = array("","progress-bar-success","progress-bar-danger","progress-bar-info","progress-bar-dark","progress-bar-yellow","progress-bar-lime","progress-bar-orange","progress-bar-purple","progress-bar-pink","progress-bar-magenta","progress-bar-brown");
$date="1995-01-01";
$student_num=array();
for($i=1;$i<7;$i++){
    $date2=date('Y-m-d',strtotime("$date +1 year"));
    $query = "SELECT COUNT(id) AS nums FROM student WHERE dob BETWEEN '$date' AND '$date2'";
    $result3 = mysqli_fetch_array(mysqli_query($connection, $query));
    $res=$result3['nums'];
    array_push($student_num,$res);
    $date=date('Y-m-d',strtotime("$date +1 year"));
}

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
                    <li><a href="teacher.php">教师管理<i class="im-user4"></i></a>
                    </li>
                    <li><a href="course.php">课程管理<i class="im-book"></i></a>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="page-header">
                                <h5>统计报表</h5>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"></div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <!-- col-lg-3 start here -->
                                    <a href="course.php">
                                        <div class="tile gray-spr m0 mb20">
                                            <div class="tile-content text-center clearfix text-muted">
                                                <div class="label">课程总数</div>
                                                <div class="spark-number"><i class="im-book"></i> <?php echo $course_to;?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <!-- col-lg-3 start here -->
                                    <a href="student.php">
                                        <div class="tile gray-spr m0 mb20">
                                            <div class="tile-content text-center clearfix text-muted">
                                                <div class="label">学生总数</div>
                                                <div class="spark-number"><i class="ec-users"></i> <?php echo $student_to;?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- col-lg-3 end here -->
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <!-- col-lg-3 start here -->
                                    <a href="teacher.php">
                                        <div class="tile gray-spr m0 mb20">
                                            <div class="tile-content text-center clearfix text-muted">
                                                <div class="label">教师总数</div>
                                                <div class="spark-number"><i class="im-user4"></i> <?php echo $teacher_to;?></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <!-- col-lg-3 end here -->
                            </div>
                            <div class="panel panel-default">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="im-pie"></i>简单饼状图</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="page-header">
                                        <h5>最受欢迎的课程排行榜</h5>
                                    </div>
                                    <?php
                                    $i=0;
                                    while($res=mysqli_fetch_array($result2)){
                                        $num_per=$res['nums']/$course_to*100;
                                        $num_per=round($num_per,2);
                                        echo "<div class=\"pie-charts ".$pie_color1[$i]."\">
                                            <div class=\"easy-pie-chart".$pie_color2[$i]."\" data-percent=\"".$num_per."\">".$num_per."%</div>
                                            <div class=\"label\">".($i+1).". ".$res['name']."</div>
                                        </div>";
                                        $i+=1;
                                    }
                                    mysqli_free_result($result2);
                                    ?>
                                </div>
                            </div>
                            <!-- End .panel -->
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-info">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa-list"></i>不同出生日期的学生数量</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="page-header text-right">
                                        <h3>学生总数： <?php echo $student_to;?></h3>
                                    </div>
                                    <form action="home.php" class="form-horizontal">
                                        <?php
                                        $year=1995;
                                        for($i=0;$i<6;$i++){
                                            $year2=$year+1;
                                            $student_per=$student_num[$i]/$student_to*100;
                                            echo "<div class=\"form-group\">
                                                    <label class=\"col-lg-2 control-label\">".$year." 年 </label>
                                                    <div class=\"col-lg-10\">
                                                        <div class=\"progress\">
                                                            <div class=\"progress-bar ".$bar_color[$i]."\" role=\"progressbar\" aria-valuenow=\"".$student_num[$i]."\" aria-valuemin=\"0\" aria-valuemax=\"".$student_to."\" style=\"width: ".$student_per."%;\">".$student_num[$i]."</div>
                                                        </div>
                                                    </div>
                                                </div>";
                                            $year+=1;
                                        }
                                        ?>
                                    </form>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <!-- Start .panel -->
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="im-pie"></i>饼状图表</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="page-header">
                                        <h5>学生男女比例</h5>
                                    </div>
                                    <div id="pie-chart" style="width: 100%; height:250px;"></div>
                                    <div class="page-header">
                                        <h5>教师男女比例</h5>
                                    </div>
                                    <div id="donut-chart" style="width: 100%; height:250px;"></div>
                                </div>
                            </div>
                            <!-- End .panel -->
                        </div>
                    </div>
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
        <script src="../assets/plugins/charts/flot/jquery.flot.js"></script>
        <script src="../assets/plugins/charts/flot/jquery.flot.pie.js"></script>
        <script src="../assets/plugins/charts/flot/jquery.flot.resize.js"></script>
        <script src="../assets/plugins/charts/flot/jquery.flot.time.js"></script>
        <script src="../assets/plugins/charts/flot/jquery.flot.growraf.js"></script>
        <script src="../assets/plugins/charts/flot/jquery.flot.categories.js"></script>
        <script src="../assets/plugins/charts/flot/jquery.flot.stack.js"></script>
        <script src="../assets/plugins/charts/flot/jquery.flot.orderBars.js"></script>
        <script src="../assets/plugins/charts/flot/jquery.flot.tooltip.min.js"></script>
        <script src="../assets/plugins/charts/flot/date.js"></script>
        <script src="../assets/plugins/charts/sparklines/jquery.sparkline.js"></script>
        <script src="../assets/plugins/charts/pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="../assets/plugins/forms/icheck/jquery.icheck.js"></script>
        <script src="../assets/plugins/forms/tags/jquery.tagsinput.min.js"></script>
        <script src="../assets/plugins/forms/tinymce/tinymce.min.js"></script>
        <script src="../assets/plugins/misc/highlight/highlight.pack.js"></script>
        <script src="../assets/plugins/misc/countTo/jquery.countTo.js"></script>
        <script src="../assets/plugins/ui/notify/jquery.gritter.js"></script>
        <script src="../assets/js/jquery.sprFlat.js"></script>
        <script src="../assets/js/app.js"></script>
        <script src="../assets/plugins/core/moment/moment.min.js"></script>
        <script src="../assets/plugins/tables/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/tables/datatables/jquery.dataTablesBS3.js"></script>
        <script src="../assets/plugins/tables/datatables/tabletools/ZeroClipboard.js"></script>
        <script src="../assets/plugins/tables/datatables/tabletools/TableTools.js"></script>
        <script>
            $(document).ready(function() {

            //------------- Datatables -------------//
            $('#datatable').dataTable({
                "sPaginationType": "bs_full", //"bs_normal", "bs_two_button", "bs_four_button", "bs_full"
                "fnPreDrawCallback": function( oSettings ) {
                    $('.dataTables_filter input').addClass('form-control input-large').attr('placeholder', '搜索..');
                    $('.dataTables_length select').addClass('form-control input-small');
                },
                "oLanguage": {
                    "sSearch": "",
                    "sLengthMenu": "<span>显示 _MENU_ 条结果</span>"
                },
                "bJQueryUI": false,
                "bAutoWidth": false,
                "sDom": "<'row'<'col-lg-6 col-md-6 col-sm-12 text-center'l><'col-lg-6 col-md-6 col-sm-12 text-center'f>r>t<'row-'<'col-lg-6 col-md-6 col-sm-12'i><'col-lg-6 col-md-6 col-sm-12'p>>",
            });
            });
        </script>
        <script>
        //------------- charts.js -------------//
        $(document).ready(function() {

            //get object with colros from plugin and store it.
            var objColors = $('body').data('sprFlat').getColors();
            var colours = {
                white: objColors.white,
                dark: objColors.dark,
                red : objColors.red,
                blue: objColors.blue,
                green : objColors.green,
                yellow: objColors.yellow,
                brown: objColors.brown,
                orange : objColors.orange,
                purple : objColors.purple,
                pink : objColors.pink,
                lime : objColors.lime,
                magenta: objColors.magenta,
                teal: objColors.teal,
                textcolor: '#5a5e63',
                gray: objColors.gray
            }

            //generate random number for charts
            randNum = function(){
                return (Math.floor( Math.random()* (1+150-50) ) ) + 80;
            }


            //------------- Pie chart -------------//
            $(function () {
                var options = {
                    series: {
                        pie: { 
                            show: true,
                            innerRadius: 0,
                            radius: 'auto',
                            highlight: {
                                opacity: 0.1
                            },
                            stroke: {
                                width: 2,
                            }
                        }					
                    },
                    legend:{
                        show:true,
                        labelFormatter: function(label, series) {
                            return '<div style="font-weight:bold;font-size:13px;">'+ label +'</div>'
                        },
                        labelBoxBorderColor: null,
                        margin: 50,
                        width: 20,
                        padding: 1
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                    },
                    tooltip: true, //activate tooltip
                    tooltipOpts: {
                        content: "%s : %y.1"+"%",
                        shifts: {
                            x: -30,
                            y: -50
                        },
                        theme: 'dark',
                        defaultTheme: false
                    }
                };
                var data = [
                    { label: '男',  data: <?php echo $student_m;?>, color: colours.blue},
                    { label: '女',  data: <?php echo $student_f;?>, color: colours.red}
                ];
                $.plot($("#pie-chart"), data, options);

            });

            //------------- Donut chart -------------//
            $(function () {
                var options = {
                    series: {
                        pie: { 
                            show: true,
                            innerRadius: 0.55,
                            highlight: {
                                opacity: 0.1
                            },
                            radius: 1,
                            stroke: {
                                width: 10
                            },
                            startAngle: 2.15
                        }					
                    },
                    legend:{
                        show:true,
                        labelFormatter: function(label, series) {
                            return '<div style="font-weight:bold;font-size:13px;">'+ label +'</div>'
                        },
                        labelBoxBorderColor: null,
                        margin: 50,
                        width: 20,
                        padding: 1
                    },
                    grid: {
                        hoverable: true,
                        clickable: true,
                    },
                    tooltip: true, //activate tooltip
                    tooltipOpts: {
                        content: "%s : %y.1"+"%",
                        shifts: {
                            x: -30,
                            y: -50
                        },
                        theme: 'dark',
                        defaultTheme: false
                    }
                };
                var data = [
                    { label: '男',  data: <?php echo $teacher_m;?>, color: colours.blue},
                    { label: '女',  data: <?php echo $teacher_f;?>, color: colours.red}
                ];
                $.plot($("#donut-chart"), data, options);

            });

            //------------- Init pie charts -------------//
            //pass the variables to pie chart init function
            //first is line width, size for pie, animated time , and colours object for theming.
            initPieChart(10,40, 1500, colours);
            initPieChartPage(20,100,1500, colours);


        });

        //Setup easy pie charts in sidebar
        var initPieChart = function(lineWidth, size, animateTime, colours) {
            $(".pie-chart").easyPieChart({
                barColor: colours.dark,
                borderColor: colours.dark,
                trackColor: '#d9dde2',
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: lineWidth,
                size: size,
                animate: animateTime
            });
        }

        //Setup easy pie charts in page
        var initPieChartPage = function(lineWidth, size, animateTime, colours) {

            $(".easy-pie-chart").easyPieChart({
                barColor: colours.dark,
                borderColor: colours.dark,
                trackColor: colours.gray,
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: lineWidth,
                size: size,
                animate: animateTime
            });
            $(".easy-pie-chart-red").easyPieChart({
                barColor: colours.red,
                borderColor: colours.red,
                trackColor: '#fbccbf',
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: lineWidth,
                size: size,
                animate: animateTime
            });
            $(".easy-pie-chart-green").easyPieChart({
                barColor: colours.green,
                borderColor: colours.green,
                trackColor: '#b1f8b1',
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: lineWidth,
                size: size,
                animate: animateTime
            });
            $(".easy-pie-chart-blue").easyPieChart({
                barColor: colours.blue,
                borderColor: colours.blue,
                trackColor: '#d2e4fb',
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: lineWidth,
                size: size,
                animate: animateTime
            });
            $(".easy-pie-chart-teal").easyPieChart({
                barColor: colours.teal,
                borderColor: colours.teal,
                trackColor: '#c3e5e5',
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: lineWidth,
                size: size,
                animate: animateTime
            });
            $(".easy-pie-chart-purple").easyPieChart({
                barColor: colours.purple,
                borderColor: colours.purple,
                trackColor: '#dec1f5',
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: lineWidth,
                size: size,
                animate: animateTime
            });

        }
        </script>
    </body>
</html>