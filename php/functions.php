<?php
/**
 * RandomString function generate a random string
 *
 * @param integer $length - is the long of the string
 * @param boolean $uc     - add a case range letters
 * @param boolean $n      - add numbers
 * @param boolean $sc     - add special characters
 * @return void
 */
function RandomString($length=10,$uc=TRUE,$n=FALSE,$sc=FALSE) {

    $source = 'abcdefghijklmnopqrstuvwxyz';
    if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if($n==1) $source .= '1234567890';
    if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
    if($length>0){
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=$length; $i++){
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
 
    }
    return $rstr;

}


/**
 * cleanHTML function that clean a string
 *
 * @param string  $text - Text to clear
 * @return void
 */
function cleanHTML( $text = "" ) {

    $strS = array('<br>','<br />','<br/>');
    $strL = array('');

    $text = str_replace($strS,$strL,$text);

    return $text;

}

/**
 * cleanString function that clean a string
 *
 * @param string  $text - Text to clear
 * @return void
 */
function cleanString( $text="" ) {

    $strS = array('(',')',' ','-','•');
    $strL = array('');

    $text = str_replace($strS,$strL,$text);

    return $text;

}


/**
 * get Configuration json
 *
 * @return void
 */
function getConfig( $sub = NULL ) {

    $file = (!$sub) ? "config.json" : "../config.json" ;
    $jsonStr = file_get_contents( $file );
    $config  = json_decode( $jsonStr );

    return $config;

}


/**
 * validate Actual URL
 */
function validateUrl( $url = NULL ){

    if ( $url == "" ) {

        $url = $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];

    }

    return $url;

}

/**
 * Crea un menu desde la información del config.json
 */
function createMenu( $menu = NULL, $tipo = NULL ) {

    if ( count($menu) > 0 ) {

        $class = ( $menu->class != "" ) ? 'class="'.$menu->class.'" ' : "";
        $id    = ( $menu->id != "" ) ? 'id="'.$menu->id.'" ' : "";
        if ( $tipo == NULL ) {
            $type = ( $menu->type != "list" ) ? $menu->type : "list";
        } else {
            $type = $tipo;
        }
        $menuHTML = "";

        if ( $type != "li" ){

            $menuHTML .= ( $menu->type !== "list" ) ? "<div " : "<ul ";
            $menuHTML .= $class . $id . ">";

        }

        foreach ($menu->items as $key => $item) {

            if ( $type == "list" || $type ="li" ) { 
                $menuHTML .= "<li ";
                if ( $item->class != "" ) { $menuHTML .= 'class="'.$item->class.'"'; }
                $menuHTML .= ">";
            }

            $itemClass = ( $item->itemClass != "" ) ? 'class="'.$item->itemClass.'"' : "";
            $target    = ( $item->target != "" ) ? 'target="'.$item->target.'"' : "";
            $menuHTML .= '<a href="'.$item->url.'" '.$itemClass.' '.$target.'>'.$key.'</a>';

            if ( $type == "list" || $type ="li" ) {
                $menuHTML .= "</li>";
            }
            
        }

        if ( $type != "li" ){
            $menuHTML .= ( $type == "link" ) ? "</div> " : "</ul>";
        }

    }

    return $menuHTML;

}

/**
 * crea un formulario pasando el objeto del mismo a la funcion
 */
function createForm( $form = NULL ){

    if ( $form ) {
        // var_dump($form);
        $action         = ($form->action != "") ? $form->action : "php/process.php";
        $method         = ($form->method != "") ? $form->method : "POST";
        $class          = ($form->class != "") ? $form->class : "";
        $id             = ($form->id != "") ? $form->id : "";
        $containerClass = ($form->containerClass != "") ? $form->containerClass : "";
        $containerId    = ($form->containerId != "") ? $form->containerId : "";
        $attribs        = ($form->attribs != "") ? $form->attribs : "";
        $mailchimpList  = ($form->mailchimpList != "") ? $form->mailchimpList : "";

        $formHTML = '';
        $formHTML .= '<form action="'.$action.'" method="'.$method.'"';
        if ( $class != "" ) { $formHTML .= ' class="' . $class . '"'; }
        if ( $id != "" ) { $formHTML .= ' id="' . $id . '"'; }
        if ( $mailchimpList != "" ) { $formHTML .= ' data-mclist="' . $mailchimpList . '"'; }

        if ( count( $form->attribs ) > 0 ){ $formHTML .= addAttribs($form->attribs); }

        $formHTML .= '>';
        $formHTML .= '<div'; // Container div
        if ( $containerClass != "" ) { $formHTML .= ' class="' . $containerClass . '"'; }
        if ( $containerId != "" ) { $formHTML .= ' id="' . $containerId . '"'; }
        $formHTML .= '>';
 
        // $fields = $form->fields;
        $formHTML .= createField($form->fields);

        if ( $form->errorBox != "" ) { 
            $formHTML .= '<div class="'.$form->errorBox.'">&nbsp;</div>';
        }

        $formHTML .= '</div>';
        $formHTML .= '</form>';
        echo $formHTML;

    }

}

/**
 * Crea campos, recibe un objeto $fields
 */
function createField( $fields ){

    $fieldsHTML = '';
    foreach ($fields as $key => $field) {
        
        $fieldsHTML .= '<div ';
        if ($field->class != "") { $fieldsHTML .= ' class="'.$field->class.'"'; }
        if ($field->id != "") { $fieldsHTML .= ' id="'.$field->id.'"'; }
        $fieldsHTML .= '>';
        $fieldsHTML .= createFieldbyType($field);
        $fieldsHTML .= '</div>';
        
    }

    return $fieldsHTML;

}

/**
 * Crea los campos en base al tipo del mismo
 */
function createFieldbyType( $fieldMain ){

    $fieldHTML = '';
    $field = $fieldMain->attribs;

    switch ($field->type) {
        case 'text':
        case 'email':
        case 'tel':
        case 'date':
        default;

            $placeholder = ($field->required == 1) ? $field->placeholder . " *" : $field->placeholder;

            if ( $field->label ) {
                $fieldHTML .= '<label for="'.$field->id.'">'.$field->label.'</label>';
            }

            $fieldHTML .= '<input type="'.$field->type.'" ';
            $fieldHTML .= 'name="'.$fieldMain->name.'" ';
            $fieldHTML .= ($field->placeholder) ? 'placeholder="'.$placeholder.'" ': '' ;
            $fieldHTML .= ($field->class) ? 'class="'.$field->class.'" ': '' ;
            $fieldHTML .= ($field->id) ? 'id="'.$field->id.'" ': '' ;
            $fieldHTML .= ($field->value) ? 'value="'. replaceValues($field->value).'" ': '' ;
            $fieldHTML .= ($field->required == 1) ? 'required ' : '';
            if ( count( $field->attribs ) > 0 ){ $fieldHTML .= addAttribs($field->attribs); }

            $fieldHTML .= '/>';
            break;
        
        case 'hidden':

            $fieldHTML .= '<input type="'.$field->type.'" ';
            $fieldHTML .= 'name="'.$fieldMain->name.'" ';
            $fieldHTML .= ($field->class) ? 'class="'.$field->class.'" ': '' ;
            $fieldHTML .= ($field->id) ? 'id="'.$field->id.'" ': '' ;
            $fieldHTML .= 'value="'. replaceValues($field->value).'" ';
            if ( count( $field->attribs ) > 0 ){ $fieldHTML .= addAttribs($field->attribs); }
            $fieldHTML .= '/>';
            break;



        case 'select':

            if ( $field->label ) {
                $fieldHTML .= '<label for="'.$field->id.'">'.$field->label.'</label>';
            }

            $fieldHTML .= '<select type="'.$field->type.'" ';
            $fieldHTML .= 'name="'.$fieldMain->name.'" ';
            $fieldHTML .= ($field->class) ? 'class="'.$field->class.'" ': '' ;
            $fieldHTML .= ($field->id) ? 'id="'.$field->id.'" ': '' ;
            if ( count( $field->attribs ) > 0 ){ $fieldHTML .= addAttribs($field->attribs); }
            $fieldHTML .= ($field->required == 1) ? 'required ' : '';
            $fieldHTML .= '>';

            $fieldHTML .= ($field->placeholder) ? '<option value="">'.$field->placeholder.'</option>': '</option>- Selecciona -</option>' ;

            $valores = explode("|",$field->value);

            foreach($valores as $valor) {

                $fieldHTML .= '<option value="';
                $fieldHTML .= str_replace('[*]','',$valor) . '" ';
                if (strpos($valor, '[*]') !== false) {
                    $fieldHTML .= 'selected';
                }
                $fieldHTML .= '>';
                $fieldHTML .= str_replace('[*]','',$valor);
                $fieldHTML .= '</option>';

            }

            $fieldHTML .= '</select>';
    
            break;

        case 'textarea':

            if ( $field->label ) {
                $fieldHTML .= '<label for="'.$field->id.'">'.$field->label.'</label>';
            }

            $placeholder = ($field->required == 1) ? $field->placeholder . " *" : $field->placeholder;
            $fieldHTML .= '<textarea name="'.$fieldMain->name.'" ';
            $fieldHTML .= ($field->placeholder) ? 'placeholder="'.$placeholder.'" ': '' ;
            $fieldHTML .= ($field->class) ? 'class="'.$field->class.'" ': '' ;
            $fieldHTML .= ($field->id) ? 'id="'.$field->id.'" ': '' ;
            $fieldHTML .= ($field->required == 1) ? ' required' : '';
            $fieldHTML .= '>';
            $fieldHTML .= ($field->value) ? 'value="'.$field->value.'" ': '' ;
            $fieldHTML .= '</textarea>';
            
            break;
            
        case 'radio':
        case 'checkbox':
            $fieldHTML .= '<div class="form-check">';
            $fieldHTML .= '<input type="'.$field->type.'" ';
            $fieldHTML .= 'name="'.$fieldMain->name.'" ';
            $fieldHTML .= ($field->placeholder) ? 'placeholder="'.$placeholder.'" ': '' ;
            $fieldHTML .= ($field->class) ? 'class="'.$field->class.'" ': '' ;
            $fieldHTML .= ($field->id) ? 'id="'.$field->id.'" ': '' ;
            $fieldHTML .= ($field->value) ? 'value="'. replaceValues($field->value).'" ': '' ;
            $fieldHTML .= ($field->required == 1) ? 'required ' : '';
            if ( count( $field->attribs ) > 0 ){ $fieldHTML .= addAttribs($field->attribs); }
            $fieldHTML .= '/>';
            if ( $field->label ) {
                $fieldHTML .= '<label class="'.$field->labelClass.'" for="'.$field->id.'">'.$field->label.'</label>';
            }
            $fieldHTML .= '</div>';
            break;

            
        case 'title':
            $tag = ( $field->tag != "" ) ? $field->tag : "p";
            $fieldHTML .= '<'.$tag;
            $fieldHTML .= ( $field->class != "" ) ? ' class="'.$field->class.'" ' : "" ;
            $fieldHTML .= '>';
            $fieldHTML .= $field->value;
            $fieldHTML .= '</' . $tag . '>';
            break;

        case 'submit':
        case 'button':

            $fieldHTML .= '<button type="'.$field->type.'" ';
            $fieldHTML .= 'name="'.$fieldMain->name.'" ';
            $fieldHTML .= ($field->class) ? 'class="'.$field->class.'" ': '' ;
            $fieldHTML .= ($field->id) ? 'id="'.$field->id.'" ': '' ;
            if ( count( $field->attribs ) > 0 ){ $fieldHTML .= addAttribs($field->attribs); }            
            $fieldHTML .= '>';
            $fieldHTML .= ($field->value) ? $field->value : '' ;
            $fieldHTML .= '</button>';
            
    }

    return $fieldHTML;

}

/**
 * Agrega la lista de atributos
 * opcion nokey agrega un atributo sin key
 */
function addAttribs($attribs){

    if ($attribs) {

        $attribsHTML = '';
        foreach ($attribs as $key => $attrib) {

            if ( $key == 'nokey' ){
                
                $attribsHTML .= ' '.replaceValues($attrib).' ';
                
            } else {
                
                $attribsHTML .= $key . '="'.replaceValues($attrib).'"';

            }

        }

        return $attribsHTML;

    }

}

/**
 * replaceValues Reemplaza valores de un string
 * @param string $value Texto a reemplazar
 */
function replaceValues( $value = NULL ) {

    $config = getConfig();
    $arrayBase    = array('[Y]','[NOW]','[TOMORROW]','[company]');
    $arrayReplace = array(date('Y'), date('Y-m-d'),date('Y-m-d', strtotime("+ 1 day")),'<a href="#" target="_blank">'.$config->info->titulo.'</a>');
    $value = str_replace( $arrayBase, $arrayReplace, $value );

    return $value;

}