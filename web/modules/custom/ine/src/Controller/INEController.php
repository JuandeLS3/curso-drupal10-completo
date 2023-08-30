<?php

namespace Drupal\ine\Controller;

use Drupal\Core\Controller\ControllerBase;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class INEController extends ControllerBase {

  /**
   * PRIMER PASO TUTORIAL, HACERLO POR CONTROLADOR, LUEGO PASARLO A SERVICE.
   */
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

  /**
   *
   */
  public function test() {
    /**
     * PRIMER PASO TUTORIAL, HACERLO POR CONTROLADOR, LUEGO PASARLO A SERVICE.
     */
    $client = \Drupal::httpClient();
    //$endpoint = "https://servicios.ine.es/wstempus/js/ES/DATOS_TABLA/50902?nult=1";
    $endpoint = $this->api_endpoint;
    $file_contents = 'N/A';

    try {
      $request = $client->get($endpoint);
      //$status = $request->getStatusCode();
      $file_contents = $request->getBody()->getContents();
    }
    catch (GuzzleException $e) {
      \Drupal::logger('ine')->error("Error!!!");
    }

    /**
     * SEGUNDO PASO TUTORIAL, USAR SERVICE
     */
    /*$response = \Drupal::service('ine.api')->test();
    return $response;*/

    return [
      '#prefix' => '<pre>',
      '#markup' => $file_contents,
      '#suffix' => '<pre>',
    ];
  }
}
