<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "Vineland-II";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "vineland_ii_summary";

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
<br><br>

<div id="general">
<h2>VINELAND-II SCORE SUMMARY</h2>
<table id="subdomain_and_domain_scores" class="display" style="width:100%">
  <thead>
    <tr align="center"> SUBDOMAIN and DOMAIN SCORES</tr>
    <tr>
      <th>SUBDOMAIN/DOMAIN</th>
      <th>raw score</th>
      <th>v-Scale Score</th>
      <th>Domain Standard Score</th>
      <th>Confidence Interval</th>
      <th>Percentile Rank</th>
      <th>Adaptive Level</th>
      <th>Age Eqivalent</th>
    <tr>
  </thead>
  <tbody>
    <tr>
      <td align="right">Receptive</td>
      <td align="center"><input type="number" name="sub_receptive_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_receptive_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_receptive_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_receptive_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_receptive_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="right">Expressive</td>
      <td align="center"><input type="number" name="sub_expressive_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_expressive_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_expressive_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_expressive_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_expressive_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="right">Written</td>
      <td align="center"><input type="number" name="sub_written_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_written_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_written_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_written_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_written_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="left">Communication</td>
      <td align="center">Sum:</td>
      <td align="center">___</td>
      <td align="center"><input type="number" name="comm_standard" min="0" max="200"></td>
      <td align="center">+/-<input type="number" name="comm_conf_interval" min="0"></td>
      <td align="center"><input type="number" name="comm_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="sub_written_adaptive_level" min="0"></td>
      <td align="center">X</td>
    </tr>
    <tr>
      <td align="right">Personal</td>
      <td align="center"><input type="number" name="sub_personal_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_personal_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_personal_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_personal_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_personal_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="right">Domestic</td>
      <td align="center"><input type="number" name="sub_domestic_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_domestic_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_domestic_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_domestic_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_domestic_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="right">Community</td>
      <td align="center"><input type="number" name="sub_community_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_community_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_community_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_community_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_community_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="left">Daily Living Skills</td>
      <td align="center">Sum:</td>
      <td align="center">___</td>
      <td align="center"><input type="number" name="daily_life_standard" min="0" max="200"></td>
      <td align="center">+/-<input type="number" name="daily_life_conf_interval" min="0"></td>
      <td align="center"><input type="number" name="daily_life_percentile" min="0" max="100" ></td>
      <td align="center"><input type="number" name="daily_life_adaptive_level" min="0" ></td>
      <td align="center">X</td>
    </tr>
    <tr>
      <td align="right">Interpersonal Relationships</td>
      <td align="center"><input type="number" name="sub_relationships_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_relationships_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_relationships_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_relationships_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_relationships_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="right">Play and Leisure Time</td>
      <td align="center"><input type="number" name="sub_playLeisureTime_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_playLeisureTime_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_playLeisureTime_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_playLeisureTime_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_playLeisureTime_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="right">Coping Skills</td>
      <td align="center"><input type="number" name="sub_copingSkills_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_copingSkills_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_copingSkills_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_copingSkills_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_copingSkills_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="left">Socialization</td>
      <td align="center">Sum:</td>
      <td align="center">___</td>
      <td align="center"><input type="number" name="socialization_standard" min="0" max="200"></td>
      <td align="center">+/-<input type="number" name="socialization_conf_interval" min="0"></td>
      <td align="center"><input type="number" name="socialization_percentile" min="0" max="100" ></td>
      <td align="center"><input type="number" name="socialization_adaptive_level" min="0"></td>
      <td align="center">X</td>
    </tr>
    <tr>
      <td align="right">Gross</td>
      <td align="center"><input type="number" name="sub_gross_motor_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_gross_motor_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_gross_motor_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_gross_motor_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_gross_motor_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="right">Fine</td>
      <td align="center"><input type="number" name="sub_fine_motor_raw" min="0"></td>
      <td align="center"><input type="number" name="sub_fine_motor_vScale" min="0" max="30"></td>
      <td align="center">X</td>
      <td align="center">+/-<input type="number" name="sub_fine_motor_conf_interval" min="0"></td>
      <td align="center">X</td>
      <td align="center"><input type="number" name="sub_fine_motor_adaptive_level" min="0"></td>
      <td align="center"><input type="number" name="sub_fine_motor_age_equivalent" min="0"></td>
    </tr>
    <tr>
      <td align="left">Motor Skills</td>
      <td align="center">Sum:</td>
      <td align="center">___</td>
      <td align="center"><input type="number" name="motor_skills_standard" min="0" max="200" ></td>
      <td align="center">+/-<input type="number" name="motor_skills_conf_interval" min="0" ></td>
      <td align="center"><input type="number" name="motor_skills_percentile" min="0" max="100" ></td>
      <td align="center"><input type="number" name="motor_skills_adaptive_level" min="0"></td>
      <td align="center">X</td>
    </tr>
  </tbody>
</table>
<br><br>

<br>
<h3>Adaptive Behavior Composite</h3>
<table id="adaptive_behavior_composite">
  <thead>
    <tr align="center"> SUBDOMAIN and DOMAIN SCORES</tr>
    <tr>
      <th>Standard Score</th>
      <th>Confidence Interval</th>
      <th>Percentile Rank</th>
      <th>Adaptive Level</th>
    <tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="number" name="composite_standard" min="0" ></td>
      <td><input type="number" name="composite_conf_interval" min="0" ></td>
      <td><input type="number" name="composite_percentile" min="0" ></td>
      <td><input type="number" name="composite_adaptive_level" min="0" ></td>
    </tr>
  </tbody>
</table>

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
