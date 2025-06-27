{% set  enumber= craft.app.request.getParam('en')  %}
{% set  key= craft.app.request.getParam('key')  %}
{% set expiry = now|date_modify('+30 days') %}
{%if enumber or key%}
{% header "Cache-Control: max-age=" ~ (expiry.timestamp - now.timestamp) %}
{% header "Pragma: cache" %}
{%endif%}
	{%if enumber%}
incrementView({{enumber}})
function incrementView(elementId) {

    // Set view data {{expiry.timestamp - now.timestamp}}
    var data = {
        'id': elementId
    };

    // Append CSRF Token
    data[window.csrfTokenName] = window.csrfTokenValue;

    // Render search results
    $.post(
        '/actions/view-count/increment',
        data,
        function (response) {
            // Handle response
        }
    );

}
{%endif%}
	{%if enumber and key%}
incrementViewKey({{enumber}},"{{key}}")
function incrementViewKey(elementId,key) {

    // Set view data
    var data = {
        'id': elementId,
		'key': key
    };

    // Append CSRF Token
    data[window.csrfTokenName] = window.csrfTokenValue;

    // Render search results
    $.post(
        '/actions/view-count/increment',
        data,
        function (response) {
            // Handle response
        }
    );

}
{%endif%}