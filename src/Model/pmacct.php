<?php
/*
 * Copyright (C) 2004-2025 Soner Tari
 *
 * This file is part of UTMFW.
 *
 * UTMFW is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * UTMFW is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with UTMFW.  If not, see <http://www.gnu.org/licenses/>.
 */

/** @file
 * Network monitoring.
 */

require_once($MODEL_PATH.'/monitoring.php');

class Pmacct extends Monitoring
{
	public $Name= 'pmacct';
	public $User= 'root';
	
	public $VersionCmd= '/usr/local/sbin/pmacctd -v 2>&1';
	
	protected $LogFilter= 'pmacct';

	function __construct()
	{
		global $TmpFile;
		
		parent::__construct();

		$this->Proc= 'pmacctd';
	
		$this->Commands= array_merge(
			$this->Commands,
			array(
				'SetIf'=>	array(
					'argv'	=>	array(NAME),
					'desc'	=>	_('Set pmacct if'),
					),
				
				'SetNet'=>	array(
					'argv'	=>	array(IPRANGE),
					'desc'	=>	_('Set pmacct net'),
					),
				)
			);
	}

	function GetVersion()
	{
		return Output($this->RunShellCommand($this->VersionCmd.' | /usr/bin/head -2 | /usr/bin/tail -1'));
	}

	function Start()
	{
		$this->StartCmd= '/usr/local/sbin/pmacctd -f /etc/pmacct/pmacctd-pnrg.conf';
		$retval= parent::Start();
		
		/// @todo Should modify pmacct code to report which conf file each child process is using in ps output
		$this->StartCmd= '/usr/local/sbin/pmacctd -f /etc/pmacct/pmacctd-protograph.conf';
		$retval&= parent::Start();

		return $retval;
	}

	function SetIf($if)
	{
		$re= '|^(\s*pcap_interface:\s*)(\w+\d+)(\s+)|ms';
		$retval=  $this->ReplaceRegexp('/etc/pmacct/pmacctd-pnrg.conf', $re, '${1}'.$if.'${3}');
		$retval&= $this->ReplaceRegexp('/etc/pmacct/pmacctd-protograph.conf', $re, '${1}'.$if.'${3}');

		return $retval;
	}
	
	function SetNet($net)
	{
		global $Re_Net;
		
		$re= "|(\s+src\s+net\s+)($Re_Net)(\s+)|ms";
		$retval=  $this->ReplaceRegexp('/etc/pmacct/pmacctd-pnrg.conf', $re, '${1}'.$net.'${3}');
		
		$re= "|(\s+dst\s+net\s+)($Re_Net)(\s+)|ms";
		$retval&= $this->ReplaceRegexp('/etc/pmacct/pmacctd-pnrg.conf', $re, '${1}'.$net.'${3}');
		
		return $retval;
	}
}
?>
