<?php
	require_once __DIR__ . '/../entity/FundraisingActivity.php';
	
	class viewCompletedFRAController {
	
		private FundraisingActivity $fra;

		public function __construct()
		{
			$this->fra = new FundraisingActivity();
		}

		public function viewCompletedFRA(): array {
			return $this->fra ->viewCompletedFRA();
		}
	}
?>	