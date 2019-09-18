<?php
/*
 //This is an attempt at creating the
 //SRS-2 preschool assessment form
 
 //Much of this file is copied and modified from:
 * Sports Physical Form created by Jason Morrill: January 2009
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_asqse2";

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

if ($record['dob'] != "") {
    $dateparts = explode(" ", $record['dob']);
    $record['dob'] = $dateparts[0];
}

if ($record['sig_date'] != "") {
    $dateparts = explode(" ", $record['sig_date']);
    $record['sig_date'] = $dateparts[0];
}
?>
<!--//This line lets us get values from the patient data instead of entering it?/>

<?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>

<html><head>
<?php html_header_show();?>

<!-- supporting javascript code -->
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js"></script>

<!-- page styles -->
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css" type="text/css">

</head>

<body class="body_top">

Printed on <?php echo date("F d, Y", time()); ?>
Client's Name: <?php echo $result['fname'] . '&nbsp;' . $result['mname'] . '&nbsp;' . $result['lname'];?>
DOB: <?php echo $result['DOB'];?>

<form method=post action="">
<span class="title"><?php xl($form_name, 'e'); ?></span><br>

  <div id="form_container">
    <div id="preliminaryInfo">
      Was age adjusted for prematurity when selecting questionnaire?
      <input type="radio" name="ageAdjustment" value="y" /> Yes. &nbsp;
      <input type="radio" name="ageAdjustment" value="n" /> No.
    </div>

    <div id="scores">
      <h4>Score Totals</h4>
      <table id="total_scores" class="display" style="width:100%">
          <thead>
              <tr>
                  <th>Area</th>
                  <th align="left">Cutoff</th>
                  <th align="left">Total Score</th>
              </tr>
          </thead>
          <tbody>
            <tr>
              <td>Communication</td>
              <td><?php echo $communCutoff ?></td>
              <td align="center"><input type="number" name="communicationScore" min="0" max="60" step="5"></td>
            </tr>
            <tr>
              <td>Gross Motor</td>
              <td><?php echo $gMotorCutoff ?></td>
              <td align="center"><input type="number" name="grossMotorScore" min="0" max="60" step="5"></td>
            </tr>
            <tr>
              <td>Fine Motor</td>
              <td><?php echo $fMotorCutoff ?></td>
              <td align="center"><input type="number" name="fineMotorScore" min="0" max="60" step="5"></td>
            </tr>
            <tr>
              <td>Problem Solving</td>
              <td><?php echo $pSolveCutoff ?></td>
              <td align="center"><input type="number" name="problemSolvingScore" min="0" max="60" step="5"></td>
            </tr>
            <tr>
              <td>Personal-Social</td>
              <td><?php echo $perSocCutoff ?></td>
              <td align="center"><input type="number" name="personalSocialScore" min="0" max="60" step="5"></td>
            </tr>
          </tbody>
        </table>
    </div>

    <div id="text_responses">
      <h4>Overall Responses</h4>
      1. Requires followup? <input type="checkbox" name="response1"> &nbsp;
      Comments: <textarea name="comments1" cols="30" rows="1"></textarea>
      <br><br>
      2. Requires followup? <input type="checkbox" name="response2"> &nbsp;
      Comments: <textarea name="comments2" cols="30" rows="1"></textarea>
      <br><br>
      3. Requires followup? <input type="checkbox" name="response3"> &nbsp;
      Comments: <textarea name="comments3" cols="30" rows="1"></textarea>
      <br><br>
      4. Requires followup? <input type="checkbox" name="response4"> &nbsp;
      Comments: <textarea name="comments4" cols="30" rows="1"></textarea>
      <br><br>
      5. Requires followup? <input type="checkbox" name="response5"> &nbsp;
      Comments: <textarea name="comments5" cols="30" rows="1"></textarea>
      <br><br>
      6. Requires followup? <input type="checkbox" name="response6"> &nbsp;
      Comments: <textarea name="comments6" cols="30" rows="1"></textarea>
    </div>

    <div id="followup_action_taken">
      <h4>Follow-up Action Taken</h4>
      <input type="checkbox" name="shouldFollowup"> Provide activities and rescreen in <input type="number" name="followupDelay" min="0" max="4"> months.
      <br>
      <input type="checkbox" name="shareResults"> Share results with primary health care provider
      <br>
      <input type="checkbox" name="referForOptions"> Refer for: <input type="checkbox" name="referForHearing"> hearing, <input type="checkbox" name="referForVision"> vision, <input type="checkbox" name="referForBehavioral"> behavioral screening.
      <br>
      <input type="checkbox" name="referToCareProvider"> Refer to primary health care provider or other community agency (specify reason): <textarea name="reasonForReferral" cols="30" rows="1"></textarea>.
      <br>
      <input type="checkbox" name="referToEarlyIntervention"> Refer to early intervention/early childhood special education.
      <br>
      <input type="checkbox" name="noFurtherAction"> No further action taken at this time.
      <br>
      <input type="checkbox" name="other"> Other (specify): <textarea name="reasonForReferral" cols="30" rows="1"></textarea>.
    </div>

    <div id="extra">
      <h4>Notes</h4>
      <textarea name="notes" id="notes" cols="80" rows="4"></textarea>
      <br><br>
    </div>

  </div> <!-- end form_container -->

</form>

</body>

<script language="javascript">
window.print();
window.close();
</script>

</html>
