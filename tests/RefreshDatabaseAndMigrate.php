<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

trait RefreshDatabaseAndMigrate {
	/**
	 * Define hooks to migrate the database before and after each test.
	 *
	 * @return void
	 */
	public function refreshDatabase(): void {
		$this->usingInMemoryDatabase()
						? $this->refreshInMemoryDatabase()
						: $this->refreshTestDatabase();
	}

	/**
	 * Determine if an in-memory database is being used.
	 *
	 * @return bool
	 */
	protected function usingInMemoryDatabase(): bool {
		$default = config('database.default');

		return config("database.connections.$default.database") === ':memory:';
	}

	/**
	 * Refresh the in-memory database.
	 *
	 * @return void
	 */
	protected function refreshInMemoryDatabase(): void {
		$this->artisan('migrate:fresh', ['--seed' => true]);

		$this->app[Kernel::class]->setArtisan(null);
	}

	/**
	 * Refresh a conventional test database.
	 *
	 * @return void
	 */
	protected function refreshTestDatabase(): void {
		if (! RefreshDatabaseState::$migrated) {
			$this->artisan('migrate:fresh', [
				'--seed' => true,
				'--drop-views' => $this->shouldDropViews(),
				'--drop-types' => $this->shouldDropTypes(),
			]);

			$this->app[Kernel::class]->setArtisan(null);

			RefreshDatabaseState::$migrated = true;
		}

		$this->beginDatabaseTransaction();
	}

	/**
	 * Begin a database transaction on the testing database.
	 *
	 * @return void
	 */
	public function beginDatabaseTransaction(): void {
		$database = $this->app->make('db');

		foreach ($this->connectionsToTransact() as $name) {
			$connection = $database->connection($name);
			$dispatcher = $connection->getEventDispatcher();

			$connection->unsetEventDispatcher();
			$connection->beginTransaction();
			$connection->setEventDispatcher($dispatcher);
		}

		$this->beforeApplicationDestroyed(function () use ($database) {
			foreach ($this->connectionsToTransact() as $name) {
				$connection = $database->connection($name);
				$dispatcher = $connection->getEventDispatcher();

				$connection->unsetEventDispatcher();
				$connection->rollback();
				$connection->setEventDispatcher($dispatcher);
				$connection->disconnect();
			}
		});
	}

	/**
	 * The database connections that should have transactions.
	 *
	 * @return array
	 */
	protected function connectionsToTransact(): array {
		return property_exists($this, 'connectionsToTransact')
							? $this->connectionsToTransact : [null];
	}

	/**
	 * Determine if views should be dropped when refreshing the database.
	 *
	 * @return bool
	 */
	protected function shouldDropViews(): bool {
		return property_exists($this, 'dropViews')
							? $this->dropViews : false;
	}

	/**
	 * Determine if types should be dropped when refreshing the database.
	 *
	 * @return bool
	 */
	protected function shouldDropTypes(): bool {
		return property_exists($this, 'dropTypes')
							? $this->dropTypes : false;
	}
}
