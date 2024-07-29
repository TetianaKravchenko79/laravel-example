let BaseRecord = {
    more: false,
    search: "",

    showMore() {
        let ajaxSetting = {
            method: "get",
            url: "/home",
            data: {
                more: this.more,
            },
            success: function (data) {
                console.log(data.table);

                $(".row.products_row").html(data.table);
            },
            error: function (data) {
                console.log(data.responseText);
            },
        };

        $.ajax(ajaxSetting);
    },

    showSearch() {
        let ajaxSetting = {
            method: "get",
            url: "/home",
            data: {
                more: true,
                search: this.search,
            },
            success: function (data) {
                console.log(data.table);

                $(".row.products_row").html(data.table);
            },
            error: function (data) {
                console.log(data.responseText);
            },
        };

        $.ajax(ajaxSetting);
    },
};
