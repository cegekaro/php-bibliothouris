/* Class for searching by isbn to get a certain book */
var searchForIsbn = function (elementId) {
    this.elementId = elementId;
}

searchForIsbn.prototype.initAutocomplete = function () {
    var isbn = $("#" + this.elementId).val();

    $("#" + this.elementId).autocomplete({
        minLength: 3,
        source: function sendRequest(request, response) {
            $.ajax({
                url: "/app_dev.php/api/submitIsbn",
                type: "GET",
                dataType: "json",
                data: {
                    "isbn": isbn
                },
                success: function (data) {
                    response(
                        $.map(data, function (item) {
                            return {
                                "label": item["title"],
                                "value": item["title"]
                            }
                        })
                    )
                }
            })
        },
        select: function (event, ui) {
            $("#" + this.elementId).val(ui.item.label);
            return false;
        }
    })
}

var search = new searchForIsbn("searchButton");
search.initAutocomplete();
