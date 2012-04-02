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

	if(@txpinterface == 'admin')
		register_callback('rah_status_dropdown', 'admin_side', 'head_end');

/**
 * Adds JavaScript to the <head>
 */

	function rah_status_dropdown() {
		global $event;

		if($event != 'article')
			return;

		$js = <<<EOF
			$(document).ready(function() {
				$('#write-status').append('<p class="status rah_status_dropdown"><select id="rah_status_dropdown" name="Status" class="list"></select></p>');
				var to = $('#rah_status_dropdown');
				$('#write-status li').each(
					function() {
						var input = $(this).children('input[type=radio]');
						to.append(
							'<option value="'+input.val()+'"'+
								(input.is(':checked') ? ' selected="selected"' : '' )+
							'>' + $(this).children('label').text()+'</option>'
						);
					}
				);
				$('#write-status ul').remove();
			});
EOF;

		echo script_js($js);
	}
?>