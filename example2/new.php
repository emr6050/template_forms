<?php
/*
 * The page shown when the user requests a new form
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
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "SRS-2 AutoScore Form School-Age";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "example2";

formHeader("Form: ".$forn_name);

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

<!-- container for the main body of the form -->
<div id="form_container">

<div id="general">
<table>
<tr><td>
Assessment ID: <input id="assessment_id" name="assessment_id" type="text">
</td></tr>
<tr><td>
Gender:
<input type="radio" id="gender" name="gender" value="male">Male
<input type="radio" id="gender" name="gender" value="female">Female
</td></tr>
<tr><td>
Child's name: <input id="child_name" name="child_name" type="text" size="50" maxlength="250">
</td></tr>
<tr><td>
Child's age in years:<input name="child_age" id="child_age" type="text" size="4" maxlength="4">
</td></tr>
<tr><td>
Rater's name: <input name="rater_name" id="rater_name" type="text" size="50" maxlength="50">
</td></tr>
<tr><td>
Date of rating:
   <input type='text' size='10' class='datepicker' name='form_date' id='form_date'
    value='<?php echo date('Y-m-d', time()); ?>'
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
</td></tr>
<tr><td>
Relationship to rated individual:
<input type="radio" id="relation" name="relation" value="mother">Mother
<input type="radio" id="relation" name="relation" value="father">Father
<input type="radio" id="relation" name="relation" value="custodial">Other custodial adult
<input type="radio" id="relation" name="relation" value="teacher">Teacher
<input type="radio" id="relation" name="relation" value="others">Other specialist
</td></tr>
<tr><td>
Grade: <input name="grade" id="grade" type="text" size="3" maxlength="3">
</td></tr>
<tr><td>
School or clinic: <input name="school_or_clinic" id="school_or_clinic" type="text" size="75" maxlength="250">
</td></tr>
</table>
</div>

<br><br>

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
