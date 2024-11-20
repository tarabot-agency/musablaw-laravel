<script>
    $(document).ready(function() {
        var intials = $('#admin-name').text().split(" ");
        var vectorName = '';
        intials.forEach(element => {
            vectorName += element.charAt(0);
        });
        if (vectorName.length >= 2) {
            vectorName = vectorName[0] + vectorName[1];
        } else {
            vectorName = vectorName;
        }
        $('#profileImage').text(vectorName);
    });

    $('#searchInput').on("keypress", "form", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $(this).submit();
        }
    });
</script>
