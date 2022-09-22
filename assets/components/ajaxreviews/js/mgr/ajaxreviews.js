var AjaxReviews = function (config) {
    config = config || {};
    AjaxReviews.superclass.constructor.call(this, config);
};
Ext.extend(AjaxReviews, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('ajaxreviews', AjaxReviews);

AjaxReviews = new AjaxReviews();