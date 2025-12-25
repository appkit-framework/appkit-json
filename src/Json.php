<?php

namespace AppKit\Json;

use Throwable;

class Json {
    public static function encode($data, $prettyPrint = false) {
        $flags = JSON_PRESERVE_ZERO_FRACTION
               | JSON_UNESCAPED_SLASHES
               | JSON_UNESCAPED_UNICODE
               | JSON_THROW_ON_ERROR;
        if($prettyPrint)
            $flags |= JSON_PRETTY_PRINT;

        try {
            return json_encode($data, $flags);
        } catch(Throwable $e) {
            throw new JsonEncodingException(
                $e -> getMessage(),
                $e -> getCode(),
                $e
            );
        }
    }

    public static function decode($json, $assoc = true) {
        try {
            return json_decode(
                $json,
                $assoc,
                flags: JSON_THROW_ON_ERROR
            );
        } catch(Throwable $e) {
            throw new JsonDecodingException(
                $e -> getMessage(),
                $e -> getCode(),
                $e
            );
        }
    }
}
