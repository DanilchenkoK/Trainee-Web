$(document).ready(function() {

    table = $('#user-list').DataTable({
        createdRow: function(row, data) {
            $(row).attr("user", data[0]);
            $(row).click(function() {
                $.ajax({
                    url: "user/" + data[0],
                    type: "post",
                    success: result => {
                        json = jQuery.parseJSON(result);
                        $("#modalLabel").text("Edit User " + json["user"]["id"]);
                        $("form").attr("action", "edit/" + json["user"]["id"]);

                        keys = Object.keys(json["user"]);
                        $("form").find("input").each(function(i) {
                            $(this).val(json["user"][keys[i]]);
                        });

                        datetimeInputsToggle(true);
                        $("#modal").modal("show");
                    }
                })
            });
        }
    });

    $("#add-user").click(function() {
        $("form :input").each(function() {
            $(this).val("");
        })
        $("#modalLabel").text("Add User");
        $("form").attr("action", "add-user");
        datetimeInputsToggle(false);
        $("#modal").modal("show");
    });


    $("form").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            type: "post",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: result => {
                json = jQuery.parseJSON(result);
                if (json["success"] == "update") {
                    keys = Object.keys(json["user"]);
                    $("tr[user='" + json["user"]["id"] + "']>td").each(function(i) {
                        if (keys[i] == "create_date" || keys[i] == "update_date")
                            json["user"][keys[i]] = json["user"][keys[i]].replace("T", " ");
                        $(this).text(json["user"][keys[i]]);
                    });
                    $("#modal").modal("hide");

                } else {
                    table.row.add([
                        json["user"]["id"],
                        json["user"]["first_name"],
                        json["user"]["last_name"],
                        json["user"]["email"],
                        json["user"]["create_date"].replace("T", " "),
                        json["user"]["update_date"],
                    ]).draw();
                    $("#modal").modal("hide");
                }
            }
        })
    })

    $('button[data-dismiss]').each(function() {
        $(this).click(function() {
            $("#modal").modal("hide");
        })
    })

    function datetimeInputsToggle(param) {
        $("input[type='datetime-local']").each(function() {
            $(this).parent().toggle(param);
        })
    }
});