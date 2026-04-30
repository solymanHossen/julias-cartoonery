<?php
/**
 * Account navigation.
 */

defined('ABSPATH') || exit;

$items = wc_get_account_menu_items();
$current = function_exists('WC') && WC()->query ? WC()->query->get_current_endpoint() : '';
?>

<nav class="space-y-2" aria-label="<?php esc_attr_e('Account navigation', 'julias-cartoonery'); ?>">
    <?php foreach ($items as $endpoint => $label) :
        $active = ('' === $current && 'dashboard' === $endpoint) || $current === $endpoint;
        ?>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" class="jc-account-tab <?php echo $active ? 'is-active' : ''; ?>" aria-current="<?php echo $active ? 'page' : 'false'; ?>">
            <?php echo wp_kses_post($label); ?>
        </a>
    <?php endforeach; ?>
</nav>
