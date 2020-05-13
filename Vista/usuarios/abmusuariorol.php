<?php
include_once "../../configuracion.php";
$objControl = new AbmUsuariorol();
$listaUsuariorol = $objControl->buscar(null);

$objControlRol = new AbmRol();
$listaRol = $objControlRol->buscar(null);

$objUsu = new AbmUsuario();
$listaUsu = $objUsu -> buscar(null);

$combo = '<select class="easyui-combobox"  id="idusuario"  name="idusuario" labelPosition="top" style="width:90%;">
<option></option>';
foreach ($listaUsu as $obj){
    $combo .='<option value="'.$obj->getIdusuario().'"> ID:'.$obj->getIdusuario().' Usuario: '.$obj->getUsnombre().'</option>';
}
$combo .='</select>';


$comboRol = '<select class="easyui-combobox"  id="idrol"  name="idrol" labelPosition="top" style="width:90%;">
<option></option>';
foreach ($listaRol as $objRol){
        $comboRol .='<option value="'.$objRol->getIdrol().'">'.$objRol->getRodescripcion().'</option>';
}
$comboRol .='</select>';


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administrador los Roles de los Usuarios</title>
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
<h2>ABM - Usuarios y Roles</h2>
<p>Seleccione la acci&oacute;n que desea realizar.</p>

<table id="dg" title="Administrador de roles de usuarios" class="easyui-datagrid" style="height:500px"
       url="accion/listarusuariosrol.php" toolbar="#toolbar" pagination="true"rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
    <tr>
        <th field="idusuario" width="10">ID del Usuario</th>
        <th field="usnombre" width="25">Nombre Usuario</th>
        <th field="idrol" width="10">ID Rol</th>
        <th field="rodescripcion" width="25">Nombre Rol</th>
    </tr>
    </thead>
</table>
<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Agregar Usuario con Rol</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Rol de Usuario</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar Rol de Usuario</a>
</div>

<div id="dlg" class="easyui-dialog" style="width:800px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">

    <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
        <h3>Informacion</h3>

        Usuario: <?php echo $combo; ?>
        Rol:     <?php echo $comboRol; ?>


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
        url = 'accion/altarolusu.php';
    }
    function editUser(){
        var row = $('#dg').datagrid('getSelected');
        if (row){
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
            $('#fm').form('load',row);
            url = 'accion/editarusuariorol.php?accion=mod&idusuario='+row.idusuario;
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
            $.messager.confirm('Confirm','Seguro que desea eliminar el usuario?', function(r){
                if (r){
                    $.post('accion/bajarolusu.php?idusuario='+row.idusuario+'&idrol='+row.idrol,
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