{% extends "base.volt" %}
{% block main %}
<div class="row">

    <div class="col-lg-4 col-md-4 col-xs-12">
        <img class="item-image" src="{{ url('static/img/item/' ~ item.image) }}"/>
        
        <div class="widget">
            <p class="widget-title">Regras</p>
            <div class="widget-content">
                <ul class="item-rules">
                    <li>Limite de reservas ativas é <strong>{{ item.maxBookTotal >= 0 ? item.maxBookTotal : 'ilimitado' }}</strong></li>
                    <li>Limite de reservas por usuário é <strong>{{ item.maxBookPerUser >= 0 ? item.maxBookPerUser : 'ilimitado' }}</strong></li>
                    {# <li>Tempo máximo de reserva é {{ item.maxBookPerUser }}</li> #}
                <ul>
            </div>
        </div>
        <div class="section available-items-wrapper">
            {% if item.maxBookTotal > 0 %}
                <p>Reservados</p>
                <span class="available-items">{{ item.getRelated('book').count() }}</span>
            {% endif %}
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-xs-12 ">
        <div class="section">
            <h2 class="item-title">{{ item.title }}</h2>
            <p class="item-description">{{ item.description }}</p>
        </div>
        
        <div class="section">
        {% if !loggedUser.isGuest() %}
            <form method="post" >
            <div class="booking-options-wrapper">
                <div>
                    <span>Início:</span>
                    <input class="control text datetime" type="text" name="datetime-start" value="{{ datetimeStart }}" />
                </div>
                <div>
                    <span>Término:</span>
                    <input class="control text datetime" type="text" name="datetime-end" value="{{ datetimeEnd }}" />
                </div>
            </div>
            <ul id="options" class="menu">
            <li>
                <input type="submit" class="btn btn-green" value="Reservar"/>
            </li>
            {% if loggedUser.isAdmin() %}
            <li>
                <a href="{{ url('item/delete/' ~ item.token) }}" class="btn btn-red"><i class="fa fa-trash" aria-hidden="true"></i> Deletar</a>
                
            </li>
            <li>
                {% if item.isVisible() %}
                    <a href="{{ url('item/hide/' ~ item.token) }}" class="btn"><i class="fa fa-eye" aria-hidden="true"></i> Esconder</a>
                {% else %}
                    <a href="{{ url('item/show/' ~ item.token) }}" class="btn"><i class="fa fa-eye" aria-hidden="true"></i> Mostrar</a>
                {% endif %}
            </li
            {% endif %}
            </ul>
            </form>
            {% else %}
            <p>Faça {{ link_to('signin', 'login') }} para reservar esse item.</p>
            {% endif %}
        </div>
        
    </div>
   
</div>
{% endblock %}