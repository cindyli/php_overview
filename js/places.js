(function ($) {
    $(document).ready(function () {
        refreshResults = function () {
            $.ajax({
                type: "POST",
                url: "get_places.php",
                dataType: "json",
                success: function (data) {
                    var results = $(".results");
                    var username = $("#username").text();
                    results.empty();
                    
                    $.each(data, function (index, element) {
                        var myrow = "";
                        var deletebutton = "";
                        if (username === element.username) {
                            myrow = "alert-success";
                            deletebutton = "<button class='close pull-left' id='close-" + element.place_id + "'>&times;</button>";
                        }
                        
                        var row = $("<div />").addClass("well " + myrow);
                        var date = $("<div />").addClass("pull-right").html("at " + element.created_date);
                        var deletePart = $("<h3 />").html(deletebutton + "&nbsp;" + element.place_name);
                        row.append(date).append(deletePart).append(" was suggested by " + element.username);
                        results.append(row);
                    });
                }
            });
        };
        
        $('button[id^="close-"]').live("click", function() {
            var id = $(this).attr("id");
            var place_id = parseInt(id.replace("close-", ""));
            
            $.ajax({
                type: "POST",
                url: "delete_place.php",
                data: "id=" + place_id,
                dataType: "json",
                success: function () {
                },
                error: function (xhr) {
                    alert(xhr.responseText);
                }
            });
            
            refreshResults();
        });
    });
    
    // Auto refresh
//    setInterval(function () {
//        refreshResults();
//    }, 3000);
    
})(jQuery);
