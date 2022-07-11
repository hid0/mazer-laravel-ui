<?php

namespace Hid0\MazerLaravelUi;

use Illuminate\Filesystem\Filesystem;
use Laravel\Ui\Presets\Preset;
use Laravel\Ui\UiCommand;

class MazerPreset extends Preset
{
  const RESOURCE_PATH = __DIR__ . '/../resources/';

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
    $command->info('Updating Webpack Mix');
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
      "@fontsource/nunito" => "^4.5.4",
      "@fortawesome/fontawesome-free" => "^5.15.4",
      "@icon/dripicons" => "^2.0.0-alpha.3",
      "@popperjs/core" => "^2.11.4",
      "apexcharts" => "^3.33.2",
      "bootstrap" => "5.1.3",
      "bootstrap-icons" => "^1.8.1",
      "chart.js" => "^2.9.4",
      "choices.js" => "^9.1.0",
      "cross-env" => "^7.0.3",
      "datatables.net" => "^1.11.5",
      "datatables.net-bs5" => "^1.11.5",
      "dayjs" => "^1.11.0",
      "dragula" => "^3.7.3",
      "feather-icons" => "^4.28.0",
      "filepond" => "^4.30.3",
      "filepond-plugin-file-validate-size" => "^2.2.5",
      "filepond-plugin-file-validate-type" => "^1.2.6",
      "filepond-plugin-image-crop" => "^2.0.6",
      "filepond-plugin-image-exif-orientation" => "^1.0.11",
      "filepond-plugin-image-filter" => "^1.0.1",
      "filepond-plugin-image-preview" => "^4.6.10",
      "filepond-plugin-image-resize" => "^2.0.10",
      "jquery" => "^3.6.0",
      "laravel-mix" => "^6.0.43",
      "nunjucks" => "^3.2.3",
      "parsleyjs" => "^2.9.2",
      "perfect-scrollbar" => "^1.5.5",
      "popper.js" => "^1.16.1",
      "quill" => "^1.3.7",
      "rater-js" => "^1.0.1",
      "rtlcss" => "^3.5.0",
      "simple-datatables" => "3.0.2",
      "summernote" => "0.8.18",
      "sweetalert2" => "^11.4.6",
      "tinymce" => "^5.10.3",
      "toastify-js" => "^1.11.2",
      "webpack" => "^5.70.0"
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
   * Update the webpack.mix.js
   *
   * @return void
   */
  protected static function updateMix()
  {
    copy(
      __DIR__ . '/../stubs/webpack.mix.js',
      base_path('webpack.mix.js')
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
