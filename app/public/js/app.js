$('a').each(function (index, a) {
    var link = $(a).attr('href');

    if (link && 0 === link.indexOf('http')) {
        $(a).attr('target', '_blank');
    }
});