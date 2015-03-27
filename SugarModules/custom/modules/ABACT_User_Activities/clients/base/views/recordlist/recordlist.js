({
    extendsFrom: 'RecordlistView',

    plugins: [
        'SugarLogic',
        'ReorderableColumns',
        'ListColumnEllipsis',
        'ErrorDecoration',
        //'Editable',
        //'MergeDuplicates',
        'Pagination',
        'LinkedModel'
    ],

    contextEvents: {
        //"list:editall:fire": "toggleEdit",
        //"list:editrow:fire": "editClicked",
        //"list:deleterow:fire": "warnDelete"
    },

    initialize: function(options) {
        this._super("initialize", [options]);

        this.on("render", function() {
            var names = this.$(".dataTable > tbody > tr.single > td[data-type='name'] a");

            /*
            // THIS ONLY WORKS IF "MODULE" COMES BEFORE "PARENT MODULE" IN LIST VIEW. WILL BREAK OTHERWISE. NEED A BETTER SOLUTION ASAP.
            */
            var modules = this.$(".dataTable > tbody > tr.single > td[data-type='enum']:first-of-type div");

            $.each(names, function(index) {
                var name = $(names[index]);
                if(name.attr('href')) {
                    var mod = $(modules[index]);
                    name.attr('href', name.attr('href').replace("ABACT_User_Activities", mod.html().trim()));
                }
            });

            // Hide Create Button
            $("a[name='create_button']").hide();
        });
    }, /*

    _setRowFields: function() {
        this._super("_setRowFields");

        var rows = this.rowFields;
        for (var property in rows) {
            if (rows.hasOwnProperty(property)) {
                if(rows[property] && rows[property][1] && rows[property][1].value && rows[property][2]) {
                    var module = rows[property][1].value[0];
                    module = module.charAt(0).toUpperCase() + module.slice(1); // Capitalize first letter

                    var href = rows[property][2].href;
                    if(href) {
                        this.rowFields[property][2].href = href.replace("ABACT_User_Activities", module);
                    }
                }
            }
        }

        console.log(this);
    }, */

    addActions:function () {
        this._super("addActions");

        this.leftColumns = []
        this.rightColumns = []
    },
})
