<?php
/*Agreement for Release of Information Form
 * Mostly copied from:
 * Sports Physical Form
 * @package   OpenEMR
 * @author    Jason Morrill
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 */


include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_info_release";

/** CHANGE THIS name to the name of your form **/
$form_name = "ECQuIP Information Release";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "info_release";

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
if ($record['psig_date'] != "") {
    $dateparts = explode(" ", $record['psig_date']);
    $record['psig_date'] = $dateparts[0];
}
if ($record['wsig_date'] != "") {
    $dateparts = explode(" ", $record['wsig_date']);
    $record['wsig_date'] = $dateparts[0];
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

<div id="general">
<?php xl ('I hereby agree: Milwaukee ECQuIP of Marquette University','e');?><br>
<input type="hidden" name="release_to" id="release_to" value="off">
<input type="checkbox" name="release_to" id="release_to" <?php if ($record["release_to"] == "on") {
	echo "checked";
	}?>>
<input type="hidden" name="obtain_from" id="obtain_from" value="off">
<label for "release_to"><?php xl('To release information to:', 'e'); ?></label>	<br>
<input type="checkbox" name="obtain_from" id="obtain_from" <?php if ($record["obtain_from"] == "on") {
	echo "checked";
	}?> >
<label for "obtain_from"><?php xl('To obtain information from:', 'e'); ?></label><br>
<?php xl('(Check one or both. By checking both, you are allowing an exchange of information between the agancies/individuals listed.)', 'e'); ?>
<br>
<?php xl('Agency and/or individual:', 'e'); ?>
<input id="info_to" name="info_to" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['info_to']);?>'/><br>
<?php xl('Street/City/State/Zip:', 'e'); ?>
<input id="info_addr" name="info_addr" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['info_addr']);?>'/><br>
<?php xl('From the records of:','e');?><br>
<?php xl('Client Name:', 'e'); ?>
<input id="name" name="name" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['name']);?>'/><br>
<?php xl('Date of Birth:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='dob' id='dob'
    value='<?php echo stripslashes($record['dob']);?>'
    title='<?php xl('yyyy-mm-dd Date of Birth', 'e'); ?>' /><br>
<?php xl('Other Names Used:', 'e'); ?>
<input id="other_name" name="other_name" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['other_name']);?>'/>
<br><?php xl('Purpose or need for sharing:', 'e'); ?>
<?php xl('(check all that apply)', 'e'); ?><br>
<input type="hidden" name="purpose_coord" id="purpose_coord" value="off">
<input type="checkbox" name="purpose_coord" <?php if ($record["purpose_coord"] == "on") {
	echo "checked";
	}?>>
<?php xl('Service coordination', 'e'); ?>
<input type="hidden" name="purpose_eval" id="purpose_eval" value="off">
<input type="checkbox" name="purpose_eval" <?php if ($record["purpose_eval"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Evaluation/Diagnosis', 'e'); ?>
<input type="hidden" name="purpose_treat" id="purpose_treat" value="off">
<input type="checkbox" name="purpose_treat" <?php if ($record["purpose_treat"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Treatment', 'e'); ?>
<br>
<input type="hidden" name="purpose_other" id="purpose_other" value="off">
<input type="checkbox" name="purpose_other" <?php if ($record["purpose_other"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Other:', 'e'); ?>
<input id="purpose_other_text" name="purpose_other_text" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['purpose_other_text']);?>'/>
<br><?php xl('Type of information to be shared:', 'e'); ?>
<?php xl('(check all that apply)', 'e'); ?><br>
<input type="hidden" name="type_developmental" id="type_developmental" value="off">
<input type="checkbox" name="type_developmental" <?php if ($record["type_developmental"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Developmental Disabilities', 'e'); ?>
<input type="hidden" name="type_medical" id="type_medical" value="off">
<input type="checkbox" name="type_medical" <?php if ($record["type_medical"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Medical', 'e'); ?>
<input type="hidden" name="type_hum_serv" id="type_hum_serv" value="off">
<input type="checkbox" name="type_hum_serv" <?php if ($record["type_hum_serv"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Human Services', 'e'); ?>
<input type="hidden" name="type_educational" id="type_educational" value="off">
<input type="checkbox" name="type_educational" <?php if ($record["type_educational"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Educational', 'e'); ?> <br>
<input type="hidden" name="type_other" id="type_other" value="off">
<input type="checkbox" name="type_other" <?php if ($record["type_other"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Other:', 'e'); ?>
<input id="type_other_text" name="type_other_text" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['type_other_text']);?>'><br>
<?php xl('Specific', 'e'); ?>
<?php xl(' information to be shared:', 'e'); ?>
<?php xl('(check all that apply)', 'e'); ?><br>
<input type="hidden" name="spec_monitor" id="spec_monitor" value="off">
<input type="checkbox" name="spec_monitor" <?php if ($record["spec_monitor"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Developmental Monitoring', 'e'); ?> <br>
<input type="hidden" name="spec_screen" id="spec_screen" value="off">
<input type="checkbox" name="spec_screen" <?php if ($record["spec_screen"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Developmental Screenings', 'e'); ?> <br>
<input type="hidden" name="spec_intake" id="spec_intake" value="off">
<input type="checkbox" name="spec_intake" <?php if ($record["spec_intake"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Intake Summary', 'e'); ?> <br>
<input type="hidden" name="spec_other" id="spec_other" value="off">
<input type="checkbox" name="spec_other" <?php if ($record["spec_other"] == "on") {
	echo "checked";
	}?>/>
<?php xl('Other:', 'e'); ?>
<input id="spec_other_text" name="spec_other_text" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['spec_other_text']);?>'>
<br>I understand that: <br>
(a) The information released is confidential and protected from further sharing <br>
(b) I have the right to cancel my agreement to release information at any time. <br>
(c) I am not required to sign this form and may refuse to do so. <br><br>
I hereby authorize the periodic release of the above information to the 
person/organization/facility/program identified above as often as necessary 
to plan for, provide care, services and treatment.
This consent (unless cancelled earlier) expires on date:
   <input type='text' size='10' class='datepicker' name='form_date' id='form_date'
    value='<?php echo stripslashes($record['form_date']);?>' title='<?php xl('yyyy-mm-dd', 'e'); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
<?php xl(', one year from the date signed, or 60 days ', 'e'); ?>
following my discharge or withdrawl from services, whichever occurs first.
</div>

<div id="bottom">
<div style="text-align:right;">
Signatures:  Yes/No means did they sign the paper version?
<br>
Client Signature:
<input type="radio" id="sig" name="sig" value="y" <?php if ($record["sig"] == "y") {
	echo "checked";
	}?>>Yes
/
<input type="radio" id="sig" name="sig" value="n" <?php if ($record["sig"] == "n") {
	echo "checked";
	}?>>No
&nbsp;&nbsp;
<?php xl('Date:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='sig_date' id='sig_date'
    value='<?php echo stripslashes($record['sig_date']);?>' title='<?php xl('yyyy-mm-dd', 'e'); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
<br>
Parent or Guardian:
<input type="radio" id="psig" name="psig" value="y" <?php if ($record["psig"] == "y") {
	echo "checked";
	}?>>Yes
/
<input type="radio" id="psig" name="psig" value="n" <?php if ($record["psig"] == "n") {
	echo "checked";
	}?>>No
&nbsp;&nbsp;
<?php xl('Date:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='psig_date' id='psig_date'
    value='<?php echo stripslashes($record['psig_date']);?>' title='<?php xl('yyyy-mm-dd', 'e'); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />	
<br>
Witness Signature:
    <input type="radio" id="wsig" name="wsig" value="y" <?php if ($record["wsig"] == "y") {
	echo "checked";
	}?>>Yes
    /
    <input type="radio" id="wsig" name="wsig" value="n" <?php if ($record["wsig"] == "n") {
	echo "checked";
	}?>>No
&nbsp;&nbsp;
<?php xl('Date:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='wsig_date' id='wsig_date'
    value='<?php echo stripslashes($record['wsig_date']);?>' title='<?php xl('yyyy-mm-dd', 'e'); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />		
</div>
</div>
<?php xl('PHOTOCOPY, FAX, OR ELECTRONIC IMAGE OF THIS CONSENT SHALL BE AS VALID AS THE ORIGINAL', 'e'); ?>
</div> <!-- end form_container -->

<input type="button" class="save" value="<?php xl('Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="dontsave" value="<?php xl('Don\'t Save Changes', 'e'); ?>"> &nbsp;
<input type="button" class="printform" value="<?php xl('Print', 'e'); ?>"> &nbsp;

</form>

</body>

<script language="javascript">
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
