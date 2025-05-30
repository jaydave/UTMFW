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

include('include.php');

$generate_status= $View->ProcessStartStopRequests();

$Reload= TRUE;
require_once($VIEW_PATH.'/header.php');
		
$View->PrintStatusForm($generate_status);

PrintHelpWindow(_HELPWINDOW('OpenBSD/spamd is a spam deferral daemon, a fake sendmail-like daemon which rejects false mail. You can run spamd if there is a mail server in the internal network. Thanks to OpenBSD/spamd, you can not only prevent unwanted e-mails but also torture spammers.'));
require_once($VIEW_PATH.'/footer.php');
?>
