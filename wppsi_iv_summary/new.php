<?php
include_once("../../globals.php");
include_once("$srcdir/api.inc");

/** CHANGE THIS name to the name of your form **/
$form_name = "WPPSI-IV";

/** CHANGE THIS to match the folder you created for this form **/
$form_folder = "wppsi_iv_summary";

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
<h1>Summary</h1>
<h2>Sum of Scaled Scores to Composite Score Conversion</h2>
<table id="convertSumOfScaledToComposite" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Scale</th>
      <th>Sum of Scaled Scores</th>
      <th>Composite Score</th>
      <th>Percentile Rank</th>
      <th>Confidence Interval</th>
    <tr>
  </thead>
  <tbody>
    <tr>
      <td align="left">Verbal Comprehension</td>
      <td align="center"><input type="number" name="vci_sumScaledScores" min="0"></td>
      <td align="center">VCI <input type="number" name="vci_composite" min="0"></td>
      <td align="center"><input type="number" name="vci_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="vci_confidence" min="90"></td>
    </tr>
    <tr>
      <td align="left">Visual Spatial</td>
      <td align="center"><input type="number" name="vsi_sumScaledScores" min="0"></td>
      <td align="center">VSI <input type="number" name="vsi_composite" min="0"></td>
      <td align="center"><input type="number" name="vsi_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="vsi_confidence" min="90"></td>
    </tr>
    <tr>
      <td align="left">Fluid Reasoning</td>
      <td align="center"><input type="number" name="fri_sumScaledScores" min="0"></td>
      <td align="center">FRI <input type="number" name="fri_composite" min="0"></td>
      <td align="center"><input type="number" name="fri_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="fri_confidence" min="90"></td>
    </tr>
    <tr>
      <td align="left">Working Memory</td>
      <td align="center"><input type="number" name="wmi_sumScaledScores" min="0"></td>
      <td align="center">WMI <input type="number" name="wmi_composite" min="0"></td>
      <td align="center"><input type="number" name="wmi_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="wmi_confidence" min="90"></td>
    </tr>
    <tr>
      <td align="left">Processing Speed</td>
      <td align="center"><input type="number" name="psi_sumScaledScores" min="0"></td>
      <td align="center">PSI <input type="number" name="psi_composite" min="0"></td>
      <td align="center"><input type="number" name="psi_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="psi_confidence" min="90"></td>
    </tr>
    <tr>
      <td align="left">Full Scale</td>
      <td align="center"><input type="number" name="fsiq_sumScaledScores" min="0"></td>
      <td align="center">FSIQ <input type="number" name="fsiq_composite" min="0"></td>
      <td align="center"><input type="number" name="fsiq_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="fsiq_confidence" min="90"></td>
    </tr>
  </tbody>
</table>
<br><br>

<h1>Ancillary and Complementary Analysis</h1>
<h2>Sum of Scaled Scores to Index Score Conversion</h2>
<table id="convertSumOfScaledToIndex" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Scale</th>
      <th>Sum of Scaled Scores</th>
      <th>Index Score</th>
      <th>Percentile Rank</th>
      <th>Confidence Interval</th>
    <tr>
  </thead>
  <tbody>
    <tr>
      <td align="left">Vocabulary Acquisition</td>
      <td align="center"><input type="number" name="vai_sumScaledScores" min="0"></td>
      <td align="center">VAI <input type="number" name="vai_composite" min="0"></td>
      <td align="center"><input type="number" name="vai_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="vai_confidence" min="90"></td>
    </tr>
    <tr>
      <td align="left">Nonverbal</td>
      <td align="center"><input type="number" name="nvi_sumScaledScores" min="0"></td>
      <td align="center">NVI <input type="number" name="nvi_composite" min="0"></td>
      <td align="center"><input type="number" name="nvi_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="nvi_confidence" min="90"></td>
    </tr>
    <tr>
      <td align="left">General Ability</td>
      <td align="center"><input type="number" name="gai_sumScaledScores" min="0"></td>
      <td align="center">GAI <input type="number" name="gai_composite" min="0"></td>
      <td align="center"><input type="number" name="gai_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="gai_confidence" min="90"></td>
    </tr>
    <tr>
      <td align="left">Cognitive Proficiency</td>
      <td align="center"><input type="number" name="cpi_sumScaledScores" min="0"></td>
      <td align="center">CPI <input type="number" name="cpi_composite" min="0"></td>
      <td align="center"><input type="number" name="cpi_percentile" min="0" max="100"></td>
      <td align="center"><input type="number" name="cpi_confidence" min="90"></td>
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
