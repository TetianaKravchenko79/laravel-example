$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

var BaseRecord = {
    clearone(id) {
        let ajaxSetting = {
            method: "post", //!!!
            url: "/clearone", //!!!
            data: {
                id: id,
            },
            success: function (data) {
                $(".cart_items_list").html(data.table);
            },
            error: function (data) {
                console.log(data.responseText);

                let answerError = JSON.parse(data.responseText);
                console.log(answerError);

                alert(answerError.message);
            },
        };

        $.ajax(ajaxSetting);
    },
};
