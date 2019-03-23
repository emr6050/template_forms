<?php
/*Agreement for Release of Information Form
 * Mostly copied from:
 * Sports Physical Form
 *
 * LICENSE: This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://opensource.org/licenses/gpl-license.php>.
 *
 * @package   OpenEMR
 * @author    Jason Morrill
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 */


include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "info_rela";

/** CHANGE THIS name to the name of your form **/
$form_name = "ECQuIP Information Release";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "info_rel";

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
<table>
<tr><td>
<?php xl ('I hereby agree: Milwaukee ECQuIP of Marquette University','e');?>
</td></tr>
<tr>
<td><input type="checkbox" name="release_to" /></input>
<?php xl('To release information to:', 'e'); ?>
<input type="checkbox" name="obtain_from" value='<?php echo stripslashes($record['obtain_from']);?>'/></input>
<?php xl('To obtain information from:', 'e'); ?>
<br>
<?php xl('(Check one or both. By checking both, you are allowing an exchange of information between the agancies/individuals listed.)', 'e'); ?>
<br>
<?php xl('Agency and/or individual:', 'e'); ?>
<input id="info_to" name="info_to" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['info_to']);?>'/><br>
<?php xl('Street/City/State/Zip:', 'e'); ?>
<input id="info_addr" name="info_addr" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['info_addr']);?>'/><br>
</td>
</tr>
<tr><td>
<?php xl('From the records of:','e');?><br>
<?php xl('Client Name:', 'e'); ?>
<input id="name" name="name" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['name']);?>'/><br>
<?php xl('Date of Birth:', 'e'); ?>
   <input type='text' size='10' class='datepicker' name='dob' id='dob'
    value='<?php echo stripslashes($record['dob']);?>'
    title='<?php xl('yyyy-mm-dd Date of Birth', 'e'); ?>' /><br>
<?php xl('Other Names Used:', 'e'); ?>
<input id="other_name" name="other_name" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['other_name']);?>'/>
</td></tr>
<tr><td>
<?php xl('Purpose or need for sharing:', 'e'); ?>
<?php xl('(check all that apply)', 'e'); ?><br>
<input type="checkbox" name="purpose_coord" value='<?php echo stripslashes($record['purpose_coord']);?>'/></input>
<?php xl('Service coordination', 'e'); ?>
<input type="checkbox" name="purpose_eval" value='<?php echo stripslashes($record['purpose_eval']);?>'/></input>
<?php xl('Evaluation/Diagnosis', 'e'); ?>
<input type="checkbox" name="purpose_treatment" value='<?php echo stripslashes($record['purpose_treatment']);?>'/></input>
<?php xl('Treatment', 'e'); ?>
<br><input type="checkbox" name="purpose_other" value='<?php echo stripslashes($record['purpose_other']);?>'/></input>
<?php xl('Other:', 'e'); ?>
<input id="purpose_other_text" name="purpose_other_text" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['purpose_other_text']);?>'/>
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
<input id="type_other_text" name="type_other_text" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['type_other_text']);?>'><br>
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
<input id="spec_other_text" name="spec_other_text" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['spec_other_text']);?>'>
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
