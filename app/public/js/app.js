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

    // jqueryui autocpmplete search box
    $.getJSON( "/data/documents", function( data ) {
        var quickSearchData = [];
        for(i in data.names) {
            quickSearchData.push({
                label: data.names[i],
                value: data.urls[i]
            });
        }
        $( "#autocomplete-input" ).autocomplete({
            source: quickSearchData,
            minLength: 2,
            select: function (event, ui) {
                _paq.push(['trackSiteSearch', ui.item, false, false]);
                $('#autocomplete-input').val(ui.item.label);
                window.location.href = ui.item.value;
            },
        });
    });
});
