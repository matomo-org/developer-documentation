
function affixSidebar()
{
    var $sidebar = $('#sidebar');

    if ($sidebar && $sidebar.length && $sidebar.height() <= $(window).height()) {
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
        var $affix = $sidebar.data('bs.affix');

        if ($affix) {
            $affix.checkPosition();
        }
    }
});