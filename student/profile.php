<?php

// make db conection
require('../db.php');
// Check if person is logged in
require('../login_check.php');
mysqli_query($connection,'set names utf8');

$query = "SELECT s.name, avatar, student_id, dob, gender, qq, phone, email, CONCAT(province, '，', city, '，', detail) AS address, enrolment, class_no, year, m.name AS mname, major_num, a.name AS aname FROM student s INNER JOIN class ON class.id = s.class_id INNER JOIN major m ON m.id = class.major_id INNER JOIN academy a ON a.id = m.academy_id WHERE username = '$username'";
$sname = mysqli_fetch_array(mysqli_query($connection, $query));
mysqli_free_result(mysqli_query($connection, $query));

//Update basic info
if(isset($_POST['submit'])){
    $dob=$_POST['dob'];
    $address=explode('，', $_POST['address']);
    $province = $address[0];
    $city = $address[1];
    $detail = $address[2];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $qq=$_POST['qq'];
    
    $query = "UPDATE student SET dob = '$dob', province = '$province', city = '$city', detail = '$detail', phone = '$phone', email = '$email', qq = '$qq' WHERE username = '$username'";
    $result1 = mysqli_query($connection,$query);
    mysqli_free_result($result1);
    header('Location: profile.php?success=1');
}

//Course information
$query = "SELECT course_no, c.name, semester FROM course c INNER JOIN student_course sc ON sc.course_id = c.id INNER JOIN student s ON s.id = sc.student_id WHERE username = '$username'";
$result = mysqli_query($connection,$query);

//Upload avatar
if(isset($_POST['submit1'])){
    if ($_FILES['file']['error']){
    switch ($_FILES['file']['error']){
        case 1:
            $str="More than the values set in php.ini";
            break;
        case 2:
            $str="More than the values set in the form";
            break;
        case 3:
            $str="Only part of the file is uploaded";
            break;
        case 4:
            $str="No files are uploaded";
            break;
        case 5:
            $str="Unable to find a temporary folder";
            break;
        case 6:
            $str="File write failure";
            break;
    }
    die($str);
    }
    //Determine the permitted size of the file
    if ($_FILES['file']['size'] > (pow(1024,2)*2)){ //(pow(1024,2)*2) == 2M
        die('The size of the file exceeds the permitted size');
    }
    //Determine the permitted MIME type, file extension
    $allowMime = ['image/png','image/jpeg','image/gif','image/jpg'];
    $allowFix = ['png','jpeg','gif','jpg'];

    $info = pathinfo($_FILES['file']['name']);
    $subFix = $info['extension'];
    if(!in_array($subFix,$allowFix)){
        die('Inallowed file suffix');
    }
    if(!in_array($_FILES['file']['type'],$allowMime)){
        die('Inallowed MIME type');
    }

    //Stitching the path to upload
    $path = "../assets/img/avatars/";
    if (!file_exists($path)){
        mkdir($path);
    }
    //File name random
    $name = uniqid().'.'.$subFix;
    //Determine if the file is uploaded
    if (is_uploaded_file($_FILES['file']['tmp_name'])){
        if(move_uploaded_file($_FILES['file']['tmp_name'] , $path.$name)){
            $query = "UPDATE student SET avatar = '$name' WHERE username = '$username'";
            $result2 = mysqli_query($connection,$query);
            mysqli_free_result($result2);
            header('Location: profile.php?success=avatar');
        }else{
            die('上传失败');
        }
    }else{
        die('这不是上传文件.');
    }
}

//Change password
if(isset($_POST['submit2'])){
    if($_POST['username']==$username){
        $old_pass = $_POST['pass'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $query = "SELECT password FROM teacher WHERE username = '$username'";
        $pass = mysqli_fetch_array(mysqli_query($connection, $query));
        mysqli_free_result(mysqli_query($connection, $query));
        if($pass['password']==$old_pass && $pass1==$pass2){
            $query = "UPDATE student SET password = '$pass1' WHERE username = '$username'";
            $result2 = mysqli_query($connection, $query);
            mysqli_free_result($result2);
            header('Location: profile.php?success=password');
        } else {
            $error = "密码错误或两次输入的密码不同！";
        }
    } else {
        $error = "错误的用户名！";
    }
}

mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>个人信息 - 学生成绩管理系统</title>
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
                                    <img class="user-avatar" src="../assets/img/avatars/<?php echo $sname['avatar'];?>"><?php echo $sname['name'];?></a>
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
                    <li><a href="grade.php">成绩查询<i class="ec-archive2"></i></a>
                    </li>
                    <li><a href="course.php"><i class="en-login"></i>选课入口</a>
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
                        <h1 class="page-header"><i class="im-profile"></i>个人信息</h1>
                        <!-- Start .bredcrumb -->
                        <ul id="crumb" class="breadcrumb">
                        </ul>
                        <!-- End .breadcrumb -->
                        <!-- Start .option-buttons -->
                        <div class="option-buttons">
                            <div class="btn-toolbar" role="toolbar">
                                <div class="btn-group">
                                    <a id="clear-localstorage" class="btn tip" title="刷 新">
                                        <i class="ec-refresh s24"></i>
                                    </a>
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
                        <?php
                        if(isset($_GET['success'])) {
                            if($_GET['success']=="1"){
                                echo "<div class=\"alert alert-success fade in\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                    <i class=\"fa-ok alert-icon s24\"></i>
                                    <strong>完成！</strong> 成功地修改个人信息。
                                </div>";
                            }elseif($_GET['success']=="password"){
                                echo "<div class=\"alert alert-success fade in\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                    <i class=\"fa-ok alert-icon s24\"></i>
                                    <strong>完成！</strong> 成功地修改密码。
                                </div>";
                            }elseif($_GET['success']=="avatar"){
                                echo "<div class=\"alert alert-success fade in\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
                                    <i class=\"fa-ok alert-icon s24\"></i>
                                    <strong>完成！</strong> 成功地修改头像。
                                </div>";
                            }
                        }
                        ?>
                    </div>
                    <!-- End .page-header -->
                </div>
                <!-- End .row -->
                <div class="outlet">
                    <!-- Start .outlet -->
                    <!-- Page start here ( usual with .row ) -->
                    <div class="row">
                        <!-- Start .row -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <!-- col-lg-4 start here -->
                            <div class="panel panel-default plain profile-widget">
                                <!-- Start .panel -->
                                <div class="panel-heading white-bg pl0 pr0">
                                    <img class="profile-image img-responsive" src="../assets/img/profile-cover.jpg" alt="profile cover">
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="profile-avatar">
                                            <a  href="#avatar" data-toggle="modal" title="更改头像"><img class="img-responsive" src="../assets/img/avatars/<?php echo $sname['avatar'];?>" alt="用户头像"></a>
                                        </div>
                                        <!-- Modal itself -->
                                        <div class="modal fade" id="avatar" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="profile.php" method="post" enctype="multipart/form-data" role="form" class="form-horizontal group-border hover-stripped" id="validate">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title">更改头像</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label class="col-lg-3 control-label">选择文件</label>
                                                                <div class="col-lg-9">
                                                                    <input type="file" name="file" id="file" class="form-control" style="display:none">
                                                                </div>
                                                            </div><p></p>
                                                            <ul>
                                                                <li>文件大小应小于<b>2 MB.</b></li>
                                                                <li>允许的文件类型: <b>JPG, PNG, GIF.</b></li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
                                                            <button type="submit" class="btn btn-success start" name="submit1">
                                                                <i class="en-upload"></i>
                                                                <span> 提 交</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="profile-name">
                                            <?php echo $sname['name'];?> <span class="label label-success">学 生</span>
                                        </div>
                                        <div class="profile-quote">
                                            <p>伟大的事业不是靠力量而是靠毅力来完成的.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer white-bg">
                                    <ul class="profile-info">
                                        <li><i class="ec-user"></i><?php echo $sname['name'];?></li>
                                        <li><?php if($sname['gender']=="男"){echo " <i class=\"fa-male\"></i>&ensp;男";}else{echo " <i class=\"fa-female\"></i>&ensp;女";}?></li>
                                        <li><i class="im-point-right"></i><abbr title="学号"><?php echo $sname['student_id'];?></abbr></li>
                                        <li><i class="im-home3"></i><abbr title="班级号"><?php echo $sname['class_no'];?></abbr></li>
                                        <li><i class="fa-bitbucket"></i> <abbr title="专业"><?php echo $sname['mname'];?></abbr></li>
                                        <li><i class="im-office"></i><abbr title="学院"><?php echo $sname['aname'];?></abbr></li>
                                        <li><i class="fa-time"></i> <abbr title="入学日期"><?php echo $sname['enrolment'];?></abbr></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End .panel -->
                            <div class="panel panel-default plain">
                                <!-- Start .panel -->
                                <div class="panel-heading white-bg">
                                    <h4 class="panel-title">我的课程</h4>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="per10">
                                                    #
                                                </th>
                                                <th class="per30">课程编号</th>
                                                <th class="per30">课程名称</th>
                                                <th class="per30">学期</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i=1;
                                            while($row=mysqli_fetch_array($result)){
                                                echo "<tr>
                                                    <td>$i</td>
                                                    <td>".$row['course_no']."</td>
                                                    <td>".$row['name']."</td>
                                                    <td>".$row['semester']."</td>
                                                </tr>";
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- End .panel -->
                        </div>
                        <!-- col-lg-4 end here -->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <!-- col-lg-4 start here -->
                            <div class="panel panel-default plain">
                                <!-- Start .panel -->
                                <div class="panel-heading white-bg">
                                    <h4 class="panel-title"><i class="ec-user"></i>修改信息</h4>
                                </div>
                                <div class="panel-body">
                                    <form class="form-vertical hover-stripped" role="form" method="post" action="profile.php">
                                        <div class="form-group">
                                            <label class="control-label">姓名</label>
                                            <input type="text" class="form-control" value="<?php echo $sname['name'];?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">学号</label>
                                            <input type="text" class="form-control" value="<?php echo $sname['student_id'];?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">出生日期</label>
                                            <input type="text" class="form-control" name="dob" value="<?php echo $sname['dob'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">住址</label>
                                            <input type="text" class="form-control" name="address" value="<?php echo $sname['address'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">电话</label>
                                            <input type="text" class="form-control" name="phone" value="<?php echo $sname['phone'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">电子邮箱</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $sname['email'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">QQ</label>
                                            <input type="text" class="form-control" name="qq" value="<?php echo $sname['qq'];?>">
                                        </div>
                                        <!-- End .form-group  -->
                                        <div class="form-group"></div>
                                        <div class="form-group mb15">
                                            <a href="#basic_info" role="button" class="btn btn-primary" data-toggle="modal">修 改</a>
                                        </div>
                                        <!-- Modal itself -->
                                        <div class="modal fade" id="basic_info" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">警 告</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-muted">你确定要修改以下内容吗？</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
                                                        <button type="submit" name="submit" class="btn btn-primary">确 认</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                        <!-- End .form-group  -->
                                    </form>
                                </div>
                            </div>
                            <!-- End .panel -->
                            <div class="panel panel-default plain">
                                <div class="panel-heading white-bg">
                                    <h4 class="panel-title"><i class="im-lock"></i>修改密码</h4>
                                </div>
                                <div class="panel-body">
                                    <form class="form-vertical hover-stripped" role="form" method="post" action="profile.php">
                                        <div class="form-group">
                                            <label class="control-label">用户名</label>
                                            <input type="text" class="form-control" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">原密码</label>
                                            <input type="password" class="form-control" name="pass">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">新密码</label>
                                            <input type="password" class="form-control" name="pass1">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">重复密码</label>
                                            <input type="password" class="form-control" name="pass2">
                                        </div>
                                        <div class="form-group">
                                            <?php if(isset($error)){echo "<label class=\"control-label\"><p class='text-danger'><b>$error</b></p></label>";}?>
                                        </div>
                                        <div class="form-group mb15">
                                            <a href="#password" role="button" class="btn btn-primary" data-toggle="modal">修 改</a>
                                        </div>
                                        <!-- Modal itself -->
                                        <div class="modal fade" id="password" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title">警 告</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-muted">你确定要修改当前信息吗？</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">取 消</button>
                                                        <button type="submit" name="submit2" class="btn btn-primary">确 认</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->
                                    </form>
                                </div>
                            </div>
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
        <script src="../assets/plugins/forms/switch/jquery.onoff.min.js"></script>
        <script src="../assets/plugins/forms/maxlength/bootstrap-maxlength.js"></script>
        <script src="../assets/plugins/forms/bootstrap-filestyle/bootstrap-filestyle.js"></script>
        <script src="../assets/plugins/forms/color-picker/spectrum.js"></script>
        <script src="../assets/plugins/forms/daterangepicker/daterangepicker.js"></script>
        <script src="../assets/plugins/forms/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="../assets/plugins/forms/globalize/globalize.js"></script>
        <script src="../assets/plugins/forms/maskedinput/jquery.maskedinput.js"></script>
        <script src="../assets/plugins/forms/select2/select2.js"></script>
        <script src="../assets/plugins/forms/dual-list-box/jquery.bootstrap-duallistbox.js"></script>
        <script src="../assets/plugins/forms/password/jquery-passy.js"></script>
        <script src="../assets/plugins/forms/checkall/jquery.checkAll.js"></script>
        <script src="../assets/plugins/forms/validation/jquery.validate.js"></script>
        <script src="../assets/plugins/forms/validation/additional-methods.min.js"></script>
        <script src="../assets/plugins/misc/highlight/highlight.pack.js"></script>
        <script src="../assets/plugins/misc/countTo/jquery.countTo.js"></script>
        <script src="../assets/js/jquery.sprFlat.js"></script>
        <script src="../assets/js/app.js"></script>
        <script src="../assets/js/pages/form-validation.js"></script>
    </body>
</html>