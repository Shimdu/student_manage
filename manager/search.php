<?php

// make db conection
require('../db.php');
// Check if person is logged in
require('../login_check.php');
mysqli_query($connection,'set names utf8');

$query = "SELECT name, avatar FROM teacher WHERE username = '$username'";
$tname = mysqli_fetch_array(mysqli_query($connection, $query));
mysqli_free_result(mysqli_query($connection, $query));

$option="";
if(isset($_POST['submit'])){
    $content = $_POST['content'];
    $option = $_POST['options'];
    
    if($option=='course'){
        $query = "SELECT course_no, c.name, semester, period, credit, if_optional, t.name AS tname FROM course c INNER JOIN teacher t ON t.id = c.teacher_id WHERE c.name LIKE '%$content%' OR t.name LIKE '%$content%'";
    }elseif($option=='teacher'){
        $query = "SELECT t.name, avatar, academic_title, dob, gender, qq, phone, email, inauguration_date, leave_date, a.name AS aname FROM teacher t INNER JOIN academy a ON a.id = t.academy_id WHERE t.name LIKE '%$content%' OR academic_title LIKE '%$content%' GROUP BY t.name";
    }else{
        $query = "SELECT s.name, avatar, s.student_id, dob, gender, qq, phone, email, CONCAT(province, '，', city, '，', detail) AS address, enrolment, class_no, year, m.name AS mname, a.name AS aname FROM student s INNER JOIN class ON class.id = s.class_id INNER JOIN major m ON m.id = class.major_id INNER JOIN academy a ON a.id = m.academy_id INNER JOIN student_course sc ON sc.student_id = s.id INNER JOIN course c ON c.id = sc.course_id WHERE s.name LIKE '%$content%' OR c.name LIKE '%$content%' OR address LIKE '%$content%' GROUP BY s.name";
    }
    $result = mysqli_query($connection,$query);
}

mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>搜索 - 学生成绩管理系统</title>
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
                        <h1 class="page-header"><i class="st-search"></i>搜索</h1>
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
                        <div class="search-page">
                            <form class="form-inline search-page-form" action="search.php" method="post">
                                <div class="col-lg-4">
                                    <div class="well bn">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="content" value="<?php if(isset($content)){echo $content;} ?>" placeholder="搜索..">
                                            <span class="input-group-btn">
                                                <button type="submit" name="submit" class="btn btn-primary"><i class="ec-search s16"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="search-page-toolbar btn-toolbar" role="toolbar">
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default btn-lg">
                                                <input type="radio" name="options" id="option1" value="course" <?php if($option==""||$option=="course"){echo "checked";}?>>课 程
                                            </label>
                                            <label class="btn btn-default btn-lg">
                                                <input type="radio" name="options" id="option2" value="student" <?php if($option=="student"){echo "checked";}?>>学 生
                                            </label>
                                            <label class="btn btn-default btn-lg">
                                                <input type="radio" name="options" id="option2" value="teacher" <?php if($option=="teacher"){echo "checked";}?>>老 师
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default plain toggle panelClose">
                                    <!-- Start .panel -->
                                    <div class="panel-heading white-bg">
                                        <h4 class="panel-title">搜索结果</h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table display" id="datatable">
                                            <?php
                                            if($option=="course"){
                                                echo "<p class='text-primary'>关于 <b>课程</b> 的搜索结果.</p>";
                                                echo "<thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>课程编码</th>
                                                        <th>课程名称</th>
                                                        <th>学 期</th>
                                                        <th>学 时</th>
                                                        <th>学 分</th>
                                                        <th>任课教师</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                                                $i=1;
                                                while($row=mysqli_fetch_array($result)){
                                                    echo "<tr>";
                                                    echo "<td>".$i."</td>";
                                                    echo "<td>".$row['course_no']."</td>";
                                                    echo "<td>".$row['name']."</td>";
                                                    echo "<td>".$row['semester']."</td>";
                                                    echo "<td>".$row['period']."</td>";
                                                    echo "<td>".$row['credit']."</td>";
                                                    echo "<td>".$row['tname']."</td>";
                                                    echo "</tr>";
                                                    $i++;
                                                }
                                                mysqli_free_result($result);
                                            } elseif($option=="teacher") {
                                                echo "<p class='text-primary'>关于 <b>老师</b> 的搜索结果.</p>";
                                                echo "<thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>头 像</th>
                                                        <th>姓 名</th>
                                                        <th>职 称</th>
                                                        <th>出生日期</th>
                                                        <th>性 别</th>
                                                        <th>QQ</th>
                                                        <th>电 话</th>
                                                        <th>邮 箱</th>
                                                        <th>任职日期</th>
                                                        <th>退休日期</th>
                                                        <th>学院名称</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                                                $i=1;
                                                while($row=mysqli_fetch_array($result)){
                                                    echo "<tr>";
                                                    echo "<td>".$i."</td>";
                                                    echo "<td><img height=\"40px\" class=\"user-avatar\" src=\"../assets/img/avatars/".$row['avatar']."\"></td>";
                                                    echo "<td>".$row['name']."</td>";
                                                    echo "<td>".$row['academic_title']."</td>";
                                                    echo "<td>".$row['dob']."</td>";
                                                    echo "<td>".$row['gender']."</td>";
                                                    if($row['qq']==""||$row['qq']==null){$row['qq']="无";}
                                                    echo "<td>".$row['qq']."</td>";
                                                    if($row['phone']==""||$row['phone']==null){$row['phone']="无";}
                                                    echo "<td>".$row['phone']."</td>";
                                                    if($row['email']==""||$row['email']==null){$row['email']="无";}
                                                    echo "<td>".$row['email']."</td>";
                                                    echo "<td>".$row['inauguration_date']."</td>";
                                                    if($row['leave_date']=="0000-00-00"||$row['leave_date']==null){$row['leave_date']="暂未退休";}
                                                    echo "<td>".$row['leave_date']."</td>";
                                                    echo "<td>".$row['aname']."</td>";
                                                    echo "</tr>";
                                                    $i++;
                                                }
                                                mysqli_free_result($result);
                                            } elseif($option=="student"){
                                                echo "<p class='text-primary'>关于 <b>学生</b> 的搜索结果.</p>";
                                                echo "<thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>头 像</th>
                                                        <th>姓 名</th>
                                                        <th>学 号</th>
                                                        <th>出生日期</th>
                                                        <th>性 别</th>
                                                        <th>QQ</th>
                                                        <th>电 话</th>
                                                        <th>邮 箱</th>
                                                        <th>住 址</th>
                                                        <th>入学日期</th>
                                                        <th>班级编号</th>
                                                        <th>学 制</th>
                                                        <th>专 业</th>
                                                        <th>学 院</th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                                                $i=1;
                                                while($row=mysqli_fetch_array($result)){
                                                    echo "<tr>";
                                                    echo "<td>".$i."</td>";
                                                    echo "<td><img height=\"40px\" class=\"user-avatar\" src=\"../assets/img/avatars/".$row['avatar']."\"></td>";
                                                    echo "<td>".$row['name']."</td>";
                                                    echo "<td>".$row['student_id']."</td>";
                                                    echo "<td>".$row['dob']."</td>";
                                                    echo "<td>".$row['gender']."</td>";
                                                    if($row['qq']==""||$row['qq']==null){$row['qq']="无";}
                                                    echo "<td>".$row['qq']."</td>";
                                                    if($row['phone']==""||$row['phone']==null){$row['phone']="无";}
                                                    echo "<td>".$row['phone']."</td>";
                                                    if($row['email']==""||$row['email']==null){$row['email']="无";}
                                                    echo "<td>".$row['email']."</td>";
                                                    echo "<td>".$row['address']."</td>";
                                                    echo "<td>".$row['enrolment']."</td>";
                                                    echo "<td>".$row['class_no']."</td>";
                                                    echo "<td>".$row['year']."</td>";
                                                    echo "<td>".$row['mname']."</td>";
                                                    echo "<td>".$row['aname']."</td>";
                                                    echo "</tr>";
                                                    $i++;
                                                }
                                                mysqli_free_result($result);
                                            } else {
                                                echo "<p class='text-primary'>搜索结果将显示在下方.</p>";
                                            }
                                            echo "</tbody>";
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .row -->
                        <!-- Page End here -->
                    </div>
                    <!-- End .outlet -->
                </div>
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