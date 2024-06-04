<?php

namespace App\Traits;

use Carbon\Carbon;

trait Common
{

    public function prepareMoneyForDatabase($val)
    {
        return str_replace(',', '.', str_replace('.', '', $val));
    }

    public function sanitizeZipcode($zipcode)
    {
        return str_replace(['.', '-', '_', ' '], '', $zipcode);
    }

    public function sanitizeCpfCnpj($doc)
    {
        return str_replace(['.', '-', '/', ' ', '_'], '', $doc);
    }

    public function sanitizePhone($phone)
    {
        return str_replace(['.', '-', '/', '(', ')', ' ', '+'], '', $phone);
    }

    public function sanitizePercentage($percentage)
    {
        $percentage = str_replace(['%', ' '], '', $percentage);
        return $this->convertMoneyToDatabase($percentage);
    }

    public function cpfIsValid($cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    public function cnpjIsValid($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        if (strlen($cnpj) != 14) {
            return false;
        }

        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    public function cpfCnpjAreValid($cpfCnpj)
    {
        $cpfCnpj = preg_replace('/[^0-9]/is', '', $cpfCnpj);
        if (strlen($cpfCnpj) === 11) {
            return $this->cpfIsValid($cpfCnpj);
        } else {
            return $this->cnpjIsValid($cpfCnpj);
        }
    }


    public function formatName($name)
    {
        $nameParts = explode(' ', $name);
        $formattedName = '';

        foreach ($nameParts as $part) {
            $formattedPart = mb_convert_case($part, MB_CASE_TITLE, 'UTF-8');
            $formattedName .= $formattedPart.' ';
        }

        return trim($formattedName);
    }

    public function formatPhone($phone)
    {
        $phone = preg_replace('/[^a-zA-Z0-9]/', '', $phone);
        $phone = preg_replace('/(\d{2})(\d{2})(\d{5})(\d{4})/', '+$1 ($2) $3-$4', $phone);

        return $phone;
    }

    public function formatPhoneNoDdi($phoneNumber)
    {
        if (strlen($phoneNumber) == 10) {
            $formattedNumber = '('.substr($phoneNumber, 0, 2).') '.substr($phoneNumber, 2, 4).'-'.substr($phoneNumber, 6);
        } elseif (strlen($phoneNumber) == 11) {
            $formattedNumber = '('.substr($phoneNumber, 0, 2).') '.substr($phoneNumber, 2, 5).'-'.substr($phoneNumber, 7);
        } else {
            $formattedNumber = $phoneNumber;
        }

        return $formattedNumber;
    }

    public function formatDateTime($dateTime)
    {
        return Carbon::parse($dateTime)->setTimeZone('America/Sao_Paulo')->format('d/m/Y H:i');
    }

    public function formatDate($dateTime)
    {
        return Carbon::parse($dateTime)->setTimeZone('America/Sao_Paulo')->format('d/m/Y');
    }

    public function formatMoney($money)
    {
        return number_format($money, 2, ',', '.');
    }

    public function formatPercent($money)
    {
        return number_format($money, 2, ',', '.').'%';
    }

    public function convertMoneyToDatabase($money)
    {
        if (is_string($money)) {
            $money = trim($money);
            if (strpos($money, ',') !== false) {
                $money = str_replace(',', '.', str_replace('.', '', $money));
            }

            return (float) $money;
        } elseif (is_numeric($money)) {
            return (float) $money;
        } else {
            if (is_null($money)) {
                return 0;
            }

            if (is_array($money)) {
                foreach ($money as $key => $value) {
                    $money[$key] = $this->convertMoneyToDatabase($value);
                }

                return $money;
            }

            return 0;
        }
    }

    public function format_cpf_cnpj($document)
    {
        $document = preg_replace('/[^0-9]/', '', $document);

        if (strlen($document) === 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '\1.\2.\3-\4', $document);
        } elseif (strlen($document) === 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '\1.\2.\3/\4-\5', $document);
        }

        return $document;
    }

    public function formatZipCode($zipcode)
    {
        return preg_replace('/(\d{5})(\d{3})/', '\1-\2', $zipcode);
    }

    public function makeImageName($custonName = null)
    {
        $letters = 'abcdefghijklmnopqrstuvwxyz0123456789';

        return $custonName.'_'.str_replace(['.', ' '], '', uniqid(rand(), true).substr(str_shuffle($letters), 0, 4)).date('YmdHis');
    }

    public function sanitizeTextToNumber($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }

    public function createDate(string $date, string $format = 'd/m/Y'): string
    {
        $dateFormat = Carbon::createFromFormat($format, $date)->setTimezone('America/Sao_Paulo');

        return $dateFormat->toDateString();
    }

    public function getArrayPermission()
    {
        $json = File::get(resource_path('mocks/permissions_data.json'));
        return json_decode($json);
    }

    public function prepareNameToSave($name)
    {
        if(empty($name)) {
            return null;
        }
        return ucfirst(mb_strtolower($name));
    }
}
