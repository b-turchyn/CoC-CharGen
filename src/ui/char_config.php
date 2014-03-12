<?php
/************************************************************************
 * Call of Cthulhu Character Generator
 * Copyright (C) 2011-2014 Brian Turchyn
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

include UI.'message_service.php';

?>
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
          <button type="reset" class="btn btn-warning" name="reset" value="Reset">Reset</button>
        </div>
      </div>
    </fieldset>
  </form>
