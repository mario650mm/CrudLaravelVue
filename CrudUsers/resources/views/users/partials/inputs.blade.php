<div class="row">
    <div class="form-group col-sm-6">
        <label for="name">Nombre</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre de usuario" v-model="user.name"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="email">Correo electrónico</label>
        <input type="text" id="email" name="email" class="form-control" placeholder="Correo de usuario" v-model="user.email"/>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label for="password">Contraseña</label>
        <input type="text" id="password" name="password" class="form-control" placeholder="Contraseña de usuario"/>
    </div>
    <div class="form-group col-sm-6">
        <label for="image">Imagen</label>
        <input type="file" id="image" name="image" class="form-control"/>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label for="type">Tipo de usuario</label>
        <select id="type" name="type" class="form-control selectpicker" data-live-search="true" v-model="user.user_type_id">
            <option data-hidden="true">Seleccione un tipo..</option>
            <option v-for="user_type in user_types" :value="user_type.id">@{{user_type.name}}</option>
        </select>
    </div>
</div>