<script>
    $(document).on('ready', function(){
        $('#inputCategory').on('change', function() {
            var $catSelect = $(this);
            $('#inputTag')
                .empty()
                .append(
                    $('#availableTags')
                        .children()
                        .filter(function(){
                            return $(this).data('cat') == $catSelect.val()
                        })
                        .clone()
                )
        });
    });
</script>