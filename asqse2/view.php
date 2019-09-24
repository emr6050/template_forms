<?php
/*
 //This is an attempt at creating the
 //SRS-2 assessment form
 
 //Much of this file is copied and modified from:
 * @package   OpenEMR
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 */


include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_asqse2_simple";

/** CHANGE THIS name to the name of your form **/
$form_name = "ASQ:SE-2";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "asqse2";

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

function PrintForm() {
    newwin = window.open("<?php echo "http://".$_SERVER['SERVER_NAME'].$rootdir."/forms/".$form_folder."/print.php?id=".$_GET["id"]; ?>","mywin");
}
</script>

</head>

<body class="body_top">

<?php echo date("F d, Y", time()); ?>

<form method=post action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=update&id=<?php echo $_GET["id"];?>" name="my_form">
<span class="title"><?php xl($form_name, 'e'); ?></span><br>

<!-- Save/Cancel links -->
<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="printform" value="<?php xl('Print', 'e'); ?>"> &nbsp;

<!-- container for the main body of the form -->
<div id="form_container">
    <div id="preliminaryInfo">
      Questionnaire interval: <?php echo stripslashes($record["quesInterval"]) ?> months.
      <br><br>
      Was age adjusted for prematurity when selecting questionnaire?
      <input type="radio" name="ageAdjustment" value="y" <?php if ($record["ageAdjustment"] == 'y') { echo "CHECKED"; } ?> /> Yes. &nbsp;
      <input type="radio" name="ageAdjustment" value="n" <?php if ($record["ageAdjustment"] == 'n') { echo "CHECKED"; } ?> /> No.
    </div>

    <div id="scores">
      <h4>Score Totals</h4>
      <table id="total_scores" class="display" style="width:100%">
          <thead>
              <tr>
                  <th>Area</th>
                  <th align="left">Score</th>
              </tr>
          </thead>
          <tbody>
            <tr>
              <td>Page 1</td>
              <td align="center"><input onblur="calcTotal()" type="number" name="score_page" id="score_page1" min="0" max="75" step="5" value="<?php echo stripslashes($record['score_page1']) ?>"></td>
            </tr>
            <tr>
              <td>Page 2</td>
              <td align="center"><input onblur="calcTotal()" type="number" name="score_page" id="score_page2" min="0" max="75" step="5" value="<?php echo stripslashes($record['score_page2']) ?>"></td>
            </tr>
            <tr>
              <td>Page 3</td>
              <td align="center"><input onblur="calcTotal()" type="number" name="score_page" id="score_page3" min="0" max="75" step="5" value="<?php echo stripslashes($record['score_page3']) ?>"></td>
            </tr>
            <tr>
              <td>Page 4</td>
              <td align="center"><input onblur="calcTotal()" type="number" name="score_page" id="score_page4" min="0" max="75" step="5" value="<?php echo stripslashes($record['score_page4']) ?>"></td>
            </tr>
            <tr>
              <td>Total</td>
              <td align="center"><input type="number" name="score_total" id="score_total" min="0" max="300" step="5" value="<?php echo stripslashes($record['score_total']) ?>"></td>
            </tr>
          </tbody>
        </table>
    </div>

    <div id="text_responses">
      <h4>Overall Responses</h4>
      1. Requires followup? <input type="checkbox" name="response1" <?php if ($record["response1"] == "on") { echo "checked";	}?> > &nbsp;
      Comments: <textarea name="comments1" cols="30" rows="1"><?php echo stripslashes($record['comments1']) ?></textarea>
      <br><br>
      2. Requires followup? <input type="checkbox" name="response2" <?php if ($record["response2"] == "on") { echo "checked";	}?> > &nbsp;
      Comments: <textarea name="comments2" cols="30" rows="1"><?php echo stripslashes($record['comments2']) ?></textarea>
      <br><br>
      3. Requires followup? <input type="checkbox" name="response3" <?php if ($record["response3"] == "on") { echo "checked";	}?> > &nbsp;
      Comments: <textarea name="comments3" cols="30" rows="1"><?php echo stripslashes($record['comments3']) ?></textarea>
    </div>

    <div id="followup_considerations">
      <h4>Follow-up Referral Considerations</h4>
      <input type="checkbox" name="f_consider_settingTime" <?php if($record['f_consider_settingTime'] == "on") {echo "checked";} ?> > Setting/time factors
      <br>
      <input type="checkbox" name="f_consider_devlopmental" <?php if($record['f_consider_devlopmental'] == "on") {echo "checked";} ?>> Developmental factors
      <br>
      <input type="checkbox" name="f_consider_health" <?php if($record['f_consider_health'] == "on") {echo "checked";} ?>> Health factors
      <br>
      <input type="checkbox" name="f_consider_familyCultural" <?php if($record['f_consider_familyCultural'] == "on") {echo "checked";} ?>> Family/cultural factors
      <br>
      <input type="checkbox" name="f_consider_parentConcerns" <?php if($record['f_consider_parentConcerns'] == "on") {echo "checked";} ?>> Parent concerns
    </div>

    <div id="followup_action_taken">
      <h4>Follow-up Action Taken</h4>
      <input type="checkbox" name="shouldFollowup" <?php if($record['shouldFollowup'] == "on") {echo "checked";} ?> > Provide activities and rescreen in <input type="number" name="followupDelay" min="0" max="4" value="<?php echo stripslashes($record['followupDelay']) ?>"> months.
      <br>
      <input type="checkbox" name="shareResults" <?php if($record['shareResults'] == "on") {echo "checked";} ?>> Share results with primary health care provider
      <br>
      <input type="checkbox" name="provideEduMat" <?php if($record['provideEduMat'] == "on") {echo "checked";} ?>> Provide parent education materials
      <br>
      <input type="checkbox" name="provideInfo" <?php if($record['provideInfo'] == "on") {echo "checked";} ?>> Provide information about available parenting classes or support groups
      <br>
      <input type="checkbox" name="repeatDiffCaregiver" <?php if($record['repeatDiffCaregiver'] == "on") {echo "checked";} ?>> Have another caregiver complete ASQ:SE-2. List caregiver here (e.g., grandparent, teacher):
      &nbsp;<textarea name="diffCaregiver" cols="30" rows="1"><?php echo stripslashes($record['diffCaregiver']) ?></textarea>.
      <br>
      <input type="checkbox" name="doDevelopScreen" <?php if($record['doDevelopScreen'] == "on") {echo "checked";} ?>> Administer developmental screening (e.g., ASQ-3)
      <br>
      <input type="checkbox" name="referToSpecialEd" <?php if($record['referToSpecialEd'] == "on") {echo "checked";} ?>> Refer to early intervention/early childhood special education
      <br>
      <input type="checkbox" name="referForEvaluation" <?php if($record['referForEvaluation'] == "on") {echo "checked";} ?>> Refer for social-emotional, behavioral, or mental health evaluation
      <br>
      <input type="checkbox" name="other" <?php if($record['other'] == "on") {echo "checked";} ?>> Other (specify): <textarea name="otherReasonForReferral" cols="30" rows="1"><?php echo stripslashes($record['otherReasonForReferral']) ?></textarea>.
    </div>

    <div id="extra">
      <h4>Notes</h4>
      <textarea name="notes" id="notes" cols="80" rows="4"><?php echo stripslashes($record['notes']) ?></textarea>
      <br><br>
    </div>

</div> <!-- end form_container -->

<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="printform" value="<?php xl('Print', 'e'); ?>"> &nbsp;

</form>

</body>

<script language="javascript">

// for calculating the total score based on the input scores from each page
function calcTotal(){
  var arr = document.getElementsByName('score_page');
  var tot=0;
  for(var i=0;i<arr.length;i++){
      if(parseInt(arr[i].value))
          tot += parseInt(arr[i].value);
  }
  document.getElementById('total').value = tot;
}

// jQuery stuff to make the page a little easier to use

$(document).ready(function(){
    $(".save").click(function() { top.restoreSession(); document.my_form.submit(); });
    $(".dontsave").click(function() { parent.closeTab(window.name, false); });
    $(".printform").click(function() { PrintForm(); });

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
