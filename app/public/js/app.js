
function affixSidebar()
{
    var $sidebar = $('#sidebar');

    if ($sidebar && $sidebar.length && getActualSidebarHeight() <= $(window).height()) {
        $sidebar.affix({
            offset: {
                top: 100, bottom: 100
            }
        });
    } else if ($sidebar && $sidebar.length) {
        $sidebar.addClass('expand')
    }
}

function getActualSidebarHeight()
{
    var copiedElement = $('#sidebar').clone().attr('id', false).css({
        visibility: 'hidden', display: 'block', position: 'absolute'
    });

    $('body').append(copiedElement);
    var height = copiedElement.height();
    copiedElement.remove();

    return height;
}

affixSidebar();

$('#sidebar').on('hidden.bs.collapse', function () {
    var $sidebar = $('#sidebar');

    if ($sidebar && $sidebar.length && getActualSidebarHeight() <= $(window).height()) {
        var $affix = $sidebar.data('bs.affix');

        if ($affix) {
            $affix.checkPosition();
        }
    }
});