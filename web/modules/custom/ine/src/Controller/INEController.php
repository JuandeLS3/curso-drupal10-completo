<?php

namespace Drupal\ine\Controller;

use Drupal\Core\Controller\ControllerBase;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class INEController extends ControllerBase {

  protected $config = null;
  protected $api_endpoint = '';

  public function __construct()
  {
    $this->config = \Drupal::config('ine.settings');
    $this->api_endpoint = $this->getConfig('api_endpoint');
  }

  protected function getConfig($name) {
    return $this->config->get($name);
  }

  public function test() {
    $response = \Drupal::service('ine.api')->test();
    return $response;
  }
}
