$("#tblLocations").sortable({
    items: 'tr',
    cursor: 'pointer',
    axis: 'y',
    dropOnEmpty: false,
    start: function (e, ui) {
        ui.item.addClass("selected");
    },
    stop: function (e, ui) {
        ui.item.removeClass("selected");
        $(this).find("tr").each(function (index) {
            if (index >= 0) {
                $(this).find("td").eq(0).html(index + 1);
            }
        });
    }
});
