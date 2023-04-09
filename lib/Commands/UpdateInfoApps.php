<?php

declare(strict_types=1);

namespace OCA\UpdateInfoCli\Commands;

use OC\App\AppManager;
use OC\Installer;
use OC\Core\Command\Base;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateInfoApps extends Base {
	/**
	 * @var AppManager $appManager
	 */
	private $appManager;

	/**
	 * @var Installer $installer
	 */
	private $installer;

	public function __construct(AppManager $appManager, Installer $installer) {
		parent::__construct();

		$this->appManager = $appManager;
		$this->installer = $installer;
	}

	public function configure(): void {
		parent::configure();
		$this->setName('updateinfo:apps')
			->setDescription('Displays the update info for apps');
	}

	public function execute(InputInterface $input, OutputInterface $output): int {
		$apps = $this->appManager->getInstalledApps();

		$appWithUpdate = [];

		foreach ($apps as $app) {
			$update = $this->installer->isUpdateAvailable($app);
			if ($update !== false) {
				$appWithUpdate[$app] = $update;
			}
		}

		if (count($appWithUpdate) > 0) {
			$this->writeArrayInOutputFormat($input, $output, $appWithUpdate);
			return 1;
		} else {
			$this->writeArrayInOutputFormat($input, $output, []);
		}
		
		return 0;
	}
}