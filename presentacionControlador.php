/*---------- Controlador paginador presentacion ----------*/
        public function paginador_presentacion_controlador(){
               
                $consulta="SELECT * FROM presentacion ORDER BY presentacion_nombre ASC";                

                $conexion = mainModel::conectar();

                $datos = $conexion->query($consulta);

                $datos = $datos->fetchAll();               
                $tabla="";
                ### Cuerpo de la tabla ###
                $tabla.='
                        <table id="table_presentacion" class="table table-dark table-bordered display dt-responsive nowrap" style="width:100%">
                                <thead>
                                        <tr class="text-center roboto-medium">
                                                <th data-priority="3">#</th>
                                                <th data-priority="1">NOMBRE</th>                            
                                                <th data-priority="2">ESTADO</th>
                                                <th>ACTUALIZAR</th>';
                if ($_SESSION['cargo_svi'] == "Administrador" && $_SESSION['id_svi']==1) {
                 $tabla.='                      <th>ELIMINAR</th>';
                }
                 $tabla.=' 
                </tr>
                                </thead>
                                <tbody>
                ';

                        foreach($datos as $rows){
                                $tabla.='
                                        <tr class="text-center" >
                                                <td></td>
                                                <td>'.$rows['presentacion_nombre'].'</td>
                                                <td>'.$rows['presentacion_estado'].'</td>
                                                <td>'.mainModel::enrutador("presentacion_update","btn_update",mainModel::encryption($rows['presentacion_id'])).'</td>';
                                if ($_SESSION['cargo_svi'] == "Administrador" && $_SESSION['id_svi']==1) {
                    $tabla.=' 
                    <td>
                                                        <form class="FormularioAjax" action="'.SERVERURL.'ajax/presentacionAjax.php" method="POST" data-form="delete" autocomplete="off" >
                                                                <input type="hidden" name="presentacion_id_del" value="'.mainModel::encryption($rows['presentacion_id']).'">
                                                                <button type="submit" class="btn btn-warning">
                                                                        <i class="far fa-trash-alt"></i>
                                                                </button>
                                                        </form>
                    </td>';
                                }
                    $tabla.=' 
                </tr>
            ';
                        }
                       
                

                $tabla.='</tbody></table>';
                

                return $tabla;
} /*-- Fin controlador --*/
