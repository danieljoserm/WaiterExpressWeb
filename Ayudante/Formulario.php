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

namespace Ayudante;

class Formulario
{

	public $controles = array();
	
	public function Input($name, $type='text', $clase='form-control', $placeholder='Ingrese la información requerida' ,$required = false, $message = "Este campo es requerido.")
	{
		$input = '<input type="'.$type.'" name="'.$name.'" class="'.$clase.'" placeholder="'.$placeholder.'" data-required="' . ($required ? "true" : "false") . '" data-message="" />';
		$controles[$name] = array($required, $message);
		
		return $input;
	}
	
	public function TextArea($name, $id = 'textarea', $clase='form-control', $rows = 5, $placeholder='Ingrese la información requerida', $required = false, $message = "Este campo es requerido.")
	{
        $textarea = '<textarea name="'.$name.'" class="'.$clase.'" rows="'.$rows.'" id="'.$id.'" placeholder="'.$placeholder.'" data-required="' . ($required ? "true" : "false") . '" data-message=""></textarea>';
		$controles[$name] = array($required, $message);

        return $textarea;
	}
	
	public function ShowError($name)
	{
		return $controles[$name][1];
	}
}
