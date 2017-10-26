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

    var $quickSearchTypeahead = $('#quick-search-typeahead');
    var initialized = false;
    $quickSearchTypeahead.on("focus", function () {
        if (!initialized) {
            initialized = true;
            var url = $quickSearchTypeahead.attr('data-action');
            $.get(url, {}, function (quickSearchData) {
                $quickSearchTypeahead.typeahead({
                    source: quickSearchData.names,
                    items: 'all',
                    updater: function (item) {
                        // get text to display in quick search box
                        var displayText = item;
                        console.log(item);

                        var trailingEmLoc = displayText.indexOf('<em>');
                        if (trailingEmLoc !== -1) {
                            displayText = displayText.substring(0, trailingEmLoc);
                        }

                        // Track the search
                        _paq.push(['trackSiteSearch', displayText, false, false]);

                        // get URL to go to
                        var itemIndex = quickSearchData.names.indexOf(item);
                        if (itemIndex !== -1) {
                            window.location.href = quickSearchData.urls[itemIndex];
                        }

                        // return display text
                        return $.trim(displayText);
                    }
                });
            });
        }
    });
});
