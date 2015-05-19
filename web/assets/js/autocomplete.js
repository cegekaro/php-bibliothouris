/* Class for searching by isbn to get a certain book */
var searchForIsbn = function (elementId, submitButtonId) {
    this.elementId = elementId;
    this.submitButtonId = submitButtonId;
}

searchForIsbn.prototype.getInsertedIsbn = function () {
    var isbn = $("#" + this.elementId).val();
    return isbn;
}

searchForIsbn.prototype.initAutocomplete = function () {
    var isbn = this.getInsertedIsbn();

    $("#" + this.elementId).autocomplete({
        minLength: 3,
        source: function sendRequest(request, response) {
            $.ajax({
                url: Routing.generate('bibl.book.api.search_by_isbn'),
                type: "POST",
                dataType: "json",
                data: {
                    "isbn": isbn
                },
                success: function (data) {
                    response(
                        $.map(data, function (item) {
                            return {
                                "label": item["isbn"] + ": " + item["title"],
                                "value": item["isbn"],
                                "title": item["title"],
                                "authorLastName": item["authorLastName"],
                                "authorFirstName": item["authorFirstName"],
                                "id": item["id"],
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

searchForIsbn.prototype.initSubmitButton = function () {
    var self = this;

    $("#" + this.submitButtonId).click(function () {
        var isbn = self.getInsertedIsbn();
        $.ajax({
            url: Routing.generate('bibl.book.book.ajax_render_books'),
            type: "POST",
            data: {
                "isbn": isbn
            },
            success: function (data) {
                // populate the table with all the books
                $(".all-books").html(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus + "Error: " + errorThrown);
            }
        })
    })
}

var search = new searchForIsbn("searchButton", "submitButton");
search.initAutocomplete();
search.initSubmitButton();
