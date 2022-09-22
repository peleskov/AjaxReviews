<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var AjaxReviews $AjaxReviews */
$AjaxReviews = $modx->getService('AjaxReviews', 'AjaxReviews', MODX_CORE_PATH . 'components/ajaxreviews/model/');
$modx->lexicon->load('ajaxreviews:default');

// handle request
$corePath = $modx->getOption('ajaxreviews_core_path', null, $modx->getOption('core_path') . 'components/ajaxreviews/');
$path = $modx->getOption('processorsPath', $AjaxReviews->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);