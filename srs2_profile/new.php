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

/** CHANGE THIS name to the name of your form **/
$form_name = "SRS-2 Profile";
/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "srs2_profile";

formHeader("Form: ".$form_name);
$returnurl = 'encounter_top.php';
$formid = 0 + (isset($_GET['id']) ? $_GET['id'] : 0);
?>

<html><head>
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

  <div id="general">
    <h3>Form Information</h3>
    AssessmentId: <input type='text' size='10' name='assessment_id' id='assessment_id'/>
    <br><br>
    AssessmentAge:
          <input type="radio" name="assessment_age" value="preschool" />Preschool (ages 2 1/2 to 4 1/2) &nbsp;
          <input type="radio" name="assessment_age" value="school_age" />School-Age (ages 4 to 18) &nbsp;
          <input type="radio" name="assessment_age" value="adult" />Adult (ages 19+)
    <br><br>
    Rater Name: <input type='text' size='10' name='rater_name' id='rater_name'/>
    <br><br>
    Rater Relationship:
          <input type="radio" name="rater_relationship" value="mother" />Mother &nbsp;
          <input type="radio" name="rater_relationship" value="father" />Father &nbsp;
          <input type="radio" name="rater_relationship" value="other_custodial_adult" />Other Custodial Adult &nbsp;
          <input type="radio" name="rater_relationship" value="teacher" />Teacher &nbsp;
          <input type="radio" name="rater_relationship" value="other_specialist" />Other Specialist
    <br><br>
    Facility: <input type='text' size='10' name='facility' id='facility'/>
    <br><br>
    Date: <input type='text' size='10' class='datepicker' name='form_date' id='form_date' value='<?php echo date('Y-m-d', time());?>' title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
    <br><br>
  </div>

  <div id="scores">
    <h4>SRS-2 Total Score Results</h4>
    SRS-2 Total Raw score: <input type='text' name='srs2_total_raw_score' id='srs2_total_raw_score'/>
    <br><br>
    SRS-2 T-score: <input type='text' name='srs2_t_score' id='srs2_t_score'/>
    <br><br>
    <h4>DSM-5 Compatible Scales</h4>
    DSM-5 SCI Raw score: <input type='text' name='dsm5_sci_raw_score' id='dsm5_sci_raw_score'/>
    <br><br>
    DSM-5 SCI T-score: <input type='text' name='dsm5_sci_t_score' id='dsm5_sci_t_score'/>
    <br><br>
    DSM-5 RRB Raw score: <input type='text' name='dsm5_rrb_raw_score' id='dsm5_rrb_raw_score'/>
    <br><br>
    DSM-5 RRB T-score: <input type='text' name='dsm5_rrb_t_score' id='dsm5_rrb_t_score'/>
    <br><br>
    <h4>Treatment Subscales</h4>
    Awr Raw score: <input type='text' name='subscale_awr_raw_score' id='subscale_awr_raw_score'/>
    <br><br>
    Awr T-score: <input type='text' name='subscale_awr_t_score' id='subscale_awr_t_score'/>
    <br><br>
    Cog Raw score: <input type='text' name='subscale_cog_raw_score' id='subscale_cog_raw_score'/>
    <br><br>
    Cog T-score: <input type='text' name='subscale_cog_t_score' id='subscale_cog_t_score'/>
    <br><br>
    Com Raw score: <input type='text' name='subscale_com_raw_score' id='subscale_com_raw_score'/>
    <br><br>
    Com T-score: <input type='text' name='subscale_com_t_score' id='subscale_com_t_score'/>
    <br><br>
    Mot Raw score: <input type='text' name='subscale_mot_raw_score' id='subscale_mot_raw_score'/>
    <br><br>
    Mot T-score: <input type='text' name='subscale_mot_t_score' id='subscale_mot_t_score'/>
    <br><br>
    RRB Raw score: <input type='text' name='subscale_rrb_raw_score' id='subscale_rrb_raw_score'/>
    <br><br>
    RRB T-score: <input type='text' name='subscale_rrb_t_score' id='subscale_rrb_t_score'/>
    <br><br>
  </div>

  <div id="extra">
    <h4>Notes</h4>
    <textarea name="notes" id="notes" cols="80" rows="4"></textarea>
    <br><br>
  </div>

  <div id="score_discussion">
    <!-- could have a trigger to display the discussion section of the SRS-2 form -->
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
</script>

</html>

