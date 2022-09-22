AjaxReviews.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        stateful: true,
        stateId: 'ajaxreviews-panel-home',
        stateEvents: ['tabchange'],
        getState: function () { return { activeTab: this.items.indexOf(this.getActiveTab()) }; },
        hideMode: 'offsets',
        items: [{
            html: '<h2>' + _('ajaxreviews') + '</h2>',
            cls: '',
            style: { margin: '15px 0' }
        }, {
            xtype: 'modx-tabs',
            defaults: { border: false, autoHeight: true },
            border: true,
            hideMode: 'offsets',
            items: [{
                title: _('ajaxreviews_items'),
                layout: 'anchor',
                items: [{
                    html: _('ajaxreviews_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'ajaxreviews-grid-items',
                    cls: 'main-wrapper',
                }]
            }, {
                title: _('ajaxreviews_item_rating'),
                layout: 'anchor',
                items: [{
                    html: _('ajaxreviews_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'ajaxreviews-grid-ratings',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    AjaxReviews.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(AjaxReviews.panel.Home, MODx.Panel);
Ext.reg('ajaxreviews-panel-home', AjaxReviews.panel.Home);
