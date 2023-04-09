<?php
declare(strict_types=1);
// SPDX-FileCopyrightText: Mathias Petermann <mathias.petermann@gmail.com>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\UpdateInfoCli\AppInfo;

use OCP\AppFramework\App;

class Application extends App {
	public const APP_ID = 'updateinfocli';

	public function __construct() {
		parent::__construct(self::APP_ID);
	}
}
