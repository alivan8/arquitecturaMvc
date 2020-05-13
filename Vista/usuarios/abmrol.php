<?php
include_once "../../configuracion.php";
$objControl = new AbmRol();
$listaRol = $objControl->buscar(null);

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administrador de Roles</title>
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/themes/color.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-easyui-1.6.6/demo/demo.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../css/estilos.css" rel="stylesheet">


</head>
<body>
<?php
include_once '../estructura/encabezado.php';
?>
<h2>ABM - Roles</h2>
<p>Seleccione la acci&oacute;n que desea realizar.</p>

<table id="dg" title="Administrador de Roles" class="easyui-datagrid" style="height:500px"
       url="accion/listarrol.php" toolbar="#toolbar" pagination="true"rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
    <tr>
        <th field="idrol" width="10">ID</th>
        <th field="rodescripcion" width="25">Descripcion</th>
    </tr>
    </thead>
</table>
<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo Rol</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Rol</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Baja Rol</a>
</div>

<div id="dlg" class="easyui-dialog" style="width:800px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">

    <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
        <h3>Rol Informacion</h3>
        <div style="margin-bottom:10px">
            <input name="rodescripcion" id="rodescripcion"  class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
        </div>
    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Aceptar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
</div>
<script type="text/javascript">
    var url;
    function newUser(){
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Usuario');
        $('#fm').form('clear');
        url = 'accion/altarol.php';
    }
    function editUser(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
            $('#fm').form('load',row);
            url = 'accion/editarrol.php?accion=mod&idrol='+row.idrol;
        }
    }
    function saveUser(){
        //alert(" Accion");
        $('#fm').form('submit',{
            url: url,
            onSubmit: function(){
                return $(this).form('validate');
            },
            success: function(result){
                var result = eval('('+result+')');
                //alert("Volvio Servidor");
                if (!result.respuesta){
                    $.messager.show({
                        title: 'Error',
                        msg: result.errorMsg
                    });
                } else {

                    $('#dlg').dialog('close');        // close the dialog
                    $('#dg').datagrid('reload');    // reload the user data
                }
            }
        });
    }
    function destroyUser(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $.messager.confirm('Confirm','Seguro que desea eliminar el rol?', function(r){
                if (r){
                    $.post('accion/bajarol.php?idrol='+row.idrol,{idrol:row.id},
                        function(result){
                            if (result.respuesta){

                                $('#dg').datagrid('reload');    // reload the user data
                            } else {
                                $.messager.show({    // show error message
                                    title: 'Error',
                                    msg: result.errorMsg
                                });
                            }
                        },'json');
                }
            });
        }
    }
</script>


<script type="text/javascript" src="../js/jquery-easyui-1.6.6/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-easyui-1.6.6/jquery.easyui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
    });
</script>
<?php

include_once '../estructura/pie.php';


?>
</body>
</html>