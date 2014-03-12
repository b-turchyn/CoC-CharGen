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
<table class="character_sheet">
  <tr>
  <td class="era"><h3><?php echo $viewVars['era'] ?></h3></td>
    <td class="basic_stats" colspan="2">
      <div>
        <div>
          <span class="fluid"><strong>Investigator Name</strong> <?php echo $viewVars['name'] ?></span>
        </div>
        <div>
          <span class="fluid"><strong>Occupation</strong> <?php echo $viewVars['occupation'] ?></span>
          <span class="fluid"><strong>Sex</strong> <?php echo $viewVars['gender'] ?></span>
        </div>
        <div>
          <span class="fluid"><strong>Nationality</strong> <?php echo $viewVars['nationality'] ?></span>
          <span class="fluid"><strong>Age</strong> <?php echo $viewVars['age'] ?></span>
        </div>
        <div>
          <span class="fluid"><strong>Birthplace</strong> <?php echo $viewVars['birthplace'] ?></span>
        </div>
        <div>
          <span class="fluid"><strong>Colleges,Degrees</strong> <?php echo $viewVars['colleges_degrees'] ?></span>
        </div>
        <div>
          <span class="fluid"><strong>Mental Disorders</strong> <?php echo $viewVars['mental_disorders'] ?></span>
        </div>
      </div>
    </td>
    <td class="characteristics" colspan="2">
      <h3>Characteristics and Rolls</h3>
      <div>
        <span><strong>STR</strong> <?php echo $viewVars['stats']->getSTR( ) ?></span>
        <span><strong>DEX</strong> <?php echo $viewVars['stats']->getDEX( ) ?></span>
        <span><strong>INT</strong> <?php echo $viewVars['stats']->getINT( ) ?></span>
        <span><strong>Idea</strong> <?php echo $viewVars['stats']->getIdea( ) ?></span>
      </div>
      <div>
        <span><strong>CON</strong> <?php echo $viewVars['stats']->getCON( ) ?></span>
        <span><strong>APP</strong> <?php echo $viewVars['stats']->getAPP( ) ?></span>
        <span><strong>POW</strong> <?php echo $viewVars['stats']->getPOW( ) ?></span>
        <span><strong>Luck</strong> <?php echo $viewVars['stats']->getLUK( ) ?></span>
      </div>
      <div>
        <span><strong>SIZ</strong> <?php echo $viewVars['stats']->getSIZ( ) ?></span>
        <span><strong>SAN</strong> <?php echo $viewVars['stats']->getSAN( ) ?></span>
        <span><strong>EDU</strong> <?php echo $viewVars['stats']->getEDU( ) ?></span>
        <span><strong>Know</strong> <?php echo $viewVars['stats']->getKnow( ) ?></span>
      </div>
      <div>
        <span class="wide"><strong>99-Cthulhu Mythos</strong> TODO</span>
        <span class="wide"><strong>Damage Bonus</strong> <?php echo $viewVars['stats']->getDMGBonus( ) ?></span>
      </div>
    </td>
  </tr>
  <tr>
    <td rowspan="2" class="player_name">
    <span><strong>Player's Name</strong> <?php echo htmlspecialchars( $viewVars['player_name'] ) ?></span>
    </td>
    <td colspan="2" class="points">
      <h3>Sanity Points</h3>
      <?php echo UI::buildSanityPoints( $viewVars['stats']->getSAN( ) ) ?>
    </td>
    <td class="points">
      <h3>Magic Points</h3>
      <?php echo UI::buildMagicPoints( $viewVars['stats']->getPOW( ) ) ?>
    </td>
    <td class="points">
      <h3>Hit Points</h3>
      <?php echo UI::buildHitPoints( $viewVars['stats']->getHP( ) ) ?>
    </td>
  </tr>
  <tr>
    <td colspan="4">
      <h3>Investigator Skills</h3>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <h3>Hand-To-Hand Weapons</h3>
    </td>
    <td colspan="3">
      <h3>Firearms</h3>
    </td>
  </tr>
</table>
