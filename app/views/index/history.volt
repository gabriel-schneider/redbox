{% extends "base.volt" %}
{% block main %}
<div class="row col-12" style="margin: 0 auto; flex-direction: column;">
    <div class="media-wrapper">
    {% for book in page.items %}
        {% set item = book.getRelated('Item') %}
        <div class="media">
            <div class="media-image {% if book.isActive() %} featured {% endif %}">
                <img src="{{ url('static/img/item/' ~ item.image) }}"/>
            </div>
            <div class="media-content">
                <dl>
                    <dt>{{ item.title }}</dt>
                    <dd>
                        <p><i class="fa fa-calendar" aria-hidden="true"></i> Inicio: {{ book.datetimeStart.format('d/m/Y \à\s H:i') }}</p>
                        <p><i class="fa fa-calendar" aria-hidden="true"></i> Término: {{ book.datetimeEnd.format('d/m/Y \à\s H:i') }}</p>
                    </dd>
                </dl>
                {% if book.canDelete() %}
                <a class="btn btn-link" href="{{ url('cancel/' ~ book.id) }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                {% endif %}
            </div>
        </div>
    {% endfor %}
    </div>
    {{ partial('pager', ['baseUrl': 'history' ,'page': page])}}
</div>

{% endblock %}