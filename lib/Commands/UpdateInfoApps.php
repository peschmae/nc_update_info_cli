<?php

declare(strict_types=1);

namespace OCA\UpdateInfoCli\Commands;

use OC\App\AppManager;
use OC\Core\Command\Base;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateInfoApps extends Base {
	/**
	 * @var AppManager $appManager
	 */
	private $appManager;

	public function __construct(AppManager $appManager, UpdateChecker $updateChecker) {
		parent::__construct();

		$this->appManager = $appManager;
		$this->updateChecker = $updateChecker;
	}

	public function configure(): void {
		parent::configure();
		$this->setName('udpateinfo:apps')
			->setDescription('Displays the update info for apps');
	}

	public function execute(InputInterface $input, OutputInterface $output): int {
		$apps = $this->appManager->getInstalledApps();

		$appWithUpdate = []

		foreach ($apps as $app) {
			$update = $this->installer->isUpdateAvailable($app);
			if ($update !== false) {
				$appWithUpdate[$app] = $update
			}
		}

		if (count($appWithUpdate) > 0) {
			$this->writeArrayInOutputFormat($input, $output, $nextcloudUpdateState);
			return 1
		} else {
			$this->writeArrayInOutputFormat($input, $output, []);
		}
		
		return 0;
	}
}