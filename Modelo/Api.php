<?php
/**
 * Copyright (C) 2017 Luis Cortes Juarez
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2017, DevFy
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	DevfyFramework
 * @author	Luis Cortes | DevFy
 * @copyright	Copyright (c) 2017, DevFy. (http://www.devfy.net/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://www.devfy.net
 * @since	Version 1.0.0
 * @filesource
 */

namespace Modelo;
use \Modelo\Conexion as Conexion;
use \Ayudante\Encriptacion as Encriptacion;

class Api
{
    
    private $con;
    private $crypt;
    private $hash;
    private $correo;
    private $clave;
    
    public function __construct()
    {
        $this->con   = new Conexion();
        $this->crypt = new Encriptacion();
    }
    
    public function set($atributo, $contenido)
    {
        $this->$atributo = $contenido;
    }
    
    public function get($atributo)
    {
        return $this->$atributo;
    }
    
    public function Usuarios()
    {
        
        $this->correo = filter_var($this->correo, FILTER_SANITIZE_STRING);
        $datos        = $this->con->ConsultaRetorno("CALL `sp_buscar_usuario`('{$this->correo}');");
        $result       = array();
        while ($row = $datos->fetch_array()) {
            array_push($result, array(
                'Cedula' => $row[0],
                'usuario' => $row[1],
                'avatar' => $row[2],
                'correo' => $row[3],
                'telefono' => $row[4],
                'nombre' => $row[5],
                'apellido' => $row[6],
                'id_rol' => $row[7],
                'rol' => $row[8],
                'token' => $row[9],
                'estado' => $row[10]
            ));
        }
        echo json_encode(array(
            "usuarios" => $result
        ));
    }
    
    public function ComprobarLogin()
    {
        $this->hash  = $this->crypt->encrypt_decrypt('encrypt', $this->clave);
        $this->login = $this->con->ConsultaRetorno("CALL `sp_comprobar_login`('{$this->correo}','{$this->hash}')");
        $this->row   = $this->login->fetch_assoc();
        echo $this->row['login'];
    }
}
?>