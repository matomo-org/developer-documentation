
function affixSidebar()
{
    var $sidebar = $('#sidebar');

    if ($sidebar && $sidebar.length && shouldEnableAffix()) {
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

    $('#collapseOne', copiedElement).css({display: 'block', height: 'auto'})

    $('body').append(copiedElement);
    var height = copiedElement.height();
    copiedElement.remove();

    return height;
}

function shouldEnableAffix()
{
    return getActualSidebarHeight() <= $(window).height();
}

affixSidebar();

$('#sidebar').on('hidden.bs.collapse', function () {
    var $sidebar = $('#sidebar');

    if ($sidebar && $sidebar.length && shouldEnableAffix()) {
        var $affix = $sidebar.data('bs.affix');

        if ($affix) {
            $affix.checkPosition();
        }
    }
});