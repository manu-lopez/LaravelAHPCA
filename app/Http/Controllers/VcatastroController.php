<?php

namespace App\Http\Controllers;
use App\Vcatastro;
use DB;
use App\Fondo;
use App\Municipio;
use App\Provincia;
use App\Serie;
use App\Seccion;
use App\NormasDescripcion;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VcatastroController extends Controller
{
    public function getData()
    {
        $dataset = Vcatastro::orderBy('ID', 'asc')->paginate(10);
        $columns = \Schema::getColumnListing('vcatastros');

        // Datos para los distintos select del modal
        $fondos = Fondo::select('ID','Fondo')->get();
        $secciones = Seccion::select('ID','Seccion')->get();
        $series = Serie::select('ID', 'Serie')->get();
        // $municipios = Municipio::select('ID','Municipio')->where('Provincia', '=', 1)->get();
        $provincias = Provincia::select('ID', 'Provincia')->get();
        $municipios = Municipio::select('ID','Municipio')->get();
        $normasdescripcion = NormasDescripcion::select('ID','Norma')->get();
        return view('catastro', compact(
                                        'dataset',
                                        'columns',
                                        'fondos',
                                        'secciones',
                                        'series',
                                        'provincias',
                                        'municipios',
                                        'normasdescripcion'));
    }

// funcion para pasar los datos al modal
    public function viewmodal($id)
    {
      $columns = \Schema::getColumnListing('vcatastros');
  		$data = Vcatastro::where('ID', '=', $id)->first();
      
      // Datos para los distintos select del modal
      $fondos = Fondo::select('ID','Fondo')->get();
      $secciones = Seccion::select('ID','Seccion')->get();
      $series = Serie::select('ID', 'Serie')->get();
      // $municipios = Municipio::select('ID','Municipio')->where('Provincia', '=', 1)->get();
      $provincias = Provincia::select('ID', 'Provincia')->get();
      $municipios = Municipio::select('ID','Municipio')->get();
      $normasdescripcion = NormasDescripcion::select('ID','Norma')->get();

  		return view('modal.edit', [
                                'data' => $data, 
                                'columns' => $columns, 
                                'fondos' => $fondos,
                                'provincias' => $provincias,
                                'municipios' => $municipios,
                                'series' => $series,
                                'secciones' => $secciones,
                                'normasdescripcion' => $normasdescripcion
      ])->render();
    }

    public function modalAdd(){
      // Datos para los distintos select del modal
      $fondos = Fondo::select('ID','Fondo')->get();
      $secciones = Seccion::select('ID','Seccion')->get();
      $series = Serie::select('ID', 'Serie')->get();
      // $municipios = Municipio::select('ID','Municipio')->where('Provincia', '=', 1)->get();
      $provincias = Provincia::select('ID', 'Provincia')->get();
      $municipios = Municipio::select('ID','Municipio')->get();
      $normasdescripcion = NormasDescripcion::select('ID','Norma')->get();

      return view('modal.add', [
                                'fondos' => $fondos,
                                'provincias' => $provincias,
                                'municipios' => $municipios,
                                'series' => $series,
                                'secciones' => $secciones,
                                'normasdescripcion' => $normasdescripcion
      ])->render();
    }

    //Custom pagination
    //  protected function paginateArray($items, $perPage = 10)
    // {
    //     //Get current page form url e.g. &page=1
    //     $currentPage = LengthAwarePaginator::resolveCurrentPage();

    //     //Slice the collection to get the items to display in current page
    //     $currentPageItems = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();

    //     //Create our paginator and pass it to the view
    //     return new LengthAwarePaginator($currentPageItems, count($items), $perPage);
    // }
    // Funcion para realizar busqueda
    public function search(Request $request)
    {
      $columns = \Schema::getColumnListing('vcatastros');

      $columnabuscar = request('columnforsearch');
      $data = request('data');

      $query = 'SELECT * FROM vcatastros WHERE "'.$columnabuscar.'" like  lower(\'%'.$data.'%\') or sinacentos(lower("'.$columnabuscar.'")) like lower(\'%'.$data.'%\') ORDER BY "ID" ASC';
      $datos = DB::select($query);
      

      //Get current page form url e.g. &page=6
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      //Create a new Laravel collection from the array data
      $coleccion = new Collection($datos);
      //Define how many items we want to be visible in each page
      $perPage = 12;
      //Slice the collection to get the items to display in current page
      $currentPageSearchResults = $coleccion-> slice(($currentPage - 1) * $perPage, $perPage)->all();
      //Create our paginator and pass it to the view
      $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($coleccion), $perPage);
      $paginatedSearchResults->appends($request->except(['page']));
      return view('buscar', ['columns' => $columns, 'datos' => $paginatedSearchResults]);
    }

    public function add()
    {
      $enArchiva = request('EnArchiva');
      $fondo = request('Fondo');
      $seccion = request('Seccion');
      $serie = request('Serie');
      $tipo = request('Tipo');
      $signatura = request('Signatura');
      $titulo = request('Titulo');
      $plano = request('Plano');
      $poligono = request('Poligono');
      $fecha = request('Fecha');
      $fechainicio = request('FechaInicio');
      $fechafin = request('FechaFin');
      $deposito = request('Deposito');
      $provincia = request('Provincia');
      $municipio = request('Municipio');
      $gerencia = request('Gerencia');
      $partidojudicial = request('PartidoJudicial');
      $numeral = request('Numeral');
      $caracteristicasfisicas = request('CaracteristicasFisicas');
      $tamano = request('Tamano');
      $procedencia = request('Procedencia');
      $autor = request('Autor');
      $observaciones = request('Observaciones');
      $fechadescripcion = request('FechaDescripcion');
      $notaarchivero = request('NotaArchivero');
      $normasdescripcion = request('Norma');
      $niveldescripcion = request('NivelDescripcion');
      $instrumentosdescripcion = request('InstrumentosDescripcion');
      $documentacionrelacionada = request('DocumentacionRelacionada');
      $disco = request('Disco');
      $ubicacionmaestro = request('UbicacionMaestro');
      $ubicacioncomprimido = request('UbicacionComprimido');

      $query = 'INSERT INTO public."1-3-5-Catastro"("EnArchiva", "Fondo", "Seccion", "Serie", "Tipo", "Signatura", "Titulo", "Plano", "Poligono", "Fecha", "FechaInicio", "FechaFin", "Deposito", "Provincia", "Municipio", "Gerencia", "PartidoJudicial", "Numeral", "CaracteristicasFisicas", "Tamano", "Procedencia", "Autor", "Observaciones", "FechaDescripcion", "NotaArchivero", "NormasDescripcion", "NivelDescripcion", "InstrumentosDescripcion", "DocumentacionRelacionada", "Disco", "UbicacionMaestro", "UbicacionComprimido") VALUES ('.$this->checkisnull($enArchiva).', '.$this->checkisnull($fondo).', '.$this->checkisnull($seccion).', '.$this->checkisnull($serie).', '.$this->checkisnull($tipo).', '.$this->checkisnull($signatura).', '.$this->checkisnull($titulo).', '.$this->checkisnull($plano).', '.$this->checkisnull($poligono).', '.$this->checkisnull($fecha).', '.$this->checkisnull($fechainicio).', '.$this->checkisnull($fechafin).', '.$this->checkisnull($deposito).', '.$this->checkisnull($provincia).', '.$this->checkisnull($municipio).', '.$this->checkisnull($gerencia).', '.$this->checkisnull($partidojudicial).', '.$this->checkisnull($numeral).', '.$this->checkisnull($caracteristicasfisicas).', '.$this->checkisnull($tamano).', '.$this->checkisnull($procedencia).', '.$this->checkisnull($autor).', '.$this->checkisnull($observaciones).', '.$this->checkisnull($fechadescripcion).', '.$this->checkisnull($notaarchivero).', '.$this->checkisnull($normasdescripcion).', '.$this->checkisnull($niveldescripcion).', '.$this->checkisnull($instrumentosdescripcion).', '.$this->checkisnull($documentacionrelacionada).', '.$this->checkisnull($disco).', '.$this->checkisnull($ubicacionmaestro).', '.$this->checkisnull($ubicacioncomprimido).')';
        // dd($query);
        try{
          $sql = DB::select($query);
        } catch (\PDOException $e){
          dd("ERROR -> ".$e);
        }
    }

    public function updateView()
    {
      $id = (int)request('ID');
      $enArchiva = request('EnArchiva');
      $fondo = request('Fondo');
      $seccion = request('Seccion');
      $serie = request('Serie');
      $tipo = request('Tipo');
      $signatura = request('Signatura');
      $titulo = request('Titulo');
      $plano = request('Plano');
      $poligono = request('Poligono');
      $fecha = request('Fecha');
      $fechainicio = request('FechaInicio');
      $fechafin = request('FechaFin');
      $deposito = request('Deposito');
      $provincia = request('Provincia');
      $municipio = request('Municipio');
      $gerencia = request('Gerencia');
      $partidojudicial = request('PartidoJudicial');
      $numeral = request('Numeral');
      $caracteristicasfisicas = request('CaracteristicasFisicas');
      $tamano = request('Tamano');
      $procedencia = request('Procedencia');
      $autor = request('Autor');
      $observaciones = request('Observaciones');
      $fechadescripcion = request('FechaDescripcion');
      $notaarchivero = request('NotaArchivero');
      $normasdescripcion = request('Norma');
      $niveldescripcion = request('NivelDescripcion');
      $instrumentosdescripcion = request('InstrumentosDescripcion');
      $documentacionrelacionada = request('DocumentacionRelacionada');
      $disco = request('Disco');
      $ubicacionmaestro = request('UbicacionMaestro');
      $ubicacioncomprimido = request('UbicacionComprimido');

      $query = 'SELECT public."updatevcatastro"('.$id.', '.$this->checkisnull($enArchiva).', '.$this->checkisnull($fondo).', '.$this->checkisnull($seccion).', '.$this->checkisnull($serie).', '.$this->checkisnull($tipo).', '.$this->checkisnull($signatura).', '.$this->checkisnull($titulo).', '.$this->checkisnull($plano).', '.$this->checkisnull($poligono).', '.$this->checkisnull($fecha).', '.$this->checkisnull($fechainicio).', '.$this->checkisnull($fechafin).', '.$this->checkisnull($deposito).', '.$this->checkisnull($provincia).', '.$this->checkisnull($municipio).', '.$this->checkisnull($gerencia).', '.$this->checkisnull($partidojudicial).', '.$this->checkisnull($numeral).', '.$this->checkisnull($caracteristicasfisicas).', '.$this->checkisnull($tamano).', '.$this->checkisnull($procedencia).', '.$this->checkisnull($autor).', '.$this->checkisnull($observaciones).', '.$this->checkisnull($fechadescripcion).', '.$this->checkisnull($notaarchivero).', '.$this->checkisnull($normasdescripcion).', '.$this->checkisnull($niveldescripcion).', '.$this->checkisnull($instrumentosdescripcion).', '.$this->checkisnull($documentacionrelacionada).', '.$this->checkisnull($disco).', '.$this->checkisnull($ubicacionmaestro).', '.$this->checkisnull($ubicacioncomprimido).')';
        try{
          $sql = DB::select($query);
          return redirect('/catastro')->with('message', 'Actualizado con exito.');
        } catch (\PDOException $e){
          //mensaje de error de la excepcion
          $message = $e->getMessage();
          //cogemos la parte anterior al mensaje
          $antes = strpos($message, 'ERROR:')+6;
          //cogemos la parte posterior al mensaje
          $context = substr($message, strpos($message, 'CONTEXT:'));
          //Restamos al total de la longitud del mensaje menos el principio, la longitud a partir de context para obtener solo el mensaje del exception 
          $error = (substr($message, $antes, ((strlen($message)-$antes) - strlen($context))));
          return redirect('/catastro')->with('error', 'No se ha podido actualizar -> '.$error);
        }
    }

    // Con esta funcion comprobamos si es nulo y le añadimos null para poder hacer el update
    static function checkisnull($var)
    {
      if ($var === '---') {
        return "null";
      } else {
        return '\''.$var.'\'';
      }
    }
}
