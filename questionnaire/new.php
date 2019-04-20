<?php
/*
 //This is an attempt at creating the
 //REDIRECT Questionnaire Form
 //file made by Deborah Schleif 2019-04-18
 //deborah.schleif@marquette.edu
 
 //Much of this file is copied and modified from the "example 2" form:
 * @package   OpenEMR
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "REDIRECT Questionnaire";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "questionnaire";

formHeader("Form: ".$form_name);

$returnurl = 'encounter_top.php';
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

<!--//This line lets us get values from the patient data instead of entering it?/>

<?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>

<!-- container for the main body of the form -->
<div id="form_container">

<div id="general">
  <?php xl('Please answer the followinf=g questions about your child who is receiving screening today.','e');?>
  1) <?php xl('What is your relationship to the child or children being screened today?','e');?>
          <input type="radio" name="relationship" value="Mother" /><?php xl('Mother','e');?> 
		  <input type="radio" name="relationship" value="Father" /><?php xl('Father','e');?> <br>
		  <input type="radio" name="relationship" value="Grandparent" /><?php xl('Grandparent');?> 
		  <input type="radio" name="relationship" value="Aunt/Uncle/Cousin" /><?php xl('Aunt/Uncle/Cousin','e');?><br> 
		  <input type="radio" name="relationship" value="Legal Guardian" /><?php xl('Legal Guardian','e');?>			  
		  <input type="radio" name="relationship" value="Other" /><?php xl('Another relationship:','e');?> &nbsp;		  
          <input id="relationshp_other" name="relationshp_other" type="text" size="50" maxlength="250"><br>
  2) <?php xl('How old is your child who is being screened today?','e');?>
  3) <?php xl('What is the race and ethnicity of your child who is being screened today?','e');?>

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

