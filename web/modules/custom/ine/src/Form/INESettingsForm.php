<?php

namespace Drupal\ine\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 */
class INESettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ine_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['ine.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get stored configuration.
    $config = $this->config('ine.settings');
    $api_endpoint = $config->get('api_endpoint');

    $form['api_endpoint'] = [
      '#type' => 'textfield',
      '#title'  => $this->t('API Endpoint'),
      '#required' => FALSE,
      '#default_value' => !empty($api_endpoint) ? $api_endpoint : '',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Get values.
    $api_endpoint = $form_state->getValue('api_endpoint');

    // Set data.
    $this->config('ine.settings')
      ->set('api_endpoint', $api_endpoint)
      ->save();
    parent::submitForm($form, $form_state);
  }

}
