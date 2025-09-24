(function () {
    // JS plugin that extends SwaggerUI filtering to include path and operationId, not just tags
    function PathSearchPlugin(system) {
        const Im = system && system.Im;
        return {
            fn: {
                opsFilter: function (taggedOps, filter) {
                    if (!filter || filter === true) return taggedOps;
                    const queryString = String(filter).toLowerCase();
                    return taggedOps
                        .map(function (tagGroup) {
                            const tagOperations = tagGroup.get('operations') || Im.List();
                            const kept = tagOperations.filter(function (tagOperation) {
                                const path = String(tagOperation.get('path') || '').toLowerCase();
                                const operation = tagOperation.get('operation') || Im.Map();
                                const summary = String(operation.get('summary') || '').toLowerCase();
                                const description = String(operation.get('description') || '').toLowerCase();
                                const operationId = String(operation.get('operationId') || '').toLowerCase();
                                const tagsList = operation.get('tags') || Im.List();
                                const tags = String(tagsList.join(' ')).toLowerCase();
                                return path.indexOf(queryString) > -1 || operationId.indexOf(queryString) > -1 ||
                                    summary.indexOf(queryString) > -1 || description.indexOf(queryString) > -1 ||
                                    tags.indexOf(queryString) > -1;
                            });
                            return tagGroup.set('operations', kept);
                        })
                        .filter(function (tagGroup) {
                            const ops = tagGroup.get('operations');
                            return ops && ops.size > 0; // remove empty tags entirely
                        });
                }
            }
        };
    }

    // Some UX enhancements to the SwaggerUI filter functionality
    function setupSwaggerFilterUX() {
        // Try a couple selectors to be resilient across minor UI changes
        const input = document.querySelector('.filter input[placeholder], input.operation-filter-input');
        if (input) {
            // Replace placeholder text with our more accurate text
            input.setAttribute('placeholder', 'Search by plugin, path, or description');
        }

        // Auto-expand/collapse tags based on filter value
        function setTagsOpen(open) {
            // Find all tag headers; clicking toggles open/closed
            const headers = document.querySelectorAll('.opblock-tag');
            var i, header, parent, isOpen;
            for (i = 0; i < headers.length; i++) {
                header = headers[i];
                // parent is usually a .opblock-tag-section; open state marked by .is-open
                parent = header && header.parentNode ? header.parentNode : null;
                isOpen = parent && parent.className && parent.className.indexOf('is-open') > -1;

                if (open && !isOpen) {
                    header.click();
                } else if (!open && isOpen) {
                    header.click();
                }
            }
        }

        // Debounce helper
        function debounce(fn, wait) {
            var t;
            return function () {
                const ctx = this, args = arguments;
                clearTimeout(t);
                t = setTimeout(function () {
                    fn.apply(ctx, args);
                }, wait);
            };
        }

        // Hook filter input
        if (input) {
            const onChange = debounce(function () {
                const val = input.value || '';
                // Expand when there is a query, collapse when cleared
                setTagsOpen(val.replace(/\s+/g, '').length > 0);
            }, 100);

            // Attach to both 'input' and 'keyup' for older browsers
            input.addEventListener ? input.addEventListener('input', onChange, false) : input.attachEvent('onkeyup', onChange);
            input.addEventListener ? input.addEventListener('keyup', onChange, false) : input.attachEvent('onkeyup', onChange);
        }
    }

    // Initialise the SwaggerUI class
    SwaggerUIBundle({
        url: "/openapi/json",
        dom_id: "#swagger-ui",
        layout: "BaseLayout",
        deepLinking: false,
        docExpansion: "none",
        filter: true,
        plugins: [PathSearchPlugin],
        onComplete: function () {
            setupSwaggerFilterUX();
        }
    });
})();