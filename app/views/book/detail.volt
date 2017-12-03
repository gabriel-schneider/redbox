{% extends "base.volt" %}
{% block main %}
<div class="row">
    
    <div class="col-lg-4 col-md-4 col-xs-12">
        <img class="item-image" src="{{ url('static/img/item/' ~ item.image) }}"/>
        <div class="section available-items-wrapper">
            {% if item.maxBookTotal > 0 %}
            <p>Reservas:</p><span class="available-items">{{ item.getRelated('book').count() }}</span>
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
            <form method="post">
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
                <a class="btn btn-red"><i class="fa fa-trash" aria-hidden="true"></i> Deletar</a>
                
            </li>
            <li>
                {% if item.isVisible() %}
                    <a href="{{ url('item/' ~ item.token ~ '/hide') }}"class="btn"><i class="fa fa-eye" aria-hidden="true"></i> Esconder</a>
                {% else %}
                    <a href="{{ url('item/' ~ item.token ~ '/show') }}"class="btn"><i class="fa fa-eye" aria-hidden="true"></i> Esconder</a>
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