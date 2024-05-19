<?php
   require_once("../config/conexion.php");
   require_once("../models/dashboard.php");

   $DashboardAdmin = new DashboardAdmin();
   $opcion = filter_input(INPUT_POST, 'Opc');


   switch ($opcion) {

    case 'ConsultarPropiedades':
        $Alldata = $DashboardAdmin->get_qtypropiedades();

        $data  ="";
        foreach($Alldata as $row)
        {

            $data = $row["qty_properties"];
        }

        echo $data;
        break;

    case 'ConsultarPropiedadesActivas':
        $Alldata = $DashboardAdmin->get_qtypropiedadesActivas();

        $data  ="";
        foreach($Alldata as $row)
        {

            $data = $row["qty_properties"];
        }

        echo $data;
        break;
    case 'ConsultarPropiedadesArriendo':
        $Alldata = $DashboardAdmin->get_qtypropiedadesArriendo();

        $data  ="";
        foreach($Alldata as $row)
        {

            $data = $row["qty_properties"];
        }

        echo $data;
        break;
        
    case 'ConsultarPropiedadesVenta':
        $Alldata = $DashboardAdmin->get_qtypropiedadesVenta();

        $data  ="";
        foreach($Alldata as $row)
        {

            $data = $row["qty_properties"];
        }

        echo $data;
        break;
    case 'ConsultarUsuarios':
        $Alldata = $DashboardAdmin->get_qtyUsuarios();

        $data  ="";
        foreach($Alldata as $row)
        {

            $data = $row["qty_users"];
        }

        echo $data;
        break;
            
     

    default:
        break;
   }

?>
