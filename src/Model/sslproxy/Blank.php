<?php
/*
 * Copyright (C) 2004-2022 Soner Tari
 *
 * This file is part of UTMFW.
 *
 * PFRE is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * PFRE is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PFRE.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace SSLproxy;

class Blank extends Rule
{
	/**
	 * Type definition for blank lines.
	 * 
	 * We should never have a Blank object without 'blank' key, hence 'require'.
	 */
	protected $typedef= array(
		'blank' => array(
			'require' => TRUE,
			'regex' => RE_BLANK,
			),
		);

	function parse($str)
	{
		$this->init();
		$this->rule['blank']= $str;
	}

	function generate()
	{
		return $this->rule['blank'];
	}
}
?>
