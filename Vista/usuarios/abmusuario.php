<?php
include_once "../../configuracion.php";
$objControl = new AbmUsuario();
$listaUsuario = $objControl->buscar(null);
$combo = '<select class="easyui-combobox"  id="idusuario"  name="idusuario" label="Usuario" labelPosition="top" style="width:90%;">
<option></option>';
foreach ($listaUsuario as $objUsuario){
    $combo .='<option value="'.$objUsuario->getIdusuario().'">'.$objUsuario->getUsnombre().':'.$objUsuario->getUspass().'</option>';
}

$combo .='</select>';
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Administrador de Usuarios</title>
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
<h2>ABM - Usuarios</h2>
<p>Seleccione la acci&oacute;n que desea realizar.</p>

<table id="dg" title="Administrador de Usuarios" class="easyui-datagrid" style="width:1200px;height:500px"
    url="accion/listarusuarios.php" toolbar="#toolbar" pagination="true"rownumbers="true" fitColumns="true" singleSelect="true">
            <thead>
            <tr>
            <th field="idusuario" width="10">ID</th>
            <th field="usnombre" width="25">Nombre</th>
            <th field="uspass" width="50">Password</th>
            <th field="usmail" width="25">e-mail</th>
            <th field="usdeshabilitado" width="20">Deshabilitado</th>

            </tr>
            </thead>
            </table>
            <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo Usuario </a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Usuario</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Baja Usuario</a>
            </div>
            
            <div id="dlg" class="easyui-dialog" style="width:800px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
                <h3>Usuario Informacion</h3>
                <div style="margin-bottom:10px">            
                <input name="usnombre" id="usnombre"  class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                <input  name="uspass" id="uspass"  class="easyui-textbox" required="true" label="Password:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                <input  name="usmail" id="usmail"  class="easyui-textbox" type="email"  required="true" label="e-mail:" style="width:100%">
                </div>
                <div style="margin-bottom:10px">
                    <input class="easyui-checkbox" name="usdeshabilitado" id="usdeshabilitado" value="1" label="Des-Habilitar:">
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
                url = 'accion/altausuario.php';
            }
            function editUser(){
                var row = $('#dg').datagrid('getSelected');
                if (row){
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Usuario');
                    $('#fm').form('load',row);
                    url = 'accion/editarusuario.php?accion=mod&idusuario='+row.idusuario;
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
                            $.post('accion/bajausuario.php?idusuario='+row.idusuario,{idusuario:row.id},
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