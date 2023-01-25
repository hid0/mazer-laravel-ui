<?php

namespace Hid0\MazerLaravelUi;

use Laravel\Ui\UiCommand;
use Illuminate\Support\ServiceProvider;

class MazerServiceProvider extends ServiceProvider
{
  /**
   * Perform post-registration booting of services.
   *
   * @return void
   */
  public function boot()
  {
    UiCommand::macro('mazer', function (UiCommand $command) {
      MazerPreset::install($command);

      $command->info('Installing package.');
      exec('npm install && npm run dev');
      $command->info('Package installed successfull.');

      $command->info('Mazer UI scaffolding installed successfully.');
    });
  }
}
