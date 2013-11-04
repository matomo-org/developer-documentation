
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
