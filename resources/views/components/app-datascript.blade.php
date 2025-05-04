<script src="{{ asset('lib/datatables.net-dt/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/datatables.net-responsive-dt/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/azia.js') }}"></script>
<script>
    $(function() {
        $('.select2').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: "@lang('locale.search')..."
        });
    })
    
    $(function(){
        'use strict'

        $('#order-listing').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: "@lang('locale.search')...",
                sSearch: '',
                lengthMenu: '_MENU_ /page',
            }
        });

        $('#order-listing').each(function() {
            var datatable = $(this);
            // SEARCH - Add the placeholder for Search and Turn this into in-line form control
            var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
            search_input.attr('placeholder', 'Search');
            // search_input.removeClass('form-control-sm');

            // LENGTH - Inline-Form control
            var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
            // length_sel.removeClass('form-control-sm');
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    });
</script> 