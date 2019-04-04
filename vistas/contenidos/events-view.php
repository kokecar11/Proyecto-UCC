<div class="container-fluid">
    <div class="page-header">
        <h1 class="text-titles"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Administración <small>EVENTOS</small></h1>
    </div>
    <p class="lead">Registrar los nuevos Eventos para los Grupos.</p>
</div>

<div class="container-fluid">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO EVENTO</h3>
        </div>
        <div class="panel-body">
            <form >
            <fieldset>
                <legend><i class="zmdi zmdi-calendar"></i> &nbsp;Registra un Evento </legend>
                </fieldset>
                <br>
                
                <fieldset>
               <div id='calendar'></div>
                </fieldset>

                <script>
                    $(document).ready(function(){
                        $('#Eventos_gp').fullcalendar();
                    });
                </script>

                <br>
               <!-- <p class="text-center" style="margin-top: 20px;">
                    <button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
                </p>
                <div class="RespuestaAjax"></div>-->
            </form>
        </div>
    </div>
</div>