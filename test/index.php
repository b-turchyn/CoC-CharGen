<?php

if(isset($_POST['coc-chargen-test_all'])) {
	foreach (glob("classes/*.php") as $filename)
	{
	    require_once($filename);
	}
}

else {
?>
<form method="POST">
<input type="hidden" value="yes" name="coc-chargen-test_all" /><input type="submit" value="Run all tests" />
</form>
<?php
}
?>