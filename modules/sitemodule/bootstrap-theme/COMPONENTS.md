All components have to be imported with `{% import "components/_components" as components %}`  
All options can be omitted in the examples below, these are the default values.  
All this components are templates that can also be extended from, see [there](src/templates/front/components)

## Alert

```
{{ components.alert({
    type: 'primary',
    dismissable: true,
    show: true,
    body: ''
}) }}
```

## Badge

```
{{ components.badge({
    color: 'primary',
    body: '',
    pill: false,
    tag: 'span',
    classes: ''
}) }}
```

## Button

`popover` and `tooltip` are both set, popover will be disabled. tag will be forced to 'button' if popover is on.    
`placement` relates to tooltips and popovers.

```
{{ components.button({
    tag: 'a',
    link: false,
    size: 'normal',
    color: 'primary',
    outlined: false,
    newTab: false,
    download: false,
    label: '',
    popover_title: false,  //text/html
    popover_content: false,  //text/html
    tooltip: false,  //text/html
    html_tooltip: false,
    placement: 'right',
    dismiss_popover_on_click: false
}) }}
```

## Modal

```
{{ components.modal({
    static: false,
    fade: true,
    id: null, //Random one will be generated id null
    keyboard: true,
    scrollable: false,
    vcentered: false,
    size: false,
    fullscreen: false,
    title: 'Modal title',
    close_label: 'Close',
    header: false, //false to display a default header, text/html otherwise
    body: null,
    footer: false, //false to display a default footer, text/html otherwise
}) }}
```
Gain more control by extending the template :

```
{% extends 'components/modal' %}

{% set static = false %}

{% block header %}
    <h2>Title</h2>
{% endblock %}

{% block body %}
    <p>Content</p>
{% endblock %}

{% block footer %}
    <p>Footer</p>
{% endblock %}
```

## Nav

```
{{ components.navItem({
    active: false,
    disabled: false,
    toggle: '',   //Overridden by dropdown if set
    dropdown: '', //Can be html
    link: '',
    label: '',
    tag: 'li',
    link_tag: 'a',
    target: '',
    classes: '',
    id: ''
}) }}

{{ components.navItems([]) }} //Array of items as defined above

{{ components.nav({
    alignment: 'start',
    vertical: false,
    tabs: false,
    pills: false,
    fill: false,
    justified: false,
    classes: '',
    tag: 'ul',
    id: '',
    items: '' //Can be used with navItems([]) as described above
}) }}
```

## Offcanvas

```
{{ components.offCanvas({
    position: 'start',
    title: 'Offcanvas',
    id: null, //Random one will be generated if null
    body_scrolling: false,
    body_backdrop: false,
    label_id: null, //Will be equal to id-'label' if not set
    header: false, //false to display a default header, text/html otherwise
    body: null     //text/html
}) }}
```
Gain more control by extending the template :

```
{% extends 'components/offcanvas' %}

{% set position = 'start' %}

{% block header %}
    <h2>Title</h2>
{% endblock %}

{% block body %}
    <p>Content</p>
{% endblock %}
```

## Pagination

```
{{ components.paginationItem({
    label: '',
    link: '#',
    aria_label: false,
    disabled: false,
    active: false
}) }}

{{ components.paginationItems([]) }} //Array of items as defined above

{{ components.pagination({
    alignment: 'start', //start, center or end
    size: false,        //false, sm or lg
    items: ''           //Can be used with paginationItems([]) as described above
}) }}
```

## Progress bar

```
{{ components.progressBar({
    current: 0,
    min: 0,
    max: 100,
    color: 'primary',
    content: '',
    height: false //Any valid css value
}) }}
```

## Spinner

```
{{ components.spinner({
    color: 'primary',
    type: 'border',  //border or grow
    hiddenMessage: 'Loading...',
    small: false,
    classes: '',
}) }}
```

## Toast

```
{{ components.toast({
    fade: true,
    show: true,
    id: null,  //Random one will be generated if null,
    header: false, //false to display a default header, text/html otherwise
    body: null,
    close_label: 'Close'
}) }}
```

## Breadcrumbs

```
{{ components.breadcrumbItem({
    label: '',
    link: '#',
    active: false,
    include_link: true
}) }}

{{ components.breadcrumbItems([]) }} //Array of items as defined above

{{ components.breadcrumbs({
    items: null, //can be used with breadcrumbItems([]) as described above
    divider: false
}) }}
```

## List groups

```
{{ components.listGroupItem({
    disabled: false,
    body: null,
    classes: '',
    tag: 'li'
}) }}

{{ components.listGroupItems([]) }} //Array of items as defined above

{{ components.listGroup({
    flush: false,
    numbered: false,
    horizontal: false,
    tag: 'ul',
    classes: '',
    items: null, //can be used with listGroupItems([]) as described above
}) }}
```

## Dropdowns

```
{{ components.dropdownItem({
    link: '#',
    label: ''
}) }}

{{ components.dropdownItems([]) }} //Array of items as defined above

{{ components.dropdown({
    tag: 'a',
    classes: 'btn btn-primary',
    id: null,   //If null a random one will be generated
    link: '#',
    label: '',
    split: false,
    dark: false,
    drop: false,  //'up', 'start' or 'end'
    splitHiddenMessage: 'Toggle Dropdown',
    items: null, //can be used with dropdownItems([]) as described above
}) }}
```