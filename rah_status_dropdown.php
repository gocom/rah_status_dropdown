<?php

/**
 * Rah_status_dropdown plugin for Textpattern CMS
 *
 * @author Jukka Svahn
 * @date 2008-
 * @license GNU GPLv2
 * @link http://rahforum.biz/plugins/rah_status_dropdown
 *
 * Copyright (C) 2012 Jukka Svahn <http://rahforum.biz>
 * Licensed under GNU Genral Public License version 2
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

	if(@txpinterface == 'admin') {
		register_callback('rah_status_dropdown', 'article_ui', 'status');
	}

/**
 * Replace status radios with a drop down
 * @param string $event
 * @param string $step
 * @param string $default
 * @param array $rs
 */

	function rah_status_dropdown($event, $step, $default, $rs) {
		global $statuses;
		
		return 
			preg_replace(
				'/<ul[^>]*?>[\s\S]*?<\/ul>/',
				graf(selectInput('Status', doArray($statuses, 'strip_tags'), !$rs['Status'] ? 4 : $rs['Status']), ' class="status"'),
				$default
			);
	}
?>