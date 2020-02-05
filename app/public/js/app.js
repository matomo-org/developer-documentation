$(function () {

$('a').each(function (index, a) {
    var link = $(a).attr('href');

    if (link && 0 === link.indexOf('http')) {
        $(a).attr('target', '_blank');
    }
});

$('.piwik-version-select').on('change', function () {
    location.assign($(this).val());
});

$('.documentation img').each(function (index, img) {
    var imageSrc = $(img).attr('src');

    if (imageSrc) {
        $(img).wrap('<a href="' + imageSrc + '" target="_blank"></a>');
    }
});

$('.documentation table').addClass('table table-striped table-bordered');

    var $quickSearchTypeahead = $('#quick-search-typeahead').find('>input');
    $quickSearchTypeahead.on("focus", function () {
        var url = $quickSearchTypeahead.attr('data-action');
        $.get(url, {}, function (quickSearchData) {
            $quickSearchTypeahead.typeahead({
                source: quickSearchData.names,
                items: 'all',
                displayText: function (item) {
                    // get text to display in quick search box

                    var trailingEmLoc = item.indexOf('<em>');
                    if (trailingEmLoc !== -1) {
                        item = item.substring(0, trailingEmLoc);
                    }
                    // return display text
                    return $.trim(item)
                },
                afterSelect: function (item) {
                    // Track the search
                    _paq.push(['trackSiteSearch', item, false, false]);

                    // get URL to go to
                    var itemIndex = quickSearchData.names.indexOf(item);
                    if (itemIndex !== -1) {
                        window.location.href = quickSearchData.urls[itemIndex];
                    }

                }
            });
        });
    });
});
