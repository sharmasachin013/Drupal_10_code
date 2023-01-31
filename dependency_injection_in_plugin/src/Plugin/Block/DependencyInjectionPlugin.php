<?php

namespace Drupal\dependency_injection_in_plugin\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'DependencyInjectionPlugin' block.
 *
 * @Block(
 *  id = "dependency_injection_plugin",
 *  admin_label = @Translation("Dependency injection plugin"),
 * )
 */
class DependencyInjectionPlugin extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Session\AccountProxyInterface definition.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->currentUser = $container->get('current_user');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $build['#theme'] = 'dependency_injection_plugin';
     $build['dependency_injection_plugin']['#markup'] =  '<p>Your user id is ' . $uid = $this->currentUser->id() . '</p>';

    return $build;
  }

}
