<?php

    function getToken() {
        $url = "https://siigonube.siigo.com:50050/connect/token";
        $body = "grant_type=password&username=Empresadeperas\\admin@peras.com&password=siigo2019&scope=WebApi offline_access";
        $ch = curl_init();
        $header = array(
            'Authorization: Basic U2lpZ29XZWI6QUJBMDhCNkEtQjU2Qy00MEE1LTkwQ0YtN0MxRTU0ODkxQjYx',
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_POST, 1);
        try
        {
            $response = curl_exec($ch);
            $response = json_decode($response);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
    }

    function getDevelopers() {
        //$url = "http://localhost:16391/api/v1/Developers/GetAll?namespace=v1";
        $url = "http://localhost:16391/api/v1/Developers/GetAll?namespace=v1";
        $ch = curl_init();
        $header = array(
            'Ocp-Apim-Subscription-Key: a21a8a8413134995b658925143dc87e7',
            'Authorization: '. getToken()
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        try
        {
            $response = curl_exec($ch);
            $response = json_decode($response, true);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
    }

    function getProducts() {
        //$url = "http://localhost:16391/api/v1/Products/GetAll?numberPage=0&namespace=v1";
        $url = "http://siigoapi.azure-api.net/siigo/api/v1/Products/GetAll?numberPage=0&namespace=v1";
        $ch = curl_init();
        $header = array(
            'Ocp-Apim-Subscription-Key: a21a8a8413134995b658925143dc87e7',
            'Authorization: '. getToken()
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        try
        {
            $response = curl_exec($ch);
            $response = json_decode($response, true);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
    }

    function createProduct($product) {
        //$url = "http://localhost:16391/api/v1/Products/Create?namespace=v1";
        $url = "http://siigoapi.azure-api.net/siigo/api/v1/Products/Create?namespace=v1";
        $ch = curl_init();
        $header = array(
            'Ocp-Apim-Subscription-Key: a21a8a8413134995b658925143dc87e7',
            'Authorization: '. getToken(),
            'Content-Type: application/json'
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $product);
        curl_setopt($ch, CURLOPT_POST, 1);
        try
        {
            $response = curl_exec($ch);
            $response = json_decode($response);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
    }

    function deleteProduct($id) {
        //$url = "http://localhost:16391/api/v1/Products/Delete/". $id . "?namespace=v1";
        $url = "http://siigoapi.azure-api.net/siigo/api/v1/Products/Delete/". $id . "?namespace=v1";
        $ch = curl_init();
        $header = array(
            'Ocp-Apim-Subscription-Key: a21a8a8413134995b658925143dc87e7',
            'Authorization: '. getToken()
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        try
        {
            $response = curl_exec($ch);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
    }
?>