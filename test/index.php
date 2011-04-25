<?php

function runTests() {
  return (php_sapi_name() == 'cli' && empty($_SERVER['REMOTE_ADDR']))
    || isset($_POST['coc-chargen-test-all']);
}

if(runTests()) {
  echo "Running tests";
	foreach (glob(dirname(__FILE__) . "/classes/*.php") as $filename)
	{
	    require_once($filename);
	}
}

else {
?>
<form method="POST">
<input type="hidden" value="yes" name="coc-chargen-test-all" /><input type="submit" value="Run all tests" />
</form>
<?php
}
?>
