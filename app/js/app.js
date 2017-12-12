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

    var search = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/data/search?q=%QUERY',
            wildcard: '%QUERY',
            rateLimitWait:0
        }
    });
    var $quickSearchTypeahead = $('#quick-search-typeahead');
    $quickSearchTypeahead.typeahead({
        highlight: true
    }, {
        name: 'search',
        display: 'title',
        source: search,
        limit: 25,
        templates: {
            empty: function (context) {
                //TODO: Maybe track in Piwik
                var div = document.createElement("div");
                div.classList.add("tt-suggestion");
                div.innerText = 'No Results Found';
                $(".tt-dataset").append(div);
            }
        }
    });
    $quickSearchTypeahead.bind('typeahead:select', function (ev, suggestion) {
        console.warn(suggestion.url);
        _paq.push(['trackSiteSearch', suggestion.title, false, false]);
        window.location.href = suggestion.url;
    });
});
