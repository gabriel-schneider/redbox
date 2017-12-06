{% extends "base.volt" %}
{% block main %}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div>
            <ul class="menu">
                <li><a class="btn btn-green" href="{{ url('item/add') }}"><i class="fa fa-plus" aria-hidden="true"></i> Criar Item</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="section">
            <p class="item-title">Últimas reservas feitas no sistema:</p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Item</th>
                        <th>Início</th>
                        <th>Término</th>
                    </tr>
                </thead>
                <tbody>
                {% for book in lastBooks %}
                    <tr>
                        <td>{{ book.getRelated('user').displayName }}</td>
                        <td>{{ book.getRelated('item').title }}</td>
                        <td>{{ book.datetimeStart.format('d/m/Y H:i') }}</td>
                        <td>{{ book.datetimeEnd.format('d/m/Y H:i') }}</td>
                    </tr>
                {% endfor %}
                </tbody>
            </table>
        </div>
    </div>
</div>
{% endblock %}