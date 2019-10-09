<?php
/*
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

$form_name = "School Readiness Assessment";
$form_folder = "sra3";

formHeader("Form: ".$form_name);
$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);

$res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB,sex,guardiansname,guardianphone,race,ethnicity
FROM patient_data WHERE pid = $pid");
$patientInfo = SqlFetchArray($res);

?>

<html>
<head>
  <?php html_header_show();?>

  <!-- other supporting javascript code -->
  <script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
  <script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js?v=<?php echo $v_js_includes; ?>"></script>
  <script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.full.min.js"></script>

  <!-- page styles -->
  <link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
  <link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css?v=<?php echo $v_js_includes; ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-datetimepicker-2-5-4/build/jquery.datetimepicker.min.css">

  <script language="JavaScript">
    // this line is to assist the calendar text boxes
    var mypcc = '<?php echo $GLOBALS['phone_country_code'] ?>';
  </script>
</head>

<body class="body_top">

  <?php echo date("F d, Y", time()); ?>

  <form method=post action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=new" name="my_form">
  <span class="title"><?php xl($form_name, 'e'); ?></span><br>

  <!-- Save/Cancel buttons -->
  <input type="button" class="save" value="<?php xl('Save', 'e'); ?>"> &nbsp;
  <input type="button" class="dontsave" value="<?php xl('Don\'t Save', 'e'); ?>"> &nbsp;

  <!-- container for the main body of the form -->
  <div id="form_container">
    <div id="dates">
      Date of test: <input type='text' size='10' class='datepicker' name='test_date' id="test_date" value="<?php echo date("Y-m-j", time()); ?>" /> <br>
      Date of birth: 
        <input type='text' size='10' class='datepicker' name='child_dob' id='child_dob' value= <?php echo $patientInfo['DOB'];?> title='<?php xl('yyyy-mm-dd Date of Birth', 'e'); ?>' /><br>
    </div>

    <div id="scores">
      <h4>Score Summary</h4>
      <table id="total_scores" class="display" style="width:100%">
        <thead>
          <tr>
            <th align="center">Subtest</th>
            <th align="center">Raw Score</th>
            <th align="center">% Mastery</th>
            <th align="center">School Readiness Concepts to Target for Instruction/Remediation</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1 Colors</td>
            <td align="center"><input type="number" name="colors_raw" id="colors_raw" min="0" max="10" step="1" value="0"></td>
            <td align="center"><input type="number" name="colors_mastery" id="colors_mastery" min="0" max="100" step="1" value="0"></td>
            <td align="left"><textarea name="color_comments" id="color_comments" cols="50" rows="1"></textarea>
          </tr>
          <tr>
            <td>2 Letters</td>
            <td align="center"><input type="number" name="letters_raw" id="letters_raw" min="0" max="15" step="1" value="0"></td>
            <td align="center"><input type="number" name="letters_mastery" id="letters_mastery" min="0" max="100" step="1" value="0"></td>
            <td align="left"><textarea name="letters_comments" id="letters_comments" cols="50" rows="1"></textarea>
          </tr>
          <tr>
            <td>3 Numbers/Counting</td>
            <td align="center"><input type="number" name="numbers_raw" id="numbers_raw" min="0" max="18" step="1" value="0"></td>
            <td align="center"><input type="number" name="numbers_mastery" id="numbers_mastery" min="0" max="100" step="1" value="0"></td>
            <td align="left"><textarea name="numbers_comments" id="numbers_comments" cols="50" rows="1"></textarea>
          </tr>
          <tr>
            <td>4 Sizing/Comparisons</td>
            <td align="center"><input type="number" name="sizeCompare_raw" id="sizeCompare_raw" min="0" max="22" step="1" value="0"></td>
            <td align="center"><input type="number" name="sizeCompare_mastery" id="sizeCompare_mastery" min="0" max="100" step="1" value="0"></td>
            <td align="left"><textarea name="sizeCompare_comments" id="sizeCompare_comments" cols="50" rows="1"></textarea>
          </tr>
          <tr>
            <td>5 Shapes</td>
            <td align="center"><input type="number" name="shapes_raw" id="shapes_raw" min="0" max="20" step="1" value="0"></td>
            <td align="center"><input type="number" name="shapes_mastery" id="shapes_mastery" min="0" max="100" step="1" value="0"></td>
            <td align="left"><textarea name="shapes_comments" id="shapes_comments" cols="50" rows="1"></textarea>
          </tr>
        </tbody>
      </table>
      <table>
        <thead>
          <tr>
            <th> </th>
            <th align="center">Raw Score</th>
            <th align="center">% Mastery</th>
            <th align="center">Norms</th>
            <th align="center">Standard Score</th>
            <th align="center">Confidence Interval</th>
            <th align="center">Percentile Rank</th>
            <th align="center">Descriptive Classification</th>
            <th align="center">Concept Age Equivalent</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td> School Readiness Composite (SRC) </td>
            <td align="center"><input type="number" name="src_raw" id="src_raw" min="0" max="85" step="1" value="0"></td>
            <td align="center"><input type="number" name="src_mastery" id="src_mastery" min="0" max="100" step="1" value="0"></td>
            <td align="center"> N/L </td>
            <td align="center"><input type="number" name="src_standard" id="src_standard" min="0" max="100" step="1" value="0"></td>
            <td align="center">
              <input type="number" name="src_conf_lower" id="src_conf_lower" min="0" max="100" step="1" value="0"> 
              to
              <input type="number" name="src_conf_upper" id="src_conf_upper" min="0" max="100" step="1" value="0"> </td>
            <td align="center"> <input type="number" name="src_perc_rank" id="src_perc_rank" min="0" max="100" step="1" value="0"> </td>
            <td align="center"> <input type="text" name="src_desc_class" id="src_desc_class"> </td>
            <td align="center"> <input type="text" name="src_age_eq" id="src_age_eq"> </td>
          </tr>
        </tbody>
      </table>
    </div>


    <div id="extra">
      <h4>Notes</h4>
      <textarea name="notes" id="notes" cols="80" rows="4"></textarea>
      <br><br>
    </div>

  </div> <!-- end form_container -->

  <!-- Save/Cancel buttons -->
  <input type="button" class="save" value="<?php xl('Save', 'e'); ?>"> &nbsp;
  <input type="button" class="dontsave" value="<?php xl('Don\'t Save', 'e'); ?>"> &nbsp;
  </form>

</body>

<script language="javascript">

  // jQuery stuff to make the page a little easier to use
  $(document).ready(function(){
      $(".save").click(function() { top.restoreSession(); document.my_form.submit(); });
      $(".dontsave").click(function() { parent.closeTab(window.name, false); });

      $('.datepicker').datetimepicker({
          <?php $datetimepicker_timepicker = false; ?>
          <?php $datetimepicker_showseconds = false; ?>
          <?php $datetimepicker_formatInput = false; ?>
          <?php require($GLOBALS['srcdir'] . '/js/xl/jquery-datetimepicker-2-5-4.js.php'); ?>
          <?php // can add any additional javascript settings to datetimepicker here; need to prepend first setting with a comma ?>
      });
  });

  //var comm_score = document.getElementById("comm_score")

</script>

</html>
