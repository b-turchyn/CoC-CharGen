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
      <legend>Meta</legend>
      <div class="control-group">
        <label class="control-label" for="player_name">Player Name</label>
        <div class="controls">
          <?php echo UI::buildTextInput( 'player_name', 'player_name', $viewVars['player_name'] ) ?>
        </div>
      </div>
    </fieldset>
    <fieldset>
      <legend>Mechanics</legend>
      <?php
      echo UI::buildControlGroup( 'era', 'Era',
        UI::BuildSelect( 'era', Era::getEras( ), 'era', NULL, $viewVars['era'] ) )
      ?>
      <?php
      echo UI::buildControlGroup( 'stat_type', 'Stat Roll Type', 
        UI::BuildSelect( 'stat_type', RollType::$ROLL_TYPES, 'stat_type', NULL, $viewVars['stat_type'] ) )
      ?>
    </fieldset>
    <fieldset>
      <legend>Character Options</legend>
      <?php
      echo UI::buildControlGroup( 'gender', 'Gender', 
        UI::BuildSelect( 'gender', Gender::$GENDERS, 'gender', NULL, $viewVars['gender'] ) )
      ?>
      <div class="control-group">
        <label class="control-label" for="occupation">Occupation</label>
        <div class="controls">
          <?php echo UI::buildSelect( 'occupation', Occupation::getOccupations( ), 'occupation', NULL, $viewVars['occupation'] ) ?>
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
