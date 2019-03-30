<?php
/* 
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
$table_name = "form_referral";

/** CHANGE THIS name to the name of your form **/
$form_name = "ECQuIP Referral";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "referral_form";

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
Name of Person Completing Form: <input id="name_comp" name="name_comp" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Relationship to Family: <input id="relation" name="relation" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Contact Information: <input id="inf_cont" name="inf_cont" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Date Completed:
   <input type='text' size='10' class='datepicker' name='date_compl' id='date_compl'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
</td></tr>

<tr><td>
Child Name: <input id="name_child" name="name_child" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Birthday:
   <input type='text' size='10' class='datepicker' name='date_birth' id='date_birth'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
</td></tr>

<tr><td>
Screening/Monitoring/Evaluations Completed M-CHA-R: <input id="Screen_comp" name="Screen_comp" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Parent Name: <input id="name_parent1" name="name_parent1" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Parent Name: <input id="name_parent2" name="name_parent2" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Street Address, City/State/Zip Code <br>
<textarea name="address1" id="address1" cols="80" rows="4"></textarea
</td></tr>

<tr><td>
Street Address, City/State/Zip Code <br>
<textarea name="address2" id="address2" cols="80" rows="4"></textarea
</td></tr>

<tr><td>
Phone Number(s)BestDay&Time for Contact <br>
<textarea name="pho_dat_time1" id="pho_dat_time1" cols="80" rows="4"></textarea
</td></tr>

<tr><td>
Phone Number(s)BestDay&Time for Contact <br>
<textarea name="pho_dat_time2" id="pho_dat_time2" cols="80" rows="4"></textarea
</td></tr>

<tr><td>
Family Navigation: <input id="nav_family" name="nav_family" type="checkbox" >
</td></tr>

<tr><td>
Agency staff and/or parent's concern regarding child:
   <input type='text' size='10' class='datepicker' name='concern' id='concern'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
</td></tr>

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
