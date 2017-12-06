{% extends "base.volt" %}
{% block main %}
<div class="row">

    <div class="col-lg-4 col-md-4 col-xs-12">
        <img class="item-image" src="{{ item.getImageUrl() }}"/>
        
        <div class="widget">
            <p class="widget-title">Regras</p>
            <div class="widget-content">
                <ul class="item-rules">
                    <li>Limite de reservas ativas é <strong>{{ item.maxBookTotal > 0 ? item.maxBookTotal : 'ilimitado' }}</strong></li>
                    <li>Limite de reservas por usuário é <strong>{{ item.maxBookPerUser > 0 ? item.maxBookPerUser : 'ilimitado' }}</strong></li>
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
            <div class="control-group">
            <ul id="options" class="menu">
                <li>
                    <input type="submit" class="btn btn-green" value="Reservar"/>
                </li>
            {% if loggedUser.isAdmin() %}
                <li>
                    <a href="{{ url('item/delete/' ~ item.token) }}" class="btn btn-red"><i class="fa fa-trash" aria-hidden="true"></i> Deletar</a>        
                </li>
                <li>
                    <a href="{{ url('item/edit/' ~ item.token) }}" class="btn"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                </li
            {% endif %}
            </ul>
            </div>
            </form>
        </div>
        <div class="section">
            <p class="item-title">Este item já foi reservado nas seguintes datas:</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Início</th>
                        <th>Término</th>
                    </tr>
                </thead>
                <tbody>
                {% for book in books %}
                    <tr>
                        <td>{{ book.getRelated('user').displayName }}</td>
                        <td>{{ book.datetimeStart.format('d/m/Y H:i') }}</td>
                        <td>{{ book.datetimeEnd.format('d/m/Y H:i') }}</td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
        {% else %}
            <p>Faça {{ link_to('signin', 'login') }} para reservar esse item.</p>
        {% endif %}
        </div>
    </div>
</div>
{% endblock %}