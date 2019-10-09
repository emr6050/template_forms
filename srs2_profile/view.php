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
$table_name = "form_srs2_profile";

/** CHANGE THIS name to the name of your form **/
$form_name = "SRS-2 Profile";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "srs2_profile";

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

</head>

<body class="body_top">

<?php echo date("F d, Y", time()); ?>

<form method=post action="<?php echo $rootdir;?>/forms/<?php echo $form_folder; ?>/save.php?mode=update&id=<?php echo $_GET["id"];?>" name="my_form">
<span class="title"><?php xl($form_name, 'e'); ?></span><br>

<!-- Save/Cancel links -->
<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;

<!-- container for the main body of the form -->
<div id="form_container">
  <div id="general">
    <h3>Form Information</h3>
    Assessment Id: <input type='text' size='25' name='assessment_id' id='assessment_id' value='<?php echo stripslashes($record['assessment_id']);?>'/>
    <br><br>
    Assessment Age:
          <input type="radio" name="assessment_age" value="preschool" <?php if ($record["assessment_age"] == 'preschool') { echo "CHECKED"; } ?>>Preschool (ages 2 1/2 to 4 1/2) &nbsp;
          <input type="radio" name="assessment_age" value="school_age" <?php if ($record["assessment_age"] == 'school_age') { echo "CHECKED"; } ?>/>School-Age (ages 4 to 18) &nbsp; 
          <input type="radio" name="assessment_age" value="adult" <?php if ($record["assessment_age"] == 'adult') { echo "CHECKED"; } ?>/>Adult (ages 19+)
    <br><br>
    Rater Name: <input type='text' size='50' name='rater_name' id='rater_name' value='<?php echo stripslashes($record['rater_name']);?>'/>
    <br><br>
    Rater Relationship:
          <input type="radio" name="rater_relationship" value="mother" <?php if ($record["rater_relationship"] == 'mother') { echo "CHECKED"; } ?>/>Mother &nbsp;
          <input type="radio" name="rater_relationship" value="father" <?php if ($record["rater_relationship"] == 'father') { echo "CHECKED"; } ?>/>Father &nbsp;
          <input type="radio" name="rater_relationship" value="other_custodial_adult" <?php if ($record["rater_relationship"] == 'other_custodial_adult') { echo "CHECKED"; } ?>/>Other Custodial Adult &nbsp;
          <input type="radio" name="rater_relationship" value="teacher" <?php if ($record["rater_relationship"] == 'teacher') { echo "CHECKED"; } ?>/>Teacher &nbsp;
          <input type="radio" name="rater_relationship" value="other_specialist" <?php if ($record["rater_relationship"] == 'other_specialist') { echo "CHECKED"; } ?>/>Other Specialist
    <br><br>
    Facility: <input type='text' size='50' name='facility' id='facility' value='<?php echo stripslashes($record['facility']);?>'/>
    <br><br>
    Date:
      <input type='text' size='10' class='datepicker' name='form_date' id='form_date' value='<?php echo stripslashes($record['form_date']);?>' title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
  </div>
  
  <div id="scores">
    <h4>SRS-2 Total Score Results</h4>
    SRS-2 Total Raw score: <input type='text' name='srs2_total_raw_score' id='srs2_total_raw_score' value='<?php echo stripslashes($record['srs2_total_raw_score']);?>'/>
    <br><br>
    SRS-2 T-score: <input type='text' name='srs2_t_score' id='srs2_t_score' value='<?php echo stripslashes($record['srs2_t_score']);?>'/>
    <br><br>
    <h4>DSM-5 Compatible Scales</h4>
    DSM-5 SCI Raw score: <input type='text' name='dsm5_sci_raw_score' id='dsm5_sci_raw_score' value='<?php echo stripslashes($record['dsm5_sci_raw_score']);?>'/>
    <br><br>
    DSM-5 SCI T-score: <input type='text' name='dsm5_sci_t_score' id='dsm5_sci_t_score' value='<?php echo stripslashes($record['dsm5_sci_t_score']);?>'/>
    <br><br>
    DSM-5 RRB Raw score: <input type='text' name='dsm5_rrb_raw_score' id='dsm5_rrb_raw_score' value='<?php echo stripslashes($record['dsm5_rrb_raw_score']);?>'/>
    <br><br>
    DSM-5 RRB T-score: <input type='text' name='dsm5_rrb_t_score' id='dsm5_rrb_t_score' value='<?php echo stripslashes($record['dsm5_rrb_t_score']);?>'/>
    <br><br>
    <h4>Treatment Subscales</h4>
    Awr Raw score: <input type='text' name='subscale_awr_raw_score' id='subscale_awr_raw_score' value='<?php echo stripslashes($record['subscale_awr_raw_score']);?>'/>
    <br><br>
    Awr T-score: <input type='text' name='subscale_awr_t_score' id='subscale_awr_t_score' value='<?php echo stripslashes($record['subscale_awr_t_score']);?>'/>
    <br><br>
    Cog Raw score: <input type='text' name='subscale_cog_raw_score' id='subscale_cog_raw_score' value='<?php echo stripslashes($record['subscale_cog_raw_score']);?>'/>
    <br><br>
    Cog T-score: <input type='text' name='subscale_cog_t_score' id='subscale_cog_t_score' value='<?php echo stripslashes($record['subscale_cog_t_score']);?>'/>
    <br><br>
    Com Raw score: <input type='text' name='subscale_com_raw_score' id='subscale_com_raw_score' value='<?php echo stripslashes($record['subscale_com_raw_score']);?>'/>
    <br><br>
    Com T-score: <input type='text' name='subscale_com_t_score' id='subscale_com_t_score' value='<?php echo stripslashes($record['subscale_com_t_score']);?>'/>
    <br><br>
    Mot Raw score: <input type='text' name='subscale_mot_raw_score' id='subscale_mot_raw_score' value='<?php echo stripslashes($record['subscale_mot_raw_score']);?>'/>
    <br><br>
    Mot T-score: <input type='text' name='subscale_mot_t_score' id='subscale_mot_t_score' value='<?php echo stripslashes($record['subscale_mot_t_score']);?>'/>
    <br><br>
    RRB Raw score: <input type='text' name='subscale_rrb_raw_score' id='subscale_rrb_raw_score' value='<?php echo stripslashes($record['subscale_rrb_raw_score']);?>'/>
    <br><br>
    RRB T-score: <input type='text' name='subscale_rrb_t_score' id='subscale_rrb_t_score' value='<?php echo stripslashes($record['subscale_rrb_t_score']);?>'/>
    <br><br>
  </div>

  <div id="extra">
    <h4>Notes</h4>
    <textarea name="notes" id="notes" cols="80" rows="4"><?php echo stripslashes($record['notes']);?></textarea>
    <br><br>
  </div>
</div> <!-- end form_container -->

<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;

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

</script>

</html>
