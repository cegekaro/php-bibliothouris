var showFilter = 0;
$(".show-advanced-filtering").click(function () {
    if (showFilter == 1) {
        // means we ve already show the filtering div
        $(".show-advanced-filtering").html("Show advanced filtering");
        $(".filtering-area").fadeOut("slow");
        showFilter = 0;
    }
    else {
        $(".show-advanced-filtering").html("Hide advanced filtering");
        $(".filtering-area").fadeIn("slow");
        showFilter = 1;
    }
})

$(".submit-filter-books").click(function() {
    $.ajax({
        type: "POST",
        url: Routing.generate('bibl.book.book.ajax_render_filtered_books'),
        data: $("#filtering-form").serialize(),
        success: function(data) {
            console.log(data);
            $(".content-table").html(data);
            $(".pagination").hide();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("Status: " + textStatus + "Error: " + errorThrown);
        }
    })
})
