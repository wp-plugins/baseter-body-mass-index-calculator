<?php
/*
Plugin Name: Baseter body mass index calculator
Plugin URI: http://www.baseter.com
Description: Calculate your body mass index.
Author: Lucian Apostol
Version: 0.3
Author URI: http://www.baseter.com
*/


function baseter() 
{
  ?>
	<script type="text/javascript">
		function mod(div,base) {
				return Math.round(div - (Math.floor(div/base)*base));
		}


		function bmi_calculator(formhandler)  {
			
			var w = formhandler.bmi_weight.value * 1;
			var HeightFeetInt = formhandler.bmi_height_ft.value * 1;
			var HeightInchesInt = formhandler.bmi_height_in.value * 1;
			HeightFeetConvert = HeightFeetInt * 12;
			h = HeightFeetConvert + HeightInchesInt;
			displaybmi = (Math.round((w * 703) / (h * h)));
			var rvalue = true;
			if ( (w <= 35) || (w >= 500)  || (h <= 48) || (h >= 120) ) {
				document.getElementById("bmi_result").innerHTML = "Invalid data";
				rvalue = false;
				return false;
			}
			if (rvalue) {
					reminderinches = mod(HeightInchesInt,12);
					formhandler.bmi_height_in.value = reminderinches;
					formhandler.bmi_height_ft.value = HeightFeetInt + 
					((HeightInchesInt - reminderinches)/12);
					document.getElementById("bmi_result").innerHTML = "Your BMI is: " + displaybmi;
			}


			return false;
		}
	</script> 

	<form id="baseterform" onsubmit="return bmi_calculator(this);" method="post">
		Weight: <input type="text" name="bmi_weight" id="bmi_weight" size="9"; /> lbs.<br>
		Height: <input type="text" name="bmi_height_ft" id="bmi_height_ft" size="9"; /> ft <br> 
		Height: <input type="text" name="bmi_height_in" id="bmi_height_in" size="9"; /> in
		<br><input type="submit" name="submit" id="submit" value="Calculate" /><br>
		<div id="bmi_result"></div>
	</form>

  <?
}

function widgetBaseter($args) {
  extract($args);
  echo $before_widget;
  echo $before_title;?>BMI calculator<?php echo $after_title;
  baseter();
  echo $after_widget;
}

function baseterInit()
{
  register_sidebar_widget(__('Baseter BMI Calculator'), 'widgetBaseter');     
}
add_action("plugins_loaded", "baseterInit");
?>