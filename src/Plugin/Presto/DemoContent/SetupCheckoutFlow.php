<?php

namespace Drupal\presto\Plugin\Presto\DemoContent;

use Drupal;
use Drupal\Core\Config\FileStorage;

/**
 * Sets up the checkout flow.
 *
 * @PrestoDemoContent(
 *     id = "setup_checkout_flow",
 *     type = \Drupal\presto\Installer\DemoContentTypes::ECOMMERCE,
 *     label = @Translation("Setup checkout flow"),
 *     weight = 4
 * )
 *
 * @package Drupal\presto\Plugin\Presto\DemoContent
 */
class SetupCheckoutFlow extends AbstractDemoContent {

  /**
   * {@inheritdoc}
   *
   * @throws \Drupal\Core\Config\UnsupportedDataTypeConfigException
   */
  public function createContent() {
    $modulePath = drupal_get_path('module', 'presto_commerce');
    $configPath = "{$modulePath}/config/optional";

    $source = new FileStorage($configPath);

    // Re-read checkout flow from the export config file.
    // This should be safe enough as this only runs within a site install
    // context.
    $configStorage = Drupal::service('config.storage');
    $configStorage->write(
      'commerce_checkout.commerce_checkout_flow.default',
      $source->read('commerce_checkout.commerce_checkout_flow.default')
    );
  }

}