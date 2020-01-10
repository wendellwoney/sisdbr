<?php

namespace Util;

class Funcao
{
    static function formatCnpjCpf($value)
    {
        $cnpj_cpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpj_cpf) === 11) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    static function imageUpload($img, $location)
    {
        $allowedExtension = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $extension = end($extension);
        $fileName = time() . '.' . $extension;

        if (0 === $img['error'] && in_array($extension, $allowedExtension)) {
            move_uploaded_file($img['tmp_name'], $location . $fileName);
            return $fileName;
        }else{
            throw new \Exception('Erro realizar o upload da imagem!');
        }
    }
}