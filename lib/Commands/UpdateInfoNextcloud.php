<?php

declare(strict_types=1);

namespace OCA\UpdateInfoCli\Commands;

use OC\Core\Command\Base;
use OCA\UpdateNotification\UpdateChecker;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateInfoNextcloud extends Base {

	/**
	 * @var UpdateChecker $updateChecker
	 */
	private $updateChecker;

	public function __construct(UpdateChecker $updateChecker) {
		parent::__construct();

		$this->updateChecker = $updateChecker;
	}

	public function configure(): void {
		parent::configure();
		$this->setName('udpateinfo:nextcloud')
			->setDescription('Displays the update info for nextcloud');
	}

	public function execute(InputInterface $input, OutputInterface $output): int {
		$nextcloudUpdateState = $this->updateChecker->getUpdateState();

		if ($nextcloudUpdateState['updateAvailable'])
			unset($nextcloudUpdateState['updateLink']);
			unset($nextcloudUpdateState['downloadLink']);
			unset($nextcloudUpdateState['changes']);
			$this->writeArrayInOutputFormat($input, $output, $nextcloudUpdateState);
			return 1
		} else {
			$this->writeArrayInOutputFormat($input, $output, ["updateAvailable" => false ]);
		}
		
		return 0;
	}
}