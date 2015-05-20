/* Class for searching by isbn to get a certain book */
var searchForInfo = function (inputId, submitButtonId, searchField) {
    this.inputId = inputId;
    this.submitButtonId = submitButtonId;
    this.searchField = searchField;
}

searchForInfo.prototype.getInsertedInfo = function () {
    var info = $("#" + this.inputId).val();
    return info;
}

searchForInfo.prototype.getSearchField = function () {
    return this.searchField;
}

searchForInfo.prototype.initAutocomplete = function () {
    var self = this;

    $("#" + this.inputId).autocomplete({
        minLength: 3,
        source: function sendRequest(request, response) {
            var valueOfField = {};
            valueOfField[self.getSearchField()] = self.getInsertedInfo();

            $.ajax({
                url: Routing.generate('bibl.book.api.search_by_isbn'),
                type: "POST",
                dataType: "json",
                data: valueOfField,
                success: function (data) {
                    response(
                        $.map(data, function (item) {
                            return {
                                "label": (self.searchField == "isbn") ? item["isbn"] + ": " + item["title"] :
                                item["title"] + ": " + item["isbn"],
                                "value": (self.searchField == "isbn") ? item["isbn"] : item["title"],
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
            $("#" + this.inputId).val(ui.item.label);
        }
    })
}

searchForInfo.prototype.initSubmitButton = function () {
    var self = this;

    $("#" + this.submitButtonId).click(function () {
        var valueOfField = {};
        valueOfField[self.getSearchField()] = self.getInsertedInfo();

        $.ajax({
            url: Routing.generate('bibl.book.book.ajax_render_books'),
            type: "POST",
            data: valueOfField,
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

var search = new searchForInfo("searchIsbnInput", "submitIsbnButton", "isbn");
search.initAutocomplete();
search.initSubmitButton();

var search = new searchForInfo("searchTitleInput", "submitTitleButton", "title");
search.initAutocomplete();
search.initSubmitButton();
