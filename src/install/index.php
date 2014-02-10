<?php
/************************************************************************
 * Call of Cthulhu Character Generator
 * Copyright (C) 2011 Brian Turchyn, Glen Conolly, Tyler Omichinski
 * All references to commercial items copyright their respective owners.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 ************************************************************************/

error_reporting(E_ALL);
ini_set('display_errors','on');

require_once 'classes/sqli.php';
require_once 'classes/configfactory.php';

define('CFG_FILE', "../config.php");
define('CFG_SAMPLE', "classes/config.sample.php");
define('INS_LOCK', "install.lock");

$sql = null;

function bufferflush ( )
{
  echo ( str_repeat ( ' ', 256 ) );
  // check that buffer is actually set before flushing
  if ( ob_get_length ( ) )
  {            
    @ob_flush( );
    @flush( );
    @ob_end_flush( );
  }    
  @ob_start( );
}
?><?php include '../ui/header.php'; ?>
      <div class="masthead">
        <h3>Call of Cthulhu Character Generator</h3>
      </div>
      <hr>
      <div class="jumbotron">
        <h1>Installer</h1>
      </div>
<?php
if ( file_exists ( INS_LOCK ) )
{
  ?>
      <div class="alert alert-error">
        The installer has been locked. Remove install.lock to reinstall.
      </div>
  <?php
}
elseif ( file_exists ( CFG_FILE ) )
{
  ?>
      <div class="alert alert-error">
	The configuration file currently exists. Remove the configuration file to continue.
      </div>
  <?php
}
// Check if we'll be able to write the config file
elseif ( !file_exists ( CFG_FILE ) && !( touch ( CFG_FILE ) && unlink ( CFG_FILE ) ) )
{
  ?>
      <div class="alert alert-error">
	Unable to write the config file. Check folder permissions.
      </div>
  <?php
}
// Check if we'll be able to write the install lock
elseif ( !file_exists ( INS_LOCK ) && !( touch ( INS_LOCK ) && unlink ( INS_LOCK ) ) )
{
  ?>
      <div class="alert alert-error">
	Unable to write the installer lock. Check folder permissions.
      </div>
  <?php
}
elseif ( isset ( $_POST[ 'coc_install' ] ) )
{
  $sql = new SQLiInstall(
    $_POST['coc_host'],
    $_POST['coc_user'],
    $_POST['coc_password'],
    $_POST['coc_database'],
    $_POST['coc_prefix']
  );
  echo "<div class=\"alert alert-info\">Successfully connected to " . $sql->host_info . "</div>";
	
  $failed = false;
	
  // Get the SQL files
  $dir = 'tabledata';
  $files = scandir($dir, 0);

  echo "<table class=\"table table-striped table-bordered table-condensed\">";
  echo "<tr><th>File</th><th class=\"table-result\">Result</th></tr>\n";
  // Iterate through each file
  foreach ( $files as $key => $value )
  {
    if ( preg_match ( "/.sql$/", $value ) )
    {
      // Output the current query being run, and flush the buffer
      echo "<tr><td>" . preg_replace ( "/.sql$/", "", $value ) . "</td><td class=\"table-result\">";
      bufferflush();
			
      // Run the query
      $res = $sql->runQueryFromFile( $value );
			
      // Display the result
      if ( $res == null )
      {
        echo "<span class=\"label label-success\"><i class=\"icon-ok\"></i></span>\n";
      }
      else
      {
        echo "<span class=\"label label-important\"><i class=\"icon-remove\"></i></span>\n";
        // Add a new row to the table to display the error message
        echo "</td></tr><tr class=\"error\"><td colspan=\"2\"><i class=\"icon-arrow-right\"></i>&nbsp;";
        echo $res[ 1 ];
        $failed = true;
      }
      echo "</td></tr>\n";
    }
  }
	
  // Only write the config and lock the installer if we've succeeded
  if ( !$failed )
  {
    $configCreated = false;
    $configFactory = new ConfigFactory( );
    $configFile = $configFactory->generate(
      CFG_SAMPLE,
      $_POST['coc_host'],
      $_POST['coc_user'],
      $_POST['coc_password'],
      $_POST['coc_database'],
      $_POST['coc_prefix'] );

    if ( $configFile != false )
    {
      $configCreated = $configFactory->write( $configFile, CFG_FILE );
    }
    echo "<tr><td>Configuration File Creation</td><td class=\"table-result\">";
    if ( $configCreated )
    {
      echo "<span class=\"label label-success\"><i class=\"icon-ok\"></i></span>\n";
    }
    else
    {
      $failed = true;
      echo "<span class=\"label label-important\"><i class=\"icon-remove\"></i></span>\n";
    }
    echo "</td></tr>";
	
    if ( !$failed )
    {
      // Lock the installer
      echo "<tr><td>Installer Lock File Creation</td><td class=\"table-result\">";
      if ( touch ( INS_LOCK ) )
      {
        echo "<span class=\"label label-success\"><i class=\"icon-ok\"></i></span>\n";
      }
      else
      {
        $failed = true;
        echo "<span class=\"label label-important\"><i class=\"icon-remove\"></i></span>\n";
      }
    }
  }
  echo "</td></tr>";
  echo "</table>\n";
	
  // Display the overall result
  if ( !$failed )
  {
    echo "<div class='alert alert-success'>Completed successfully!</div>";
  }
  else
  {
    echo "<div class='alert alert-error'>One or more install queries failed. Your installation of CoC Chargen may not function properly!</div>";
  }
	
}
else
{
  ?>
	<form method='POST' class="form-horizontal">
          <fieldset>
            <legend>Database Options</legend>
            <div class="control-group">
              <label class="control-label" for="coc_host">Server host name</label>
              <div class="controls">
                <input type="text" id="coc_host" name="coc_host">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="coc_user">Database username</label>
              <div class="controls">
                <input type="text" id="coc_user" name="coc_user">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="coc_password">Database password</label>
              <div class="controls">
                <input type="password" id="coc_password" name="coc_password">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="coc_database">Database name</label>
              <div class="controls">
                <input type="text" id="coc_database" name="coc_database">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="coc_prefix">Table prefix</label>
              <div class="controls">
                <input type="text" id="coc_prefix" name="coc_prefix" value="coc_">
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                <button type="submit" class="btn btn-primary" name="coc_install" value="Install">Install</button>
              </div>
            </div>
          </fieldset>
	</form>
      <?php
}
?><?php include '../ui/footer.php'; ?>
