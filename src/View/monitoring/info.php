<?php
/*
 * Copyright (C) 2004-2024 Soner Tari
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

require_once('include.php');

$View->Model= 'symon';
$generate_symon_status= $View->ProcessStartStopRequests();
$View->Model= 'symux';
$generate_symux_status= $View->ProcessStartStopRequests();
$View->Model= 'pmacct';
$generate_pmacct_status= $View->ProcessStartStopRequests();
$View->Model= 'collectd';
$generate_collectd_status= $View->ProcessStartStopRequests();

$Reload= TRUE;
require_once($VIEW_PATH.'/header.php');
		
$View->Model= 'symon';
$View->PrintStatusForm($generate_symon_status);
$View->Model= 'symux';
$View->Caption= 'Symux';
$View->PrintStatusForm($generate_symux_status);
$View->Model= 'pmacct';
$View->Caption= 'Pmacct';
$View->PrintStatusForm($generate_pmacct_status);
$View->Model= 'collectd';
$View->Caption= 'Collectd';
$View->PrintStatusForm($generate_collectd_status);

PrintHelpWindow(_HELPWINDOW('Graphs on this web user interface are generated by these monitoring processes. Settings of these software are handled by automatic configuration.'));
require_once($VIEW_PATH.'/footer.php');
?>
