<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles"><i class="zmdi zmdi-balance zmdi-hc-fw"></i> Administración <small>EMPRESA</small></h1>
    </div>
    <p class="lead">Creacion de Grupos de Proyecto y Ante-Proyecto!</p>
</div>

<div class="container-fluid">
    <ul class="breadcrumb breadcrumb-tabs">
        <li>
            <a href="<?php echo SERVERURLL?>group/" class="btn btn-info">
                <i class="zmdi zmdi-plus"></i> &nbsp; NUEVO GRUPO
            </a>
        </li>
        <!--<li>
            <a href="<?php echo SERVERURLL?>grouplist" class="btn btn-success">
                <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE GRUPOS
            </a>
        </li>-->
    </ul>
</div>

<!-- panel datos de los grupos -->
<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS DEL GRUPO</h3>
        </div>
        <div class="panel-body">
            <form>
                <fieldset>
                    <legend><i class="zmdi zmdi-assignment"></i> &nbsp; Datos básicos</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre del Grupo *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="nombre-reg" required="" maxlength="40">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Integrantes</legend>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Usuario de Integrante *</label>
                                    <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,50}" class="form-control" type="text" name="director-reg" required="" maxlength="50">
                                </div>
                            </div>
                         
                            <div class="form-group label-floating">
                                <div class="col-xs-12 col-sm-6">
                                    <label class="control-label">Tipo de Proceso*</label>
                                    <select class="form-control" id="Tipo_pross" name="Tipo_pross">
                                        <option class="control-label" value="Ante-Proyecto">Ante-Proyecto</option>
                                        <option class="control-label" value="Proyecto">Proyecto</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Año *</label>
                                    <input pattern="[0-9]{4,4}" class="form-control" type="text" name="year-reg" required="" maxlength="4">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br>
                <p class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                </p>
            </form>
        </div>
    </div>
</div>