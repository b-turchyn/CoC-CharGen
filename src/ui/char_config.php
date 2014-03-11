<?php require_once ROOT_DIR . 'classes/ui.php'; ?>
<?php require_once ROOT_DIR . 'models/era.php'; ?>
<?php require_once ROOT_DIR . 'models/roll_type.php'; ?>
<?php require_once ROOT_DIR . 'models/gender.php'; ?>

  <form method='POST' class="form-horizontal">
    <fieldset>
      <legend>Mechanics</legend>
      <div class="control-group">
        <label class="control-label" for="era">Era</label>
        <div class="controls">
          <?php echo UI::buildSelect( 'era', Era::$ERAS, 'era' ) ?>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="stat_type">Stat Roll Type</label>
        <div class="controls">
          <?php echo UI::buildSelect( 'stat_type', RollType::$ROLL_TYPES, 'stat_type' ) ?>
        </div>
      </div>
    </fieldset>
    <fieldset>
      <legend>Character Options</legend>
      <div class="control-group">
        <label class="control-label" for="gender">Gender</label>
        <div class="controls">
          <?php echo UI::buildSelect( 'gender', Gender::$GENDERS, 'gender' ) ?>
        </div>
      </div>
      <div class="control-group">
        <div class="controls">
          <button type="submit" class="btn btn-primary" name="generate" value="Generate">Generate</button>
        </div>
      </div>
    </fieldset>
  </form>
