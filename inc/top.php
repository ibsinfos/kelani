
<div id="wrapper"> 
  
  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="index.php">Institute Management System</a> </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ($_SESSION['user_session']=='loged')?$_SESSION['username']: 'User'; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li> <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a> </li>
          <li> <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a> </li>
          <li> <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a> </li>
          <li class="divider"></li>
          <li> <a href="./logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out </a> </li>
        </ul>
      </li>
    </ul>
    
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
        <li class="active"> <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a> </li>
        <li> <a href="student_management.php"><i class="fa fa-fw fa-bar-chart-o"></i> Student Management</a> </li>
		<li> <a href="student_view.php"><i class="fa fa-fw fa-bar-chart-o"></i> Student View</a> </li>
        <li> <a href="students_attends.php"><i class="fa fa-fw fa-barcode"></i> Student Attendance </a> </li>
        <li> <a href="employee.php"><i class="fa fa-fw fa-bar-chart-o"></i> Employee Management</a> </li>
        <li> <a href="employee_attends.php"><i class="fa fa-fw fa-table"></i> Employee Attends</a> </li>
        <li> <a href="expences.php"><i class="fa fa-fw fa-table"></i> Expenses</a> </li>
        <li> <a href="javascript:;" data-toggle="collapse" data-target="#payment_list"><i class="fa fa-fw fa-cc-visa"></i> Payment <i class="fa fa-fw fa-caret-down"></i></a>
          <ul id="payment_list" class="collapse">
          	<li> <a href="student_payments.php"> Student Payment</a> </li>
            <li> <a href="lecture_payments.php"> Lecturer Payments</a> </li>
            <li> <a href="lecture_payment_view.php"> Lecturer Payments View</a> </li>
            <!--<li> <a href="employee_payments.php"> Employee Payment</a> </li>-->
          </ul>
        </li>
        <li> <a href="javascript:;" data-toggle="collapse" data-target="#admin_list"><i class="fa fa-fw fa-database"></i> Admin <i class="fa fa-fw fa-caret-down"></i></a>
          <ul id="admin_list" class="collapse">
            <li> <a href="course.php"> Course Management</a> </li>
            <li> <a href="subject.php"> Subject Management</a> </li>
            <li> <a href="course_subject.php"> Subject and Course Management</a> </li>
            <li> <a href="courseProcess.php"> Course Process</a> </li>
            <li> <a href="branch.php"> Branch</a> </li>
            <li> <a href="al_subject.php"> AL Subject</a> </li>
            <li> <a href="acadamicyear.php"> Acadamic Year</a> </li>
            <li> <a href="polling_divisions.php"> Polling Divisions</a> </li>
            <li> <a href="part.php"> Part</a> </li>
            <li> <a href="examcenter.php"> Exam&frasl;Seminar Center</a> </li>
            <li> <a href="designation.php"> Designation</a> </li>
          </ul>
        <li> <a href="javascript:;" data-toggle="collapse" data-target="#report_list"><i class="fa fa-fw fa-cc-visa"></i> Report <i class="fa fa-fw fa-caret-down"></i></a>
          <ul id="report_list" class="collapse">
          	<li> <a href="pnl.php"> Profit & Lost</a> </li>
            <!--<li> <a href="employee_payments.php"> Employee Payment</a> </li>-->
          </ul>
        </li>
        <li> <a href="javascript:;" data-toggle="collapse" data-target="#security_list"><i class="fa fa-fw fa-cc-visa"></i> Security <i class="fa fa-fw fa-caret-down"></i></a>
          <ul id="security_list" class="collapse">
          	<li> <a href="user.php"> User</a> </li>
            <li> <a href="userPrivileges.php"> User Privileges</a> </li>
            <li> <a href="userlevel.php"> User Level</a> </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </nav>
</div>
