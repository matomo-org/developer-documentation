
function affixSidebar()
{
    var $sidebar = $('#sidebar');

    if ($sidebar && $sidebar.length) {
        $sidebar.affix({
            offset: {
                top: 100, bottom: 100
            }
        });
    }
}

affixSidebar();

$('#sidebar').on('hidden.bs.collapse', function () {
    var $sidebar = $('#sidebar');

    if ($sidebar && $sidebar.length) {
        $sidebar.addClass('affix-top').removeClass('affix affix-bottom');
    }
});