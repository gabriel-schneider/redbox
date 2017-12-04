{% extends "base.volt" %}
{% block main %}
<div class="row" style="margin: 0 auto; flex-direction: column;">
    {% if page.total_items <= 0 %}
        <div class="col-12 center-lg">
            <h2>Não há histórico de reservas</h2>
            <p>Todas as reservas que você fizer irão aparecer nesta página</p>
        </div>
    {% else %}
    <div class="col-12">
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
                    <a class="btn btn-link" href="{{ url('item/unbook/' ~ book.id) }}"><i class="fa fa-times" aria-hidden="true"></i></a>
                    {% endif %}
                </div>
            </div>
        {% endfor %}
        </div>
        {{ partial('pager', ['baseUrl': 'user/history' ,'page': page])}}
    </div>
    
    {% endif %}
</div>

{% endblock %}