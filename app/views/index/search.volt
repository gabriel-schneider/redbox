{% extends "base.volt" %}
{% block main %}
<div class="row col-12" style="margin: 0 auto; flex-direction: column;">
    <div>
        <p>Você procurou por: {{ search }}</p>
    </div>
    <div class="media-wrapper">
    {% for item in page.items %}
        <a href="{{ url("detail/" ~ item.token) }}">
        <div class="media hoverable">
            <div class="media-image">
                <img src="{{ url('static/img/item/' ~ item.image) }}"/>
            </div>
            <div class="media-content">
                <dl>
                    <dt>{{ item.title }}</dt>
                    <dd>{{ item.description }}</dd>
                </dl>
                <span class="item-count">{{ item.getRelated('book').count() }}</span>
            </div>
        </div>
        </a>
    {% endfor %}
    </div>
    {{ partial('pager', ['baseUrl': 'search?search=' ~ search ,'page': page])}}
</div>

{% endblock %}