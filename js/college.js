window.addEventListener("load", function () {
    var is_interested_images = document.getElementsByClassName("is-interested-image");
    Array.from(is_interested_images).forEach(element => {
        element.addEventListener("click", function (event) {
            $('#interested').click(function(){
                var XHR = new XMLHttpRequest();
                var property_id = event.target.getAttribute("property_id");
                var is_interested_image = document.querySelectorAll(".property-id-" + property_id + " .is-interested-image")[0];
                var interested_user_count = document.querySelectorAll(".property-id-" + property_id + " .interested-user-count")[0];
                is_interested_image.classList.add("far");
                is_interested_image.classList.remove("fas");
                $.ajax({
                    url:'toggle_interested.php?property_id=' + property_id,
                    type: 'POST',
                });
            });
            $('#notinterested').click(function(){
                var XHR = new XMLHttpRequest();
                var property_id = event.target.getAttribute("property_id");
                var is_interested_image = document.querySelectorAll(".property-id-" + property_id + " .is-interested-image")[0];
                var interested_user_count = document.querySelectorAll(".property-id-" + property_id + " .interested-user-count")[0];
                is_interested_image.classList.add("fas");
                is_interested_image.classList.remove("far");
                $.ajax({
                    url:'toggle_interested.php?property_id=' + property_id,
                    type: 'POST',
                });
            });
        });
    });
});