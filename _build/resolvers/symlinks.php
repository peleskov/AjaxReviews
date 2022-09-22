<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/AjaxReviews/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/ajaxreviews')) {
            $cache->deleteTree(
                $dev . 'assets/components/ajaxreviews/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/ajaxreviews/', $dev . 'assets/components/ajaxreviews');
        }
        if (!is_link($dev . 'core/components/ajaxreviews')) {
            $cache->deleteTree(
                $dev . 'core/components/ajaxreviews/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/ajaxreviews/', $dev . 'core/components/ajaxreviews');
        }
    }
}

return true;