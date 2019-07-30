<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\Docente;
use App\Articulo;
use App\Libro;
use App\Software;
use App\Ponencia;
use App\Fechacierre;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller {

    public function acta() {
        return view('reportes.acta')
                        ->with('location', 'reportes');
    }

    public function acta_pdf($anio, $per) {
        if ($per == 1) {
            $fi = $anio . "-01-01";
            $ff = $anio . "-06-30";
        } else {
            $fi = $anio . "-07-01";
            $ff = $anio . "-12-31";
        }
        $solicitudes = DB::table('solicituds')->whereBetween('fecha', [$fi, $ff])->get();
        $a = null;
        if ($solicitudes !== null) {
            foreach ($solicitudes as $value) {
                $a[] = Solicitud::find($value->id);
            }
        }
        if ($a != null) {
            $sol = null;
            $cont = 1;
            foreach ($a as $i) {
                if ($i->tipo == "LIBRO") {
                    $pro = Libro::where('solicitud_id', $i->id)->first();
                    $fechapubl = $pro->fecha_publicacion;
                } else if ($i->tipo == "SOFTWARE") {
                    $pro = Software::where('solicitud_id', $i->id)->first();
                    $fechapubl = " ";
                } else if ($i->tipo == "PONENCIA") {
                    $pro = Ponencia::where('solicitud_id', $i->id)->first();
                    $fechapubl = $pro->fecha_evento;
                } else {
                    $pro = Articulo::where('solicitud_id', $i->id)->first();
                    $fechapubl = $pro->fechapublicacion;
                }
                if ($i->tipo == "PONENCIA" || $i->tipo == "ARTICULO INDEXADO") {
                    $puntos = $i->puntos_bo;
                } else {
                    $puntos = $i->puntos_ps;
                }
                $obj["num"] = $cont++;
                $obj["docente"] = $i->docente->primer_nombre . " " . $i->docente->segundo_nombre . " " . $i->docente->primer_apellido . " " . $i->docente->segundo_apellido;
                $obj["fundamento"] = $i->tipo . " TITULADO: " . $i->titulo . " FECHA DE PUBLICACIÓN: " . $fechapubl . " AUTORES: " . $i->num_autores;
                $obj["puntos"] = $puntos;
                $sol[] = $obj;
            }
            dd($sol);
            return json_encode($sol);
        } else {
            return "null";
        }
    }

    public function productividad() {
        return view('reportes.productividad')
                        ->with('location', 'reportes');
    }

    public function getSolicitudes($estado, $fi, $ff, $tipo) {
        dd($fi);
    }

}
