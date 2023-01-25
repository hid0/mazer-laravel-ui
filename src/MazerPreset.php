<?php

namespace Hid0\MazerLaravelUi;

use Illuminate\Filesystem\Filesystem;
use Laravel\Ui\Presets\Preset;
use Laravel\Ui\UiCommand;

class MazerPreset extends Preset
{
  const RESOURCE_PATH = __DIR__ . '/../stubs/default/resources/';

  /**
   * Install the preset
   * 
   * @param UiCommand $command
   * @return void
   */

  public static function install(UiCommand $command)
  {
    static::updatePackages();
    $command->info('Updating Assets');
    static::updateAssets();

    $command->info('Updating Resource JS');
    static::updateScripts();
    $command->info('Updating Resource SASS');
    static::updateStyles();
    $command->info('Updating Resource Layouts');
    static::updateLayoutViews();
    $command->info('Updating Vite');
    static::updateMix();

    static::removeNodeModules();
  }

  /**
   * Update the given package array.
   *
   * @param  array  $packages
   * @return array
   */

  protected static function updatePackageArray(array $packages)
  {
    return [
      "@ckeditor/ckeditor5-build-classic" => "^32.0.0",
      "@fontsource/nunito" => "^4.5.11",
      "@fortawesome/fontawesome-free" => "^5.15.4",
      "@icon/dripicons" => "^2.0.0-alpha.3",
      "@popperjs/core" => "^2.11.6",
      "apexcharts" => "^3.36.3",
      "bootstrap" => "5.2.3",
      "bootstrap-icons" => "^1.10.2",
      "chart.js" => "^4.1.1",
      "choices.js" => "^10.2.0",
      "cross-env" => "^7.0.3",
      "datatables.net" => "^1.13.1",
      "datatables.net-bs5" => "^1.13.1",
      "dayjs" => "^1.11.7",
      "dragula" => "^3.7.3",
      "feather-icons" => "^4.29.0",
      "filepond" => "^4.30.4",
      "filepond-plugin-file-validate-size" => "^2.2.8",
      "filepond-plugin-file-validate-type" => "^1.2.8",
      "filepond-plugin-image-crop" => "^2.0.6",
      "filepond-plugin-image-exif-orientation" => "^1.0.11",
      "filepond-plugin-image-filter" => "^1.0.1",
      "filepond-plugin-image-preview" => "^4.6.11",
      "filepond-plugin-image-resize" => "^2.0.10",
      "jsvectormap" => "^1.5.1",
      "laravel-mix" => "^6.0.49",
      "nunjucks" => "^3.2.3",
      "parsleyjs" => "^2.9.2",
      "perfect-scrollbar" => "^1.5.5",
      "quill" => "^1.3.7",
      "rater-js" => "^1.0.1",
      "rtlcss" => "^4.0.0",
      "simple-datatables" => "^4.0.8",
      "summernote" => "0.8.20",
      "sweetalert2" => "^11.6.16",
      "tinymce" => "^6.3.1",
      "toastify-js" => "^1.12.0",
      "vite" => "^4.0.4",
      "laravel-vite-plugin" => "^0.7.3"
    ] + $packages;
  }

  protected static function updateScripts()
  {
    static::copyDirectory(static::RESOURCE_PATH . 'js', resource_path('js'));
  }

  /**
   * Update the SCSS
   *
   * @return void
   */
  protected static function updateStyles()
  {
    (new Filesystem)->deleteDirectory(resource_path('sass'));

    static::copyDirectory(static::RESOURCE_PATH . 'sass', resource_path('sass'));
  }

  /**
   * Update the default layout
   *
   * @return void
   */
  protected static function updateLayoutViews()
  {
    static::copyDirectory(static::RESOURCE_PATH . 'views/layouts', resource_path('views/layouts'));
    static::copyDirectory(static::RESOURCE_PATH . 'views/partials', resource_path('views/partials'));
    static::copyDirectory(static::RESOURCE_PATH . 'views/app', resource_path('views/app'));
  }

  /**
   * Update the vite.config.js
   *
   * @return void
   */
  protected static function updateMix()
  {
    copy(
      __DIR__ . '/../stubs/default/vite.config.js',
      base_path('vite.config.js')
    );
  }

  /**
   * Copy a directory
   *
   * @param $source
   * @param $destination
   * @return void
   */
  private static function copyDirectory($source, $destination)
  {
    (new Filesystem)->copyDirectory($source, $destination);
  }
}
