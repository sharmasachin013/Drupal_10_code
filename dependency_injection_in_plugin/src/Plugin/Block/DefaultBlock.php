<?php

namespace Drupal\dependency_injection_in_plugin\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a 'dependency_block' block.
 *
 * @Block(
 *  id = "dependency_block",
 *  admin_label = @Translation("dependency_block"),
 * )
 */
class DefaultBlock extends BlockBase {

  /**
   * @var AccountInterface $account
   */
  protected $account;
/**
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param \Drupal\Core\Session\AccountInterface $account
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountInterface $account) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->account = $account;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user')
    );
  }
  
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['drupalist_activate_block']['#markup'] = '<p>Your user id is ' . $uid = $this->account->id() . '</p>';

    return $build;
  }
}
