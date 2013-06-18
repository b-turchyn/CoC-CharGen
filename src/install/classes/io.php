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

class FileIO {
	/**
	 * Retrieves an ASCII file's contents
	 *
	 * @param string $filename 
	 * @return boolean false on failure, string content on pass
	 * @author Brian Turchyn
	 */
	public static function getFile($filename) {
		$result = false;
		// Make sure no directory recursing
		if(!preg_match("/\.\./", $filename)) {
			// Open the file for reading
			$handle = @fopen($filename, "r");
			// Did we successfully open the file?
			if($handle) {
				$contents = @fread($handle, filesize($filename));
				$result = $contents;
			}
		}
		
		// We're done
		return $result;
	}
	
	/**
	 * Binary-safe file writing. Rough anti-folder-traversal protection built-in
	 *
	 * @param string $filename 
	 * @return boolean false on failure, true on success
	 * @author Brian Turchyn
	 */
	public static function putFile($filename, $contents, $binary = false) {
		$handle = null;
		$result = false;
		
		// Make sure no directory recursing
		if(!preg_match("/\.\./", $filename)) {
			// Can we touch the file?
			if ( @touch($filename) ) {
				// Attempt to open the file; no reading required. 
				if ( $binary )
					$handle = @fopen($filename, "wb");
				else
					$handle = @fopen($filename, "w");
				
				// If we're in, attempt to write the contents
				if ( $handle ) {
					$result = @fwrite($handle, $contents);
					if ( $result !== false )
						$result = true;
				}
			}
		}
		
		return $result;
	}
}

?>