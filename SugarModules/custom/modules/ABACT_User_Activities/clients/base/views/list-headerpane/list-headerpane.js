({
    extendsFrom: 'ListHeaderpaneView',

    initialize: function(options) {
        this._super('initialize', [options]);

        this.$('a[name=create_button]').hide();
    }
})
