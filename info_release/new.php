<?php
/*
 //This is an attempt at creating the
 //Milwaukee ECQuip Agreement for Release of Information
 //file made by Deborah Schleif 2019-03-16
 //deborah.schleif@marquette.edu
 
 //Much of this file is copied and modified from the "example 2" form:
 * @package   OpenEMR
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "Agreement for Release of Information";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "info_release";

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
<table>
<tr><td>
<?php xl ('I hereby agree: Milwaukee ECQuIP of Marquette University','e');?>
</td></tr>
<tr>
<td><input type="checkbox" name="release_to" ></input>
<?php xl('To release information to:', 'e'); ?>
<input type="checkbox" name="obtain_from" ></input>
<?php xl('To obtain information from:', 'e'); ?>
<br>
<?php xl('(Check one or both. By checking both, you are allowing an exchange of information between the agancies/individuals listed.)', 'e'); ?>
<br>
<?php xl('Agency and/or individual:', 'e'); ?>
<input id="info_to" name="info_to" type="text" size="50" maxlength="250"><br>
<?php xl('Street/City/State/Zip:', 'e'); ?>
<input id="info_addr" name="info_addr" type="text" size="50" maxlength="250"><br>
</td>
</tr>
<tr><td>
<?php xl('From the records of:','e');?><br>
<?php xl('Client Name:', 'e'); ?>
<input id="name" name="name" type="text" size="50" maxlength="250" value= <?php echo $result['fname'] . '&nbsp;' . $result['mname'] . '&nbsp;' . $result['lname'];?> ><br>
<?php xl('Date of Birth:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='dob' id='dob'
    value= <?php echo $result['DOB'];?> 
    title='<?php xl('yyyy-mm-dd Date of Birth', 'e'); ?>' /><br>
<?php xl('Other Names Used:', 'e'); ?>
<input id="other_name" name="other_name" type="text" size="50" maxlength="250">
</td></tr>
<tr><td>
<?php xl('Purpose or need for sharing:', 'e'); ?>
<?php xl('(check all that apply)', 'e'); ?><br>
<input type="checkbox" name="purpose_coord"></input>
<?php xl('Service coordination', 'e'); ?>
<input type="checkbox" name="purpose_eval"></input>
<?php xl('Evaluation/Diagnosis', 'e'); ?>
<input type="checkbox" name="purpose_treat"></input>
<?php xl('Treatment', 'e'); ?>
<br><input type="checkbox" name="purpose_other"></input>
<?php xl('Other:', 'e'); ?>
<input id="purpose_other_text" name="purpose_other_text" type="text" size="50" maxlength="250">
</td></tr>
<tr><td>
<?php xl('Type of information to be shared:', 'e'); ?>
<?php xl('(check all that apply)', 'e'); ?><br>
<input type="checkbox" name="type_developmental"></input>
<?php xl('Developmental Disabilities', 'e'); ?>
<input type="checkbox" name="type_medical"></input>
<?php xl('Medical', 'e'); ?>
<input type="checkbox" name="type_hum_serv"></input>
<?php xl('Human Services', 'e'); ?>
<input type="checkbox" name="type_educational"></input>
<?php xl('Educational', 'e'); ?> <br>
<input type="checkbox" name="type_other"></input>
<?php xl('Other:', 'e'); ?>
<input id="type_other_text" name="type_other_text" type="text" size="50" maxlength="250"><br>
<?php xl('Specific', 'e'); ?>
<?php xl(' information to be shared:', 'e'); ?>
<?php xl('(check all that apply)', 'e'); ?><br>
<input type="checkbox" name="spec_monitor"></input>
<?php xl('Developmental Monitoring', 'e'); ?> <br>
<input type="checkbox" name="spec_screen"></input>
<?php xl('Developmental Screenings', 'e'); ?> <br>
<input type="checkbox" name="spec_intake"></input>
<?php xl('Intake Summary', 'e'); ?> <br>
<input type="checkbox" name="spec_other"></input>
<?php xl('Other:', 'e'); ?>
<input id="spec_other_text" name="spec_other_text" type="text" size="50" maxlength="250">
</td></tr>
<tr><td>
I understand that: <br>
(a) The information released is confidential and protected from further sharing <br>
(b) I have the right to cancel my agreement to release information at any time. <br>
(c) I am not required to sign this form and may refuse to do so. <br><br>
I hereby authorize the periodic release of the above information to the 
person/organization/facility/program identified above as often as necessary 
to plan for, provide care, services and treatment.
</td></tr>
<tr><td>
This consent (unless cancelled earlier) expires on date:
   <input type='text' size='10' class='datepicker' name='form_date' id='form_date'
    value='<?php echo date('Y-m-d', strtotime('+1 year')); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
<?php xl(', one year from the date signed, or 60 days ', 'e'); ?>
following my discharge or withdrawl from services, whichever occurs first.
</td></tr>
</table>
</div>

<div id="bottom">
<div style="text-align:right;">
Signatures:  Yes/No means did they sign the paper version?
<br>
Client Signature:
<input type="radio" id="sig" name="sig" value="y">Yes
/
<input type="radio" id="sig" name="sig" value="n">No
&nbsp;&nbsp;
<?php xl('Date:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='sig_date' id='sig_date'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
<br>
Parent or Guardian:
<input type="radio" id="psig" name="psig" value="y">Yes
/
<input type="radio" id="psig" name="psig" value="n">No
&nbsp;&nbsp;
<?php xl('Date:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='psig_date' id='psig_date'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />	
<br>
Witness Signature:
<input type="radio" id="wsig" name="wsig" value="y">Yes
/
<input type="radio" id="wsig" name="wsig" value="n">No
&nbsp;&nbsp;
<?php xl('Date:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='wsig_date' id='wsig_date'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />		
</div>
</div>
<?php xl('PHOTOCOPY, FAX, OR ELECTRONIC IMAGE OF THIS CONSENT SHALL BE AS VALID AS THE ORIGINAL', 'e'); ?>
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

