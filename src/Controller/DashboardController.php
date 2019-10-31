<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\CargaMeta;
use App\Repository\CargaMetaRepository;

use App\Repository\EmpresaRepository;

use App\Repository\TiendaRepository;

use App\Entity\Gastos;
use App\Repository\GastosRepository;

use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Shared_Date;
use PHPExcel_Worksheet;


use App\Repository\TrabajadorRepository;

class DashboardController extends AbstractController
{
    /**
     * @Route("/Dashboard", name="app_dashboard")
     */
    public function index(CargaMetaRepository $cargaMetaRepository, TrabajadorRepository $trabajadorRepository, TiendaRepository $tiendaRepository): Response
    {        
        ini_set('display_errors', 1); 
        error_reporting(~0);
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $usuario = $this->getUser();       
        //dump($usuario);exit;
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'usuario' => $usuario,
            'trabajadors' => $trabajadorRepository->findAll(),
            'cargaMetas' => $cargaMetaRepository->findAll(),
            'tiendas' => $tiendaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/excelCarga", name="app_xls")
     */
    public function excelCarga(CargaMetaRepository $cargaMetaRepository, EmpresaRepository $empresaRepository, TiendaRepository $tiendaRepository)
    {

        // sin limite de tiempo para la carga de datos
        set_time_limit(0);

        // sin limite de memoroia para la carga
        ini_set('memory_limit', '-1');

        /* BUSCA LA RUTA DEL DOCUMENTO */
        $spreadsheet = PHPExcel_IOFactory::load("uploads/xls/Prorrateo Metas Andes 2019 (1).xlsx");

        /* OBTENGO TODOS LOS DATOS DEL XLSX */
        $worksheet = $spreadsheet->getActiveSheet();       
        
        /* MUESTRA LA CANTIDAD MAXIMA DE COLUMNAS  SOLO LA "A" o "DX"*/
        $columnMax = $worksheet->getHighestColumn();

        /* MUESTRA LA CANTIDAD MAXIMA DE FILAS */ 
        $MaxRow = $worksheet->getHighestRow();

        /* MUESTRA EL VALOR DE LA CELDA */ 
        //$cell = $worksheet->getCell();

        /* MUESTRA EL VALOR DE LA CELDA */
        //$cell = $worksheet->getCell('A2')->getValue();

        /* SEPARA LAS COLUMNA EN CADA CELDA */
        //$separar_columnas = explode("\t", $cell);

        /* OBTENGO VALOR DE CADA CELDA $separar_columnas[0] $separar_columnas[1] $separar_columnas[2]*/
        //$separar_columnas[0];
      
        $fechas = array();
        $dias = array();
        $semanas = array();
        $cadenas = array();
        $tiendas = array();
        $metas = array();
        $variables = array();

        $entityManager = $this->getDoctrine()->getManager();
        $lastColumn = $worksheet->getHighestColumn();
        $lastColumn++;
        for($row = 2; $row != $MaxRow; $row++) 
        {   
            for($column = 'A'; $column != $lastColumn; $column++)
            {            
                // valor de la celda
                $cell = $worksheet->getCell($column.''.$row)->getValue();
                
                //// ENTRA SI LA FILA ES 2 Y LA COLUMNA NO ES LAS MARCADAS
                if ($row == 2 AND !in_array($column, array('A','B','C','D','E','F'))) 
                {
                    /// variable para las fechas
                    $date_dia = $cell;

                    /// obtengo fecha
                    $fecha = date('d-m-Y', PHPExcel_Shared_Date::ExcelToPHP($date_dia));
                    //// meto todas las fechas en un array $fechas
                    array_push($fechas,$fecha);

                    /// obtengo dia semana palabra (ejemplo:lunes)
                    $dia = date('l', PHPExcel_Shared_Date::ExcelToPHP($date_dia));
                    //// meto todos los dias en un array $dias
                    array_push($dias,$dia);
                    
                    /// obtengo numero de semana
                    $semana = date('W', PHPExcel_Shared_Date::ExcelToPHP($date_dia));
                    //// meto todas las semanas en un array $semanas
                    array_push($semanas,$semana);
                }

                /// capturar cadena 
                if ($row != 2 AND in_array($column, array('A')))
                {
                    $cadena = $worksheet->getCell('A'.$row)->getValue();
                    array_push($cadenas,$cadena);
                }
                /// capturar tienda
                if ($row != 2 AND in_array($column, array('B')))
                {
                    $tienda = $worksheet->getCell('B'.$row)->getValue();
                    array_push($tiendas,$tienda);
                }
            }/// fin columna
        }//// fin row 
        $count_filas = 0;
        for($row = 3; $row != $MaxRow; $row++) 
        {
            $count_columnas = 0;
            $lastColumn = $worksheet->getHighestColumn();
            $lastColumn++;
            for($column = 'G'; $column != $lastColumn; $column++)
            {   
                if (!in_array($column, array('A','B','C','D','E','F'))) 
                {
                    /// metas
                    $meta = $worksheet->getCell($column.''.$row)->getOldCalculatedValue();
                    array_push($metas,$meta);
                    $count_columnas++;    
                }
            }
        $count_filas++;
        }
        $contador = 0;
        $countNuevo = 0;
        $countExiste = 0;
        $mostrar = array();
        for($filas = 0; $filas != $count_filas; $filas++) 
        {
            for($columnas = 0; $columnas != $count_columnas; $columnas++) 
            {
                $constante = $contador.' '.$cadenas[$filas].' '.$tiendas[$filas].' '.$fechas[$columnas].' '.$dias[$columnas].' '.$semanas[$columnas].' '.$metas[$contador];
                
                /// revisa que exista otra tienda para insertar datos
                if (!is_null($cadenas[$filas])){
                    array_push($variables,$constante);
                    ///busca objeto cadena para insertar
                    $cadenaObj = $empresaRepository->findOneBy(array('name' => $cadenas[$filas]));

                    /// busca objeto tienda para insertar
                    $tiendaObj = $tiendaRepository->findOneBy(array('nombre' => $tiendas[$filas]));
                    
                    /// busca si existe la carga
                    $existe = $cargaMetaRepository->findOneBy(array('cadena' => $cadenaObj, 'tienda' => $tiendaObj, 'fecha' => new \DateTime($fechas[$columnas]) ));
                    
                    if (is_null($existe)){
                        /// insertar carga nueva
                        $carga = new CargaMeta();
                        $carga->setCadena($cadenaObj);
                        $carga->setTienda($tiendaObj);
                        $carga->setFecha(new \DateTime($fechas[$columnas]));
                        $carga->setDiaSemana($dias[$columnas]);
                        $carga->setSemana($semanas[$columnas]);
                        $carga->setMeta($metas[$contador]);
                        $entityManager->persist($carga);
                        $entityManager->flush();
                        $countNuevo++;
                    } else {
                        /// actualiza meta de la carga
                        $existe->setMeta($metas[$contador]);
                        $entityManager->persist($existe);
                        $entityManager->flush();
                        $countExiste++;
                    }
                }
                $contador++;
            } 
        } 
        $mostrar = 'Insert:'.$countNuevo.' Update:'.$countExiste; //.' '.$variables;
        dump($mostrar);exit;
        
    
     }


    /**
     * @Route("/excelGastos", name="app_xls_gastos")
     */
    public function excelGastos(GastosRepository $GastosRepository, EmpresaRepository $empresaRepository, TiendaRepository $tiendaRepository)
    {

        // sin limite de tiempo para la carga de datos
        set_time_limit(0);

        // sin limite de memoroia para la carga
        ini_set('memory_limit', '-1');

        /* BUSCA LA RUTA DEL DOCUMENTO */
        $spreadsheet = PHPExcel_IOFactory::load("uploads/xls/EERR por PDV RiPaJo 2019 Alta EST.xlsx");

        /* OBTENGO TODOS LOS DATOS DEL XLSX */
        $worksheet = $spreadsheet->getActiveSheet();       
        
        /* MUESTRA LA CANTIDAD MAXIMA DE COLUMNAS  SOLO LA "A" o "DX"*/
        $columnMax = $worksheet->getHighestColumn();

        /* MUESTRA LA CANTIDAD MAXIMA DE FILAS */ 
        $MaxRow = $worksheet->getHighestRow();

        /* MUESTRA EL VALOR DE LA CELDA */ 
        //$cell = $worksheet->getCell();

        /* MUESTRA EL VALOR DE LA CELDA */
        //$cell = $worksheet->getCell('A2')->getValue();

        /* SEPARA LAS COLUMNA EN CADA CELDA */
        //$separar_columnas = explode("\t", $cell);

        /* OBTENGO VALOR DE CADA CELDA $separar_columnas[0] $separar_columnas[1] $separar_columnas[2]*/
        //$separar_columnas[0];
      
        $cadenas = array();
        $tiendas = array();
        $cells = array();
        $variables = array();

        $entityManager = $this->getDoctrine()->getManager();
        $lastColumn = $worksheet->getHighestColumn();
        $lastColumn++;
        $contador11 = 0;
        $MaxRow++;
        for($row = 5; $row != $MaxRow; $row++) 
        {   
            for($column = 'A'; $column != $lastColumn; $column++)
            {          
                if (!in_array($column, array('AF','AG','AH','AI','AJ')))
                { 
                    // valor de la celda
                    if (is_null($worksheet->getCell($column.''.$row)->getOldCalculatedValue())){
                        $cell = $worksheet->getCell($column.''.$row)->getValue();
                    } else {
                        $cell = $worksheet->getCell($column.''.$row)->getOldCalculatedValue();
                    }

                    array_push($cells,$cell);

                    /// capturar cadena 
                    if (in_array($column, array('J')))
                    {
                        $cadena = $worksheet->getCell('J'.$row)->getValue();
                        array_push($cadenas,$cadena);
                    }
                    /// capturar tienda
                    if (in_array($column, array('K')))
                    {
                        $tienda = $worksheet->getCell('K'.$row)->getValue();
                        array_push($tiendas,$tienda);
                    }

                    ///busca objeto cadena para insertar
                    //$cadenaObj = $empresaRepository->findOneBy(array('name' => $cadena));
                    /// busca objeto tienda para insertar
                    //$tiendaObj = $tiendaRepository->findOneBy(array('nombre' => $tienda));
                    /// busca si existe la carga
                    //$existe = $GastosRepository->findOneBy(array('cadena' => $cadenaObj, 'tienda' => $tiendaObj ));

                    /// insertar carga nueva si columna es A nuevo gasto para insertar
                    if (in_array($column, array('A')))
                    {
                        $gastos = new Gastos();
                        $gastos->setModeloPdv1($cell);
                    }

                    if (in_array($column, array('B'))){$gastos->setTipoPdv1($cell);}
                    if (in_array($column, array('C'))){$gastos->setPdv1Q($cell);}
                    if (in_array($column, array('D'))){$gastos->setModeloPdv2($cell);}
                    if (in_array($column, array('E'))){$gastos->setTipoPdv2($cell);}
                    if (in_array($column, array('F'))){$gastos->setPdv2Q($cell);}
                    if (in_array($column, array('G'))){$gastos->setSupDiasSe($cell);}
                    if (in_array($column, array('H'))){$gastos->setTipoSupervision($cell);}
                    if (in_array($column, array('I'))){$gastos->setZonaCiudad($cell);}
                    if (in_array($column, array('J'))){$gastos->setCadena($cell);}
                    if (in_array($column, array('K'))){$gastos->setTienda($cell);}
                    if (in_array($column, array('L'))){$gastos->setVentaPromedio($cell);}
                    if (in_array($column, array('M'))){$gastos->setIncrementoVenta($cell);}
                    if (in_array($column, array('N'))){$gastos->setVentaTotal($cell);}
                    if (in_array($column, array('O'))){$gastos->setComisionRetail($cell);}
                    if (in_array($column, array('P'))){$gastos->setMargenTienda($cell);}
                    if (in_array($column, array('Q'))){$gastos->setSupervision($cell);}
                    if (in_array($column, array('R'))){$gastos->setVendedorReposicion01($cell);}
                    if (in_array($column, array('S'))){$gastos->setVendedorReposicion02($cell);}
                    if (in_array($column, array('T'))){$gastos->setBodegaje($cell);}
                    if (in_array($column, array('U'))){$gastos->setPacking($cell);}
                    if (in_array($column, array('V'))){$gastos->setPicking($cell);}
                    if (in_array($column, array('W'))){$gastos->setTransporte($cell);}
                    if (in_array($column, array('X'))){$gastos->setCostoMercaderia($cell);}
                    if (in_array($column, array('Y'))){$gastos->setMerma($cell);}
                    if (in_array($column, array('Z'))){$gastos->setMuebles($cell);}
                    if (in_array($column, array('AA'))){$gastos->setMargenOperacional($cell);}
                    if (in_array($column, array('AB'))){$gastos->setGastosAdministracion($cell);}
                    if (in_array($column, array('AC'))){$gastos->setResultadoActual($cell);}
                    if (in_array($column, array('AD'))){$gastos->setResultadoModelo($cell);}

                    if (in_array($column, array('AE')))
                    {
                        $contador11++;

                        $gastos->setDiferencial($cell);
                        
                        $entityManager->persist($gastos);
                        $entityManager->flush();
                    } /// fin in_array($column, array('AE')

                } /// fin in_array($column, array('AF','AG','AH','AI','AJ')
            }/// fin columna
        }//// fin row 
        dump($column); 
        dump($cells); 
        //$mostrar = 'Insert:'.$countNuevo.' Update:'.$countExiste; //.' '.$variables;
        dump($contador11);exit;

        
    
     }     

    /**
     * @Route("/excelShow", name="app_xls_Show")
     */
    public function excelShow(CargaMetaRepository $cargaMetaRepository, $empresa = 1): Response
    {
        return $this->render('dashboard/excel.html.twig', [
            'cargaMetas' => $cargaMetaRepository->findAll(),
        ]);
    }
}
