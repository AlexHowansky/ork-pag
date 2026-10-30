$(function() {
    if (window.matchMedia('(min-width: 641px)').matches) {
        $('input[name=search]').focus();
    }
    $(window).on('scroll', function() {
        $('.head').toggleClass('stuck', window.scrollY > 0);
    });
    new ResizeObserver(function() {
        document.documentElement.style.setProperty('--head-height', Math.floor($('.head').outerHeight()) + 'px');
    }).observe($('.head')[0]);
    $('select').change(function() {
        $('#form').submit();
    });
    $('#clear').click(function() {
        $('select').val('');
        $('select[name=numPlayersType]').val('atLeast');
        $('select[name=expansions]').val('0');
        $('input[name=search]').val('');
        $('#form').submit();
    });
    if ($('#table tbody tr[data-game-id]').length > 0) {
        $('#table').DataTable({
            order: [[1, 'asc'], [2, 'desc']],
            paging: false,
            searching: false,
            autoWidth: false,
            info: false,
            layout: {
                topStart: null,
                topEnd: null,
                bottomStart: null,
                bottomEnd: null
            }
        });
    }
    $('table tbody tr[data-game-id]').click(function(event) {
        if ($(event.target).closest('a').length === 0) {
            window.open($(this).find('a').attr('href'));
        }
    });
});
