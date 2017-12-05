{% extends "base.volt" %}
{% block main %}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div>
            <ul class="menu">
                <li><a class="menu-item" href="{{ url('item/add') }}"><i class="fa fa-plus" aria-hidden="true"></i> Item</a></li>
            </ul>
        </div>
    </div>
</div>
{% endblock %}