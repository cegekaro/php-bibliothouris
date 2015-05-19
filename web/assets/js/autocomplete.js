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
                url: Routing.generate('bibl.book.api.searchByIsbn'),
                type: "POST",
                dataType: "json",
                data: {
                    "isbn": isbn
                },
                success: function (data) {
                    response(
                        $.map(data, function (item) {
                            return {
                                "label": item["isbn"] + ": "+ item["title"],
                                "value": item["isbn"]
                            }
                        })
                    )
                }
            })
        },
        select: function (event, ui) {
            $("#" + this.elementId).val(ui.item.label);
        }
    })
}

var search = new searchForIsbn("searchButton");
search.initAutocomplete();
