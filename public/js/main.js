$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

var BaseRecordForAll = {
    mailer: function (message, contact) {
        var ajaxSetting = {
            method: "post",
            url: "/mailer",
            data: {
                message: message,
                contact: contact,
            },
            success: function (data) {
                console.log(data);

                let dataJson = JSON.parse(data);

                // if (dataJson.mail) {
                //    alert('Your message has been received successfully. Wait our answer soon!');
                // } else {
                //    alert('There is any mistake. Try it later!');
                // }
                if (dataJson.mail) {
                    //alert('Your message has been sending successfully!');
                    swal({
                        title: "Сongratulations!",
                        text: "Your message has been sending successfully!",
                        icon: "success",
                    });
                } else {
                    //...for example in Mail.php 'titl' => ... - //!!!error API
                    //alert('There is any mistake!');
                    swal({
                        title: "Oops!",
                        text: "There is any mistake!",
                        icon: "error",
                    });
                }
            },
            error: function (data) {
                console.log(data.responseText);
            },
        };
        $.ajax(ajaxSetting);
    },
};
