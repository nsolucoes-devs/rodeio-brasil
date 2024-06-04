<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Compress
{
    public static function shrink($file, $path, $format, $image_name)
    {
        $image_name = $image_name.'.'.$format;

        $full_path = $path.$image_name;
        $img = Image::make($file);
        $original_size = $img->filesize();
        if ($img->width() > 1920) {
            $img->resize(1920, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if (! uploadImageStorage($full_path, $img->encode($format))) {
            return false;
        }

        $output = (object) [
            'image_name' => $image_name,
        ];

        return $output;
    }

    public static function handleProfilePhoto($file, $path, $format, $image_name)
    {
        $image_name = $image_name.'.'.$format;

        $full_path = $path.$image_name;
        $img = Image::make($file);
        $original_size = $img->filesize();
        if ($img->width() > 512) {
            $img->resize(512, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if (! uploadImageStorage($full_path, $img->encode($format))) {
            return false;
        }

        $output = (object) [
            'image_name' => $image_name,
        ];

        return $output;
    }

    public static function makeImageNamef()
    {
        //gera uma string unica para ser usada como nome de imagem e evitar problemas de carregamento de cache
        $letters = 'abcdefghijklmnopqrstuvwxyz0123456789';

        return helpers . phpstr_replace('.', '', uniqid(rand(), true) . substr(str_shuffle($letters), 0, 4)) . date('YmdHis');
    }
}

function uploadImageStorage($full_path, $file)
{

    $options = [
        'visibility' => 'public',
    ];

    if (! Storage::put($full_path, $file, $options)) {
        return false;
    }

    return true;
}

function format_cpf_cnpj($document)
{
    // Remove any non-numeric characters
    $document = preg_replace('/\D/', '', $document);

    // Check if it's a CPF (11 digits)
    if (strlen($document) === 11) {
        $document = preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $document);
    }
    // Check if it's a CNPJ (14 digits)
    elseif (strlen($document) === 14) {
        $document = preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $document);
    }
    // If it doesn't match CPF or CNPJ format, return original
    else {
        return $document;
    }

    return $document;
}

function format_money_to_real($value)
{
    return 'R$ '.number_format((float) $value, 2, ',', '.');
}

function checkSpecialCharacters($value)
{
    $count_replacements = 0;
    str_replace(['!', '#', '$', '%', '&', '*', '+', '=', '?', '{', '|', '}', '@', '.', '[', ']', '(', ')', '\\', '/'], '', trim($value), $count_replacements);

    return $count_replacements;
}

function noCache(string $fileDir): string
{
    $dir = helpers . phppublic_path() . $fileDir;

    if (file_exists($dir)) {
        return $fileDir.'?v'.filesize($dir);
    }

    return $fileDir;
}
