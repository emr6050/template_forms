<?php

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_sra2";

/** CHANGE THIS name to the name of your form **/
$form_name = "School Readiness Assessment";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "sra2";

formHeader("Form: ".$form_name);
$returnurl = 'encounter_top.php';

/* load the saved record */
$record = formFetch($table_name, $_GET["id"]);

/* remove the time-of-day from the date fields */
if ($record['form_date'] != "") {
    $dateparts = explode(" ", $record['form_date']);
    $record['form_date'] = $dateparts[0];
}
?>

<html><head>
<?php html_header_show();?>

<!-- supporting javascript code -->
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

<style>

table, th, td{
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}

</style>

</head>

<body class="body_top">

<?php echo date("F d, Y", time()); ?>

<form method=post action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=update&id=<?php echo $_GET["id"];?>" name="my_form">
<span class="title"><?php xl($form_name, 'e'); ?></span><br>

<!-- Save/Cancel links -->
<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;
<br><br>

<!-- container for the main body of the form -->
<div id="form_container">

  <div id="dates">
    Date of test: <input type='text' size='10' class='datepicker' name='test_date' id="test_date" value="<?php echo stripslashes($record["test_date"]); ?>" /> <br>
    Date of birth: 
      <input type='text' size='10' class='datepicker' name='child_dob' id='child_dob' value="<?php echo stripslashes($record["child_dob"]);?>" /><br>
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
          <td>Colors</td>
          <td align="center"><input type="number" name="colors_raw" id="colors_raw" min="0" max="10" step="1" value="<?php echo stripslashes($record["colors_raw"]);?>"></td>
          <td align="center"><input type="number" name="colors_mastery" id="colors_mastery" min="0" max="100" step="1" value="<?php echo stripslashes($record["colors_mastery"]);?>"></td>
          <td align="center"><textarea name="color_comments" id="color_comments"><?php echo stripslashes($record["color_comments"]);?></textarea>
        </tr>
        <tr>
          <td>Letters</td>
          <td align="center"><input type="number" name="letters_raw" id="letters_raw" min="0" max="15" step="1" value="<?php echo stripslashes($record["letters_raw"]);?>"></td>
          <td align="center"><input type="number" name="letters_mastery" id="letters_mastery" min="0" max="100" step="1" value="<?php echo stripslashes($record["letters_mastery"]);?>"></td>
          <td align="center"><textarea name="letters_comments" id="letters_comments"><?php echo stripslashes($record["letters_comments"]);?></textarea>
        </tr>
        <tr>
          <td>Numbers/Counting</td>
          <td align="center"><input type="number" name="numbers_raw" id="numbers_raw" min="0" max="18" step="1" value="<?php echo stripslashes($record["numbers_raw"]);?>"></td>
          <td align="center"><input type="number" name="numbers_mastery" id="numbers_mastery" min="0" max="100" step="1" value="<?php echo stripslashes($record["numbers_mastery"]);?>"></td>
          <td align="center"><textarea name="numbers_comments" id="numbers_comments"><?php echo stripslashes($record["numbers_comments"]);?></textarea>
        </tr>
        <tr>
          <td>Sizing/Comparisons</td>
          <td align="center"><input type="number" name="sizeCompare_raw" id="sizeCompare_raw" min="0" max="22" step="1" value="<?php echo stripslashes($record["sizeCompare_raw"]);?>"></td>
          <td align="center"><input type="number" name="sizeCompare_mastery" id="sizeCompare_mastery" min="0" max="100" step="1" value="<?php echo stripslashes($record["sizeCompare_mastery"]);?>"></td>
          <td align="center"><textarea name="sizeCompare_comments" id="sizeCompare_comments"><?php echo stripslashes($record["sizeCompare_comments"]);?></textarea>
        </tr>
        <tr>
          <td>Shapes</td>
          <td align="center"><input type="number" name="shapes_raw" id="shapes_raw" min="0" max="20" step="1" value="<?php echo stripslashes($record["shapes_raw"]);?>"></td>
          <td align="center"><input type="number" name="shapes_mastery" id="shapes_mastery" min="0" max="100" step="1" value="<?php echo stripslashes($record["shapes_mastery"]);?>"></td>
          <td align="center"><textarea name="shapes_comments" id="shapes_comments"><?php echo stripslashes($record["shapes_comments"]);?></textarea>
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
          <th align="center">Confidence Interval <br> (<input type="number" name="src_conf_level" id="src_conf_level" min="0" max="100" value="<?php echo stripslashes($record["src_conf_level"]);?>"> % Level)</th>
          <th align="center">Percentile Rank</th>
          <th align="center">Descriptive Classification</th>
          <th align="center">Concept Age Equivalent</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td> School Readiness Composite (SRC) </td>
          <td align="center"><input type="number" name="src_raw" id="src_raw" min="0" max="85" step="1" value="<?php echo stripslashes($record["src_raw"]);?>"></td>
          <td align="center"><input type="number" name="src_mastery" id="src_mastery" min="0" max="100" step="1" value="<?php echo stripslashes($record["src_mastery"]);?>"></td>
          <td align="center"> N/L </td>
          <td align="center"><input type="number" name="src_standard" id="src_standard" min="0" max="100" step="1" value="<?php echo stripslashes($record["src_standard"]);?>"></td>
          <td align="center">
            <input type="number" name="src_conf_lower" id="src_conf_lower" min="0" max="100" step="1" value="<?php echo stripslashes($record["src_conf_lower"]);?>"> 
            to
            <input type="number" name="src_conf_upper" id="src_conf_upper" min="0" max="100" step="1" value="<?php echo stripslashes($record["src_conf_upper"]);?>"> </td>
          <td align="center"> <input type="number" name="src_perc_rank" id="src_perc_rank" min="0" max="100" step="1" value="<?php echo stripslashes($record["src_perc_rank"]);?>"> </td>
          <td align="center"> <textarea name="src_desc_class" id="src_desc_class"><?php echo stripslashes($record["src_desc_class"]);?> </textarea> </td>
          <td align="center"> <textarea name="src_age_eq" id="src_age_eq" ><?php echo stripslashes($record["src_age_eq"]);?> </textarea> </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div id="extra">
    <h4>Notes</h4>
    <textarea name="notes" id="notes" cols="80" rows="4"><?php echo stripslashes($record["notes"]);?></textarea>
    <br><br>
  </div>

</div> <!-- end form_container -->

<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;

</form>

</body>

<script language="javascript">

// for calculating the total score based on the input scores from each page
function calcTotal(){
    var arr = [];
    arr.push(document.getElementsByName('score_page1')[0]);
    arr.push(document.getElementsByName('score_page2')[0]);
    arr.push(document.getElementsByName('score_page3')[0]);
    arr.push(document.getElementsByName('score_page4')[0]);
  var tot=0;
  for(var i=0;i<arr.length;i++){
      if(parseInt(arr[i].value))
          tot += parseInt(arr[i].value);
  }
  document.getElementById('score_total').value = tot;
}

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

</script>

</html>
