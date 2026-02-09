<?php
include 'db.php';

/* SAFETY CHECK */
$roll_no = $_GET['roll_no'] ?? '';
if ($roll_no == '') {
    die('Roll number is required');
}

/* FULL SQL QUERY */
$sql = "
SELECT 
    s.roll_no, s.enrollment_no, s.name, s.father_name, s.mother_name,
    s.category, s.medium, s.college,
    c.course_name, c.part, c.exam_session,
    sub.subject_name, sub.max_marks, sub.min_marks,
    m.marks_1, m.marks_2, m.marks_3, m.marks_4, m.marks_5,
    m.subject_total, m.remarks,
    r.total_marks, r.result_status
FROM students s
JOIN student_courses sc ON sc.student_id = s.student_id
JOIN courses c ON c.course_id = sc.course_id
JOIN subjects sub ON sub.course_id = c.course_id
JOIN marks m ON m.subject_id = sub.subject_id AND m.student_id = s.student_id
LEFT JOIN results r ON r.student_id = s.student_id AND r.course_id = c.course_id
WHERE s.roll_no = :roll_no
ORDER BY sub.subject_id
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['roll_no' => $roll_no]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$data) die('No record found');

$student = $data[0];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="google-site-verification" content="Dedr6PlOLvhFyJkhabxs3tW6B8QuhApYEpnIC268L_I" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="description" content="The University of Rajasthan homepage allows you to find web resources at University of Rajasthan, Jaipur">
    <meta name="keywords" content=" India,Rajasthan,Jaipur, Pink city,University of Rajasthan, University Website, Syllabi,  Uniraj Home Page, Uniraj ERNET, Uniraj ac, Uniraj edu, Uniraj res,College, Affiliated College, Constituent College,Commerce College,Maharaja College, Maharani College,Rajasthan College, CCT, RAPIM, Law College, Five Year Law College, Hostels, Infonet, APTC, Health Center,Admission, Research,Syllabi, Academic Programme,Courses, Faculty">
    <meta name="provider" content="infonet@uniraj.ac.in">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <title>Invertis University</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" type="text/css">
    <link href="css/fontawesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="css/non-responsive.css">
    <link rel="stylesheet" href="css/megamenu.css" type="text/css" media="screen" /> 

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
<div id="main">
     <div id="wrapper"> 
    <div>
<link rel="stylesheet" href="css/all.css">

<div id="header">
     <div style="float:left;padding:0px;" >
          <img src="images/header-object.png" style="float:left">
          <!--<h1 style="float:left;padding:0px;text-align:center;color:darkblue;">राजस्थान विश्वविद्यालय</h1>
          <h1 style="float:left;padding:0px;text-align:center;color:orange;">University of Rajasthan</h1>-->
     </div>
     <div style="float:right;padding:0px;"> 
          <div id="toplink" align="right">     
              <ul class="fa-ul"> 
                  <li><a target="_self" class="first" href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span> Home</span></a></li> 
                  <li><a target="_blank" href="https://www.invertisuniversity.ac.in/"><i class="fa fa-globe" aria-hidden="true"></i><span> IU Website</span></a></li>  
                 <!--  <li><a target="_blank" href= "http://daak.uniraj.ac.in"><i class="fas fa-envelope" aria-hidden="true"></i><span> DAAK </span></a></li>      
                  <li><a target="_blank" href="http://www.uniraj.edu.in"><i class="fas fa-user-graduate" aria-hidden="true"></i><span> Student Portal</span></a></li>
                  <li><a target="_blank" href="http://earxiv.uniraj.ac.in/"><i class="fas fa-money-check" aria-hidden="true"></i><span> OnlinePayment</span></a></li> -->
              </ul>
          </div>
          <div>
                   </div>
</div>
</div>
          <div id="content">
             <div class="row">
                 <div class="col-3"><br \><div class="card">
    <!--<h4  class="card-header"></h4>-->
    <div class="card-body">
        <div class="accordion" id="ResultAccordion">
             <div class="accordion-item">
                 <h2 class="accordion-header" id="headingHome">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" 
                             aria-expanded="false" aria-controls="collapseFive">
                         <a target="_self" href="index1.php"><span class="glyphicon glyphicon-home" aria-hidden="true">Home (Old Result)</span></a>
                     </button>
                 </h2>
                 <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingHome" data-bs-parent="#ResultAccordion">
                       <div class="accordion-body"> 
                       </div>
                 </div>
             </div>
             <div class="accordion-item">
                 <h2 class="accordion-header" id="headingMain">
                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" 
                             aria-expanded="true" aria-controls="collapseOne">Main Examination <br \>(Old Result)</button>
                 </h2>
                 <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingMain" data-bs-parent="#ResultAccordion">
                       <div class="accordion-body">
          <div class="dropdown dropend">
                                 <a class="btn color1 dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" 
                                    data-bs-toggle="dropdown" aria-expanded="false"> Undergraduate </a>
                                 <!-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                     <li><a class="dropdown-item" href="?id=101">Arts</a></li>
                                     <li><a class="dropdown-item" href="?id=102">Commerce</a></li>
                                     <li><a class="dropdown-item" href="?id=103">Education</a></li>
                                     <li><a class="dropdown-item" href="?id=104">Engineering</a></li>
                                     <li><a class="dropdown-item" href="?id=105">Fine Arts</a></li>
                                     <li><a class="dropdown-item" href="?id=106">Law</a></li>
                                     <li><a class="dropdown-item" href="?id=107">Management</a></li>
                                     <li><a class="dropdown-item" href="?id=108">Medical & Pharmaceutics</a></li>
                                     <li><a class="dropdown-item" href="?id=109">Science</a></li>
                                 </ul> -->
                            </div>
                            <br \>
          <div class="dropdown dropend">
                                 <a class="btn color1 dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" 
                                    data-bs-toggle="dropdown" aria-expanded="false"> Postgraduate </a>
                                <!--   <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                     <li><a class="dropdown-item" href="?id=202">Commerce</a></li>
                                     <li><a class="dropdown-item" href="?id=203">Education</a></li>
                                     <li><a class="dropdown-item" href="?id=204">Engineering</a></li>
                                     <li><a class="dropdown-item" href="?id=205">Fine Arts</a></li>
                                     <li><a class="dropdown-item" href="?id=201">Humanities & Social Sciences</a></li>
                                     <li><a class="dropdown-item" href="?id=206">Law</a></li>
                                     <li><a class="dropdown-item" href="?id=207">Management</a></li>
                                     <li><a class="dropdown-item" href="?id=208">Medical & Pharmaceutics</a></li>
                                     <li><a class="dropdown-item" href="?id=09">Science</a></li>
                                 </ul> -->
                            </div>
                       </div>
                 </div>
             </div>
             <div class="accordion-item">
                 <h2 class="accordion-header" id="headingReval">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" 
                             aria-expanded="false" aria-controls="collapseTwo">Revaluation Result<br \>(Old Result)</button>
                 </h2>
                 <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingReval" data-bs-parent="#ResultAccordion">
                       <div class="accordion-body">
          <div class="dropdown dropend">
                                 <a class="btn color1 dropdown-toggle" href="#" role="button" id="dropdownMenuLink3" 
                                    data-bs-toggle="dropdown" aria-expanded="false"> Undergraduate </a>
                                <!--  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink3">
                                     <li><a class="dropdown-item" href="?id=301">Arts</a></li>
                                     <li><a class="dropdown-item" href="?id=302">Commerce</a></li>
                                     <li><a class="dropdown-item" href="?id=303">Education</a></li>
                                     <li><a class="dropdown-item" href="?id=304">Engineering</a></li>
                                     <li><a class="dropdown-item" href="?id=305">Fine Arts</a></li>
                                     <li><a class="dropdown-item" href="?id=306">Law</a></li>
                                     <li><a class="dropdown-item" href="?id=307">Management</a></li>
                                     <li><a class="dropdown-item" href="?id=308">Medical & Pharmaceutics</a></li>
                                     <li><a class="dropdown-item" href="?id=309">Science</a></li>
                                 </ul> -->
                            </div>
                            <br \>
          <div class="dropdown dropend">
                                 <a class="btn color1 dropdown-toggle" href="#" role="button" id="dropdownMenuLink4" 
                                    data-bs-toggle="dropdown" aria-expanded="false"> Postgraduate </a>
                                <!--  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink4">
                                     <li><a class="dropdown-item" href="#">Commerce</a></li>
                                     <li><a class="dropdown-item" href="?id=403">Education</a></li>
                                     <li><a class="dropdown-item" href="?id=404">Engineering</a></li>
                                     <li><a class="dropdown-item" href="?id=405">Fine Arts</a></li>
                                     <li><a class="dropdown-item" href="?id=401">Humanities & Social Sciences</a></li>
                                     <li><a class="dropdown-item" href="?id=406">Law</a></li>
                                     <li><a class="dropdown-item" href="?id=407">Management</a></li>
                                     <li><a class="dropdown-item" href="?id=408">Medical & Pharmaceutics</a></li>
                                     <li><a class="dropdown-item" href="?id=409">Science</a></li>
                                 </ul> -->
                            </div>
                       </div>
                 </div>
             </div>
             <!-- <div class="accordion-item">
                 <h2 class="accordion-header" id="headingScrutiny">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" 
                             aria-expanded="false" aria-controls="collapseThree">Scrutiny Result<br \>(Old Result)</button>
                 </h2>
                 <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingScrutiny" data-bs-parent="#ResultAccordion">
                       <div class="accordion-body"> 
          <a href="library/pdf/B.Sc-Part-3-2018(Scrutiny)-29sept2018.pdf" target="_blank" rel="noopener noreferrer">
                               B.Sc. Part-III Exam.-2018</a>
                       </div>
                 </div>
             </div> -->
             <div class="accordion-item">
                 <h2 class="accordion-header" id="headingOther">
                     <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" 
                             aria-expanded="false" aria-controls="collapseFour">
              <a target="_self" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true">Current Session Result</span></a>
                     </button>
                 </h2>
                 <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingOther" data-bs-parent="#ResultAccordion">
                       <div class="accordion-body">
                       </div>
                 </div>
             </div>

        </div>
    </div>
</div>
</div>
                 <div class="col-9">
              <br \>
 <style type="text/css">
    .bb td, .bb th {border-bottom: 1px solid black !important;}
</style>
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" />


    <div class="card">
        <a class="btn-sm  " href="#&quot;" onclick="window.print();return false;">Print</a> 
        <div class="card-body">
          <!-- startprint -->


            <a href="#" onclick="window.print();return false;">print this page</a>

            <table width="100%" border="1" color="black" cellpadding="0" cellspacing="0" background="library/marksheet1.jpg" class="print">

                <tbody><tr>
                    <td colspan="2"> 
                        <table width="100%" border="0" color="black" cellpadding="0" cellspacing="0">
                          <tbody><tr height="60">
                            <td width="10%" height="60" valign="top"><img src="./images/header-object.png" width="50" height="50" border="0"></td>
                            <td width="80%" height="60" align="center" valign="top"><font color="brown" size="+2"><strong>Invertis University </strong></font><strong><br><font size="+1"><?= htmlspecialchars($student['course_name']) ?> <?= htmlspecialchars($student['part']) ?> - <?= htmlspecialchars($student['exam_session']) ?></font></strong></td>      
                            <td width="10%" height="60"></td>
                          </tr>
                        </tbody></table>
                    </td>
                </tr>   
                <tr>
                    <td colspan="2">  
                        <table width="100%" border="0" color="black" cellpadding="0" cellspacing="0" frame="border">
                  <tbody><tr>
                    <td width="10%" height="5"><strong><font color="Navy" size="-1"></font></strong></td>
                    <td width="20%" height="5"><strong><font color="Navy" size="-1">Name</font></strong></td>
                    <td width="40%" height="5"><strong><font color="Navy" size="-1"><?= $student['name'] ?></font></strong></td>
                    <td width="10%" height="5"><strong><font color="Navy" size="-1">Roll No.</font></strong></td>
                    <td width="20%" height="5"><strong><font color="Navy" size="-1"><?= $student['roll_no'] ?></font></strong></td>
                  </tr>
                  <tr>
                    <td width="10%" height="5"><strong><font color="Navy" size="-1"></font></strong></td>
                    <td width="20%" height="5"><font color="Navy" size="-1">Father's Name:</font></td>
                    <td width="40%" height="5"><font color="Navy" size="-1"><?= $student['father_name'] ?></font></td>
                    <td width="10%" height="5"><font color="Navy" size="-1">E. No.</font></td>
                    <td width="20%" height="5"><font color="Navy" size="-1"><?= $student['enrollment_no'] ?></font></td>
                  </tr>
                  <tr>
                    <td width="10%" height="5"><strong><font color="Navy" size="-1"></font></strong></td>
                    <td width="20%" height="5"><font color="Navy" size="-1">Mother's Name:</font></td>
                    <td width="40%" height="5"><font color="Navy" size="-1"><?= $student['mother_name'] ?></font></td>
                    <td width="10%" height="5"><font color="Navy" size="-1">Category</font></td>
                    <td width="20%" height="5"><font color="Navy" size="-1"><?= $student['category'] ?></font></td>
                   </tr>
                  <tr>
                    <td width="10%" height="5"><strong><font color="Navy" size="-1"></font></strong></td>
                    <td width="20%" height="5"><font color="Navy" size="-1">College/Deptt./Centre</font></td>
                    <td width="40%" height="5"><font color="Navy" size="-1"><?= $student['college'] ?></font></td>
                    <td width="10%" height="5"><font color="Navy" size="-1">Medium</font></td>
                    <td width="20%" height="5"><font color="Navy" size="-1"><?= $student['medium'] ?></font></td>
                    <td width="5%" height="5"><strong><font color="Navy" size="-1"></font></strong></td>
                  </tr>
                        </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td width="100%" height="">
                        <table width="100%" height="10" border="2" color="black" cellpadding="0" cellspacing="0" frame="border">
                            <tbody>
                               <tr>
                                  <td width="50%" height="5" align="center" valign="top" colspan="1" rowspan="2"> <font color="Navy" size="-2"><strong>Subject(s) offered </strong></font></td>
                                  <td width="5%" height="5" align="center" valign="top" colspan="1" rowspan="2"> <font color="Navy" size="-2"><strong>&nbsp;</strong></font></td>
                                  <td width="5%" height="5" align="center" valign="top" colspan="1" rowspan="2"> <font color="Navy" size="-2"><strong>Max. Marks</strong></font></td>
                                  <td width="5%" height="5" align="center" valign="top" colspan="1" rowspan="2"> <font color="Navy" size="-2"><strong>Min. Marks</strong></font></td>
                                  <td width="5%" height="5" align="center" valign="top" colspan="6" rowspan="1"><font color="Navy" size="-2"><strong>Marks Obtained </strong></font></td>
                                  <td rowspan="2" colspan="1" width="5%" height="5" align="center" valign="top"> <font color="Navy" size="-2"><strong>Remarks</strong></font></td>
            </tr>


                <tr>
                                  <td width="5%"><font color="Navy" size="-2"><strong>I</strong></font></td>
                                  <td width="5%"> <font color="Navy" size="-2"><strong>II</strong></font></td>
                                  <td width="5%"> <font color="Navy" size="-2"><strong>III</strong></font></td>
                                  <td width="5%"> <font color="Navy" size="-2"><strong>IV</strong></font></td>
                                  <td width="5%"> <font color="Navy" size="-2"><strong>V</strong></font></td>
                                  <td width="5%"><font color="Navy" size="-2"><strong>Subject Total</strong></font></td>
                </tr>

                 <tr>
                                    <td width="50%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1"><strong>&nbsp;<u>Compulsory Papers</u></strong></font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font> </td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font></td>
                                      <td width="5%" valign="top" style=" border-bottom: hidden"> <font color="Navy" size="-1">&nbsp;</font></td>
                 </tr>
        <?php foreach ($data as $row): ?>
           

                  <tr>
                                  <td width="50%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1"><?= $row['subject_name'] ?></font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;<?= $row['marks_1'] ?></font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;<?= $row['marks_2'] ?></font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;<?= $row['marks_3'] ?></font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;<?= $row['marks_4'] ?></font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;<?= $row['marks_5'] ?></font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;<?= $row['subject_total'] ?></font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                </tr>
        
        <?php endforeach; ?>
         <tr>
                                  <td width="50%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1"><strong>&nbsp;<u>Optional Papers</u></strong></font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                  <td width="5%" valign="top" style="border-top: hidden; border-bottom: hidden"><font color="Navy" size="-1">&nbsp;</font></td>
                                </tr>

        <tr>
                                  <td width="85%" colspan="9"><font color="Navy" size="-1">Total Marks Obtained excluding compulsory and backlog paper/subject(s) marks</font></td>
                                  <td width="10%"><font color="Navy" size="-1">&nbsp;<?= $student['total_marks'] ?></font></td>
                                  <td width="5%">&nbsp;<?= $student['result_status'] ?></td>
                                </tr>
       
        </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="1" width="100%">
                          <tbody>
                              <tr>
                              <td rowspan="1" colspan="6"><strong><font size="-1">Disclaimer Notice &amp;  Legal Warning:</font></strong><font color="black" size="-1">In case of any discrepancy,marksheet issued by University of Rajasthan should be considered as authentic</font></td>
                            </tr>
                          </tbody>
                        </table> 
                    </td>
                </tr>
            </tbody></table>

        </div>
       <div class="card "><center><a class="btn btn-primary  justify-content-center m-auto" href="#&quot;" onclick="window.print();return false;">Print</a></center></div>
    </div>

        
              </div>
                  
              </div>
          </div>
          <div id="footer">





<p align="center">
    <a target="_self" class="first" href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a> | 
    <a target="_blank" href="https://www.invertisuniversity.ac.in/"><i class="fa fa-globe" aria-hidden="true"></i><span> IU Website</span></a> | 
  <!--   <a target="_blank" href= "http://daak.uniraj.ac.in"><i class="fas fa-envelope" aria-hidden="true"></i><span> Daak </span></a> | 
    <a target="_blank" href="http://wwww.uniraj.edu.in/"><i class="fas fa-user-graduate " aria-hidden="true"></i><span> Student Portal</span></a> | 
    <a target="_blank" href="http://earxiv.uniraj.ac.in"><i class="fas fa-money-check" aria-hidden="true"></i><span> Online Payment</span></a> |  -->


    
 </p>
 
 
 
 <!--
<div align=center>Visitor No. : <a href='#'><img src='https://www.counter12.com/img-0CdB86x1Zy01913W-6.gif' border='0' alt='free counter'></a><script type='text/javascript' src='https://www.counter12.com/ad.js?id=0CdB86x1Zy01913W'></script></div>-->
 <p align="center">Copyright © 2021. All Rights Reserved.</p>
 <p align="center">A site designed and maintained by  INFONET CENTER, Invertis University,Bareilly -  Uttar Pradesh<br/>Site best viewed in Google Chrome (version 90.0.4 and above) and Mozilla Firefox (version 88.0.2 and above)  in 1366x768 resolution</p>

</div>     
     </div>
</div>


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap5.min.js"></script>



    <script type="text/javascript" src="js/jquery.jclock.min.js"></script>


    <script type="text/javascript">
        $(function($) { var options = {format: '%I:%M:%S %p',utc: true,utc_offset: 5.5,fontFamily: 'Verdana, Times New Roman',
                                       fontSize: '18px',foreground: '#002f2f'}; 
        $('.jclock').jclock(options);});
    </script>

    <script>  
  $(document).ready(function() {
        $('#ResultList').DataTable({
            "paging":   true,
            "ordering": false,
            "info":     true,
                  "autoWidth": false,
                  "searching": false,
                  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                  "pagingType": "full_numbers"
                 });
  } );
    </script>
</body>
</html>
