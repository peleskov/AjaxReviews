<?php

/**
 * The home manager controller for AjaxReviews.
 *
 */
class AjaxReviewsHomeManagerController extends modExtraManagerController
{
    /** @var AjaxReviews $AjaxReviews */
    public $AjaxReviews;


    /**
     *
     */
    public function initialize()
    {
        $this->AjaxReviews = $this->modx->getService('AjaxReviews', 'AjaxReviews', MODX_CORE_PATH . 'components/ajaxreviews/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['ajaxreviews:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ajaxreviews');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->AjaxReviews->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/ajaxreviews.js');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/widgets/ratings.grid.js');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/widgets/ratings.windows.js');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->AjaxReviews->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        AjaxReviews.config = ' . json_encode($this->AjaxReviews->config) . ';
        AjaxReviews.config.connector_url = "' . $this->AjaxReviews->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "ajaxreviews-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="ajaxreviews-panel-home-div"></div>';

        return '';
    }
}