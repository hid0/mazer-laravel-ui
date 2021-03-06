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
    UiCommand::macro('stisla', function (UiCommand $command) {
      StislaPreset::install($command);

      $command->info('Installing package.');
      exec('npm install && npm run production');
      $command->info('Package installed successfull.');

      $command->info('Stisla UI scaffolding installed successfully.');
    });
  }
}
