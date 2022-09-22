AjaxReviews.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'ajaxreviews-panel-home',
            renderTo: 'ajaxreviews-panel-home-div'
        }]
    });
    AjaxReviews.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(AjaxReviews.page.Home, MODx.Component);
Ext.reg('ajaxreviews-page-home', AjaxReviews.page.Home);