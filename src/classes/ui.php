<?php
/************************************************************************
 * Call of Cthulhu Character Generator
 * Copyright (C) 2013 Brian Turchyn
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

/**
 * The UI class is responsible for building all UI elements in the application
 */
class UI
{
  static function buildControlGroup( $label_id, $label_value, $contents ) {
    $id = htmlspecialchars( $label_id );
    $value = htmlspecialchars( $label_value );
    return <<<EOF
      <div class="control-group">
        <label class="control-label" for="{$label_id}">{$label_value}</label>
        <div class="controls">
          {$contents}
        </div>
      </div>
EOF;
  }

  static function buildTextInput( $id, $name = NULL, $value = NULL, $klass = NULL, $placeholder = NULL ) {
    $result = "<input type=\"text\" id=\"" . htmlspecialchars( $id ) . "\"";

    if ( $name != NULL ) {
      $result .= " name=\"" . htmlspecialchars( $name ) . "\"";
    }
    if( $value !== NULL ) {
      $result .= " value=\"" . htmlspecialchars( $value ) . "\"";
    }
    if ( $klass != NULL ) {
      $result .= " class=\"" . htmlspecialchars ( $klass ) . "\"";
    }
    if( $placeholder !== NULL ) {
      $result .= " placeholder=\"" . htmlspecialchars( $placeholder ) . "\"";
    }

    $result .= ">";

    return $result;
  }

  static function buildSelect( $id, $selections, $name = NULL, $klass = NULL, $selected = NULL ) {
    $result = "<select id=\"" . htmlspecialchars( $id ) . "\"";

    if ( $name != NULL ) {
      $result .= " name=\"" . htmlspecialchars( $name ) . "\"";
    }
    if ( $klass != NULL ) {
      $result .= " class=\"" . htmlspecialchars ( $klass ) . "\"";
    }

    $result .= ">";

    for ($i = 0; $i < count($selections); $i++) {
      $current = $selections[ $i ];
      $result .= "<option value=\"" . htmlspecialchars( $current['key'] ) . "\"";

      if( $current['key'] != NULL && $current['key'] == $selected ) {
        $result .= " selected=\"selected\"";
      }

      $result .= ">" . htmlspecialchars( $current['value'] ) . "</option>\n";
    }

    $result .= "</select>\n";

    return $result;
  }

  static function buildMagicPoints( $points ) {
    $result = "<span class=\"bolded\">Unconscious</span>";

    $result .= self::buildNumbers( 0, 37, $points );

    return $result;
  }

  static function buildHitPoints( $points ) {
    $result = "<span class=\"bolded\">Dead</span>";

    $result .= self::buildNumbers( -2, 37, $points );

    return $result;
  }

  static function buildSanityPoints( $points ) {
    $result = "<span class=\"bolded\">Insane</span>";

    $result .= self::buildNumbers( 0, 99, $points );

    return $result;
  }

  private static function buildNumbers( $start, $end, $tippingPoint ) {
    $result = "";

    for( $i = $start; $i <= $end; $i++ ) {
      $result .= " <span";
      if( $i > $tippingPoint ) {
        $result .= " class=\"muted\"";
      }
      $result .= ">" . $i . "</span>";
    }

    return $result;
  }
}

?>
