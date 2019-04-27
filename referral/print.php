<?php
/*
 //This is an attempt at creating the
 //Referral Form
 
 //Much of this file is copied and modified from:
 * Sports Physical Form created by Jason Morrill: January 2009
 */

include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS - name of the database table associated with this form **/
$table_name = "form_referral";

/** CHANGE THIS name to the name of your form **/
$form_name = "Referral Form";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "referral";

formHeader("Form: ".$form_name);
$returnurl = 'encounter_top.php';

/* load the saved record */
$record = formFetch($table_name, $_GET["id"]);

/* remove the time-of-day from the date fields */
if ($record['form_date'] != "") {
    $dateparts = explode(" ", $record['form_date']);
    $record['form_date'] = $dateparts[0];
}
if ($record['date_compl'] != "") {
    $dateparts = explode(" ", $record['date_compl']);
    $record['date_compl'] = $dateparts[0];
}
if ($record['date_birth'] != "") {
    $dateparts = explode(" ", $record['date_birth']);
    $record['date_birth'] = $dateparts[0];
}
?>

<html><head>
<?php html_header_show();?>

<!-- supporting javascript code -->
<script type="text/javascript" src="<?php echo $GLOBALS['assets_static_relative']; ?>/jquery-min-3-1-1/index.js"></script>
<script type="text/javascript" src="<?php echo $GLOBALS['webroot'] ?>/library/textformat.js"></script>

<!-- page styles -->
<link rel="stylesheet" href="<?php echo $css_header;?>" type="text/css">
<link rel="stylesheet" href="../../forms/<?php echo $form_folder; ?>/style.css" type="text/css">

</head>

<body class="body_top">

Printed on <?php echo date("F d, Y", time()); ?>

<form method=post action="">
<table>
<tr>
<td>
<img src="MU-logo.jpg" alt="MU logo" style="width:120px;height:100px;">
</td>
<td>
<span class="title"><?php xl($form_name, 'e'); ?></span><br>
Autism Family Navigation<br>
Milwaukee Autism Project<br>
Referral Form For Birth-3 Programs<br>
</td>
<td>
<img src="MHA-logo.jpg" alt="MU logo"style="width:184px;height:75px;">
</td>
</tr>
</table>


<!-- container for the main body of the form -->
<div id="form_container">

<div id="general">


<?php xl('Name of Person Completing Form:', 'e'); ?>&nbsp;	
<input id="name_comp" name="name_comp" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['name_comp']);?>'><br>
<?php xl('Relationship to Family:', 'e'); ?>&nbsp;
<input id="relation" name="relation" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['relation']);?>'><br>
<?php xl('Contact Information:', 'e'); ?><br>
<textarea id="inf_cont" name="inf_cont" cols="80" rows="2"><?php echo stripslashes ($record['inf_cont']); ?></textarea><br>
<?php xl('Date Completed:', 'e'); ?>&nbsp;	
<input type='text' size='10' class='datepicker' name='date_compl' id='date_compl'
value=<?php echo $record['date_compl'];?> 
title='<?php xl('yyyy-mm-dd', 'e'); ?>' />
<?php xl('Child\'s Name: ', 'e'); ?>&nbsp;	
<input id="name_child" name="name_child" type="text" size="50" maxlength="250" value='<?php echo stripslashes($record['name_child']);?>'><br>
<?php xl('Child\'s Birthdate: ', 'e'); ?>&nbsp;	
<input type='text' size='10' class='datepicker' name='date_birth' id='date_birth'
value=<?php echo $record['date_birth'];?> 
title='<?php xl('yyyy-mm-dd', 'e'); ?>' />

<?php xl('Screening/Monitoring/Evaluations Completed: ', 'e'); ?>&nbsp;
<input id="Screen_comp" name="Screen_comp" type="text" list="screen_types" value='<?php echo stripslashes($record['Screen_comp']);?>' /><br>
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
<input id="name_parent1" name="name_parent1" type="text" size="45" maxlength="250"
value='<?php echo stripslashes($record['name_parent1']);?>'><br>
<?php xl('Parent 1 Address:', 'e'); ?><br>
<textarea name="address1" id="address1" cols="35" rows="3"><?php echo stripslashes ($record['address1']); ?></textarea><br>
<?php xl('Parent 1 Phone Number(s):', 'e'); ?><br>
<textarea name="pho1" id="pho1" cols="35" rows="2"><?php echo stripslashes ($record['pho1']); ?></textarea><br>
<?php xl('Best Day & Time for Contact 1:','e');?><br>
<textarea name="pho_dat_time1" id="pho_dat_time1" cols="35" rows="2"> <?php echo stripslashes ($record['pho_dat_time1']); ?></textarea><br>
</td>
<td>
<?php xl('Parent 2 Name:', 'e'); ?><br>
<input id="name_parent2" name="name_parent2" type="text" size="45" maxlength="250"
value='<?php echo stripslashes($record['name_parent2']);?>'><br>
<?php xl('Parent 2 Address:', 'e'); ?><br>
<textarea name="address2" id="address2" cols="35" rows="3"><?php echo stripslashes ($record['address2']); ?></textarea><br>
<?php xl('Parent 2 Phone Number(s):', 'e'); ?><br>
<textarea name="pho2" id="pho2" cols="35" rows="2"><?php echo stripslashes ($record['pho2']); ?></textarea><br>
<?php xl('Best Day & Time for Contact 2:','e');?><br>
<textarea name="pho_dat_time2" id="pho_dat_time2" cols="35" rows="2"><?php echo stripslashes ($record['pho_dat_time2']); ?></textarea><br>
</td>
</tr>
<span class="bold">
<?php xl('Which program(s) is the client interested in learning more about?', 'e'); ?>
</span><br>
<input type="hidden" name="nav_family" id="nav_family" value="off">
<input id="nav_family" name="nav_family" type="checkbox" <?php if ($record["nav_family"] == "on") {
	echo "checked";
	}?>>&nbsp;
<?php xl('Family Navigation:','e'); ?><br>
</table>

<?php xl('Agency staff and/or parent\'s concern regarding child:', 'e'); ?>
<textarea  name='concern' id='concern'cols="80" rows="4"><?php echo stripslashes ($record['concern']); ?></textarea>

 </div> <!-- end form_container -->

</form>
 Completed referrals should be e-mailed, faxed or mailed 
 <span class="bold"><br>along with a signed Consent for Release of Information </span>
  to Troney Small (ltroney.small@marquette.edu). Once a referral is received, it is reviewed by the Family Navigators 
 and a call is placed to the referent for more information and to schedule further contact. <br><br>


</body>
 604 North 16th Street, Schroeder Complex, Room 306A, PO BOx 1881, Milwaukee, WI 53201<br>
 Phone: 414-940-3276  414-228-3727 Fax: 414-276-3124
<script language="javascript">
window.print();
window.close();
</script>

</html>
