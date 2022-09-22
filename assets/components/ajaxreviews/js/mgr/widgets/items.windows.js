AjaxReviews.window.CreateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ajaxreviews-item-window-create';
    }
    Ext.applyIf(config, {
        title: _('ajaxreviews_item_create'),
        width: 550,
        autoHeight: true,
        url: AjaxReviews.config.connector_url,
        action: 'mgr/item/create',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    AjaxReviews.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(AjaxReviews.window.CreateItem, MODx.Window, {

    getFields: function (config) {
        return [{
            layout: 'column',
            border: false,
            anchor: '100%',
            items: [{
                layout: 'form',
                border: false,
                columnWidth: .33,
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('ajaxreviews_item_author_id'),
                    name: 'author_id',
                    id: config.id + '-author_id',
                    anchor: '99%',
                    allowBlank: false,
                }]
            }, {
                layout: 'form',
                border: false,
                columnWidth: .33,
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
                columnWidth: .33,
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('ajaxreviews_item_rating'),
                    name: 'rating',
                    id: config.id + '-rating',
                    anchor: '99%',
                    allowBlank: false,
                }]
            }]
        }, {
            xtype: 'textfield',
            fieldLabel: _('ajaxreviews_item_title'),
            name: 'title',
            id: config.id + '-title',
            anchor: '99%'
        }, {
            xtype: 'textarea',
            fieldLabel: _('ajaxreviews_item_content'),
            name: 'content',
            id: config.id + '-content',
            height: 150,
            anchor: '99%'
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('ajaxreviews_item_active'),
            name: 'active',
            id: config.id + '-active',
            checked: true,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('ajaxreviews-item-window-create', AjaxReviews.window.CreateItem);


AjaxReviews.window.UpdateItem = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'ajaxreviews-item-window-update';
    }
    Ext.applyIf(config, {
        title: _('ajaxreviews_item_update'),
        width: 550,
        autoHeight: true,
        url: AjaxReviews.config.connector_url,
        action: 'mgr/item/update',
        fields: this.getFields(config),
        keys: [{
            key: Ext.EventObject.ENTER, shift: true, fn: function () {
                this.submit()
            }, scope: this
        }]
    });
    AjaxReviews.window.UpdateItem.superclass.constructor.call(this, config);
};
Ext.extend(AjaxReviews.window.UpdateItem, MODx.Window, {

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
                columnWidth: .33,
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('ajaxreviews_item_author_id'),
                    name: 'author_id',
                    id: config.id + '-author_id',
                    anchor: '99%',
                    allowBlank: false,
                }]
            }, {
                layout: 'form',
                border: false,
                columnWidth: .33,
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
                columnWidth: .33,
                items: [{
                    xtype: 'numberfield',
                    fieldLabel: _('ajaxreviews_item_rating'),
                    name: 'rating',
                    id: config.id + '-rating',
                    anchor: '99%',
                    allowBlank: false,
                }]
            }]
        }, {
            xtype: 'textfield',
            fieldLabel: _('ajaxreviews_item_title'),
            name: 'title',
            id: config.id + '-title',
            anchor: '99%'
        }, {
            xtype: 'textarea',
            fieldLabel: _('ajaxreviews_item_content'),
            name: 'content',
            id: config.id + '-content',
            height: 150,
            anchor: '99%'
        }, {
            xtype: 'xcheckbox',
            boxLabel: _('ajaxreviews_item_active'),
            name: 'active',
            id: config.id + '-active',
            checked: true,
        }];
    },

    loadDropZones: function () {
    }

});
Ext.reg('ajaxreviews-item-window-update', AjaxReviews.window.UpdateItem);