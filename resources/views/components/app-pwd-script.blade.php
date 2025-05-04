<script>
    $('.input-group-text').each(function () {
        $(this).on('click', function () {
            let classname = $(this).children('i').prop('class') === 'fa fa-eye-slash' ? 'fa fa-eye' : 'fa fa-eye-slash';
            $(this).children('i').prop('class', classname);
            let parent = $(this).parent().parent();
            
            let type = parent.children('input').prop('type') == 'password' ? 'text' : 'password';
            parent.children('input').prop('type', type);
        })
    });
</script>