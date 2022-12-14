AjaxReviews.window.CreateRating = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ajaxreviews-rating-window-create';
    }
    Ext.applyIf(config, {
        title: _('ajaxreviews_rating_create'),
        width: 550,
        autoHeight: true,
        url: AjaxReviews.config.connector_url,
        action: 'mgr/rating/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    AjaxReviews.window.CreateRating.superclass.constructor.call(this, config);
};
Ext.extend(AjaxReviews.window.CreateRating, MODx.Window, {

    getFields: function (config) {
        return [{
            layout: 'column',
            border: false,
            anchor: '100%',
            items: [{
                layout: 'form',
                border: false,
                columnWidth: .5,
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('ajaxreviews_item_user_id'),
                    name: 'user_id',
                    id: config.id + '-user_id',
                    anchor: '99%',
                    allowBlank: false,
                }]
            }, {
                layout: 'form',
                border: false,
                columnWidth: .5,
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('ajaxreviews_item_rating'),
                    name: 'rating',
                    id: config.id + '-rating',
                    anchor: '99%',
                    allowBlank: false,
                }]
            }]
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('ajaxreviews-rating-window-create', AjaxReviews.window.CreateRating);


AjaxReviews.window.UpdateRating = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ajaxreviews-rating-window-update';
    }
    Ext.applyIf(config, {
        title: _('ajaxreviews_rating_update'),
        width: 550,
        autoHeight: true,
        url: AjaxReviews.config.connector_url,
        action: 'mgr/rating/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    AjaxReviews.window.UpdateRating.superclass.constructor.call(this, config);
};
Ext.extend(AjaxReviews.window.UpdateRating, MODx.Window, {

    getFields: function (config) {
        return [{
            xtype: 'hidden',
            name: 'id',
            id: config.id + '-id',
        }, {
            layout: 'column',
            border: false,
            anchor: '100%',
            items: [{
                layout: 'form',
                border: false,
                columnWidth: .5,
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('ajaxreviews_item_user_id'),
                    name: 'user_id',
                    id: config.id + '-user_id',
                    anchor: '99%',
                    allowBlank: false,
                }]
            }, {
                layout: 'form',
                border: false,
                columnWidth: .5,
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('ajaxreviews_item_rating'),
                    name: 'rating',
                    id: config.id + '-rating',
                    anchor: '99%',
                    allowBlank: false,
                }]
            }]
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('ajaxreviews-rating-window-update', AjaxReviews.window.UpdateRating);