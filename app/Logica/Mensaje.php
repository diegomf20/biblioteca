<?php

namespace App\Logica;


class Mensaje
{
    public static function mostrar()
    {
        if ( session_status() != PHP_SESSION_ACTIVE ) session_start(); //si no hay seccion activada create una 
        if(isset($_SESSION['mensaje-info'])){
            $mensaje=$_SESSION['mensaje-info'];    
            unset($_SESSION['mensaje-info']);
        }else{
            $mensaje="";
        }
        
        return $mensaje;
    }
    
    public static function success($texto){
        $mensaje='<div class="col-12 form-group"><div class="alert desvanecen alert-success alert-dismissible fade show" role="alert">'
                        .$texto.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>'.
                '</div></div>';

        return $mensaje;
    }
    public static function danger($texto){
        $mensaje='<div class="col-12 form-group"><div class="alert desvanecen alert-danger alert-dismissible fade show" role="alert">'
                        .$texto.
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>'.
                    '</div></div>';
        return $mensaje;
    }
    public static function warning($texto){
        $mensaje='<div class="col-12 form-group"><div class="alert desvanecen alert-warning alert-dismissible fade show" role="alert">'
                        .$texto.
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>'.
                    '</div></div>';
        return $mensaje;
    }
    public static function info($texto){
        $mensaje='<div class="col-12 form-group"><div class="alert desvanecen alert-info alert-dismissible fade show" role="alert">'
                        .$texto.
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>'.
                    '</div></div>';
        return $mensaje;
    }
}
