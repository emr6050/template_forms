<?php
/*
 //This is an attempt at creating the NSC Referral Form
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "NSC Referral Form";
/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "nextstep_referral";

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


<?php xl('Name of Person Completing Form:', 'e'); ?>&nbsp;	
<input id="name_comp" name="name_comp" type="text" size="50" maxlength="250"><br>
<?php xl('Relationship to Family:', 'e'); ?>&nbsp;
<input id="relation" name="relation" type="text" size="50" maxlength="250"><br>
<?php xl('Contact Information:', 'e'); ?><br>
<textarea id="inf_cont" name="inf_cont" cols="80" rows="2"></textarea><br>
<?php xl('Date Completed:', 'e'); ?>&nbsp;	
<input type='text' size='10' class='datepicker' name='date_compl' id='date_compl'
value='<?php echo date('Y-m-d', time()); ?>'
title='<?php xl('yyyy-mm-dd', 'e'); ?>' /><br>
<?php xl('Child\'s Name: ', 'e'); ?>&nbsp;	
<input id="name_child" name="name_child" type="text" size="50" maxlength="250" value= <?php echo $result['fname'] . '&nbsp;' . $result['mname'] . '&nbsp;' . $result['lname'];?>>
<?php xl('Child\'s Birthdate: ', 'e'); ?>&nbsp;	
<input type='text' size='10' class='datepicker' name='date_birth' id='date_birth'
value=<?php echo $result['DOB'];?> 
title='<?php xl('yyyy-mm-dd', 'e'); ?>' />

<?php xl('Screening/Monitoring/Evaluations Completed: ', 'e'); ?>&nbsp;
<input id="Screen_comp" name="Screen_comp" type="text" list="screen_types" /><br>
	  <datalist id = "screen_types"/>
        <option value = "" ></option>		
        <option value = "M-CHAT-R">M-CHAT-R</option>
      </datalist>
<br>
</div>

<table border="1">
<tr>
<td>
<?php xl('Parent 1 Name:', 'e'); ?><br>
<input id="name_parent1" name="name_parent1" type="text" size="45" maxlength="250"><br>
<?php xl('Parent 1 Address:', 'e'); ?><br>
<textarea name="address1" id="address1" cols="35" rows="3"></textarea><br>
<?php xl('Parent 1 Phone Number(s):', 'e'); ?><br>
<textarea name="pho1" id="pho1" cols="35" rows="2"></textarea><br>
<?php xl('Best Day & Time for Contact 1:','e');?><br>
<textarea name="pho_dat_time1" id="pho_dat_time1" cols="35" rows="2"></textarea><br>
</td>
<td>
<?php xl('Parent 2 Name:', 'e'); ?><br>
<input id="name_parent2" name="name_parent2" type="text" size="45" maxlength="250"><br>
<?php xl('Parent 2 Address:', 'e'); ?><br>
<textarea name="address2" id="address2" cols="35" rows="3"></textarea><br>
<?php xl('Parent 2 Phone Number(s):', 'e'); ?><br>
<textarea name="pho2" id="pho2" cols="35" rows="2"></textarea><br>
<?php xl('Best Day & Time for Contact 2:','e');?><br>
<textarea name="pho_dat_time2" id="pho_dat_time2" cols="35" rows="2"></textarea><br>
</td>
</tr>
<span class="bold"><?php xl('Which program(s) is the client interested in learning more about?', 'e'); ?></span><br>
<input id="nav_family" name="nav_family" type="checkbox" >&nbsp; <?php xl('Family Navigation','e'); ?><br>
<input id="devAsdAssess" name="devAsdAssess" type="checkbox" >&nbsp; <?php xl('Development/Autism Assessment','e'); ?><br>
<input id="childTherapy" name="childTherapy" type="checkbox" >&nbsp; <?php xl('Child Therapy','e'); ?><br>

</table>

<?php xl('Agency staff and/or parent\'s concern regarding child:', 'e'); ?>
<textarea  name='concern' id='concern'cols="80" rows="4"></textarea>


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

