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

var quickSearchData = null;

var $quickSearchTypeahead = $('#quick-search-typeahead>input');
$quickSearchTypeahead.typeahead({
    source: function (query, process) {
        if (quickSearchData) {
            process(quickSearchData.names);
        } else {
            var url = $quickSearchTypeahead.attr('data-action');

            $.get(url, {}, function (data) {
                quickSearchData = data;
                process(quickSearchData.names);
            });
        }
    },
    items: -1,
    updater: function (item) {
        // get text to display in quick search box
        var displayText = item;

        var trailingEmLoc = displayText.indexOf('<em>');
        if (trailingEmLoc != -1) {
            displayText = displayText.substring(0, trailingEmLoc);
        }

        // Track the search
        _paq.push(['trackSiteSearch', displayText, false, false]);

        // get URL to go to
        var itemIndex = quickSearchData.names.indexOf(item);
        if (itemIndex != -1) {
            window.location.href = quickSearchData.urls[itemIndex];
        }

        // return display text
        return $.trim(displayText);
    }
});

});
