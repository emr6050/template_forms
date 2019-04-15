<?php
/*
 //This is an attempt at creating the
 //Referral Form
 
 //Much of this file is copied and modified from:
 * @package   OpenEMR
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @link      http://www.open-emr.org
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "Referral Form";
/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "referral";

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
<!--//This line lets us get values from the patient data instead of entering it?/>

<?php $res = sqlStatement("SELECT fname,mname,lname,ss,street,city,state,postal_code,phone_home,DOB FROM patient_data WHERE pid = $pid");
$result = SqlFetchArray($res); ?>
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
Name of Person Completing Form: <input id="name_comp" name="name_comp" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Relationship to Family: <input id="relationship" name="relationship" type="text" size="50" maxlength="250">
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
Child Name: <input id="name_child" name="name_child" type="text" size="50" maxlength="250" value= <?php echo $result['fname'] . '&nbsp;' . $result['mname'] . '&nbsp;' . $result['lname'];?>>
</td></tr>

<tr><td>
Birthday:
   <input type='text' size='10' class='datepicker' name='date_birth' id='date_birth'
    value=<?php echo $result['DOB'];?> 
    title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
</td></tr>

<tr><td>
Screening/Monitoring/Evaluations Completed: <input id="Screen_comp" name="Screen_comp" type="text" size="50" maxlength="250" value="M-CHA-R">
</td></tr>

<tr><td>
Parent 1 Name: <input id="name_parent1" name="name_parent1" type="text" size="50" maxlength="250">
</td></tr>

<tr><td>
Parent 2 Name: <input id="name_parent2" name="name_parent2" type="text" size="50" maxlength="250">
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
Phone Number(s)for Contact 1<br>
<textarea name="pho_1" id="pho_1" cols="80" rows="4"></textarea
</td></tr>

<tr><td>
BestDay and Time for Contact 1 <br>
<textarea name="dat_time1" id="dat_time1" cols="80" rows="4"></textarea
</td></tr>

<tr><td>
Phone Number(s)for Contact 2<br>
<textarea name="pho_2" id="pho_2" cols="80" rows="4"></textarea
</td></tr>

<tr><td>
BestDay and Time for Contact 2 <br>
<textarea name="dat_time2" id="dat_time2" cols="80" rows="4"></textarea
</td></tr>

<tr><td>
Family Navigation: <input id="nav_family" name="nav_family" type="checkbox" >
</td></tr>

<tr><td>
Agency staff and/or parent's concern regarding child:
   <textarea  name='concern' id='concern'cols="80" rows="4"></textarea
</td></tr>

</div>
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

